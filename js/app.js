var app = angular.module('webApp',['blockUI','ngTable','angularjs-datetime-picker','ui.bootstrap','ngDialog']);

var FOLDER='/lyra/work/nivsmart';
//var FOLDER='/nivsmart';

var HOST=window.location.origin+FOLDER;
app.constant('CONSTANTS',{
	'LEADSTATUS':
	{
		'1':
		{
			'id':'0',
			'label':'Fresh Lead',
			'option':'',
			'color':'btn btn-default'
		},
		'7':
		{
			'id':'1',
			'label':'Completed',
			'option':'',
			'color':'btn btn-success'
		},
		'4':
		{
			'id':'2',
			'label':'Droped',
			'option':'Droped',
			'color':'btn btn-danger'
		},
		'5':
		{
			'id':'3',
			'label':'Follow-up',
			'option':'Follow-up',
			'color':'btn btn-warning'
		},
		'6':
		{
			'id':'4',
			'label':'Freezed',
			'option':'Freezed',
			'color':'btn btn-info'
		},
		'3':
		{
			'id':'5',
			'label':'Pipeline',
			'option':'Moved',
			'color':'btn btn-primary'
		},
		'2':
		{
			'id':'6',
			'label':'Cold Process',
			'option':'',
			'color':'btn btn-default'
		},
		'8':
		{
			'id':'7',
			'label':'Roll Back',
			'option':'Roll Back',
			'color':'btn btn-danger'
		}
	},
	'LEADSOURCE':
	{
		'DIRECT':
		{
			'id':0,
			'label':'Direct'
		},
		'TALLY':
		{
			'id':1,
			'label':'Tally'
		},
		'PARTNER':
		{
			'id':2,
			'label':'Partner'
		},
		'BPO':
		{
			'id':3,
			'label':'BPO'
		},
		'BPOPARTNER':
		{
			'id':4,
			'label':'BPO Partner'
		},
		'BPOPARTNER':
		{
			'id':5,
			'label':'Experience Lead'
		}
	},
	'TYPEOFPROCESS':
	{
		'BYSELF':{
			'id':0,
			'label':'By Self'
			},
		'MOVED':{
			'id':1,
			'label':'Moved'
			},
		'ROLLBACK':{
			'id':3,
			'label':'ROll Back'
			},
		'WAITING':{
			'id':4,
			'label':'Waiting for Process'
			}
	},
	'NATUREOFBUSINESS':
	{
		'MANUFACTURING':{
			'id':1,
			'label':'Manufacturing'
			},
		'TRADING':{
			'id':2,
			'label':'Trading'
			},
		'SERVICE':{
			'id':3,
			'label':'Service'
			}
	},
	'PROSPECTTYPE':
	{
		'SALES':
		{
			'id':1,
			'label':'Sales',
			'prodcutid':4
		},
		'SERVICE':
		{
			'id':2,
			'label':'Service',
			'prodcutid':5
		},
		'SOLUTION':
		{
			'id':3,
			'label':'Solution',
			'prodcutid':6
		}
	},
	'DEPT':
	{
		'SALES':
		{
			'id':4,
			'label':'Sales'
		},
		'SERVICE':
		{
			'id':5,
			'label':'Service'
		},
		'SOLUTION':
		{
			'id':6,
			'label':'Solution'
		},
		'ACCOUNTS':
		{
			'id':7,
			'label':'Accounts'
		},
		'FEEDBACK':
		{
			'id':8,
			'label':'Feedback'
		}
	},
	'DOMAINOFBUSINESS':
	{
		'Invoicing':
		{
			'VAT/CST Invoices':
			{
				'id':1,
				'label':'VAT/CST Invoices'
			},
			'Service Tax':
			{
				'id':2,
				'label':'Service Tax'
			},
			'Excise Invoices':
			{
				'id':3,
				'label':'Excise Invoices'
			}
		},
		'Inventory':
		{
			'Inventory':
			{
				'id':1,
				'label':'Inventory'
			},
			'Order Processing':
			{
				'id':2,
				'label':'Order Processing'
			},
			'Manufacturing Journal':
			{
				'id':3,
				'label':'Manufacturing Journal'
			},
			'Job Work':
			{
				'id':4,
				'label':'Job Work'
			}
		},
		'Filing':
		{
			'VAT':
			{
				'id':1,
				'label':'VAT'
			},
			'Service Tax':
			{
				'id':2,
				'label':'Service Tax'
			},
			'Excise for Manufacturing':
			{
				'id':3,
				'label':'Excise for Manufacturing'
			}
		},
		'Diagonals':
		{
			'Banking':
			{
				'id':1,
				'label':'Banking'
			},
			'TDS':
			{
				'id':2,
				'label':'TDS'
			},
			'Payroll':
			{
				'id':3,
				'label':'Payroll'
			},
			'Synchronisation':
			{
				'id':4,
				'label':'Synchronisation'
			},
			'Cost centres':
			{
				'id':5,
				'label':'Cost centres'
			},
			'Security Controls':
			{
				'id':6,
				'label':'Security Controls'
			}
		}
	},
	'EXPENSESTYPES':
	{
		'Maintenance':
		{
			'id':1,
			'label':'Maintenance'
		},
		'Travel':
		{
			'id':2,
			'label':'Travel'
		},
		'Meals':
		{
			'id':3,
			'label':'Meals'
		},
		'Staying':
		{
			'id':4,
			'label':'Staying'
		},
		'Others':
		{
			'id':5,
			'label':'Others'
		}
	},
	'ALERTTIME':1000
});

