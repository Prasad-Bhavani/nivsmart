app.controller('expensesCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		submitted:false,
		submit:true,
		attend:{},
		obj:{},
		pay:{},
		isView:true
	});

	$scope.count=1;
	$scope.expense=[1];
	$scope.expensesTypes=CONSTANTS.EXPENSESTYPES;

	angular.extend($scope,{
		subExpensesStatus:function(formStatus)
		{
			$scope.submit=true;
			if(formStatus)
			{
				dataService.getData('/ws/updateExpensesByACUNT',$scope.pay).then(function(response){
						response=response.data;
						console.log(response);
					if(response==1)
					{
						$scope.alertMsg='Successfully Updated';
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
		subExpenses:function(formStatus)
		{
			$scope.submitted=true;
			if(formStatus)
			{
				$scope.obj.type=$filter('foreachval')($scope.obj.expense_type);
				$scope.obj.amount=$filter('foreachval')($scope.obj.expense_amount);
				$scope.obj.remarks=$filter('foreachval')($scope.obj.expense_remarks);
				dataService.getData('/ws/submitExpenses',$scope.obj).then(function(response){
					response=response.data;
					console.log(response);
					if(response!=0)
					{
						$scope.alertMsg='Successfully Submitted';
				   		ngDialog.open({
						    template:'../template/alert.html',
						    className: 'ngdialog-theme-default',
							scope:$scope
						}).closePromise.then(function(){
							$scope.resetForm();
							angular.forEach(response,function(val,key){
							response[key].sno=key+1;
							if(val.paid_status!='') response[key].status='Closed'; else response[key].status='Pending';
							response[key].from_date=$filter('date')(new Date(val.from_date),'dd-MMM-yyyy');
							response[key].to_date=$filter('date')(new Date(val.to_date),'dd-MMM-yyyy');
							if(val.paid_date_time!='0000-00-00 00:00:00') response[key].paid_date_time=$filter('date')(new Date(val.paid_date_time),'dd-MMM-yyyy'); else response[key].paid_date_time='------';
						});
						$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: response});
						});
					}
					else
					{
						$scope.alertMsg='Error Occured, Please try Again!';
				   		ngDialog.open({
						    template:'../template/alert.html',
						    className: 'ngdialog-theme-default',
							scope:$scope
						}).closePromise.then(function(){
						});	
					}
				});
			}
		},
		getEMPExpensesbyBranch:function()
		{
			dataService.getData('/ws/getEMPExpensesbyBranch',$scope.obj).then(function(response){
					response=response.data;
					console.log(response);
					if(response!=0)
					{
						angular.forEach(response,function(val,key){
							response[key].sno=key+1;
							response[key].status=$filter('getExpensesStatus')(val.admin_status,val.master_status,val.paid_status);
							response[key].from_date=$filter('date')(new Date(val.from_date),'dd-MMM-yyyy');
							response[key].to_date=$filter('date')(new Date(val.to_date),'dd-MMM-yyyy');
							if(val.paid_date_time!='0000-00-00 00:00:00') response[key].paid_date_time=$filter('date')(new Date(val.paid_date_time),'dd-MMM-yyyy'); else response[key].paid_date_time='------';
						});
						$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: response});
					}
					else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
				});
		},
		getViewExpense:function(rec)
		{
			$scope.submit=false;
			$scope.pay={};
			$scope.data={};
			$scope.data=rec;
			$scope.pay.payid=rec.id;
			$scope.isView=true;
			$scope.types=CONSTANTS.EXPENSESTYPES;
			$scope.data.rows=$filter('getExpensesArray')(rec.type,rec.amount,rec.remarks,rec.admin_status,rec.admin_remarks,rec.master_status,rec.master_remarks);
			ngDialog.openConfirm({
				template:'template/expenses_view.html',
			    className: 'ngdialog-theme-default custom-width-800',
			    scope:$scope,
			    closeByEscape:true
			}).then(function(){
			}).catch(function(){
			});
		},
		resetForm:function()
		{
			$scope.submitted=false;
			$scope.obj={};
			$scope.expense=[1];
		},
		columnCheck:function(type,id)
		{
			if(type=='add')
			{
				$scope.count=$scope.count+1;
				$scope.expense.push($scope.count);	
			}
			else
			if(type=='remove')
			{
				angular.element( document.querySelector( '#expense_'+id ) ).remove();
				$scope.expense.pop(id);
			}
		},
		getUpdate:function()
		{
			$scope.isView=false;
		}
	});
$scope.getEMPExpensesbyBranch();
});