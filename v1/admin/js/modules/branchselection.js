app.controller('branchSelection', function($scope,$http,blockUI,alertService,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		lead:{},
		submitted:false,
		ALERTTIME:3000,
		isEntry:false,
		onCheck:false,
		shortlead:{},
	});

	$scope.lead.agent="browser";
	$scope.prospecttype=CONSTANTS.PROSPECTTYPE;

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
		selectBranch:function(id,samepage)
		{
			blockUI.start('Please Wait...');
			dataService.getData('/ws/goBranch',{agent:"browser",id:id}).then(function(response){
				response=response.data;
				if(response=='0')
				{
					location.href='../index.php';
				}
				else
				if(response==1)
				{
					alertService.add('danger', 'You are unable to Login This Branch', $scope.ALERTTIME);					
				}
				else
				{
					if(samepage==true) location.href="?";
					else location.href="dashboard.php";
				}
			});
			blockUI.stop();
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
		getSESSIONVariable:function()
		{
			dataService.getData('/ws/getSESSIONVariable',{}).then(function(response){
				recs=angular.copy(response.data);
				if(recs!='')
				{
					$scope.lead_branch_id=recs.sbranchid;
					$scope.lead.lead_branch_id=$scope.lead_branch_id;
					$scope.sroleid=recs.sroleid;
				}
			});
		},
		getShortLead:function()
		{
			$scope.shortlead={};
			$scope.submitted=false;
			$scope.shortlead.lead_branch_id=$scope.lead_branch_id;
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
		}
	});
	$scope.getSESSIONVariable();
	$scope.getLeadFields();
});