app.filter('capitalize', function() {
  return function(token) {
      return token.charAt(0).toUpperCase() + token.slice(1);
   }
});

app.filter('toNumber', function() {
    return function(n) {
        return new Number(n);
    };
});

app.filter('percentage', ['$filter', function ($filter) {
  return function (input, decimals) {
    return $filter('number')(input * 100, decimals) + '%';
  };
}]);

app.filter('roundpercentage',function($filter){
	return function(myValue, totalValue){
		if(totalValue==0) totalValue=1;
   		var result = ((myValue/totalValue)*100)
   		return Math.round(result, 2);
	}
});

app.filter('sumByKey', function() {
	return function(data, key) {
		if (typeof(data) === 'undefined' || typeof(key) === 'undefined') {
			return 0;
		}

		var sum = 0;
		for (var i = data.length - 1; i >= 0; i--) {
			if(data[i][key]!=null)
			sum += parseInt(data[i][key]);
		}

		return sum;
	};
});

app.filter('underscoreless', function () {
  return function (input) {
      return input.replace(/_/g, ' ');
  };
});

app.filter("ucwords", function () {
    return function (input){
        if(input) { //when input is defined the apply filter
           input = input.toLowerCase().replace(/\b[a-z]/g, function(letter) {
              return letter.toUpperCase();
           });
        }
        return input; 
    }    
});

app.filter('format', function () {
  return function (item) {
	  if(item){
		   var t = item.split(/[- :]/);	   
		   var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
		   var time=d.getTime();                 
		   return time;
	  }
  };
});

app.filter('foreachval',function($filter){
	return function(data)
	{
		selectedData=[];
		angular.forEach(data,function(val,key){
			selectedData.push(val.replace(/\*/g,'-'));
		});
		return selectedData.join('*');
	}
});

app.filter('getExpensesString',function($filter){
	return function(expenses)
	{
		var data=[];
		var type='';
		var amount='';
		var remarks='';
		angular.forEach(expenses,function(val){
			angular.forEach(val, function(value,key){
				if(key=='expense_type') type+=value+'*';
				if(key=='expense_amount') amount+=parseInt(value)+'*';
				if(key=='expense_remarks') remarks+=value.replace(/\*/g,'-')+'*';
			});
		});
		data={'type':type.substring(0,type.length-1),'amount':amount.substring(0,amount.length-1),'remarks':remarks.substring(0,remarks.length-1)};
		return data;
	}
});

app.filter('getExpensesStatus',function($filter){
	return function(admin_status,master_status,paid_status)
	{
		var data='';
		if(paid_status==1) data='Paid'; else if(paid_status==0 && master_status!='') data='Pending at Accounts'; else if(master_status=='' && admin_status!='') data='Pending at Head Office'; else if(admin_status=='') data='Pending at Branch';
		return data;
	}
});

app.filter('getExpensesArray',function($filter){
	return function(type,amount,remarks,admin_status,admin_remarks,master_status,master_remarks)
	{
		type=type.split('*');
		amount=amount.split('*');
		remarks=remarks.split('*');
		if(admin_status!='') admin_status=admin_status.split('*');
		if(admin_remarks!='') admin_remarks=admin_remarks.split('*');
		if(master_status!='') master_status=master_status.split('*');
		if(master_remarks!='') master_remarks=master_remarks.split('*');
		data=[];
		total=0;
		angular.forEach(type,function(val,key){
			value={};
			if(val!='')
			{
				value.type=val;
				value.amount=parseInt(amount[key]);
				value.remarks=remarks[key];
				if(admin_status!='') value.admin_status=admin_status[key]; else value.admin_status='Pending';
				if(admin_remarks!='') value.admin_remarks=admin_remarks[key]; else value.admin_remarks='';
				if(master_status!='') value.master_status=master_status[key]; else value.master_status='Pending';
				if(master_remarks!='') value.master_remarks=master_remarks[key]; else value.master_remarks='';
				data.push(value);
			}
		});
		return data;
	}
});

