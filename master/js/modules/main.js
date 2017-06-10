app.controller('mainCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService,$q){

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
		shortlead:{}
	});

	$scope.lead.agent="browser";
	$scope.business=CONSTANTS.NATUREOFBUSINESS;
	$scope.domainbusiness=CONSTANTS.DOMAINOFBUSINESS;
	$scope.prospecttype=CONSTANTS.PROSPECTTYPE;
	$scope.LEADSTATUS=CONSTANTS.LEADSTATUS;
	$scope.sources=CONSTANTS.LEADSOURCE;
	$scope.lead.source_from=0;
	$scope.count=1;

	angular.extend($scope,{
		subSortForm:function(formStatus)
		{
			$scope.submitted=true;
			if(formStatus)
			{
				blockUI.start('Please Wait...');
				dataService.getData('/ws/CRMShortLeadCreation',$scope.shortlead).then(function(response){
					response=response.data;
					console.log(response);
					if(response=='1')
					{
						$scope.alertMsg='Lead Successfully Created';
						var alertBox=ngDialog.open({
				            template:'../template/alert.html',
				            className: 'ngdialog-theme-default',
				            scope:$scope
				        	}).closePromise.then(function(){
							$scope.shortlead={};
							$scope.submitted=false;
							$scope.isEntry=false;
							$scope.shortlead.lead_branch_id=$scope.lead_branch_id;
							location.href='?';
						});
					}
				});
				blockUI.stop();
			}
		},
		getShortLead:function()
		{
			$scope.shortlead={};
			$scope.submitted=false;
			$scope.shortlead.lead_branch_id=1;
			$scope.isEntry=false;
			ngDialog.openConfirm({
				template:'../template/shortleadcreation.html',
				className: 'ngdialog-theme-default',
				scope:$scope,
				closeByEscape:true
			}).then(function(){
			}).catch(function(){
			});
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
		},
		getSearchFields:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getSearchFields',{}).then(function(response){
				response=angular.copy(response.data);
				$scope.DEPT=response.depts;
				$scope.roles=response.roles;
				$scope.EMPS=response.emps;
				$scope.branches=response.branches;
			blockUI.stop();
			});
		},
		getRolesbyDept:function(deptid)
		{
			console.log(deptid);
			$scope.search.dept_id=deptid;
			$scope.search.is_master=1;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getEmpRolesByDeptID',$scope.search).then(function(response){
				response=angular.copy(response.data);
				$scope.roles=response;
				console.log($scope.roles);
			blockUI.stop();
			});
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
		getBranches:function()
		{
			dataService.getData('/ws/getBranches',{}).then(function(response){
				recs=angular.copy(response.data);
				if(recs!='')
				{
					$scope.branches=recs.branches;
					$scope.shortlead.lead_branch_id=1;
				}
			});
		},
		getLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getAllLeads',{}).then(function(response){
				recs=angular.copy(response.data);
				if(recs!='0')
				{
					recs=$filter('customLabels')(recs,$scope.LEADSTATUS);
					$scope.leads=recs;
            		$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
					$scope.isLeads=true;
					$scope.isLeadView=false;
				}
			blockUI.stop();
			});
		},
		subSearchForm:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getLeadsBySearch',$scope.search).then(function(response){
				recs=angular.copy(response.data);
				if(recs!='0')
				{
					recs=$filter('customLabels')(recs,$scope.LEADSTATUS);
					$scope.leads=recs;
            		$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
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
				console.log(res);
				if(res!='')
				{
					 [].push.apply($scope.leadhistory, res);
				}
			$scope.count=$scope.count+5;
			});
			blockUI.stop();
		},
		openSearch:function()
		{
			$scope.isSearch=true;
		},
		closeSearch:function()
		{
			$scope.isSearch=false;
		},
		goBack:function(page)
		{
			$scope.isLeadView=false;
			$scope.isLeads=true;
		},
		getLeadFields:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getLeadFields',{}).then(function(response){
				response=angular.copy(response.data);
				$scope.states=response.states;
				$scope.prospectTypes=response.products;
				$scope.branches=response.branches;
				$scope.shortlead.lead_branch_id=1;
			blockUI.stop();
			});
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
	$scope.getSearchFields();
});