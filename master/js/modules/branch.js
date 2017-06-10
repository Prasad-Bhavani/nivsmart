app.controller('branchCtrl', function($scope,$http,blockUI,alertService,NgTableParams,$filter,$parse,dataService){

	angular.extend($scope,{
		obj:{},
		submitted:false,
		exist:false,
		states:[],
		cities:[],
		ALERTTIME:3000,
		cityid:''
	});

	$scope.obj.agent="browser";

	angular.extend($scope,{

		subForm:function(formStatus)
		{
			$scope.submitted=true;
			if(formStatus==true)
			{
				TYPE='success';
				if($scope.obj.id)
				{
					LOADMSG='Updating...';
					MSG='Successfully Updated';
				}
				else
				{
					LOADMSG='Adding...';
					MSG='Successfully Added';
				}
				blockUI.start(LOADMSG);
				$scope.obj.agent="browser";
					dataService.getData('/ws/addBranch',$scope.obj).then(function(response){
				data=response.data;
					blockUI.stop();
					if(data.status!=0)
					{
						$scope.obj={};
						$scope.submitted=false;
						$scope.branches=angular.copy(data.recs);
						alertService.add(TYPE, MSG, $scope.ALERTTIME);
					}
					else
					{
						$scope.obj.exist=true;
						alertService.add('danger', 'Branch Already Exists', $scope.ALERTTIME);
					}
				});
			}
		},
		getBranches:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getBranches',{agent:"browser",status:1}).then(function(response){
				data=response.data;
				$scope.branches=angular.copy(data);
				angular.forEach($scope.branches,function(val,key){
					$scope.branches[key].sno=key+1;
				});
				$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: $scope.branches});
				blockUI.stop();
			});
		},
		getCities:function(state_id)
		{
			if(state_id==undefined) $scope.cities={};
			$scope.obj.city_id='';
			if(state_id)
			{
				blockUI.start('Please Wait...');
					data.getData('/ws/getCitiesByStateId',{agent:"browser",state_id:state_id,status:1}).then(function(response){
				response=response.data;
					$scope.cities=angular.copy(data);
					blockUI.stop();
				});
			}
		},
		getStates:function()
		{
			if($scope.obj.id) msg='Updating...'; else msg='Adding...';
			blockUI.start(msg);
				dataService.getData('/ws/getStates',{agent:"browser",status:1}).then(function(response){
				data=response.data;
				$scope.states=angular.copy(data);
				blockUI.stop();
			});
		},
		getBranch:function(branchid)
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getBranch',{agent:"browser",id:branchid}).then(function(response){
				response=response.data;
				$scope.obj=angular.copy(response.branch);
				$scope.cities=angular.copy(response.cities);
				blockUI.stop();
			});
		},
		changeBranchStatus:function(branchId,status)
		{
			$scope.submitted=false;
			$scope.obj={};
			if(status==undefined) status=0;
			blockUI.start('Please Wait...');
				dataService.getData('/ws/changeBranchStatus',{agent:"browser",id:branchId,status:status}).then(function(response){
				response=response.data;
				if(response)
				{
					$scope.branches=angular.copy(response);
					alertService.add('success', 'Successfully Updated', $scope.ALERTTIME);
					blockUI.stop();
				}
			});
		},
		resetForm:function()
		{
			$scope.submitted=false;
			$scope.obj=false;
		}
	});
	$scope.getStates();
	$scope.getBranches();
});