app.filter('getquotationarray',function($filter){
	return function(prospect_name,rate,quantity)
	{
		prospect_name=prospect_name.split('*');
		rate=rate.split('*');
		quantity=quantity.split('*');
		data=[];
		total='';
		angular.forEach(prospect_name,function(val,key){
			value={};
			value.prospect_name=val;
			value.rate=rate[key];
			value.quantity=quantity[key];
			data.push(value);
		});
		return data;
	}
});

app.filter('customLabels',function($filter){
	return function(recs,LEADSTATUS)
	{
		angular.forEach(recs,function(value,key){
						recs[key].sno=key+1;
						recs[key].created_date_time=$filter('date')(new Date(value.created_date_time),'dd-MMM-yyyy');
						if(value.status==null) 		value.status=0;
						if(value.is_present==null)  value.is_present=0;
						if(value.dept==null)  		value.dept=0;
						if(value.status==0) recs[key].is_present='Lead Manager';
						else if(value.status==2 && value.is_present==0 && value.lead_completed==0) recs[key].is_present='Feed Back';
						else if(value.is_present==0 && value.dept!=0 && (value.status==2 || value.status==1) && value.lead_completed==1) recs[key].is_present='Closed';
						else if(value.is_present==0 && value.dept!=0) recs[key].is_present=recs[key].dept;
						angular.forEach(LEADSTATUS,function(v,k){
							if(value.status==v.id)
							{
								recs[key].status=v.label;
							}
						});
					});
		return recs;
	}
});

app.filter('customUserDateFilter', function($filter) {
    return function(values, dateString) {
     var filtered = [];
  
      if(typeof values != 'undefined' && typeof dateString != 'undefined') {
        angular.forEach(values, function(value) {
            if($filter('date')(value.Date).indexOf(dateString) >= 0) {
              filtered.push(value);
            }
          });
      }
      
      return filtered;
    }
});

app.filter('splitData',function($filter){
	return function(data, symbol)
	{
		var attend=[];

		var todatyDate=new Date().getDate();
		dates=data.date.split(symbol);
		times=data.time.split(symbol);
		attend_status=data.status.split(symbol);
		absent_session=data.absent_session.split(symbol);
		remarks=data.remarks.split(symbol);

		angular.forEach(dates,function(val,key){
			if(todatyDate==val)
			{
				attend.date=dates[key];
				attend.time=times[key];
				if(attend_status[key]==1) attend.status='Present';
				else if(attend_status[key]==0) attend.status='Absent';
				if(absent_session[key]==1) attend.absent_session='Morning Session';
				else if(absent_session[key]==2) attend.absent_session='Evening Session';
				else if(absent_session[key]==3) attend.absent_session='Full Day';
				else attend.absent_session='-------';
				attend.remarks=remarks[key];
			}
		})
		return attend;
	}
});

app.filter('ymdTodmy', function () {
  return function (item) {
	  if(item){
	   	   var t = item.split(/[- :]/);	   
		   var d = new Date(t[0], t[1]-1, t[2]);
		   var time=d.getTime();                 
		   return time;
	  }
  };
});

app.directive('watchChange', function() {
    return {
        scope: {
            onchange: '&watchChange'
        },
        link: function(scope, element, attrs) {
            element.on('input', function() {
                scope.$apply(function () {
                    scope.onchange();
                });
            });
        }
    };
});

app.config(['ngDialogProvider', function (ngDialogProvider) {
    ngDialogProvider.setDefaults({
        className: 'ngdialog-theme-default',
        showClose: false,
        closeByDocument: false,
        closeByEscape: false
    });
}]);

 app.directive('onlyDigits', function () {
    return {
      require: 'ngModel',
      restrict: 'A',
      link: function (scope, element, attr, ctrl) {
        function inputValue(val) {
          if (val) {
            var digits = val.replace(/[^0-9]/g, '');
            if (digits !== val) {
              ctrl.$setViewValue(digits);
              ctrl.$render();
            }
            return parseInt(digits,10);
          }
          return undefined;
        }            
        ctrl.$parsers.push(inputValue);
      }
    };
});