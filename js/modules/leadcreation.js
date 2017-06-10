app.controller('leadCreationCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		lead:{},
		submitted:false,
		states:[],
		isLeads:true,
		isLeadView:false,
		backup:{},
		isEntry:false,
		onCheck:false,
		isSearch:false,
		search:{},
		searched:false
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
	$scope.search.lead_branch_id='';

	angular.extend($scope,{
		subForm:function(formStatus)
		{
			$scope.lead.roleid=$scope.sroleid;
			console.log($scope.lead);
			$scope.submitted=true;
			if(formStatus)
			{
				blockUI.start('Please Wait...');
				$scope.lead.agent="browser";
				console.log($scope.lead);
				dataService.getData('/ws/CRMLeadCreation',$scope.lead).then(function(response){
					blockUI.stop();
					console.log(response.data);
					if(response.data.result==1)
					{
						$scope.alertMsg='Lead Successfully Created';
						var alertBox=ngDialog.open({
				            template:'../template/alert.html',
				            className: 'ngdialog-theme-default',
				            scope:$scope
				        	}).closePromise.then(function(){
							$scope.lead={};
							$scope.lead.source_from=0;
							$scope.submitted=false;
							$scope.isEntry=false;
							$scope.lead.lead_branch_id=$scope.lead_branch_id;
							$scope.isSearch=false;
							$scope.search={};
							$scope.search.lead_branch_id=$scope.lead.lead_branch_id;
							$('a[href="#leads"]').tab('show');
							recs=$filter('customLabels')(response.data.recs,$scope.LEADSTATUS);
							if(recs!=0)
							{
								$scope.leads=recs;
		            			$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
							}
							else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
						});
					}
					else
					if(response.data==0)
					{
						$scope.lead.exist=true;
						alertService.add('danger', 'Please Try Again', CONSTANTS.ALERTTIME);
					}
				});
			}
		},
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
		getCities:function(state_id)
		{
			if(state_id==undefined) $scope.cities={};
			$scope.lead.city_id='';
			if(state_id)
			{
				blockUI.start('Please Wait...');
				dataService.getData('/ws/getCitiesByStateId',{agent:"browser",state_id:state_id,status:1}).then(function(response){
					$scope.cities=angular.copy(response.data);
				blockUI.stop();
				});
			}
		},
		getProspectDetails:function(product_type_id)
		{
			$scope.prospectDetails={};
			$scope.lead.prospect_details='';
			$scope.lead.prospect_details_id='';
			if(product_type_id)
			{
				blockUI.start('Please Wait...');
				dataService.getData('/ws/getProspectDetails',{agent:"browser",product_type_id:product_type_id}).then(function(response){
					if(response.data!=0) $scope.prospectDetails=response.data;
				blockUI.stop();
				});
			}
		},
		getBusinessNamesByID:function(business_type_id)
		{
			$scope.businessnames={};
			$scope.lead.business_name='';
			if(business_type_id)
			{
				blockUI.start('Please Wait...');
				dataService.getData('/ws/getBusinessNamesByID',{agent:"browser",business_type_id:business_type_id}).then(function(response){
					if(response.data!=0) $scope.businessnames=response.data;
				blockUI.stop();
				});
			}
		},
		getSESSIONVariable:function()
		{
			dataService.getData('/ws/getSESSIONVariable',{}).then(function(response){
				recs=angular.copy(response.data);
				if(recs!='')
				{
					$scope.lead_branch_id=recs.sbranchid;
					$scope.search.lead_branch_id=recs.sbranchid;
					$scope.lead.lead_branch_id=$scope.lead_branch_id;
					$scope.sroleid=recs.sroleid;
				}
			});
		},
		getLeads:function()
		{
			$scope.isSearch=false;
			$scope.search={};
			$scope.search.lead_branch_id=$scope.lead.lead_branch_id;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getCreatedLeads',{}).then(function(response){
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
		getAllLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getAllLeads',{}).then(function(response){
				recs=angular.copy(response.data);
				if(recs!='0')
				{
					$scope.leads=recs;
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
		subSearchForm:function(formStatus)
		{
			$scope.searched=true;
			if(formStatus)
			{
				blockUI.start('Please Wait...');
				dataService.getData('/ws/getCreatedLeadsBySearch',$scope.search).then(function(response){
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
			}
		},
		resetForm:function()
		{
			$scope.lead={};
			$scope.lead.source_from=0;
			$scope.submitted=false;
			$scope.lead.lead_branch_id=$scope.lead_branch_id;
			$scope.isEntry=false;
		},
		goBack:function(page)
		{
			$scope.isLeadView=false;
			$scope.isLeads=true;
		},
		openSearch:function()
		{
			$scope.isSearch=true;
		},
		closeSearch:function()
		{
			$scope.isSearch=false;
		},
		checkDupLead:function(company_name,contact_no)
		{
			if(contact_no!=undefined && company_name!=undefined && $scope.onCheck==false)
			{
				$scope.onCheck=true;
				blockUI.start('Please Wait...');
				dataService.getData('/ws/checkDupLead',{agent:"browser",company_name:company_name,contact_no:contact_no}).then(function(response){
					response=response.data;
					if(response>0)
					{
						$scope.alertMsg='Lead Already Exist on this Company and Mobile Number. Are you sure you want Create Again';
						ngDialog.openConfirm({
						    template:'../template/confirm.html',
					        className: 'ngdialog-theme-default',
					        scope:$scope,
					        closeByEscape:true
					   	}).then(function(){
							$scope.alertMsg='Proceed to Create New Lead';
							ngDialog.openConfirm({
							    template:'../template/confirm.html',
						        className: 'ngdialog-theme-default',
						        scope:$scope,
						        closeByEscape:true
						   	}).then(function(){
						   		$scope.isEntry=true;
						   	}).catch(function(){
					   		$scope.isEntry=false;
					   	});
					   	}).catch(function(){
					   		$scope.isEntry=false;
					   	});
					}
					else $scope.isEntry=true;
					$scope.onCheck=false;
					console.log(response);
				});
				blockUI.stop();
			}
		}
	});
	//$('a[href="#lead"]').tab('show');
	$scope.getLeadFields();
	$scope.getSESSIONVariable();
	$scope.getLeads();
});