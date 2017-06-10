app.controller('EMPAttendanceCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,dataService){

	var self = this;

	angular.extend($scope,{
		recs:{},
		obj:{}
	});

	$scope.obj.agent="browser";

	angular.extend($scope,{

		getEMPAttendance:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getEMPAttendance',{agent:"browser"}).then(function(response){
				response=response.data;
				console.log(response);
				if(response!=0)
				{
					angular.forEach(response,function(val,key){
						response[key].sno=key+1;
						response[key].attend=$filter('splitData')(val,'*');
					});
					$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: response});			
				}
				else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
			blockUI.stop();
			});
		}
	});
	$scope.getEMPAttendance();
});