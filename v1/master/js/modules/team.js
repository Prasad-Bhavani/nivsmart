app.controller('teamCtrl', function($scope,$http,blockUI,alertService,NgTableParams,$filter,$parse,dataService){

	angular.extend($scope,{
		obj:{},
		target:{},
		submitted:false,
		targetSubmit:false,
		ifGenerate:false,
		ALERTTIME:3000
	});

	$scope.obj.agent="browser";
	$scope.months=['January','February','March','April','May','June','July','August','September','October','November','December'];
	$scope.presentMonth=new Date().getMonth();

	angular.extend($scope,{
		subTargetForm:function(formStatus)
		{
			$scope.targetSubmit=true;
			if(formStatus)
			{
				$scope.ifGenerate=true;
				var period=$scope.target.period;
			}
		},
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
				console.log($scope.obj);
					dataService.getData('/ws/addTeam',$scope.obj).then(function(response){
				data=response.data;
					blockUI.stop();
					if(data==2)
					{
						$scope.obj.exist=true;
						alertService.add('danger', 'City Already Exists', $scope.ALERTTIME);
					}
					else
					{
						$scope.obj={};
						$scope.submitted=false;
						if(data!=0)
						{
							angular.forEach(data,function(val,key){
								data[key].sno=key+1;
							});
							$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: data});
						}
						else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: {}});
						alertService.add(TYPE, MSG, $scope.ALERTTIME);
					}
				});
			}
		},
		getTeams:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getTeams',{agent:"browser"}).then(function(response){
				data=response.data;
				console.log(data);
				$scope.teams={};
				if(data!=0)
				{
					angular.forEach(data,function(val,key){
						data[key].sno=key+1;
					});
					$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: data});
					$scope.teams=data;
				}
				else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: {}});
				blockUI.stop();
			});
		},
		getTeam:function(teamId)
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getTeam',{agent:"browser",id:teamId}).then(function(response){
				response=response.data;
				console.log(response);
				$scope.obj=angular.copy(response);
				blockUI.stop();
			});
		},
		changeTeamStatus:function(teamId,status)
		{
			$scope.submitted=false;
			$scope.obj={};
			if(status==undefined) status=0;
			blockUI.start('Please Wait...');
				dataService.getData('/ws/changeTeamStatus',{agent:"browser",id:teamId,status:status}).then(function(response){
				response=response.data;
				if(response)
				{
					if(response!=0)
					{
						angular.forEach(response,function(val,key){
							response[key].sno=key+1;
						});
						$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: response});
					}
					else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: {}});
					blockUI.stop();
					alertService.add('success', 'Successfully Updated', $scope.ALERTTIME);
				}
			});
		},
		resetForm:function()
		{
			$scope.submitted=false;
			$scope.obj=false;
			$scope.targetSubmit=false;
			$scope.target={};
			$scope.ifGenerate=false;
		}
	});
	$scope.getTeams();
});