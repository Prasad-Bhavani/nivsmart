		clickToOpen:function(){
			$scope.text='Are You Sure';
			ngDialog.openConfirm({
	            template:'../template/confirm.html',
	            className: 'ngdialog-theme-default',
	            scope:$scope
	        	}).then(function(val) {
	        		location.href="leads.php";
				}).catch(function (val) {
					location.href="profile.php";
			});
		},


		,
		checkColdStatus:function($event, id)
		{
			var isChecked=$event.target.checked;
			if(isChecked)
			{
				$scope.alertMsg='Are you sure to taken?';
				ngDialog.openConfirm({
				    template:'../template/confirm.html',
				    className: 'ngdialog-theme-default',
				    scope:$scope
				    }).then(function(){
				    	$scope.isCheckedOff=true;
				    	$scope.isUpdate_id=true;
					$http({
						method:'post',
						url: HOST+"/ws/takenColdLead",
						data:{agent:"browser",id:id},
						headers: {'Content-Type': 'application/x-www-form-urlencoded'}
					})
					.success(function(data){
						console.log(data);
					});
				    }).catch(function(){
				   	 	$scope.isCheckedOff=false;
				    	$event.target.checked=false;
				    	$scope.isUpdate_id=false;
					});
			}
		}

