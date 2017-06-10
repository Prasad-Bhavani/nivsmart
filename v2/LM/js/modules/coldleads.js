app.controller('coldLeadCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		lead:{},
		submitted:false,
		states:[],
		isLeads:true,
		isLead:false,
		isColdInbox:true,
		isColdLeads:true,
		isLeadView:false,
		isUpdate:false,
		leadUpdateStatus:{},
		isEntry:true,
		onCheck:false
	});

	$scope.lead.agent="browser";
	$scope.business=CONSTANTS.NATUREOFBUSINESS;
	$scope.domainbusiness=CONSTANTS.DOMAINOFBUSINESS;
	$scope.prospecttype=CONSTANTS.PROSPECTTYPE;
	$scope.sources=CONSTANTS.LEADSOURCE;
	$scope.LEADSTATUS=CONSTANTS.LEADSTATUS;
	$scope.DEPT=CONSTANTS.DEPT;
	$scope.lead.source_from=0;
	$scope.count=1;

	angular.extend($scope,{
		subLeadForm:function(formStatus)
		{
			$scope.submitted=true;
			if(formStatus)
			{
				blockUI.start('Please Wait...');
				if($scope.lead.status=='') $scope.lead.status=6;
				//blockUI.start('Please Wait...');
				$scope.lead.agent="browser";
				if($scope.lead.id)
				{
				dataService.getData('/ws/updateLeadManagerLead',$scope.lead).then(function(response){
					result=response.data;
					console.log(result);
					blockUI.stop();
						if(result==1)
						{
							$scope.alertMsg='Lead Successfully Updated';
							var alertBox=ngDialog.open({
					            template:'../template/alert.html',
					            className: 'ngdialog-theme-default',
					            scope:$scope
					        	});
							alertBox.closePromise.then(function(){
								window.location='?';
							});
						}
						else
						if(result==0)
						{
							$scope.lead.exist=true;
							alertService.add('danger', 'Please Try Again', CONSTANTS.ALERTTIME);
						}
					});
				}
			}
		},
		subColdLeadStatus:function(formStatus)
		{
			$scope.statusSubmitted=true;
			if(formStatus)
			{
				$scope.leadStatus=$scope.leadUpdateStatus;
				$scope.leadStatus.id=$scope.lead.id;
				blockUI.start('Please Wait...');
				dataService.getData('/ws/updateLeadMangerColdLeadStatus',$scope.leadStatus).then(function(response){
					console.log(response);
				blockUI.stop();
					$scope.alertMsg='Successfully Updated';
						var alertBox=ngDialog.open({
					        template:'../template/alert.html',
					        className: 'ngdialog-theme-default',
					        scope:$scope
					    });
						alertBox.closePromise.then(function(){
							window.location='?';
						});
			});
			}
		},
		getLeadFields:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getLeadFields',{agent:"browser"}).then(function(response){
				response=response.data;
				$scope.states=response.states;
				$scope.prospectTypes=response.products;
				$scope.branches=response.branches;
				blockUI.stop();
			});
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
		getCities:function(state_id)
		{
			if(state_id==undefined) $scope.cities={};
			$scope.lead.city_id='';
			if(state_id)
			{
				blockUI.start('Please Wait...');
				dataService.getData('/ws/getCitiesByStateId',{agent:"browser",state_id:state_id,status:1}).then(function(response){
				data=response.data;
					$scope.cities=angular.copy(data);
					blockUI.stop();
				});
			}
		},
		getProspectDetails:function(product_type_id)
		{
			$scope.prospectDetails={};
			$scope.lead.prospect_details_id='';
			if(product_type_id)
			{
				blockUI.start('Please Wait...');
				dataService.getData('/ws/getProspectDetails',{agent:"browser",product_type_id:product_type_id}).then(function(response){
				data=response.data;
					if(data.length>0) $scope.prospectDetails=data;
					blockUI.stop();
				});
			}
		},
		selectBranch:function(id)
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/goBranch',{agent:"browser",id:id}).then(function(response){
				response=response.data;
				if(response!='')
				{
					location.href='dashboard.php';
				}
				blockUI.stop();
			});
		},
		getSESSIONVariable:function(recs)
		{
			dataService.getData('/ws/getSESSIONVariable',{agent:"browser"}).then(function(response){
				recs=response.data;
				if(recs!='')
				{
					$scope.lead_branch_id=recs.sbranchid;
					$scope.lead.lead_branch_id=$scope.lead_branch_id;
				}
			});
		},
		getColdLeads:function()
		{
			blockUI.start('Please Wait..');
			dataService.getData('/ws/getLeadManagerColdLeads',{agent:"browser"}).then(function(response){
					recs=response.data;
					if(recs!='0')
					{
						angular.forEach(recs,function(val,key){
							recs[key].sno=key+1;
							if(val.status!=0) recs[key].is_updated_date_time=$filter('date')(new Date(val.is_updated_date_time),'dd-MMM-yyyy');
							else recs[key].is_updated_date_time='';
						});
						$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
					}
					else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
					$scope.isColdInbox=false;
					$scope.isColdLeads=true;
					$scope.isLeads=true;
					$scope.isLeadView=false;
					$scope.isUpdate=false;
					blockUI.stop();
			});
		},
		getColdInboxLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getLeadManagerColdInboxLeads',{agent:"browser"}).then(function(response){
				recs=response.data;
				console.log(recs);
				if(recs!='0')
				{
					angular.forEach(recs,function(val,key){
						recs[key].sno=key+1;
						recs[key].is_taken_date_time=$filter('date')(new Date(val.is_taken_date_time),'dd-MMM-yyyy');
					});
					$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
				}
				else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
				$scope.isColdInbox=true;
				$scope.isColdLeads=false;
				$scope.isLeads=true;
				$scope.isLeadView=false;
				$scope.isUpdate=false;
			blockUI.stop();
			});
		},
		getLead:function(id,status)
		{
			$scope.count=1;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getViewLead',{agent:"browser",id:id}).then(function(response){
				data=response.data;
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
					$scope.isUpdate=false;
					$scope.page='$scope.isLeads';
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
		getEditLead:function(id,status)
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getEditColdLead',{agent:"browser",id:id,status:status}).then(function(response){
				data=response.data;
				if(data!='')
				{
					$scope.lead=data.rec;
					$scope.cities=data.recs;
					$scope.isLeads=false;
					$scope.isLeadView=false;
					$scope.isUpdate=true;
				}
			});
			blockUI.stop();
		},
		moveToColdInbox:function(id)
		{
			$scope.alertMsg='Are You sure, You want to Take this Lead?';
			ngDialog.openConfirm({
			    template:'../template/confirm.html',
		        className: 'ngdialog-theme-default',
		        scope:$scope,
		        closeByEscape:true
		   	}).then(function(){
		   		blockUI.start('Please Wait...');
			dataService.getData('/ws/moveToColdInbox',{agent:"browser",id:id}).then(function(response){
				data=response.data;
				    blockUI.stop();
				   console.log(data);
		   			if(data.result=='3')
		   			{
		   				$scope.alertMsg='Sorry This Lead Already Taken by Other'
		   				ngDialog.open({
				            template:'../template/alert.html',
				            className: 'ngdialog-theme-default',
				            scope:$scope
				        });	
		   			}
		   			else
		   			if(data.result=='1')
		   			{
		   				$scope.alertMsg='Successfully Lead Moved to your Inbox'
		   				ngDialog.open({
				            template:'../template/alert.html',
				            className: 'ngdialog-theme-default',
				            scope:$scope
				        });
		   			}
					if(data.recs!=0)
					{
						recs=data.recs;
						angular.forEach(recs,function(val,key){
							recs[key].sno=key+1;
							if(val.status!=0) recs[key].is_updated_date_time=$filter('date')(new Date(val.is_updated_date_time),'dd-MMM-yyyy');
							else recs[key].is_updated_date_time='';
						});
						$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
					}
					else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
					$scope.isLeads=true;
					$scope.isLeadView=false;
		   		});
		   	}).catch(function(){

		   	});
		},
		getColdUpdateBox:function(leadid)
		{
			$scope.prospectDetails={};
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getEditColdLead',{agent:"browser",id:leadid}).then(function(response){
					result=response.data;
					console.log(result);
					if(result)
					{
						$scope.lead=result.rec;
						$scope.lead.prospect_type_id='';
						$scope.lead.prospect_details_id='';
						$scope.lead.status='';
						$scope.lead.lead_dept_id='';
						$scope.cities=result.recs;
						$scope.businessnames=result.business_names;
						ngDialog.openConfirm({
			   				 template:'../template/updatecoldstatus.html',
		      				 className: 'ngdialog-theme-default custom-width-800',
		       				 scope:$scope,
		      				 closeByEscape:true
						}).then(function(){

						}).catch(function(){
							$scope.statusSubmitted=false;
							$scope.submitted=false;
							$scope.lead={};
							$scope.leadUpdateStatus={};
						});
					}
				});
			blockUI.stop();
		},
		resetForm:function()
		{
			$scope.lead={};
			$scope.submitted=false;
			$scope.lead=false;
			$scope.lead.lead_branch_id=$scope.lead_branch_id;
		},
		goBack:function(page)
		{
			$scope.isLeadView=false;
			$scope.isLeads=true;
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
	
	$scope.getLeadFields();
	$scope.getSESSIONVariable();
	$scope.getColdLeads();
});