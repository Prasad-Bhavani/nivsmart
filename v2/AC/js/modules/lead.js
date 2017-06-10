app.controller('leadCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		lead:{},
		leads:{},
		data:{},
		empid:{},
		leadUpdateStatus:{},
		sempid:'',
		submitted:false,
		isLeads:true,
		isLead:false
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
		getLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getACUNTLeads',{agent:"browser"}).then(function(response){
			recs=response.data;
			console.log(recs);
			blockUI.stop();
				if(recs!='0')
				{
					angular.forEach(recs,function(val,key){
						recs[key].sno=key+1;
						if(val.if_interest_demo==1) recs[key].demo_date_time=$filter('date')(new Date(val.demo_date_time),'dd-MMM-yyyy hh:mm a');
						else recs[key].demo_date_time='';
					});
		            $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
				} else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
				$scope.isLeads=true;
				$scope.isLeadView=false;
				$scope.isAllLeads=false;
				$scope.isInboxLeads=true;
			});
		},
		getLead:function(id,status)
		{
			$scope.count=1;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getViewLead',{agent:"browser",id:id}).then(function(response){
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
		getUpdateBox:function(id,lead_id,product_type_id)
		{
			$scope.lead.lead_id=lead_id;
			$scope.lead.id=id;
			$scope.lead.product_type_id=product_type_id;
			ngDialog.openConfirm({
				template:'template/updateleadstatus.html',
		    	className: 'ngdialog-theme-default',
		    	scope:$scope,
		    	closeByEscape:true
			}).then(function(){

			}).catch(function(){
				$scope.submitted=false;
				$scope.lead={};
			});
		},
		getProspectDetails:function(id,product_type_id,status)
		{
			if(status==5)
			{
				$scope.lead.quotationEdit=false;
				blockUI.start('Please Wait...');
				dataService.getData('/ws/getQuotationDetails',{agent:"browser",product_type_id:product_type_id,id:id}).then(function(response){
					console.log(response);
					if(response.data.quotation!=0)
					{
						$scope.lead.prospect_details_id=response.data.quotation.prospect_details_id;
						$scope.lead.quantity=response.data.quotation.quantity;
						$scope.lead.rate=response.data.quotation.rate;
						$scope.lead.amount=response.data.quotation.amount;
						$scope.lead.des=response.data.quotation.des;
						$scope.lead.quotationEdit=true;
					}
					if(response.data.recs!=0) $scope.prospectDetails=response.data.recs;
				});
				blockUI.stop();
			}
		},
		getEmps:function(empid)
		{
			blockUI.start('Please Wait...');
		   		dataService.getData('/ws/getEMPSbyDept',{agent:"browser"}).then(function(response){
		   			recs=response.data;
		   			if(recs!=0) $scope.emps=recs; else $scope.emps={};
		   		});
		   	blockUI.stop();
		},
		subLeadStatus:function(formStatus)
		{
			$scope.submitted=true;
			if(formStatus)
			{
				blockUI.start('Please Wait...');
		   		dataService.getData('/ws/updateLeadStatusbyACUNT',$scope.lead).then(function(response){
		   			result=response.data;
		   			console.log(result);
		   		blockUI.stop();
		   			if(result==1)
		   			{
		   				$scope.alertMsg='Lead Status Successfully Updated';
		   				ngDialog.open({
					        template:'../template/alert.html',
					        className: 'ngdialog-theme-default',
					        scope:$scope
					    }).closePromise.then(function(){
					        window.location='?';
					    });
		   			}
		   		});
			}
		},
		getSESSIONVariable:function(recs)
		{
			dataService.getData('/ws/getSESSIONVariable',{agent:"browser"}).then(function(response){
				recs=response.data;
				if(recs!='')
				{
					console.log(recs);
					$scope.lead_branch_id=recs.sbranchid;
					$scope.lead.lead_branch_id=$scope.lead_branch_id;
					$scope.sempid=recs.sempid;
				}
			});
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

	$scope.getLeads();
	$scope.getSESSIONVariable();
});