
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="webApp">
<head>
    <meta charset="utf-8" />
    <title>NIV SMART</title>

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
    <script src="js/modules/lead.js"></script>
    <script src="js/modules/movedleads.js"></script>
    <script src="js/modules/profile.js"></script>
     
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

.clear
{
    clear: both;
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
                        NIV SMART                    </a>
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
                            <li class="usercss">Gopi(Service - Head)</li>
                            <li>
                                <div class="dropdown" style="margin-top:5px;" ng-controller="branchSelection">
  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Tenali  <span class="caret"></span></button>
  <ul class="dropdown-menu">
        <li><a href="#" ng-click="selectBranch(1,true)">Main Branch(Guntur)</a></li>
        <li><a href="#" ng-click="selectBranch(4,true)">Vizag Branch</a></li>
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
                    <!--<li>
                        <a href="myleads.php">
                            <i class="menu-icon glyphicon glyphicon-tasks"></i>
                            <span class="menu-text"> Create Lead </span>
                        </a>
                    </li>-->
                    <li>
                        <a href="leads.php">
                            <i class="menu-icon glyphicon glyphicon-tasks"></i>
                            <span class="menu-text"> Leads </span>
                        </a>
                    </li>
                    <li>
                        <a href="movedleads.php">
                            <i class="menu-icon glyphicon glyphicon-tasks"></i>
                            <span class="menu-text"> Moved Leads </span>
                        </a>
                    </li>
                    <li>
                        <a href="profile.php">
                            <i class="menu-icon glyphicon glyphicon-user"></i>
                            <span class="menu-text"> Profile </span>
                        </a>
                    </li>
                    <li>
                        <a href="reports.php">
                            <i class="menu-icon glyphicon glyphicon-tasks"></i>
                            <span class="menu-text"> Reports </span>
                        </a>
                    </li>
                </ul>
                <!-- /Sidebar Menu -->
            </div>
            <!-- /Page Sidebar -->
<style type="text/css">
.profilelabel
{
    width: 25%;
}
.text
{
    width: 25%;
}
</style>
<!-- Page Content -->
            <div class="page-content" ng-controller="profileCtrl">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="#">Home</a>
                        </li>
                        <li class="active">Profile</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                                
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                            Profile
                        </h1>
                    </div>
                    <!--Header Buttons-->
                    <div class="header-buttons">
                        <a class="sidebar-toggler" href="#">
                            <i class="fa fa-arrows-h"></i>
                        </a>
                        <a class="refresh" id="refresh-toggler" href="#">
                            <i class="glyphicon glyphicon-refresh"></i>
                        </a>
                        <a class="fullscreen" id="fullscreen-toggler" href="#">
                            <i class="glyphicon glyphicon-fullscreen"></i>
                        </a>
                    </div>
                    <!--Header Buttons End-->
                </div>
                <!-- /Page Header -->
                <!-- Page Body -->
                <div class="page-body">
                    
                    <br />
   
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="well with-header">
            <div class="header bordered-warning">Profile</div>
                           <div class="well">
                            <table class="table table-striped table-bordered table-hover">
                                  
                                    <tbody>
                                            <tr>
                                            <td colspan="4" style="color: #2dc3e8">Company Details</td>
                                            </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Employee ID</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_id}}</td>
                                            <td class="profilelabel">
                                                <a href="#">Department</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.dept}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Email</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_email}}</td>
                                            <td class="profilelabel">
                                                <a href="#">Role</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.role}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Branches</a>
                                            </td>
                                            <td class="hidden-xs profiletext" colspan="3"><span style="display: block;" ng-repeat="branch in branches">{{branch.branch_name}}</span></td>
                                            </tr>
                                            <tr>
                                            <td colspan="4" style="color: #2dc3e8">Personal Detail</td>
                                            </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Name</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_name}}</td>
                                            <td class="profilelabel">
                                                <a href="#">State</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.state}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Email</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_email}}</td>
                                            <td class="profilelabel">
                                                <a href="#">City</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.city}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Phone Number</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_phone_no}}</td>
                                            <td class="profilelabel">
                                                <a href="#">Address</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_addr}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Education</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_education}}</td>
                                            <td class="profilelabel">
                                                <a href="#">PAN Number</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_pan_no}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="color: #2dc3e8">Bank Details</td>
                                            </tr>
                                            <tr>
                                            <td class="profilelabel">
                                                <a href="#">Bank Name</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_name}}</td>
                                            <td class="profilelabel">
                                                <a href="#">Brank Branch</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_branch}}</td>
                                            </tr>
                                            <tr>
                                            <td class="profilelabel">
                                                <a href="#">Bank Account Number</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_ac_no}}</td>
                                            <td class="profilelabel">
                                                <a href="#">Brank IFSC Code</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_ifsc_code}}</td>
                                            </tr>
                                    </tbody>
                                </table>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <!-- /Page Container -->
        <!-- Main Container -->

    </div>

    <!--Basic Scripts-->
    <script src="../assets/js/slimscroll/jquery.slimscroll.min.js"></script>
    <!--Beyond Scripts-->
    <script src="../assets/js/beyond.js"></script>
</body>
</html>