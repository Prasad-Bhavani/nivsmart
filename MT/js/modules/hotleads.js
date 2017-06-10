app.controller('hotLeadCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

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
		leadFollowupStatus:{},
		isEntry:true
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
				console.log($scope.lead);
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
								window.location='?'
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
				else
				{
					$http({
						method:'post',
						url: HOST+"/ws/addCRMLead",
						data:$scope.lead,
						headers: {'Content-Type': 'application/x-www-form-urlencoded'}
					})
					.success(function(result){
						blockUI.stop();
						if(result==1)
						{
							$scope.alertMsg='Lead Successfully Created';
							var alertBox=ngDialog.open({
					            template:'../template/alert.html',
					            className: 'ngdialog-theme-default',
					            scope:$scope
					        	});
							alertBox.closePromise.then(function(){
								window.location='myleads.php'
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
		subHotLeadStatus:function(formStatus)
		{
			$scope.statusSubmitted=true;
			if(formStatus)
			{
				$scope.leadStatus=$scope.leadUpdateStatus;
				$scope.leadStatus.id=$scope.lead.id;
				blockUI.start('Please Wait...');
				dataService.getData('/ws/updateLeadMangerHotLeadStatus',$scope.leadStatus).then(function(response){
				blockUI.stop();
				console.log(response);
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
		subFollowupStatus:function(formStatus)
		{
			$scope.statusSubmitted=true;
			if(formStatus)
			{
				$scope.leadFollowupStatus.id=$scope.lead.id;
				blockUI.start('Please Wait...');
				dataService.getData('/ws/updateFollowupStatus',$scope.leadFollowupStatus).then(function(response){
				blockUI.stop();
				console.log(response.data);
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
console.log($scope.leadFollowupStatus);
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
		getHotInboxLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getTeleHotLeads',{agent:"browser"}).then(function(response){
				recs=response.data;
				console.log(recs);
				if(recs!='0')
				{
					angular.forEach(recs,function(val,key){
						recs[key].sno=key+1;
						if(val.if_interest_demo!=0)
						{
							recs[key].demo_date_time=$filter('date')(new Date(val.demo_date_time),'dd-MMM-yyyy hh:mm a');
						}
						else recs[key].demo_date_time='';
					});
					$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
				}
				else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
				$scope.isHotInbox=true;
				$scope.isFollowup=false;
				$scope.isLeads=true;
				$scope.isLeadView=false;
				$scope.isUpdate=false;
				$scope.isColdInbox=false;
			blockUI.stop();
			});
		},
		getTeleColdLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getTeleColdLeads',{agent:"browser"}).then(function(response){
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
				$scope.isFollowup=false;
				$scope.isLeads=true;
				$scope.isLeadView=false;
				$scope.isUpdate=false;
				$scope.isHotInbox=false;
			blockUI.stop();
			});
		},
		getFollowupLeads:function()
		{
			blockUI.start('Please Wait..');
			dataService.getData('/ws/getFollowupLeads',{agent:"browser"}).then(function(response){
					recs=response.data;
					console.log(recs);
					if(recs!='0')
					{
						angular.forEach(recs,function(val,key){
								recs[key].sno=key+1;
								recs[key].followup_date_time=$filter('date')(new Date(val.followup_date_time),'dd-MMM-yyyy hh:mm a');
						});
						$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
					}
					else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
					$scope.isFollowup=true;
					$scope.isLeads=true;
					$scope.isLeadView=false;
					$scope.isUpdate=false;
					$scope.isColdInbox=false;
					$scope.isHotInbox=false;
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
		moveToHotInbox:function(id)
		{
			$scope.alertMsg='Are You sure, You want to Take this Lead?';
			ngDialog.openConfirm({
			    template:'../template/confirm.html',
		        className: 'ngdialog-theme-default',
		        scope:$scope,
		        closeByEscape:true
		   	}).then(function(){
		   		blockUI.start('Please Wait...');
			dataService.getData('/ws/moveToHotInbox',{agent:"browser",id:id}).then(function(response){
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
					if(data.recs!='0') $scope.hotleads=data.recs; else $scope.hotleads={};
					$scope.isLeads=true;
					$scope.isLeadView=false;
		   		});
		   	}).catch(function(){

		   	});
		},
		getUpdateBox:function(leadid,deptid,type)
		{
			console.log(deptid);
			if(deptid!=0)
			{
				$scope.leadid=leadid;
				blockUI.start('Please Wait...');
				$scope.leadFollowupStatus={};
				dataService.getData('/ws/getEditHotLead',{agent:"browser",id:$scope.leadid}).then(function(response){
						result=response.data;
						$scope.leadUpdateStatus={};
						if(result)
						{
							$scope.lead=result.rec;
							$scope.prospecttype=CONSTANTS.PROSPECTTYPE;
							$scope.cities=result.recs;
							if(result.pros!=0) $scope.prospectDetails=result.pros;
							ngDialog.openConfirm({
				   				 template:'../template/followup.html',
			      				 className: 'ngdialog-theme-default custom-width-800',
			       				 scope:$scope,
			      				 closeByEscape:true
							}).then(function(){

							}).catch(function(){
								$scope.statusSubmitted=false;
								$scope.lead={};
							});
							console.log(result);
						}
					});
				blockUI.stop();
			}
			else
			{
				$scope.prospectDetails={};
				blockUI.start('Please Wait...');
				dataService.getData('/ws/getEditHotLead',{agent:"browser",id:leadid}).then(function(response){
						result=response.data;
						console.log(result);
						if(result)
						{
							$scope.lead=result.rec;
							$scope.cities=result.recs;
							$scope.businessnames=result.business_names;
							$scope.prospectDetails=result.pros;
							$scope.lead.status="";
							$scope.lead.lead_dept_id="";
							$scope.followupLead=type;
							ngDialog.openConfirm({
				   				 template:'../template/updatehotstatus.html',
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
			}
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
		}
	});
	
	$scope.getLeadFields();
	$scope.getSESSIONVariable();
	$scope.getHotInboxLeads();
});