app.controller('monthlyFollowupCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		lead:{},
		leadUpdateStatus:{},
		submitted:false,
		states:[],
		isLeads:true,
		isLead:false,
		isEditView:false,
		isAllLeads:true,
		isInbox:false,
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
			if(product_type_id=='') $scope.prospectDetails={};
			$scope.lead.prospect_details='';
			if(product_type_id)
			{
				blockUI.start('Please Wait...');
				dataService.getData('/ws/getProspectDetails',{agent:"browser",product_type_id:product_type_id}).then(function(response){
				data=response.data;
					if(data.length>0) $scope.prospectDetails=data;
					blockUI.stop();
				});
				console.log(data);
			}
			console.log(product_type_id);
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
		getMonthlyFollowupLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getMonthlyFollowupLeads',{agent:"browser"}).then(function(response){
			recs=response.data;
			console.log(recs);
				if(recs!='0')
				{
					angular.forEach(recs,function(val,key){
						recs[key].sno=key+1;
						angular.forEach($scope.LEADSTATUS,function(v,k){
							if(val.status==v.id) recs[key].status=v.label;
						});
						if(val.if_interest_demo==1) recs[key].demo_date_time=$filter('date')(new Date(val.demo_date_time),'dd-MMM-yyyy hh:mm a');
						else recs[key].demo_date_time='';
					});
		            $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
					$scope.isAllLeads=true;
					$scope.isInbox=false;
					$scope.isLeadView=false;
				} else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
				$scope.inboxleads={};
			});
			blockUI.stop();
		},
		getInboxLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getInboxMonthlyFollowupLeads',{agent:"browser"}).then(function(response){
			recs=response.data;
				if(recs!='0')
				{
					angular.forEach(recs,function(val,key){
						recs[key].sno=key+1;
					});
		            $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
					$scope.isLeads=true;
					$scope.isAllLeads=false;
					$scope.isInbox=true;
					$scope.isLeadView=false;
				} else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
				$scope.leads={};
			});
			blockUI.stop();
		},
		getMyLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getMarketingTeleMyLeads',{agent:"browser"}).then(function(response){
			recs=response.data;
				if(recs!='0')
				{
					$scope.myleads=recs;
					$scope.isLeads=true;
					$scope.isLead=false;
					$scope.isLeadView=false;
				}
			});
			blockUI.stop();
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
		moveToInbox:function(id)
		{
			$scope.alertMsg='Are You sure, You want to Take this Lead?';
			ngDialog.openConfirm({
			    template:'../template/confirm.html',
		        className: 'ngdialog-theme-default',
		        scope:$scope,
		        closeByEscape:true
		   	}).then(function(){
		   	blockUI.start('Please Wait...');
			dataService.getData('/ws/movetoInboxMonthlyLead',{agent:"browser",id:id}).then(function(response){
				result=response.data;
				console.log(result);
				    blockUI.stop();
		   			if(result.result=='3')
		   			{
		   				$scope.alertMsg='Sorry This Lead Already Taken by Other'
		   				ngDialog.open({
				            template:'../template/alert.html',
				            className: 'ngdialog-theme-default',
				            scope:$scope
				        });
		   			}
		   			else
		   			{
		   				$scope.alertMsg='Successfully Lead Moved to your Inbox'
		   				ngDialog.open({
				            template:'../template/alert.html',
				            className: 'ngdialog-theme-default',
				            scope:$scope
				        });
		   			}
		   			if(result.recs!=0)
				        {
				        	recs=result.recs;
							angular.forEach(recs,function(val,key){
								recs[key].sno=key+1;
								angular.forEach($scope.LEADSTATUS,function(v,k){
									if(val.status==v.id) recs[key].status=v.label;
								});
								if(val.if_interest_demo==1) recs[key].demo_date_time=$filter('date')(new Date(val.demo_date_time),'dd-MMM-yyyy hh:mm a');
								else recs[key].demo_date_time='';
							});
		            		$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
						} else 
		            $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
		   		});
		   	}).catch(function(){

		   	});
		},
		getUpdateBox:function(id,lead_id)
		{
			$scope.lead.id=id;
			$scope.lead.lead_id=lead_id;
			blockUI.start('Please Wait...');
				ngDialog.openConfirm({
					template:'template/updatemonthlylead.html',
			      	className: 'ngdialog-theme-default',
			       	scope:$scope,
			      	closeByEscape:true
				}).then(function(){

				}).catch(function(){
					$scope.submitted=false;
					$scope.lead={};
				});
			blockUI.stop();
		},
		subLeadStatus:function(formStatus)
		{
			$scope.submitted=true;
			if(formStatus)
			{
				blockUI.start('Please Wait...');
				dataService.getData('/ws/updateMonthlyLead',$scope.lead).then(function(response){
					result=response.data;
				blockUI.stop();
					if(result)
					{
						$scope.alertMsg='Successfully Updated';
						ngDialog.open({
			   				 template:'../template/alert.html',
		      				 className: 'ngdialog-theme-default',
		       				 scope:$scope,
						}).closePromise.then(function(){
							window.location='?';
						});
					}
					else
					{
					}
				console.log(result);
				});
			}
		},
		resetForm:function()
		{
			$scope.lead={};
			$scope.submitted=false;
			$scope.lead.lead_branch_id=$scope.lead_branch_id;
			$scope.lead.source_from=0;
		},
		goBack:function()
		{
			$scope.isLeadView=false;
			$scope.isLeads=true;
		}
	});
	$('a[href="#coldinbox"]').tab('show');
	$scope.getLeadFields();
	$scope.getSESSIONVariable();
	$scope.getMonthlyFollowupLeads();
});