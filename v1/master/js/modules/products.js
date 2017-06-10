app.controller('productCtrl', function($scope,$http,blockUI,alertService,NgTableParams,$filter,$parse,dataService){

	angular.extend($scope,{
		obj:{},
		submitted:false,
		exist:false,
		states:[],
		cities:[],
		ALERTTIME:3000
	});

	$scope.obj.agent="browser";

	angular.extend($scope,{

		subForm:function(formStatus)
		{
			$scope.submitted=true;
			if(formStatus==true)
			{
				TYPE='success';
				if($scope.obj.id)
				{
					LOADMSG='Updating...';
					MSG='Successfully Updated';
				}
				else
				{
					LOADMSG='Adding...';
					MSG='Successfully Added';
				}
				blockUI.start(LOADMSG);
				$scope.obj.agent="browser";
					dataService.getData('/ws/addProduct',$scope.obj).then(function(response){
				data=response.data;
					blockUI.stop();
					if(data.status!=0)
					{
						$scope.obj={};
						$scope.submitted=false;
						$scope.products=angular.copy(data.recs);
						angular.forEach($scope.products,function(val,key){
							$scope.products[key].sno=key+1;
						});
						$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: $scope.products});
						alertService.add(TYPE, MSG, $scope.ALERTTIME);
					}
					else
					{
						$scope.obj.exist=true;
						alertService.add('danger', 'Product Already Exists', $scope.ALERTTIME);
					}
				});
			}
		},
		getProducts:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getProducts',{agent:"browser"}).then(function(response){
				data=response.data;
				angular.forEach(data,function(val,key){
							data[key].sno=key+1;
				});
				$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: data});
				blockUI.stop();
			});
		},
		getProductTypes:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getProductTypes',{agent:"browser"}).then(function(response){
				data=response.data;
				console.log(data);
				$scope.productTypes=angular.copy(data);
				blockUI.stop();
			});
		},
		getProduct:function(productid)
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getProduct',{agent:"browser",id:productid}).then(function(response){
				response=response.data;
				$scope.obj=angular.copy(response);
				$scope.getCities($scope.obj.state_id);
				blockUI.stop();
			});
		},
		changeProductStatus:function(productId,status)
		{
			$scope.submitted=false;
			$scope.obj={};
			if(status==undefined) status=0;
			blockUI.start('Please Wait...');
				dataService.getData('/ws/changeProductStatus',{agent:"browser",id:productId,status:status}).then(function(response){
				response=response.data;
				if(response)
				{
					$scope.products=angular.copy(response);
					angular.forEach($scope.products,function(val,key){
							$scope.products[key].sno=key+1;
						});
						$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: $scope.products});
					alertService.add('success', 'Successfully Updated', $scope.ALERTTIME);
					blockUI.stop();
				}
			});
		},
		resetForm:function()
		{
			$scope.submitted=false;
			$scope.obj=false;
		}
	});
	$scope.getProductTypes();
	$scope.getProducts();
});