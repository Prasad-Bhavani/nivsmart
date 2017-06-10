app.controller('employeeCtrl', function($scope,$http,blockUI,$rootScope,alertService,$filter,NgTableParams,CONSTANTS,$location,dataService){

	var self = this;

	angular.extend($scope,{
		obj:{},
		submitted:false,
		exist:false,
		states:[],
		msg:'',
		ALERTTIME:3000,
		selected:{},
		emp_branch_ids:'',
		multibranch:0,
		branchshow:false,
		branchMSG:false,
		EMProle:'',
		EMPS:true
	});

	$scope.obj.agent="browser";
	pid=$location.search().id;

	angular.extend($scope,{
		checkBranchCount:function(branchid)
		{
			selectedBranches=[];
			angular.forEach($scope.selected.branch, function(val,key){
				if(val==true) selectedBranches.push(key);
			});
			
			$scope.branchesCount=selectedBranches.length;
		},
		subForm:function(formStatus)
		{
				$scope.submitted=true;
				selectedBranches=[];
				redirect=false;

				angular.forEach($scope.selected.branch, function(val,key){
					if(val==true) selectedBranches.push(key);
					$scope.branchids=selectedBranches.join();
				});
				
				$scope.branchesCount=selectedBranches.length;

				if($scope.multibranch==1)
				{
					$scope.obj.emp_branch_ids=$scope.branchids+',';
				}
				else $scope.obj.emp_branch_ids=1;
				console.log(formStatus);
				if(formStatus && $scope.branchesCount!=0)
				{
					TYPE='success';
					if($scope.obj.emp_id)
					{
						LOADMSG='Updating...';
						MSG='Successfully Updated';
						redirect=true;
					}
					else
					{
						LOADMSG='Creating...';
						MSG='Successfully Created';
					}
					blockUI.start(LOADMSG);
					$scope.obj.agent="browser";
						dataService.getData('/ws/createEMP',$scope.obj).then(function(response){
						data=response.data;
						console.log(data);
						blockUI.stop();
						if(data.status==0)
						{
							$scope.obj.exist=true;
							alertService.add('danger', 'Error Occured Please Try Again', $scope.ALERTTIME);
						}
						else
						if(data.status==2)
						{
							$scope.obj.exist=true;
							alertService.add('danger', 'Email Already Exist', $scope.ALERTTIME);
						}
						else
						{
							$scope.obj={};
							$scope.selected={};
							$scope.submitted=false;
							$scope.branchshow=false;
							alertService.add(TYPE, MSG, $scope.ALERTTIME);
							if(redirect) window.location='employees.php';
						}
					});
				}
		},
		getCities:function(state_id)
		{
			if(state_id==undefined) $scope.cities={};
			$scope.obj.emp_city_id='';
			if(state_id)
			{
				blockUI.start('Please Wait...');
					dataService.getData('/ws/getCitiesByStateId',{agent:"browser",state_id:state_id,status:1}).then(function(response){
					data=response.data;
					$scope.cities=angular.copy(data);
					blockUI.stop();
				});
			}
		},
		getActiveBranchesByRoles:function(deptid,roleid)
		{
			$scope.selected={};
			if(pid!=undefined) pid=pid; else pid='';
				dataService.getData('/ws/getActiveBranchesByRoles',{agent:"browser",deptid:deptid,roleid:roleid,status:1,pid:pid}).then(function(response){
				data=response.data;
				if(data.recs==0)
				{
					$scope.branchMSG=true;
					$scope.EMProle=angular.copy(data.role);
				}
				else
				{
					$scope.branchMSG=false;
					$scope.EMProle='';
				}
				$scope.branches=angular.copy(data.recs);
				$scope.multibranch=angular.copy(data.rec.multiple_branches);
				$scope.branchshow=true;
			});
		},
		getStates:function()
		{
				dataService.getData('/ws/getStates',{agent:"browser",status:1}).then(function(response){
				data=response.data;
				$scope.states=angular.copy(data);
			});
		},
		getDepartments:function()
		{
				dataService.getData('/ws/getDepartments',{agent:"browser",status:1}).then(function(response){
				data=response.data;
				$scope.departments=angular.copy(data);
			});
		},
		getEmpRolesByDeptID:function(dept_id)
		{
			$scope.emp_role_id='';
			$scope.branchshow=false;
			if(dept_id!=undefined)
			{
				blockUI.start('Please Wait...');
					dataService.getData('/ws/getEmpRolesByDeptID',{agent:"browser",status:1,dept_id:dept_id}).then(function(response){
					data=response.data;
					$scope.roles=angular.copy(data);
					$scope.obj.emp_role_id='';
					blockUI.stop();
				});	
			}
			else $scope.roles={};
		},
		getEMPS:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getEMPS',{agent:"browser",status:1}).then(function(response){
				data=response.data;
				$scope.emps=angular.copy(data);
				angular.forEach($scope.emps,function(val,key){
					$scope.emps[key].sno=key+1;
				});
				$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: $scope.emps});
				$scope.EMP=false;
				$scope.EMPS=true;
			});
			blockUI.stop();
		},
		changeEMPStatus:function(empId,status)
		{
			$scope.submitted=false;
			$scope.obj={};
			if(status==undefined) status=0;
			blockUI.start('Please Wait...');
				dataService.getData('/ws/changeEMPStatus',{agent:"browser",id:empId,status:status}).then(function(response){
				response=response.data;
				if(response)
				{
					$scope.emps=angular.copy(response);
					alertService.add('success', 'Successfully Updated', $scope.ALERTTIME);
					$scope.EMP=false;
					$scope.EMPS=true;
					blockUI.stop();
				}
			});
		},
		resetForm:function()
		{
			$scope.submitted=false;
			$scope.obj=false;
			$scope.selected={};
			$scope.multibranch=0;
			$scope.emp_branch_ids='Main Branch';
			$scope.branchshow=false;
			$scope.branchMSG=false;
		},
		getBack:function()
		{
			$scope.EMP=false;
			$scope.EMPS=true;
		},
		getEMPProfile:function(empid)
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getEMPProfile',{agent:"browser",empid:empid}).then(function(response){
				response=response.data;
				$scope.profile=response.profile;
				$scope.branches=response.branches;
				$scope.EMP=true;
				$scope.EMPS=false;
				blockUI.stop();
			});
		},
		getEMPforEdit:function(empid)
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getEMPforEdit',{agent:"browser",empid:empid}).then(function(response){
				response=response.data;
				if(response!=0)
				{
					$scope.selected.branch={};
					$scope.obj=response.emp;
					$scope.roles=response.roles;
					$scope.cities=response.cities;
					$scope.branches=response.branches;
					$scope.not_allow=response.not_allow;
					angular.forEach(response.branches,function(val,key){
						if($scope.obj.emp_branch_ids.indexOf(val.id+',')>=0)
						{
							$scope.selected.branch[val.id]=true;
						}
					});
					$scope.branchshow=true;
					$scope.multibranch=angular.copy(response.count);
				}
				blockUI.stop();
			});
		}
	});
	$scope.getStates();
	$scope.getDepartments();
	$scope.getEMPS();
	if(pid!=undefined && pid!='') $scope.getEMPforEdit(pid);
});