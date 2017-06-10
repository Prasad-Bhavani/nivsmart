app.controller('attendanceCtrl', function($scope,$http,blockUI,$rootScope,alertService,NgTableParams,$filter,$parse,CONSTANTS,ngDialog,dataService){

	var self = this;

	angular.extend($scope,{
		attendSubmitted:false,
		attend:{}
	});

	leadhistory=[];
	$scope.lead.agent="browser";

	angular.extend($scope,{
		getAttendanceBox:function(formStatus)
		{
			dataService.getData('/ws/checkEMPAttendace',{agent:"browser"}).then(function(response){
				console.log(response.data);
				if(response.data==0)
				{
					today=new Date().getDay();
					if(today!=0)
					{
						$scope.attend={};
						$scope.attend.date=$filter('date')(new Date(), 'dd-MMM-yyyy');
						$scope.attendSubmitted=false;
						ngDialog.openConfirm({
							template:'../template/emp_attendance.html',
							className: 'ngdialog-theme-default',
							scope:$scope,
							closeByEscape:true
						}).then(function(){
						}).catch(function(){
						});
					}					
				}
			});
		},
		subAttendanceForm:function(formStatus)
		{
			$scope.attendSubmitted=true;
			if(formStatus)
			{
				dataService.getData('/ws/sendEMPAttendance',$scope.attend).then(function(response){
					response=response.data;
					console.log(response);
					if(response==1)
					{
						$scope.alertMsg='Successfully Sent';
				   		ngDialog.open({
						    template:'../template/alert.html',
						    className: 'ngdialog-theme-default',
							scope:$scope
						}).closePromise.then(function(){
							$('input[name=close]').trigger('click').trigger('click');	
						});			
					}
					else
					{
						$scope.alertMsg='Sorry, Please try Again!';
				   		ngDialog.open({
						    template:'../template/alert.html',
						    className: 'ngdialog-theme-default',
							scope:$scope
						});	
					}
				});
			}
		}
	});
	//$scope.getAttendanceBox();
});