app.controller('profileCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,dataService){

	var self = this;

	angular.extend($scope,{
		profile:{}
	});

	angular.extend($scope,{

		getEMPProfile:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getEMPProfile',{agent:"browser"}).then(function(response){
				response=response.data;
				$scope.profile=response.profile;
				$scope.branches=response.branches;
			});
			blockUI.stop();
		}
	});
	$scope.getEMPProfile();
});