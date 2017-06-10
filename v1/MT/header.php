<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="webApp">
<head>
    <meta charset="utf-8" />
    <title><?php echo SITENAME; ?></title>

    <meta name="description" content="Dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <!--Basic Styles-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../assets/css/weather-icons.min.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />

    <!--Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <!--Beyond styles-->
    <link id="beyond-link" href="assets/css/beyond.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/demo.min.css" rel="stylesheet" />
    <link href="../assets/css/typicons.min.css" rel="stylesheet" />
    <link href="../assets/css/animate.min.css" rel="stylesheet" />
    <link type="text/css" href="../assets/css/angular-block-ui.min.css" rel="stylesheet">
    <link type="text/css" href="../assets/css/ng-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/datepicker/angularjs-datetime-picker.css" />
    <link rel="stylesheet" href="../assets/ngdialog/ngDialog.css">
    <link rel="stylesheet" href="../assets/ngdialog/ngDialog-theme-default.css">

    <script src="../js/angular.min.js"></script>
    <script type="text/javascript" src="../js/angular-block-ui.min.js"></script>
    <script type="text/javascript" src="../js/ngDialog.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../js/ui-bootstrap-tpls-2.2.0.min.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/services.js"></script>
    <script src="../js/alertService.js"></script>
    <script src="../js/modalbox.js"></script>
    <script src="js/modules/branchselection.js"></script>
    <script src="js/modules/hotleads.js"></script>
    <script src="js/modules/coldleads.js"></script>
    <script src="../js/modules/leadsreport.js"></script>
    <script src="../js/modules/emp_profile.js"></script>
    <script src="../js/modules/leadcreation.js"></script>
     
    <script type="text/javascript" src="../js/ng-table.min.js"></script>
   
    <script src="assets/js/skins.min.js"></script>
    <script src="../assets/datepicker/angularjs-datetime-picker.js"></script>
<style type="text/css">

.sw4_notify {
position: fixed;
top: 0;
width: 100%;
z-index: 999999;
border-radius: 0 !important;
}

.handcss tbody tr
{
    cursor: pointer;
}
.ngdialog.ngdialog-theme-default.custom-width-800 .ngdialog-content {
    margin-top: -100px;
    padding: 0px;
    min-width: 800px;
}
.ngdialog.ngdialog-theme-default.custom-width-900 .ngdialog-content {
    width: 900px;
}

.sw4_notify > alert{
width: 100% ;
display: block;
border-radius: 0 !important;
margin-bottom: 10px;
}

.checkboxdisplay
{
    position: static;
    opacity: inherit;
    height: inherit;
}

.titlebottom
{
    margin-bottom: 10px;
}
</style>
</head>

<body class="ng-cloak">

    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-inner">
            <div class="navbar-container">
                <!-- Navbar Barnd -->
                <div class="navbar-header pull-left" style="margin-top: 0px;">
                    <a href="#" class="navbar-brand">
                        <?php echo SITENAME; ?>
                    </a>
                </div>
                <!-- /Navbar Barnd -->

 <!-- START : Alert Messages -->
 <div class="sw4_notify">
  <alert ng-repeat="alert in alerts" type="alert.type" class="alert alert-{{alert.type}}">{{ alert.msg }} <button type="button" class="close"><span class="close" data-dismiss="alert" aria-label="close">&times;</span></button></alert>
</div>
<!-- END : Alert Messages -->

                <!-- Sidebar Collapse -->
                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="collapse-icon fa fa-bars"></i>
                </div>
                <!-- /Sidebar Collapse -->
                <!-- Account Area and Settings -->
                <div class="navbar-header pull-right">
                    <div class="navbar-account">
                        <ul class="account-area">
                            <li class="usercss"><?php $user=getEMpEmail(); echo $user['emp_name'].'('.$user['dept'].' - '.$user['role'].')'; ?></li>
                            <li>
                                <div class="dropdown" style="margin-top:5px;" ng-controller="branchSelection">
  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><?php if(!empty($_SESSION['niv_branch'])) echo $_SESSION['niv_branch']; ?>
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <?php if(count($branchrecs)>0){foreach($branchrecs as $branchrecs) {?>
    <li><a href="#" ng-click="selectBranch(<?php echo $branchrecs['id']; ?>,true)"><?php echo $branchrecs['branch_name']; ?></a></li>
    <?php } } ?>
    <li><a href="branchselection.php">Go to Branch Selection</a></li>
  </ul>
</div>
                            </li>
                           <li>
                                <div style="margin-top:5px; margin-left:10px;">
  <a href="../index.php?action=signout"><button class="btn btn-default" type="button">Logout </button></a>
</div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <!-- /Account Area and Settings -->
            </div>
        </div>
    </div>
    <!-- /Navbar -->
    <!-- Main Container -->
    <div class="main-container container-fluid">
        <!-- Page Container -->
        <div class="page-container"> 
            <!-- Page Sidebar -->
            <div class="page-sidebar menu-compact" id="sidebar">
                <!-- Page Sidebar Header-->
                <div class="sidebar-header-wrapper">
                    <input type="text" class="searchinput" />
                    <i class="searchicon fa fa-search"></i>
                    <div class="searchhelper">Search Here</div>
                </div>
                <!-- /Page Sidebar Header -->
                <!-- Sidebar Menu -->
                <ul class="nav sidebar-menu">
                    <!--Dashboard-->
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="menu-icon glyphicon glyphicon-home"></i>
                            <span class="menu-text"> Dashboard </span>
                        </a>
                    </li>
                    <li>
                        <a href="leadcreation.php">
                            <i class="menu-icon glyphicon glyphicon-tasks"></i>
                            <span class="menu-text"> Create Lead </span>
                        </a>
                    </li>
                    <li>
                        <a href="leads.php">
                            <i class="menu-icon glyphicon glyphicon-tasks"></i>
                            <span class="menu-text"> Leads </span>
                        </a>
                    </li>
                    <li>
                        <a href="leadsreport.php">
                            <i class="menu-icon glyphicon glyphicon-tasks"></i>
                            <span class="menu-text"> Leads Report </span>
                        </a>
                    </li>
                    <li>
                        <a href="profile.php">
                            <i class="menu-icon glyphicon glyphicon-user"></i>
                            <span class="menu-text"> Profile </span>
                        </a>
                    </li>
                    <!--<li>
                        <a href="reports.php">
                            <i class="menu-icon glyphicon glyphicon-tasks"></i>
                            <span class="menu-text"> Reports </span>
                        </a>
                    </li>-->
                </ul>
                <!-- /Sidebar Menu -->
            </div>
            <!-- /Page Sidebar -->
