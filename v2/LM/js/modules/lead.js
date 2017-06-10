app.controller('leadCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		lead:{},
		leadUpdateStatus:{},
		submitted:false,
		states:[],
		isLeads:true,
		isLead:false,
		isEditView:false,
		isHotLeads:true,
		isHotInbox:false,
		isFollowup:false
	});

	$scope.lead.agent="browser";
	$scope.business=CONSTANTS.NATUREOFBUSINESS;
	$scope.domainbusiness=CONSTANTS.DOMAINOFBUSINESS;
	$scope.prospecttype=CONSTANTS.PROSPECTTYPE;
	$scope.sources=CONSTANTS.LEADSOURCE;
	$scope.LEADSTATUS=CONSTANTS.LEADSTATUS;
	$scope.DEPT=CONSTANTS.DEPT;
	$scope.lead.source_from=0;

	angular.extend($scope,{
		subForm:function(formStatus)
		{
			$scope.submitted=true;
			if(formStatus)
			{
				if(!$scope.lead.status) $scope.lead.status=0;
				$scope.lead.tele_id=1;
				blockUI.start('Please Wait...');
				$scope.lead.agent="browser";
				if($scope.lead.id)
				{
					dataService.getData('/ws/UpdateCRMColdLead',$scope.lead).then(function(response){
					result=response.data;
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
								window.location='coldleads.php'
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
					dataService.getData('/ws/addCRMLead',$scope.lead).then(function(response){
					result=response.data;
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
		getColdLeads:function()
		{
			dataService.getData('/ws/getColdLeads',{agent:"browser"}).then(function(response){
			recs=response.data;
				if(recs!='0')
				{
					$scope.coldleads=recs;
				} else $scope.coldleads={};
				$scope.isColdInbox=false;
				$scope.isColdLeads=true;
				$scope.isLeads=true;
				$scope.isView=false;
				$scope.isUpdate=false;
			});
		},
		getColdInboxLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getColdInboxLeads',{agent:"browser"}).then(function(response){
			recs=response.data;
				if(recs!='0')
				{
					$scope.coldinboxleads=recs;
				}
				$scope.isColdInbox=true;
				$scope.isColdLeads=false;
				$scope.isLeads=true;
				$scope.isView=false;
				$scope.isUpdate=false;
			blockUI.stop();
			});
		},
		getHotLeads:function()
		{
			blockUI.start('Please Wait...');
			$http({
				method:'post',
				url: HOST+"/ws/getHotLeads",
				data:{agent:"browser"},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(recs){
				if(recs!='0')
				{
					$scope.hotleads=recs;
					$scope.isHotLeads=true;
					$scope.isHotInbox=false;
					$scope.isFollowup=false;
				}
				console.log(recs);
			});
			blockUI.stop();
		},
		getHotInboxLeads:function()
		{
			blockUI.start('Please Wait...');
			$http({
				method:'post',
				url: HOST+"/ws/getHotInboxLeads",
				data:{agent:"browser"},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(recs){
				if(recs!='0')
				{
					$scope.hotinboxleads=recs;
					$scope.isHotLeads=false;
					$scope.isHotInbox=true;
					$scope.isFollowup=false;
				}
				console.log(recs);
			});
			blockUI.stop();
		},
		getFollowupLeads:function()
		{
			blockUI.start('Please Wait...');
			$http({
				method:'post',
				url: HOST+"/ws/getFollowupLeads",
				data:{agent:"browser"},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(recs){
				if(recs!='0')
				{
					$scope.followupleads=recs;
					$scope.isHotLeads=false;
					$scope.isHotInbox=false;
					$scope.isFollowup=true;
				}
				console.log(recs);
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
					$scope.isUpdate=false;
				}
			});
			blockUI.stop();
		},
		getLead:function(id,status)
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getMarketingExecutiveLead',{agent:"browser",id:id,status:status}).then(function(response){
			data=response.data;
				if(data!='')
				{
					$scope.leadrec=data.rec;
					$scope.coldhistory=data.coldhistory;
					$scope.isLeads=false;
					$scope.isView=true;
					$scope.isUpdate=false;
				}
			});
			blockUI.stop();
		},
		getColdLead:function(id,status)
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getColdLead',{agent:"browser",id:id,status:status}).then(function(response){
				data=response.data;
				if(data!='')
				{
					if(data.rec!='0') $scope.leadrec=data.rec;
					if(data.coldhistory!='0') $scope.coldhistory=data.coldhistory;
					$scope.isLeads=false;
					$scope.isView=true;
					$scope.isUpdate=false;
				}
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
					$scope.isView=false;
					$scope.isUpdate=true;
				}
			});
			blockUI.stop();
		},
		moveToColdInbox:function(id,status)
		{
			$scope.alertMsg='Are You sure, You want to Take this Lead?';
			ngDialog.openConfirm({
			    template:'../template/confirm.html',
		        className: 'ngdialog-theme-default',
		        scope:$scope,
		        closeByEscape:true
		   	}).then(function(){
		   	blockUI.start('Please Wait...');
			dataService.getData('/ws/moveToColdInbox',{agent:"browser",id:id,status:status}).then(function(response){
				result=response.data;
				    blockUI.stop();
		   			if(result=='0')
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
				        $scope.coldleads=result;
		   			}
		   		});
		   	}).catch(function(){

		   	});
		},
		moveToHotInbox:function(id,status)
		{
			$scope.alertMsg='Are You sure, You want to Take this Lead?';
			ngDialog.openConfirm({
			    template:'../template/confirm.html',
		        className: 'ngdialog-theme-default',
		        scope:$scope,
		        closeByEscape:true
		   	}).then(function(){
		   	blockUI.start('Please Wait...');
			dataService.getData('/ws/moveToHotInbox',{agent:"browser",id:id,status:status}).then(function(response){
				result=response.data;
				    blockUI.stop();
		   			if(result=='0')
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
				        $scope.hotleads=result;
				        console.log(result);
		   			}
		   		});
		   	}).catch(function(){

		   	});
		},
		getUpdateBox:function(id)
		{
			$scope.leadid=id;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getEditColdLead',{agent:"browser",id:$scope.leadid}).then(function(response){
					result=response.data;
					if(result)
					{
						$scope.lead=result.rec;
						$scope.cities=result.recs;
						$scope.prospectDetails=result.pros;
						ngDialog.openConfirm({
			   				 template:'../template/updatestatus.html',
		      				 className: 'ngdialog-theme-default custom-width-800',
		       				 scope:$scope,
		      				 closeByEscape:true
						}).then(function(){

						}).catch(function(){
							$scope.statusSubmitted=false;
							$scope.lead={};
						});
					}
				});
			blockUI.stop();
		},
		getHotUpdateBox:function(id)
		{
			$scope.leadid=id;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getEditHotLead',{agent:"browser",id:$scope.leadid}).then(function(response){
					result=response.data;
					if(result)
					{
						$scope.lead=result.rec;
						$scope.prospecttype=CONSTANTS.PROSPECTTYPE;
						$scope.cities=result.recs;
						if(result.pros!=0) $scope.prospectDetails=result.pros;
						ngDialog.openConfirm({
			   				 template:'../template/updatestatus.html',
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
		},
		getFollowBox:function(id)
		{
			$scope.leadid=id;
			blockUI.start('Please Wait...');
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
		},
		subLeadStatus:function(formStatus)
		{
			$scope.statusSubmitted=true;
			if(formStatus)
			{
				$scope.leadUpdateStatus.id=$scope.lead.id;
				blockUI.start('Please Wait...');
				dataService.getData('/ws/updateColdStatus',$scope.leadUpdateStatus).then(function(response){
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
				});
			}
		},
		resetForm:function()
		{
			$scope.lead={};
			$scope.submitted=false;
			$scope.lead.lead_branch_id=$scope.lead_branch_id;
			$scope.lead.source_from=0;
		}
	});
	$('a[href="#coldinbox"]').tab('show');
	$scope.getLeadFields();
	$scope.getSESSIONVariable();
	$scope.getMyLeads();
	$scope.getHotLeads();
	$scope.getColdLeads();
	$scope.getColdInboxLeads();
});