<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');

if(empty($_SESSION['nivsmartid']))
{
    header('Location: ../index.php');
    exit;
}
else
if(($_SESSION['niv_deptid']!=4 && $_SESSION['niv_roleid']!=6) && ($_SESSION['niv_deptid']!=5 && $_SESSION['niv_roleid']!=8) && ($_SESSION['niv_deptid']!=6 && $_SESSION['niv_roleid']!=10))
{
    header('Location: ../index.php');
    exit;
}

if(!empty($_SESSION['branchname'])) unset($_SESSION['branchname']);
$branches=getEMPBranches($_SESSION['nivsmartid']);
$rec='';
?>
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
    <!--<link href="../assets/css/weather-icons.min.css" rel="stylesheet" />-->
    <link href="../assets/css/style.css" rel="stylesheet" />

    <!--Fonts-->
    <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>-->
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
    <script src="../js/ui-bootstrap-tpls-2.2.0.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/services.js"></script>
    <script src="../js/alertService.js"></script>
    <script src="js/modules/branchselection.js"></script>
     
    <script src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/ng-table.min.js"></script>
   
    <script src="assets/js/skins.min.js"></script>
    <script src="../assets/datepicker/angularjs-datetime-picker.js"></script>
<style type="text/css">
.page-content {
margin-left: 0px;
}
.sw4_notify {
position: fixed;
top: 0;
width: 100%;
z-index: 999999;
border-radius: 0 !important;
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
</style>
</head>

<body class="ng-cloak" ng-controller="branchSelection">

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

                <!-- Account Area and Settings -->
                <div class="navbar-header pull-right">
                    <div class="navbar-account">
                        <ul class="account-area">
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

            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Body -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="well">
                            <table class="table table-striped table-bordered table-hover">
                                    <thead class="flip-content bordered-palegreen">
                                        <tr>
                                            <th>
                                                <i class="fa fa-briefcase"></i> Branch Name
                                            </th>
                                            <th class="hidden-xs">
                                                <i class="fa fa-phone"></i> Contact Number
                                            </th>
                                            <th>
                                                <i class="fa fa-envelope"></i> Contact Email
                                            </th>
                                            <th>
                                                <i class="fa fa-check"></i> Select Branch
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($branches)>0){ foreach($branches as $branches){?>
                                        <tr>
                                            <td>
                                                <?php echo $branches['branch_name'];  ?>
                                            </td>
                                            <td class="hidden-xs">
                                                <?php echo $branches['phno']; ?>
                                            </td>
                                            <td>
                                                <?php echo $branches['email']; ?>
                                            </td>
                                            <td align="center">
                                                <a href="#" ng-click="selectBranch(<?php echo $branches['id']; ?>,false)" class="btn btn-default btn-xs purple">Go</a>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                               </div>
                              </div>
                            <div class="clearfix"></div>
                    </div>
                    
					
                   
                   
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
<?php
include_once('footer.php');
?>