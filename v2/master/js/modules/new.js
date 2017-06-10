app.controller('stateCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse){

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
				$http({
					method:'post',
					url: HOST+"/ws/addState",
					data:$scope.obj,
					headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				})
				.success(function(data){
					blockUI.stop();
					if(data.status!=0)
					{
						$scope.obj={};
						$scope.submitted=false;
						if(data.recs!=0) $scope.states=angular.copy(data.recs); else $scope.states=[];
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
			$http({
				method:'post',
				url: HOST+"/ws/getStates",
				data:{agent:"browser"},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(response){
				var temp=JSON.stringify(response);
				console.log(temp);
				$scope.temp1=temp;
				self.tableParams = new NgTableParams({count: 10}, {counts: [],dataset: temp});	self.tableParams.reload();
				blockUI.stop();
			});
		},
		getState:function(stateId)
		{
			blockUI.start('Please Wait...');
			$http({
				method:'post',
				url: HOST+"/ws/getState",
				data:{agent:"browser",id:stateId},
				headers:{'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(response){
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
			$http({
				method:'post',
				url: HOST+"/ws/changeStateStatus",
				data:{agent:"browser",id:stateId,status:status},
				headers:{'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(response){
				if(response)
				{
					$scope.states=angular.copy(response);
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