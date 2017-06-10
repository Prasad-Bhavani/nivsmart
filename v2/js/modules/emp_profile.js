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
		},
		getTeamsTargets:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getTeamsTargetsbyPeriod',{agent:"browser"}).then(function(response){
				$scope.teamsTargets=response.data.recs;
				$scope.targetPeriod=response.data.rec;
			blockUI.stop();
			});
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
	$scope.getEMPProfile();
	$scope.getTeamsTargets();
});