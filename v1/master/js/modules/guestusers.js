app.controller('guestUserCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,dataService){

	var self = this;

	angular.extend($scope,{
		obj:{},
		submitted:false,
		exist:false,
		users:[]
	});

	$scope.obj.agent="browser";

	angular.extend($scope,{

		getGuestUsers:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getGuestUsers',{agent:"browser"}).then(function(response){
				response=response.data;
				angular.forEach(response,function(val,key){
					response[key].sno=key+1;
					if(val.if_tally==1) response[key].if_tally='Yes'; else response[key].if_tally='No';
					response[key].created_date_time=$filter('date')(new Date(val.created_date_time),'dd-MMM-yyyy');
				});
				$scope.users=response;
				blockUI.stop();
				$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: $scope.users});
			});
		}
	});
	$scope.getGuestUsers();
});