<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

$ptitle='Teams';
include_once('header.php');
?>
            <!-- Page Content -->
            <div class="page-content" ng-controller="teamCtrl">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="dashboard.php">Home</a>
                        </li>
                        <li class="active"><?php echo $ptitle; ?></li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                            <?php echo $ptitle; ?>
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="widget-body">
                                            <div class="widget-main ">
                                                <div class="tabbable">
                                                    <ul class="nav nav-tabs tabs-flat" id="myTab11">
                                                        <li class="">
                                                            <a data-toggle="tab" href="#getTeams" aria-expanded="false" ng-click="getTeams()">
                                                                Teams
                                                            </a>
                                                        </li>
                                                        <li class="active">
                                                            <a data-toggle="tab" href="#getTeamTargert" aria-expanded="true" ng-click="getTeamTargert()">
                                                                Targets
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content tabs-flat">
                                                        <div id="getTeams" class="tab-pane">
                                                            <div ng-include="'template/addteam.html'"></div>
                                                        </div>
                                                        <div id="getTeamTargert" class="tab-pane active">
                                                            <div ng-include="'template/teamtargets.html'"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    </div>
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
<?php
include_once('footer.php');
?>