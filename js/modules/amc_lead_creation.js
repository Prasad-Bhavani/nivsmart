app.controller('amcCreationCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		lead:{},
		submitted:false,
		states:[],
		isLeads:true,
		isLeadView:false,
		backup:{},
		isEntry:true,
		onCheck:false,
		isSearch:false,
		search:{},
		selected:{},
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
	$scope.lead.lead_branch_id=1;
	$scope.invoiceCount=0;
	$scope.inventoryCount=0;
	$scope.filingCount=0;
	$scope.diagonalsCount=0;

	angular.extend($scope,{
		checkInvoiceCount:function()
		{
			selectedInvoice=[];
			angular.forEach($scope.selected.invoice, function(val,key){
				if(val==true) selectedInvoice.push(key);
			});
			$scope.invoiceCount=selectedInvoice.length;
			$scope.lead.invoice=selectedInvoice.join();
		},
		checkInventoryCount:function()
		{
			selectedInventory=[];
			angular.forEach($scope.selected.inventory, function(val,key){
				if(val==true) selectedInventory.push(key);
			});
			$scope.inventoryCount=selectedInventory.length;
			$scope.lead.inventory=selectedInventory.join();
		},
		checkFilingCount:function()
		{
			selectedFiling=[];
			angular.forEach($scope.selected.filing, function(val,key){
				if(val==true) selectedFiling.push(key);
			});
			$scope.filingCount=selectedFiling.length;
			$scope.lead.filing=selectedFiling.join();
		},
		checkDiagonalsCount:function()
		{
			selectedDiagonals=[];
			angular.forEach($scope.selected.diagonals, function(val,key){
				if(val==true) selectedDiagonals.push(key);
			});
			$scope.diagonalsCount=selectedDiagonals.length;
			$scope.lead.diagonals=selectedDiagonals.join();
		},
		subForm:function(formStatus)
		{
			$scope.lead.roleid=$scope.sroleid;
			$scope.submitted=true;
			console.log($scope.lead);
			if(formStatus)
			{
				if($scope.invoiceCount!=0 && $scope.inventoryCount!=0 && $scope.filingCount!=0 && $scope.diagonalsCount!=0)
				{
					blockUI.start('Please Wait...');
					$scope.lead.agent="browser";
					dataService.getData('/ws/AMCLeadCreation',$scope.lead).then(function(response){
						blockUI.stop();
						console.log(response);
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
								window.location.href='?';
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
			dataService.getData('/ws/getAMCCreatedLeads',{}).then(function(response){
				recs=angular.copy(response.data);
				if(recs!='0')
				{
					angular.forEach(recs,function(val,key){
						recs[key].sno=key+1;
						if(val.if_interest_amc==1) recs[key].if_interest_amc='Yes'; else recs[key].if_interest_amc='No';
						recs[key].created_date_time=$filter('date')(new Date(val.created_date_time),'dd-MMM-yyyy');
					});
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
		getLead:function(id)
		{
			$scope.count=1;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getAMCViewLead',{agent:"browser",id:id}).then(function(response){
				data=response.data;
				if(data)
				{
					$scope.leadrec=data;
					$scope.isLeads=false;
					$scope.isLeadView=true;
				}
			});
			blockUI.stop();
		},
		getViewMoreHistory:function(leadid)
		{
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
			$scope.invoiceCount=0;
			$scope.inventoryCount=0;
			$scope.filingCount=0;
			$scope.diagonalsCount=0;
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
		}/*,
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
				});
				blockUI.stop();
			}
		}*/
	});
	//$('a[href="#lead"]').tab('show');
	$scope.getLeadFields();
	//$scope.getSESSIONVariable();
	$scope.getLeads();
});