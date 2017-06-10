app.controller('leadsReportCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		lead:{},
		submitted:false,
		states:[],
		isLeads:true,
		isLeadView:false,
		backup:{},
		isEntry:false,
		onCheck:false
	});

	leadhistory=[];
	$scope.lead.agent="browser";
	$scope.business=CONSTANTS.NATUREOFBUSINESS;
	$scope.domainbusiness=CONSTANTS.DOMAINOFBUSINESS;
	$scope.prospecttype=CONSTANTS.PROSPECTTYPE;
	$scope.LEADSTATUS=CONSTANTS.LEADSTATUS;
	$scope.sources=CONSTANTS.LEADSOURCE;
	$scope.DEPT=CONSTANTS.DEPT;
	$scope.lead.source_from=0;
	$scope.count=1;

	angular.extend($scope,{
		getLeadFields:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getLeadFields',{}).then(function(response){
				response=angular.copy(response.data);
				$scope.states=response.states;
				$scope.prospectTypes=response.products;
				$scope.branches=response.branches;
			blockUI.stop();
			});
		},
		getSESSIONVariable:function()
		{
			dataService.getData('/ws/getSESSIONVariable',{}).then(function(response){
				recs=angular.copy(response.data);
				if(recs!='')
				{
					$scope.lead_branch_id=recs.sbranchid;
					$scope.lead.lead_branch_id=$scope.lead_branch_id;
					$scope.sroleid=recs.sroleid;
				}
			});
		},
		getLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getLeadsReport',{}).then(function(response){
				recs=angular.copy(response.data);
				console.log(recs);
				if(recs!='0')
				{
					recs=$filter('customLabels')(recs,$scope.LEADSTATUS);
					$scope.leads=recs;
            		$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
					$scope.isLeads=true;
					$scope.isLeadView=false;
				}
				else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
			blockUI.stop();
			});
		},
		getStatusCount:function(id)
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getStatusCount',{}).then(function(response){
				recs=angular.copy(response.data);
				console.log(recs);
				if(recs!='0')
				{
					$scope.count=recs;
					$scope.isLeads=true;
					$scope.isLeadView=false;
				}
			blockUI.stop();
			});
		},
		getLead:function(id,status)
		{
			$scope.count=1;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getViewLead',{agent:"browser",id:id,status:status}).then(function(response){
				data=response.data;
				console.log(data);
				if(data.rec)
				{
					$scope.leadrec=data.rec;
					$scope.historylen=data.len;
					$scope.quotdetails=data.quotation;
					$scope.customersno=data.customersno;
					$scope.monthlyfollowup=data.monthlyfollowup;
					if(data.quotation!=0) $scope.quotation=$filter('getquotationarray')(data.quotation.prospect_details_id,data.quotation.rate,data.quotation.quantity);
					$scope.leadhistory={};
					$scope.isLeads=false;
					$scope.isLeadView=true;
				}
			});
			blockUI.stop();
		},
		getViewMoreHistory:function(leadid)
		{
			console.log($scope.count);
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getViewMoreHistory',{agent:'browser',leadid:leadid,count:$scope.count}).then(function(response){
				res=response.data;
				if(res!='')
				{
					 [].push.apply($scope.leadhistory, res);
				}
			$scope.count=$scope.count+5;
			});
			blockUI.stop();
		},
		goBack:function(page)
		{
			$scope.isLeadView=false;
			$scope.isLeads=true;
		}
	});
	$scope.getLeadFields();
	$scope.getSESSIONVariable();
	$scope.getLeads();
	$scope.getStatusCount();
});