app.controller('stateCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,dataService){

	var self = this;

	angular.extend($scope,{
		obj:{},
		submitted:false,
		exist:false,
		states:[],
		msg:'',
		ALERTTIME:3000
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
					dataService.getData('/ws/addState',$scope.obj).then(function(response){
				data=response.data;
					blockUI.stop();
					if(data.status!=0)
					{
						$scope.obj={};
						$scope.submitted=false;
						angular.forEach(data.recs,function(val,key){
							data.recs[key].sno=key+1;
						});
						$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: data.recs});
						alertService.add(TYPE, MSG, $scope.ALERTTIME);
					}
					else
					{
						$scope.obj.exist=true;
						alertService.add('danger', 'State Already Exists', $scope.ALERTTIME);
					}
				});
			}
		},
		getStates:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getStates',{agent:"browser"}).then(function(response){
				response=response.data;
				$scope.states=response;
				blockUI.stop();
				angular.forEach($scope.states,function(val,key){
					$scope.states[key].sno=key+1;
				});
				$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: $scope.states});
			});
		},
		getState:function(stateId)
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getState',{agent:"browser",id:stateId}).then(function(response){
				response=response.data;
				$scope.obj=angular.copy(response);
				blockUI.stop();
			});
		},
		changeStateStatus:function(stateId,status)
		{
			$scope.submitted=false;
			$scope.obj={};
			if(status==undefined) status=0;
			blockUI.start('Please Wait...');
				dataService.getData('/ws/changeStateStatus',{agent:"browser",id:stateId,status:status}).then(function(response){
				response=response.data;
				if(response)
				{
					$scope.states=angular.copy(response);
					angular.forEach($scope.states,function(val,key){
						$scope.states[key].sno=key+1;
					});
					$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: $scope.states});
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
});