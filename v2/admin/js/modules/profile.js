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
				if(response.data)
				$scope.profile=response.data.profile;
				$scope.branches=response.data.branches;
				blockUI.stop();
				console.log(response);
			});
		}
	});
	$scope.getEMPProfile();
});