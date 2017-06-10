app.controller('leadsReportCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		lead:{},
		submitted:false,
		isLeadView:false,
		isLeads:true
	});

	$scope.lead.agent="browser";
	$scope.business=CONSTANTS.NATUREOFBUSINESS;
	$scope.domainbusiness=CONSTANTS.DOMAINOFBUSINESS;
	$scope.prospecttype=CONSTANTS.PROSPECTTYPE;
	$scope.sources=CONSTANTS.LEADSOURCE;
	$scope.LEADSTATUS=CONSTANTS.LEADSTATUS;
	$scope.DEPT=CONSTANTS.DEPT;

	angular.extend($scope,{
		getMovedLeads:function()
		{
			blockUI.start('Please Wait..');
			dataService.getData('/ws/getMovedLeads',{agent:"browser"}).then(function(response){
					recs=response.data;
					console.log(recs);
					if(recs!='0')
					{
						$scope.leads=recs;
					}
					$scope.isLeads=true;
					$scope.isLeadView=false;
					blockUI.stop();
			});
		},
		getLead:function(id,status)
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getViewLead',{agent:"browser",id:id}).then(function(response){
				data=response.data;
				console.log(data);
				if(data!='')
				{
					$scope.leadrec=data;
					$scope.isLeads=false;
					$scope.isLeadView=true;
					$scope.page='$scope.isLeads';
				}
			});
			blockUI.stop();
		},
		getEMPIDNAME:function(id)
		{
			dataService.getData('/ws/getEMPIDNAME',{agent:"browser",id:id}).then(function(response){
				data=response.data;
				console.log(data);
				if(data!='')
				{
					$scope.leadrec=data;
					$scope.isLeads=false;
					$scope.isLeadView=true;
					$scope.page='$scope.isLeads';
				}
			});
		},
		goBack:function(page)
		{
			$scope.isLeadView=false;
			$scope.isLeads=true;
		}
	});
	
	$scope.getMovedLeads();
});