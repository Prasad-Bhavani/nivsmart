app.controller('teamCtrl', function($scope,$http,blockUI,alertService,NgTableParams,$filter,$parse,dataService,ngDialog){

	angular.extend($scope,{
		obj:{},
		target:{},
		submitted:false,
		targetSubmit:false,
		ifGenerate:false,
		ALERTTIME:3000,
		generateSubmit:false
	});

	$scope.obj.agent="browser";
	$scope.months=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];
	$scope.years=[new Date().getFullYear()-1,new Date().getFullYear(),new Date().getFullYear()+1];

	angular.extend($scope,{
		subTargetForm:function(formStatus)
		{
			$scope.targetSubmit=true;
			if(formStatus)
			{
				blockUI.start('Please Wait...');
				angular.forEach($scope.targetslist,function(value,key){
					var mon=[];
					var target=[];
					var reached=[];
					angular.forEach(value.target,function(v,k){
						mon.push(v.mon);
						target.push(v.target);
						reached.push(0);
					});
					if($scope.targetslist.id=='') $scope.targetslist[key].targetList={'months':mon.join('*'),'targets':target.join('*')};
					else $scope.targetslist[key].targetList={'months':mon.join('*'),'targets':target.join('*'),'reached_targets':reached.join('*')};
				});
				dataService.getData('/ws/addTeamTargets',{'teamData':$scope.targetslist}).then(function(response){
					data=response.data;
					if(data!=0)
						{
							angular.forEach(data,function(val,key){
								data[key].sno=key+1;
								data[key].created_date_time=$filter('date')(new Date(val.created_date_time),'dd-MMM-yyyy hh:mm a');
								if(val.updated_date_time!='0000-00-00 00:00:00') data[key].updated_date_time=$filter('date')(new Date(val.updated_date_time),'dd-MMM-yyyy hh:mm a'); else data[key].updated_date_time='';
							});
							$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: data});
						}
						else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: {}});
					$scope.resetForm();
					alertService.add('success', 'Successfully Teams Target Created', $scope.ALERTTIME);
					blockUI.stop();
				});
			}
		},
		subGenerate:function(formStatus)
		{
			$scope.generateSubmit=true;
			if(formStatus)
			{
				$scope.targetslist=[];
				$scope.ifGenerate=true;
				var monthstart=$scope.target.monthstart;
				var period=$scope.target.period;
				angular.forEach($scope.teams,function(value,key){
				if(value.status==1)
				{
					teamName={'team':value.name};
					var target=[];
					var periodstart='';
					var periodend  ='';
					for(var i=parseInt(monthstart);i<(parseInt(monthstart)+parseInt(period));i++)
					{
						var data={};
						if(i>12) num=i-12; else num=i;
						if(i>12) year=parseInt($scope.target.yearstart)+1; else year=$scope.target.yearstart;
						data.mon=$scope.months[num-1]+'-'+year;
						data.target=0;
						target.push(data);
						start=$scope.months[$scope.target.monthstart-1]+'-'+$scope.target.yearstart;
						end=$scope.months[num-1]+'-'+year;
					}
				$scope.targetslist.push({'team':value.name,'target_period':start+' to '+end,'team_id':value.id,'target':target,'total_target':0});				
				}
			});
			}
		},
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
					dataService.getData('/ws/addTeam',$scope.obj).then(function(response){
				data=response.data;
					blockUI.stop();
					if(data==2)
					{
						$scope.obj.exist=true;
						alertService.add('danger', 'Team Already Exist', $scope.ALERTTIME);
					}
					else
					{
						$scope.obj={};
						$scope.submitted=false;
						if(data!=0)
						{
							$scope.teams=data;
							angular.forEach(data,function(val,key){
								data[key].sno=key+1;
							});
							$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: data});
						}
						else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: {}});
						alertService.add(TYPE, MSG, $scope.ALERTTIME);
					}
				});
			}
		},
		getTeamsTargets:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getTeamsTargets',{agent:"browser"}).then(function(response){
				data=response.data;
				console.log(data);
				if(data!=0)
				{
					angular.forEach(data,function(val,key){
						data[key].sno=key+1;
						data[key].created_date_time=$filter('date')(new Date(val.created_date_time),'dd-MMM-yyyy hh:mm a');
						if(val.updated_date_time!='0000-00-00 00:00:00') data[key].updated_date_time=$filter('date')(new Date(val.updated_date_time),'dd-MMM-yyyy hh:mm a'); else data[key].updated_date_time='';
					});
					$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: data});
				}
				else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: ''});
				blockUI.stop();
			});
		},
		getTeamTargets:function(id)
		{
			$scope.reachedtargets=[];
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getTeamTargets',{agent:"browser",id:id}).then(function(response){
				$scope.reachedtargets=response.data;
				if(response.data.sales_target_updated_date!='0000-00-00 00:00:00') response.data.sales_target_updated_date=$filter('date')(new Date(response.data.sales_target_updated_date),'dd-MMM-yyyy hh:mm a'); else response.data.sales_target_updated_date='';
				if(response.data.bonus_updated_date!='0000-00-00 00:00:00') response.data.bonus_updated_date=$filter('date')(new Date(response.data.bonus_updated_date),'dd-MMM-yyyy hh:mm a'); else response.data.bonus_updated_date='';
				ngDialog.openConfirm({
				template:'template/update_team_targets.html',
			    className: 'ngdialog-theme-default custom-width-800',
			    scope:$scope,
			    closeByEscape:true
				}).then(function(){
				}).catch(function(){
				});
				blockUI.stop();
			});
		},
		subUpdateTargets:function()
		{
			storedData=[];
			var totalReached=0;
			var target_updated_date_time='';
			angular.forEach($scope.reachedtargets.reached,function(val,key){
				if(val==undefined) val=0;
				value=val;
				val=parseInt(val)+parseInt($scope.reachedtargets.reached_targets.split('*')[key]);
				totalReached+=val;
				if(target_updated_date_time!='') target_updated_date_time+='*';
				if(value!=0) target_updated_date_time+=$filter('date')(new Date(),'dd-MMM-yyyy hh:mm a');
				else
				if($scope.reachedtargets.target_updated_date_time.split('*')[key]!=undefined && $scope.reachedtargets.target_updated_date_time.split('*')[key]!=0)
					target_updated_date_time+=$scope.reachedtargets.target_updated_date_time.split('*')[key];
				else target_updated_date_time+='0';
				storedData.push(val);
			});
			if($scope.reachedtargets.sales_target_new==undefined) $scope.reachedtargets.sales_target_new=0;
			if($scope.reachedtargets.bonus_new==undefined) $scope.reachedtargets.bonus_new=0;
			$scope.subReachedTarget={'id':$scope.reachedtargets.id,'reached_targets':storedData.join('*'),'reached_target':totalReached,'target_updated_date_time':target_updated_date_time,'sales_target':$scope.reachedtargets.sales_target_new,'bonus':$scope.reachedtargets.bonus_new};
			blockUI.start('Please Wait...');
				dataService.getData('/ws/updateTeamTargets',$scope.subReachedTarget).then(function(response){
					result=response.data;
					console.log(result);
					blockUI.stop();
					$scope.alertMsg='Successfully Updated';
					ngDialog.open({
				            template:'../template/alert.html',
				            className: 'ngdialog-theme-default',
				            scope:$scope
				        	}).closePromise.then(function(){
					window.location.href='?';
				});
			});
		},
		getTeams:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getTeams',{agent:"browser"}).then(function(response){
				data=response.data;
				$scope.teams={};
				if(data!=0)
				{
					angular.forEach(data,function(val,key){
						data[key].sno=key+1;
					});
					$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: data});
					$scope.teams=data;
				}
				else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: {}});
				blockUI.stop();
			});
		},
		getAllTeams:function()
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getTeams',{agent:"browser"}).then(function(response){
				data=response.data;
				$scope.teams={};
				if(data!=0)
				{
					$scope.teams=data;
				}
				blockUI.stop();
			});
		},
		getTeam:function(teamId)
		{
			blockUI.start('Please Wait...');
				dataService.getData('/ws/getTeam',{agent:"browser",id:teamId}).then(function(response){
				response=response.data;
				$scope.obj=angular.copy(response);
				blockUI.stop();
			});
		},
		changeTeamStatus:function(teamId,status)
		{
			$scope.submitted=false;
			$scope.obj={};
			if(status==undefined) status=0;
			blockUI.start('Please Wait...');
				dataService.getData('/ws/changeTeamStatus',{agent:"browser",id:teamId,status:status}).then(function(response){
				response=response.data;
				if(response)
				{
					if(response!=0)
					{
						$scope.teams=response;
						angular.forEach(response,function(val,key){
							response[key].sno=key+1;
						});
						$scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: response});
					}
					else $scope.tableParams = new NgTableParams({page: 1, count: 10}, {data: {}});
					blockUI.stop();
					alertService.add('success', 'Successfully Updated', $scope.ALERTTIME);
				}
			});
		},
		resetForm:function()
		{
			$scope.submitted=false;
			$scope.obj=false;
			$scope.targetSubmit=false;
			$scope.targetslist=[];
			$scope.generateSubmit=false;
			$scope.target=[];
		},
		getTotal:function()
		{
			angular.forEach($scope.targetslist,function(val,k){
				var total=0;
				angular.forEach(val.target,function(value,key){
					if(value.target) total+=value.target;
				});
				$scope.targetslist[k].total_target=total;
			});
		}
	});
	$scope.getAllTeams();
	$scope.getTeamsTargets();
});