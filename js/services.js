app.service('dataService', function($http,ngDialog) {
	
   this.getData = function(serv,obj,$scope) {	   
	   obj.agent="browser";
	   return $http({
			  method: "post",
			  url: HOST+serv,
			  data:obj,		  
			  headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
		})
		.success(function (data) {
		if(data==104)
		{
			ngDialog.open({
				            template:'../template/session_expired.html',
				            className: 'ngdialog-theme-default',
				            scope:$scope
				    }).closePromise.then(function(){
				    	window.location='../index.php';
				    });
		}
		else return data;
		}).error(function(data){         	
         	return data ;
        });
   }
});