app.controller('expensesCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		submitted:false,
		attend:{},
		obj:{},
		total:0,
		grandTotal:0
	});

	$scope.count=1;
	$scope.expense=[{expense_type:'',expense_amount:'',expense_remarks:''}];
	$scope.expensesTypes=CONSTANTS.EXPENSESTYPES;

	angular.extend($scope,{
		subExpenses:function(formStatus)
		{
			$scope.submitted=true;
			$scope.obj.data=$filter('getExpensesString')($scope.expense);
			if(formStatus)
			{
				$scope.obj.type=$scope.obj.data.type;
				$scope.obj.amount=$scope.obj.data.amount;
				$scope.obj.remarks=$scope.obj.data.remarks;
				dataService.getData('/ws/submitExpenses',$scope.obj).then(function(response){
					response=response.data;
					if(response!=0)
					{
						$scope.alertMsg='Successfully Submitted';
				   		ngDialog.open({
						    template:'../template/alert.html',
						    className: 'ngdialog-theme-default',
							scope:$scope
						}).closePromise.then(function(){
							$scope.resetForm();
							$scope.total=0;
							totalAmount=0;
							actualAmount=0;
							paidAmount=0;
							angular.forEach(response,function(val,key){
							response[key].sno=key+1;
							totalAmount=val.amount.split('*');
							response[key].status=$filter('getExpensesStatus')(val.admin_status,val.master_status,val.paid_status);
							angular.forEach(totalAmount,function(v,k){
								if(v!='')
								{
									actualAmount+=parseInt(v);
									if(response[key].status=='Paid')
									{
										if(val.master_status.split('*')[k]=='Approved') paidAmount+=parseInt(v);
									}
								} 
							});
							response[key].from_date=$filter('date')(new Date(val.from_date),'dd-MMM-yyyy');
							response[key].to_date=$filter('date')(new Date(val.to_date),'dd-MMM-yyyy');
							if(val.paid_date_time!='0000-00-00 00:00:00') response[key].paid_date_time=$filter('date')(new Date(val.paid_date_time),'dd-MMM-yyyy'); else response[key].paid_date_time='------';
							response[key].actualAmount='Rs. '+actualAmount;
							if(response[key].status=='Paid') response[key].paidAmount='Rs. '+paidAmount;
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
		getEMPExpenses:function()
		{
			dataService.getData('/ws/getEMPExpenses',$scope.obj).then(function(response){
					response=response.data;
					if(response!=0)
					{
						angular.forEach(response,function(val,key){
							actualAmount=0;
							paidAmount=0;
							response[key].sno=key+1;
							totalAmount=val.amount.split('*');
							response[key].status=$filter('getExpensesStatus')(val.admin_status,val.master_status,val.paid_status);
							angular.forEach(totalAmount,function(v,k){
								if(v!='')
								{
									actualAmount+=parseInt(v);
									if(response[key].status=='Paid')
									{
										if(val.master_status.split('*')[k]=='Approved') paidAmount+=parseInt(v);
									}
								} 
							});
							response[key].from_date=$filter('date')(new Date(val.from_date),'dd-MMM-yyyy');
							response[key].to_date=$filter('date')(new Date(val.to_date),'dd-MMM-yyyy');
							if(val.paid_date_time!='0000-00-00 00:00:00') response[key].paid_date_time=$filter('date')(new Date(val.paid_date_time),'dd-MMM-yyyy'); else response[key].paid_date_time='------';
							response[key].actualAmount='Rs. '+actualAmount;
							if(response[key].status=='Paid') response[key].paidAmount='Rs. '+paidAmount;
						});
						$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: response});
					}
					else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
				});
		},
		getViewExpense:function(rec)
		{
			$scope.data={};
			$scope.data=rec;
			$scope.types=CONSTANTS.EXPENSESTYPES;
			$scope.data.rows=$filter('getExpensesArray')(rec.type,rec.amount,rec.remarks,rec.admin_status,rec.admin_remarks,rec.master_status,rec.master_remarks);
			ngDialog.openConfirm({
				template:'../template/expenses_view.html',
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
			$scope.expense=[];
			$scope.expense=[{expense_type:'',expense_amount:'',expense_remarks:''}];
			$scope.total=0;
		},
		columnCheck:function(type,id)
		{
			if(type=='add')
			{
				$scope.count=$scope.count+1;
				$scope.expense.push({expense_type:'',expense_amount:'',expense_remarks:''});
			}
			else
			if(type=='remove')
			{
				var newExpList=[];
				angular.forEach($scope.expense,function(val,key){
					if(id!=key) newExpList.push(val);
				});
				$scope.expense=newExpList;
				total=0;
				angular.forEach($scope.expense,function(val,key){
					if(val.expense_amount!=undefined && val.expense_amount!='')
					{
						value=parseInt(val.expense_amount);
						total+=parseInt(value);	
					}
				});
				$scope.total=total;
			}
		},
		getAmount:function()
		{
			total=0;
			angular.forEach($scope.expense,function(val,key){

				if(val.expense_amount!=undefined && val.expense_amount!='')
				{
					value=parseInt(val.expense_amount);
					total+=parseInt(value);	
				}
			});
			$scope.total=total;
		}
	});
$scope.getEMPExpenses();
});