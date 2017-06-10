app.controller('leadCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		lead:{},
		submitted:false,
		states:[],
		isLeads:true,
		isLeadView:false,
		backup:{},
		isEntry:false
	});

	$scope.lead.agent="browser";
	$scope.business=CONSTANTS.NATUREOFBUSINESS;
	$scope.domainbusiness=CONSTANTS.DOMAINOFBUSINESS;
	$scope.prospecttype=CONSTANTS.PROSPECTTYPE;
	$scope.LEADSTATUS=CONSTANTS.LEADSTATUS;
	$scope.sources=CONSTANTS.LEADSOURCE;
	$scope.lead.source_from=0;

	angular.extend($scope,{
		subForm:function(formStatus)
		{
			console.log($scope.lead);
			$scope.submitted=true;
			console.log(formStatus);
			if(formStatus)
			{
				$scope.lead.status=0;
				blockUI.start('Please Wait...');
				$scope.lead.agent="browser";
				$scope.lead.assign_tele_id=1;
				dataService.getData('/ws/addCRMLead',$scope.lead).then(function(response){
					blockUI.stop();
					console.log(response.data);
					if(response.data.result!=undefined || response.data.result==1)
					{
						$scope.alertMsg='Lead Successfully Created';
						var alertBox=ngDialog.open({
				            template:'../template/alert.html',
				            className: 'ngdialog-theme-default',
				            scope:$scope
				        	}).closePromise.then(function(){
							$scope.lead={};
							$scope.submitted=false;
							$scope.lead.lead_branch_id=$scope.lead_branch_id;
							console.log(response.data.recs);
							$scope.leads=response.data.recs;
							$scope.lead.source_from=0;
							$('a[href="#leads"]').tab('show');
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
				console.log(response);
				if(response!='')
				{
					recs=angular.copy(response.data);
					$scope.lead_branch_id=recs.sbranchid;
					$scope.lead.lead_branch_id=$scope.lead_branch_id;
				}
			});
		},
		getLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getCreatedLeads',{}).then(function(response){
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
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getViewLead',{agent:"browser",id:id,status:status}).then(function(response){
				data=response.data;
				console.log(data);
				if(data)
				{
					$scope.leadrec=data;
					$scope.isLeads=false;
					$scope.isLeadView=true;
				}
			});
			blockUI.stop();
		},
		resetForm:function()
		{
			$scope.lead={};
			$scope.submitted=false;
			$scope.lead.lead_branch_id=$scope.lead_branch_id;
			$scope.isEntry=false;
			$scope.lead.source_from=0;
		},
		goBack:function(page)
		{
			$scope.isLeadView=false;
			$scope.isLeads=true;
		},
		checkDupLead:function(label,val)
		{
			if(val!=undefined)
			{
				blockUI.start('Please Wait...');
				dataService.getData('/ws/checkDupLead',{agent:"browser",label:label,val:val}).then(function(response){
					response=response.data;
					if(response>0)
					{
						$scope.alertMsg='Lead Already Exist on this Company. Are you sure you want Create Again';
						ngDialog.openConfirm({
						    template:'../template/confirm.html',
					        className: 'ngdialog-theme-default',
					        scope:$scope,
					        closeByEscape:true
					   	}).then(function(){
							$scope.alertMsg='Create New Lead';
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