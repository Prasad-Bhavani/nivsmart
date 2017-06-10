<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

include_once('header.php');
?>
<style type="text/css">
.subdiv
{
    background-color: lightgray;
}
</style>
<!-- Page Content -->
            <div class="page-content" ng-controller="monthlyFollowupCtrl">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="#">Home</a>
                        </li>
                        <li class="active">Leads</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                                
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                            Leads
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
                 <div class="widget-body" ng-show="isLeads">
                                            <div class="widget-main ">
                                                <div class="tabbable">
                                                    <ul class="nav nav-tabs tabs-flat" id="myTab11">
                                                        <li class="">
                                                            <a data-toggle="tab" href="#inbox" aria-expanded="false" ng-click="getInboxLeads()">
                                                                Inbox
                                                            </a>
                                                        </li>
                                                        <li class="active">
                                                            <a data-toggle="tab" href="#leads" aria-expanded="true" ng-click="getMonthlyFollowupLeads()">
                                                                Leads
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content tabs-flat">

                                                        <div id="inbox" class="tab-pane">
                                                            <div ng-include="'template/monthly_followup.html'"></div>
                                                        </div>

                                                        <div id="leads" class="tab-pane active">
                                                            <div ng-include="'template/monthly_followup.html'"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <div ng-if="isLeadView" ng-include="'../template/leadview.html'"></div>
                    </div>
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
<?php
include_once('footer.php');
?>

