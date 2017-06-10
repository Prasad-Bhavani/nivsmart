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

	angular.extend($scope,{
		getEMPS:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getEMPS',{agent:"browser",status:1}).then(function(response){
				data=response.data;
				if(data!=0)
				{
					$scope.emps=angular.copy(data);
					angular.forEach($scope.emps,function(val,key){
						$scope.emps[key].sno=key+1;
					});
					$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: $scope.emps});
				}
				else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
				$scope.EMP=false;
				$scope.EMPS=true;
			});
			blockUI.stop();
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
		}
	});
	$scope.getEMPS();
});