app.controller('natureofBusinessCtrl', function($scope,$http,blockUI,alertService,CONSTANTS,NgTableParams,$filter,$parse,dataService){

	angular.extend($scope,{
		obj:{},
		submitted:false,
		exist:false,
		ALERTTIME:3000
	});

	$scope.obj.agent="browser";
	$scope.business_type_id=CONSTANTS.NATUREOFBUSINESS;

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
					dataService.getData('/ws/addBusiness',$scope.obj).then(function(response){
				data=response.data;
					blockUI.stop();
					if(data.status!=0)
					{
						$scope.obj={};
						$scope.submitted=false;
						$scope.business=angular.copy(data.recs);	
						angular.forEach($scope.business,function(val,key){
							angular.forEach($scope.business_type_id,function(v,k){
								if(val.business_type_id==v.id) $scope.business[key].business_type_id=v.label;
							});
							$scope.business[key].sno=key+1;
						});
						$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: $scope.business});
						alertService.add(TYPE, MSG, $scope.ALERTTIME);
					}
					else
					{
						$scope.obj.exist=true;
						alertService.add('danger', 'Business Name Already Exists', $scope.ALERTTIME);
					}
				});
			}
		},
		getBusiness:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getBusiness',{agent:"browser"}).then(function(response){
				data=response.data;
				$scope.business=angular.copy(data);
				angular.forEach($scope.business,function(val,key){
					angular.forEach($scope.business_type_id,function(v,k){
						if(val.business_type_id==v.id) $scope.business[key].business_type_id=v.label;
					});
					$scope.business[key].sno=key+1;
				});
				$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: $scope.business});
				blockUI.stop();
			});
		},
		getBusinessName:function(businessnameid)
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getBusinessName',{agent:"browser",id:businessnameid}).then(function(response){
				response=response.data;
				$scope.obj=angular.copy(response);
				blockUI.stop();
			});
		},
		changeBusinessStatus:function(productId,status)
		{
			$scope.submitted=false;
			$scope.obj={};
			if(status==undefined) status=0;
			blockUI.start('Please Wait...');
				dataService.getData('/ws/changeBusinessStatus',{agent:"browser",id:productId,status:status}).then(function(response){
				response=response.data;
				if(response)
				{
					$scope.business=angular.copy(response);
					angular.forEach($scope.business,function(val,key){
						angular.forEach($scope.business_type_id,function(v,k){
							if(val.business_type_id==v.id) $scope.business[key].business_type_id=v.label;
						});
						$scope.business[key].sno=key+1;
					});
					$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: $scope.business});
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
	$scope.getBusiness();
});