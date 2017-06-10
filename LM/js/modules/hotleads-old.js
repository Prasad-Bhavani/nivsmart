app.controller('leadCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		lead:{},
		submitted:false,
		states:[],
		isLeads:true,
		isLead:false,
		isColdInbox:true,
		isColdLeads:true,
		isView:false,
		isUpdate:true
	});

	$scope.lead.agent="browser";
	$scope.business=CONSTANTS.NATUREOFBUSINESS;
	$scope.domainbusiness=CONSTANTS.DOMAINOFBUSINESS;
	$scope.prospecttype=CONSTANTS.PROSPECTTYPE;
	$scope.sources=CONSTANTS.LEADSOURCE;
	$scope.LEADSTATUS=CONSTANTS.LEADSTATUS;
	$scope.lead.source_from=0;

	angular.extend($scope,{
		subForm:function(formStatus)
		{
			$scope.submitted=true;
			if(formStatus)
			{
				$scope.lead.status=CONSTANTS.LEADSTATUS.PIPELINE.id;
				blockUI.start('Please Wait...');
				$scope.lead.agent="browser";
				if($scope.lead.id)
				{
					$http({
						method:'post',
						url: HOST+"/ws/UpdateCRMColdLead",
						data:$scope.lead,
						headers: {'Content-Type': 'application/x-www-form-urlencoded'}
					})
					.success(function(result){
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
		getLeadFields:function()
		{
			blockUI.start('Please Wait...');
			$http({
				method:'post',
				url: HOST+"/ws/getLeadFields",
				data:{agent:"browser"},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(response){
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
				$http({
					method:'post',
					url: HOST+"/ws/getCitiesByStateId",
					data:{agent:"browser",state_id:state_id,status:1},
					headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				})
				.success(function(data){
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
				$http({
					method:'post',
					url: HOST+"/ws/getProspectDetails",
					data:{agent:"browser",product_type_id:product_type_id},
					headers:{'Content-Type': 'application/x-www-form-urlencoded'}
				})
				.success(function(data){
					if(data.length>0) $scope.prospectDetails=data;
					blockUI.stop();
				});
			}
		},
		selectBranch:function(id)
		{
			blockUI.start('Please Wait...');
			$http({
				method:'post',
				url: HOST+"/ws/goBranch",
				data:{agent:"browser",id:id},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(response){
				if(response!='')
				{
					location.href='dashboard.php';
				}
				blockUI.stop();
			});
		},
		getSESSIONVariable:function(recs)
		{
			$http({
				method:'post',
				url: HOST+"/ws/getSESSIONVariable",
				data:{agent:"browser"},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(recs){
				if(recs!='')
				{
					$scope.lead_branch_id=recs.sbranchid;
					$scope.lead.lead_branch_id=$scope.lead_branch_id;
				}
			});
		},
		getColdLeads:function()
		{
			$http({
				method:'post',
				url: HOST+"/ws/getMarketingTeleColdLeads",
				data:{agent:"browser"},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(recs){
				if(recs!='0')
				{
					$scope.coldleads=recs;
				}
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
			$http({
				method:'post',
				url: HOST+"/ws/getColdInboxLeads",
				data:{agent:"browser"},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(recs){
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
				url: HOST+"/ws/getMarketingTeleHotLeads",
				data:{agent:"browser"},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(recs){
				if(recs!='0')
				{
					$scope.hotleads=recs;
					$scope.isLeads=true;
					$scope.isView=false;
					$scope.isUpdate=false;
				}
			});
			blockUI.stop();
		},
		getMyLeads:function()
		{
			blockUI.start('Please Wait...');
			$http({
				method:'post',
				url: HOST+"/ws/getMarketingTeleMyLeads",
				data:{agent:"browser"},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(recs){
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
			$http({
				method:'post',
				url: HOST+"/ws/getMarketingExecutiveLead",
				data:{agent:"browser",id:id,status:status},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(data){
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
			$http({
				method:'post',
				url: HOST+"/ws/getColdLead",
				data:{agent:"browser",id:id,status:status},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(data){
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
			$http({
				method:'post',
				url: HOST+"/ws/getEditColdLead",
				data:{agent:"browser",id:id,status:status},
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(data){
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
		   		$http({
		   			method:'post',
		   			url: HOST+"/ws/moveToColdInbox",
		   			data:{agent:"browser",id:id,status:status},
		   			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		   		})
		   		.success(function(result)
		   		{
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
					$scope.lead=result.rec;
					$scope.cities=result.recs;
					$scope.isLeads=false;
					$scope.isView=false;
					$scope.isUpdate=true;
		   			}
		   		});
		   	}).catch(function(){

		   	});
		},
		resetForm:function()
		{
			$scope.lead={};
			$scope.submitted=false;
			$scope.lead=false;
			$scope.lead.lead_branch_id=$scope.lead_branch_id;
		}
	});
	$scope.getLeadFields();
	$scope.getSESSIONVariable();
	$scope.getMyLeads();
	$scope.getColdLeads();
	$scope.getHotLeads();
});