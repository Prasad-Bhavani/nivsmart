app.controller('branchSelection', function($scope,$http,blockUI,alertService,dataService){

	var self = this;

	angular.extend($scope,{
		lead:{},
		submitted:false,
		ALERTTIME:3000
	});

	$scope.lead.agent="browser";

	angular.extend($scope,{

		selectBranch:function(id,samepage)
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/goBranch',{agent:"browser",id:id}).then(function(response){
				response=response.data;
				if(response=='0')
				{
					location.href='../index.php';
				}
				else
				if(response==1)
				{
					alertService.add('danger', 'You are unable to Login This Branch', $scope.ALERTTIME);					
				}
				else
				{		
					if(samepage==true) location.href="?";
					else location.href="dashboard.php";
				}
			blockUI.stop();
			});
		}
	});
});