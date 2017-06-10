app.controller('cityCtrl', function($scope,$http,blockUI,alertService,NgTableParams,$filter,$parse,dataService){

	angular.extend($scope,{
		obj:{},
		submitted:false,
		exist:false,
		states:[],
		cities:[],
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
					dataService.getData('/ws/addCity',$scope.obj).then(function(response){
				data=response.data;
					blockUI.stop();
					if(data.status!=0)
					{
						$scope.obj={};
						$scope.submitted=false;
						if(data.recs!=0)
						{
							angular.forEach(data.recs,function(val,key){
								data.recs[key].sno=key+1;
							});
							$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: data.recs});
						}
						else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: {}});
						alertService.add(TYPE, MSG, $scope.ALERTTIME);
					}
					else
					{
						$scope.obj.exist=true;
						alertService.add('danger', 'City Already Exists', $scope.ALERTTIME);
					}
				});
			}
		},
		getCities:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getCities',{agent:"browser"}).then(function(response){
				data=response.data;
				if(data!=0)
				{
					angular.forEach(data,function(val,key){
						data[key].sno=key+1;
					});
					$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: data});
				}
				else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: {}});
				blockUI.stop();
			});
		},
		getStates:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getStates',{agent:"browser",status:1}).then(function(response){
				data=response.data;
				if(data!=0) $scope.states=angular.copy(data); else $scope.states=[];
				blockUI.stop();
			});
		},
		getCity:function(cityId)
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getCity',{agent:"browser",id:cityId}).then(function(response){
				response=response.data;
				console.log(response);
				$scope.obj=angular.copy(response);
				blockUI.stop();
			});
		},
		changeCityStatus:function(cityId,status)
		{
			$scope.submitted=false;
			$scope.obj={};
			if(status==undefined) status=0;
			blockUI.start('Please Wait...');
				dataService.getData('/ws/changeCityStatus',{agent:"browser",id:cityId,status:status}).then(function(response){
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
					$scope.cities=angular.copy(response);
					blockUI.stop();
					alertService.add('success', 'Successfully Updated', $scope.ALERTTIME);
				}
			});
		},
		resetForm:function()
		{
			$scope.submitted=false;
			$scope.obj=false;
		}
	});
	$scope.getCities();
	$scope.getStates();
});