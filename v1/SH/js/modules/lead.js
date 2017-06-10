app.controller('leadCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		lead:{},
		leads:{},
		inboxleads:{},
		data:{},
		empid:{},
		leadUpdateStatus:{},
		sempid:'',
		submitted:false,
		isLeads:true,
		isLead:false,
		isInboxLeads:false,
		isAllLeads:false,
		selected:{},
		noAssign:true,
		assignsubmitted:false
	});

	$scope.lead.agent="browser";
	$scope.business=CONSTANTS.NATUREOFBUSINESS;
	$scope.domainbusiness=CONSTANTS.DOMAINOFBUSINESS;
	$scope.prospecttype=CONSTANTS.PROSPECTTYPE;
	$scope.sources=CONSTANTS.LEADSOURCE;
	$scope.LEADSTATUS=CONSTANTS.LEADSTATUS;
	$scope.DEPT=CONSTANTS.DEPT;
	$scope.lead.source_from=0;
	$scope.busCount=1;
	$scope.invoiceCount=0;
	$scope.inventoryCount=0;
	$scope.filingCount=0;
	$scope.diagonalsCount=0;
	$scope.count=1;
	$scope.quotation=[1];

	angular.extend($scope,{
		checkCheckList:function()
		{
			if($scope.invoiceCount!=0 && $scope.inventoryCount!=0 && $scope.filingCount!=0 && $scope.diagonalsCount!=0 && $scope.checklist.lead_implementation!='' && $scope.checklist.next_contact_date!='')
			{
				$scope.lead.check=1;
			}
			else $scope.lead.check='';
			$('input[name=close]').trigger('click').trigger('click');
		},
		subCheckList:function(formStatus,element)
		{
			$scope.checksubmitted=true;
			if(formStatus && $scope.invoiceCount>0 && $scope.inventoryCount>0 && $scope.filingCount>0 && $scope.diagonalsCount>0)
			{
				$scope.lead.check=1;
				$('input[name=close]').trigger('click').trigger('click');
			}
			else $scope.lead.check='';
		},
		checkBusCount:function()
		{
			selectedBus=[];
			angular.forEach($scope.selected.bus, function(val,key){
				if(val==true) selectedBus.push(key);
			});
			$scope.busCount=selectedBus.length;
		},
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
		getChecklist:function(busid)
		{
			$scope.checksubmitted=false;
			$scope.business=CONSTANTS.NATUREOFBUSINESS;
			$scope.busid=busid;
			ngDialog.openConfirm({
			    template:'../template/nature_of_business_checklist.html',
			    className: 'ngdialog-theme-default custom-width-800',
			    scope:$scope,
			    closeByEscape:true
			}).then(function(){
		   	});		
		},
		getLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getCRMHeadLeads',{agent:"browser"}).then(function(response){
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
				$scope.isAllLeads=true;
				$scope.isInboxLeads=false;
			});
		},
		getInboxLeads:function()
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getCRMHeadInboxLeads',{agent:"browser"}).then(function(response){
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
				console.log(res);
				if(res!=0)
				{
					console.log(res);
					 [].push.apply($scope.leadhistory, res);
				}
			$scope.count=$scope.count+5;
			});
			blockUI.stop();
		},
		getLeadids:function()
		{
			selectedLeadIds=[];
			angular.forEach($scope.selected.leads, function(val,key){
				if(val==true) selectedLeadIds.push(key);
			});		
			if(selectedLeadIds.length!=0) $scope.noAssign=false; else $scope.noAssign=true;
		},
		getAssignBox:function()
		{
			$scope.alertMsg='Are You sure, You want to Assign?';
			ngDialog.openConfirm({
			    template:'../template/confirm.html',
		        className: 'ngdialog-theme-default',
		        scope:$scope,
		        closeByEscape:true
		   	}).then(function(){
		   		blockUI.start('Please Wait...');
		   			dataService.getData('/ws/getEMPSbyDept',{agent:"browser"}).then(function(response){
		   				recs=response.data;
		   				if(recs!=0) $scope.emps=recs; else $scope.emps={};
		   			});
		   		blockUI.stop();
				ngDialog.openConfirm({
			   		template:'../template/assignleads.html',
		      		className: 'ngdialog-theme-default',
		       		scope:$scope,
		      		closeByEscape:true
				}).then(function(){

				}).catch(function(){
					$scope.statusSubmitted=false;
					$scope.submitted=false;
					$scope.lead={};
					$scope.leadUpdateStatus={};
				});
		   	}).catch(function(){

		   	});
		},
		subAssignLeads:function(formStatus)
		{
			$scope.assignsubmitted=true;
			if(formStatus)
			{
				$scope.data.empid=$scope.empid.emp_id;
				$scope.data.leadids=selectedLeadIds;
				console.log($scope.data);
			   	blockUI.start('Please Wait...');
				dataService.getData('/ws/assignLeadsbyHead',$scope.data).then(function(response){
					result=response.data;
					    blockUI.stop();
					    console.log(result);
			   			if(result==1)
			   			{
			   				$scope.alertMsg='Successfully Leads are Assigned'
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
		getUpdateBox:function(id,lead_id,qid,leadverified,bid)
		{
			if(qid==null) qid=0;
			if(leadverified==null) qid=0;
			$scope.selected={};
			$scope.lead.bid=bid;
			$scope.busCount=1;
			$scope.lead.lead_id=lead_id;
			$scope.lead.id=id;
			$scope.lead.qid=qid;
			$scope.lead.verified=leadverified;
			if(qid!=0)
			{
				blockUI.start('Please Wait...');
					dataService.getData('/ws/getChecklistData',{id:id}).then(function(response){
						rec=response.data;
						if(rec!=0)
						{
							$scope.lead.if_serial_no=1;
							$scope.checklist=rec;
							$scope.lead.serial_no=rec.serial_no;
							$scope.selected.invoice=rec.diagonals.split(',');
							$scope.lead.check=1;
							$scope.invoiceCount=1;
							$scope.inventoryCount=1;
							$scope.filingCount=1;
							$scope.diagonalsCount=1;
						}
						else $scope.lead.if_serial_no=0;
					});
				blockUI.stop();
			}
			ngDialog.openConfirm({
				template:'../template/updateleadstatus.html',
		    	className: 'ngdialog-theme-default',
		    	scope:$scope,
		    	closeByEscape:true
			}).then(function(){

			}).catch(function(){
				$scope.submitted=false;
				$scope.lead={};
			});
		},
		getEmps:function(id,leadid)
		{
			if(id==1)
			{
				blockUI.start('Please Wait...');
			   		dataService.getData('/ws/getEMPSbyDept',{agent:"browser"}).then(function(response){
			   			recs=response.data;
			   			if(recs!=0) $scope.emps=recs; else $scope.emps={};
			   		});
			   	blockUI.stop();
			}
			else
			{
				blockUI.start('Please Wait...');
				dataService.getData('/ws/getQuotationDetails',{agent:"browser",id:leadid}).then(function(response){
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
		subLeadStatus:function(formStatus)
		{
			$scope.submitted=true;
			if($scope.lead.qid==0 && $scope.lead.status==5 && $scope.lead.moveto==7)
			{
				$scope.lead.prospect_details_id=$filter('foreachval')($scope.lead.quotation.prospect_details_id);
				$scope.lead.rate=$filter('foreachval')($scope.lead.quotation.rate);
				$scope.lead.quantity=$filter('foreachval')($scope.lead.quotation.quantity);				
			}
			if(formStatus)
			{
				if($scope.lead.moveto==1) $scope.lead.movetoemp=$scope.empid.emp_id; else $scope.lead.movetoemp=$scope.lead.moveto;
				blockUI.start('Please Wait...');
		   		dataService.getData('/ws/updateleadstatus',$scope.lead).then(function(response){
		   			result=response.data;
		   			console.log(result);
		   		blockUI.stop();
		   			if(result==1)
		   			{
		   				$scope.lead.status='';
		   				$scope.submitted=false;
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
					$scope.lead_branch_id=recs.sbranchid;
					$scope.lead.lead_branch_id=$scope.lead_branch_id;
					$scope.sempid=recs.sempid;
					console.log($scope.sempid);
				}
			});
		},
		resetForm:function()
		{
			$scope.lead={};
			$scope.submitted=false;
			$scope.lead.lead_branch_id=$scope.lead_branch_id;
			$scope.selected={};
			$scope.busCount=1;
			$scope.lead.source_from=0;
		},
		goBack:function()
		{
			$scope.isLeadView=false;
			$scope.isLeads=true;
		},
		getConfrim:function()
		{
			var res=confirm('Are you sure you want to close it');
			if(res)
			{
				alert('Ok, Close it');
				$('input[name=closeit]').trigger('click').trigger('click')
			}
			else alert('Sorry, Please Try Again');
		},
		getClose:function()
		{
			alert('Ok, Close it');
		},
		columnCheck:function(type,id)
		{
			if(type=='add')
			{
				$scope.count=$scope.count+1;
				$scope.quotation.push($scope.count);
			}
			else
			if(type=='remove')
			{
				$scope.quotation.pop(id);
			}
			getAmount($scope.lead.quotation);
		},
		getAmount:function(quotation)
		{
			rate=0;
			quantity=0;
			total=0;
			angular.forEach(quotation.rate,function(val,key){
				if(quotation.rate[key]==undefined) rate=0; else rate=quotation.rate[key];
				if(quotation.quantity[key]==undefined) quantity=0; else quantity=quotation.quantity[key];
				total+=rate*quantity;
			});
			$scope.quotation.total_amount=total;
		}
	});

	$scope.getLeads();
	$scope.getSESSIONVariable();
});