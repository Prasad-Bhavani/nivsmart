app.controller('dashboardCtrl', function($scope,$http,blockUI,alertService,NgTableParams,$filter,$parse,dataService,CONSTANTS){

	angular.extend($scope,{
		leadsCount:{},
		leadsPercent:{},
		isDashboard:true,
		isSearch:false,
		isLeads:false,
		isLeadView:false,
		search:{},
		submitted:false,
		isEMPS:false,
		type:'Branch',
		isTargets:true
	});

	$scope.LEADSTATUS=CONSTANTS.LEADSTATUS;
	$scope.products=CONSTANTS.PROSPECTTYPE;
	$scope.search.dept_id='All';
	$scope.search.role_id="All";
	$scope.search.emp_id="All";
	$scope.search.type=0;

	angular.extend($scope,{
		subSearchForm:function(formstatus)
		{
			$scope.submitted=true;
			$scope.search.branch_id=$scope.branchid;
			$scope.search.status_id=$scope.statusid;
			if(formstatus)
			{
				blockUI.start('Please Wait...');
				dataService.getData('/ws/getLeadsBySearch',{search:$scope.search}).then(function(response){
					console.log(response);
					//datas=angular.copy(response.data);
				blockUI.stop();
				});
			}
		},   
		getSearchFields:function()
		{
			$scope.search.dept_id="All";
			$scope.search.role_id="All";
			$scope.search.emp_id="All";
			$scope.search.type=0;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getSearchFields',{}).then(function(response){
				response=angular.copy(response.data);
				$scope.DEPT=response.depts;
				$scope.EMPS=response.emps;
			blockUI.stop();
			});
		},   
		getRolesbyDept:function(dept_id)
		{
			$scope.search.role_id="All";
			$scope.search.emp_id="All";
			$scope.search.type=0;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getRolesbyDept',{dept_id:dept_id}).then(function(response){
				response=angular.copy(response.data);
				console.log(response);
				$scope.roles=response.roles;
				$scope.EMPS=response.emps;
			blockUI.stop();
			});
		},   
		getEMPSbyRole:function(role_id)
		{
			$scope.search.emp_id="All";
			$scope.search.type=0;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getEMPSbyRole',{role_id:role_id}).then(function(response){
				console.log(response);
				response=angular.copy(response.data);
				$scope.EMPS=response;
			blockUI.stop();
			});
		},
		getLeadsCountByStatus:function()
			{
				dataService.getData('/ws/getLeadsCountByStatus',{agent:"browser",status:$scope.LEADSTATUS}).then(function(response){
					response=response.data;
					console.log(response);
					var getTotal=0;
					statusCount=[];

					angular.forEach($scope.LEADSTATUS,function(val,key)
					{
						statusCount[val.id]=0;
					});

					angular.forEach(response,function(val,key){
						var alltotal=0;
						var statusIndiTotal=0;
						angular.forEach(val.count,function(val,key){
							alltotal+=val;
						});
						response[key].alltotal=alltotal;
						getTotal+=alltotal;
						statusCount[0]+=val.count[0];
						statusCount[1]+=val.count[1];
						statusCount[2]+=val.count[2];
						statusCount[3]+=val.count[3];
						statusCount[4]+=val.count[4];
						statusCount[5]+=val.count[5];
						statusCount[6]+=val.count[6];
					});
					$scope.getTotal=getTotal;
					$scope.statusCount=statusCount;
					$scope.leadsCount=response;
			});			
		},
		getLeadsCountByProduct:function()
			{
				blockUI.start('Please Wait...');
				dataService.getData('/ws/getLeadsCountByProduct',{agent:"browser",status:$scope.LEADSTATUS,products:$scope.products}).then(function(response){
					response=response.data;
					console.log(response);
					var getProductTotal=0;
					prodcutstatusCount=[];

					angular.forEach($scope.LEADSTATUS,function(val,key)
					{
						prodcutstatusCount[val.id]=0;
					});

					angular.forEach(response,function(val,key){
						var alltotal=0;
						var statusIndiTotal=0;
						angular.forEach(val.count,function(val,key){
							alltotal+=val;
						});
						response[key].alltotal=alltotal;
						getProductTotal+=alltotal;
						prodcutstatusCount[0]+=val.count[0];
						prodcutstatusCount[1]+=val.count[1];
						prodcutstatusCount[2]+=val.count[2];
						prodcutstatusCount[3]+=val.count[3];
						prodcutstatusCount[4]+=val.count[4];
						prodcutstatusCount[5]+=val.count[5];
						prodcutstatusCount[6]+=val.count[6];
					});
					$scope.getProductTotal=getProductTotal;
					$scope.prodcutstatusCount=prodcutstatusCount;
					$scope.prodcutleadsCount=response;
					console.log($scope.prodcutleadsCount);
				blockUI.stop();
			});			
		},
		getLeads:function(branchid,status)
		{
			$scope.type='Branch';
			$scope.search.dept_id="All";
			$scope.search.role_id="All";
			$scope.search.emp_id="All";
			$scope.search.type=0;
			$scope.branchid=branchid;
			$scope.statusid=status;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getLeadsforDashboard',{branchid:branchid,status:status}).then(function(response){
				recs=angular.copy(response.data);
				console.log(recs);
				if(recs!='0')
				{
					recs=$filter('customLabels')(recs,$scope.LEADSTATUS);
					$scope.leads=recs;
            		$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
				}
				else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
				$scope.isLeads=true;
				$scope.isEMPS=false;
			blockUI.stop();
			});
		},
		getLeadsbyProduct:function(productid,status)
		{
			$scope.type='Product';
			$scope.search.dept_id="All";
			$scope.search.role_id="All";
			$scope.search.emp_id="All";
			$scope.search.type=0;
			$scope.productid=productid;
			$scope.statusid=status;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getLeadsbyProduct',{productid:productid,status:status}).then(function(response){
				recs=angular.copy(response.data);
				console.log(recs);
				if(recs!='0')
				{
					recs=$filter('customLabels')(recs,$scope.LEADSTATUS);
					$scope.leads=recs;
            		$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: recs});
				}
				else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
				$scope.isLeads=true;
				$scope.isEMPS=false;
			blockUI.stop();
			});
		},
		getLead:function(id,status)
		{
			$scope.count=1;
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getViewLead',{agent:"browser",id:id,status:status}).then(function(response){
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
					$scope.isEMPS=false;
					$scope.isLeadView=true;
					$scope.isDashboard=false;
				}
			});
			blockUI.stop();
		},
		getViewMoreHistory:function(leadid)
		{
			console.log($scope.count);
			blockUI.start('Please Wait...');
			dataService.getData('/ws/getViewMoreHistory',{agent:'browser',leadid:leadid,count:$scope.count}).then(function(response){
				res=response.data;
				console.log(res);
				if(res!='')
				{
					 [].push.apply($scope.leadhistory, res);
				}
			$scope.count=$scope.count+5;
			});
			blockUI.stop();
		},
		openSearch:function()
		{
			$scope.isSearch=true;
		},
		closeSearch:function()
		{
			$scope.isSearch=false;
		},
		goBack:function(page)
		{
			$scope.isLeadView=false;
			$scope.isLeads=true;
			$scope.isDashboard=true;
		},
		resetForm:function()
		{
			$scope.search={};
			$scope.search.branch_id="All";	
			$scope.isSearch=false;
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getLeadsCountByStatus',{agent:"browser",status:$scope.LEADSTATUS}).then(function(response){
					response=response.data;
					$scope.totalLeads=response[0]+response[1]+response[2]+response[3]+response[4]+response[5]+response[6];
					angular.forEach(response,function(val,key){
						$scope.leadsPercent[key]=$filter('roundpercentage')(val,$scope.totalLeads);
					});
					$scope.leadsCount=response;
				blockUI.stop();
			$scope.isLeadView=false;
			$scope.isLeads=false;
			$scope.isDashboard=true;
			});		
		},
		leadsClosed:function()
		{
			$scope.isLeadView=false;
			$scope.isLeads=false;
			$scope.isEMPS=false;
			$scope.isDashboard=true;
			$scope.statusid='';
			$scope.branchid='';			
		},
		getEMPAttendCount:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getEMPAttendCount',{agent:"browser"}).then(function(response){
				response=response.data;
				$scope.counts=response;
			blockUI.stop();
			});
		},
		getEMPSbyAttendance:function(empids,searchby)
		{
			$scope.statusid='';
			$scope.branchid='';
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getEMPSbyAttendance',{agent:"browser",empids:empids,searchby:searchby}).then(function(response){
				response=response.data;
				console.log(response);
				if(response!=0)
				{
					angular.forEach(response,function(val,key){
						response[key].sno=key+1;
						if(searchby!='pending') response[key].attend=$filter('splitData')(val,'*');
					});
					$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: response});			
				}
				else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
			blockUI.stop();

			$scope.isLeads=false;
			$scope.isEMPS=true;
			});		
		},
		getTargets:function()
		{
			if($scope.isTargets) $scope.isTargets=false; else $scope.isTargets=true;
		}
	});

$scope.getLeadsCountByStatus();
$scope.getSearchFields();
$scope.getEMPAttendCount();
$scope.getLeadsCountByProduct();
});