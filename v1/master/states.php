<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

$ptitle='States';
include_once('header.php');
?>
            <!-- Page Content -->
            <div class="page-content" ng-controller="stateCtrl">
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
					    <div class="col-lg-6 col-sm-12 col-xs-12 col-lg-offset-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="widget">
                                        <div class="widget-header bordered-bottom bordered-blue">
                                            <span class="widget-caption">Add State</span>
                                        </div>
                                        <div class="widget-body">
                                            <div>
                                                <form role="form" method="post" novalidate name="stateForm" id="stateForm" ng-submit="subForm(stateForm.$valid)" class="form-horizontal" autocomplete="off">
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-md-2 col-sms-12 control-label" for="state">State</label>
                                                        <div class="col-lg-10 col-md-10 col-sm-12">
                                                        <input class="form-control" ng-class="{'has-error':submitted && stateForm.state.$error.required || obj.exist}" id="state" name="state"  placeholder="Enter State" onblur="this.placeholder='Enter State'" onfocus="this.placeholder=''" type="text" ng-model="obj.state" ng-required="true">
                                                        <p ng-show="submitted && stateForm.state.$error.required" class="error">Please Enter State</p>
                                                        <p ng-show="submitted && obj.exist && !stateForm.state.$error.required" class="error">State Already Exists</p>
                                                        </div>
                                                    </div>
                                                   
                                                   <div class="col-lg-offset-2 col-md-offset-2">
                                                    <button type="submit" name="sub" id="sub" class="btn btn-blue">{{obj.id ? 'Update' : 'Add'}}</button> <button type="reset" id="resetbtn" name="resetbtn" class="btn btn-red" ng-click="resetForm()">{{obj.id ? 'Cancel' : 'Clear'}}</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                       

                    </div>

                   
                   <br />



<div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="widget">
                                <div class="widget-header bordered-bottom bordered-yellow">
                                    <span class="widget-caption">Search on All Columns</span>
                                </div>
                                <div class="widget-body no-padding">
                                    <form>
 <div class="table-responsive table-bordered ng-table-settings mar-top-20">
            <table ng-table="tableParams" class="table" show-filter="true">
                    <tr ng-repeat="state in $data" ng-if="$data.length>0">
                                <td title="'Sl.No'" sortable="'sno'">{{state.sno}}.</td>
                                <td data-title="'States'" sortable="'state'" filter="{ 'state': 'text' }">{{ state.state }}</td>
                                <td title="'Action'" style="cursor: pointer;text-align:center">
                                <a href="#" class="btn btn-success btn-xs" ng-click="getState(state.id)" ng-attr-title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <div class="widget-buttons buttons-bordered">
                                <label>
                                    <input class="checkbox-slider slider-icon colored-success" type="checkbox" name="status_{{state.id}}" id="status_{{state.id}}" ng-model="status_state.id" ng-true-value="1" ng-false-value="0" ng-checked="state.status==1" ng-click="changeStateStatus(state.id,status_state.id)">
                                    <span class="text"></span>
                                </label>
                                </div></td>
                                        </tr>
                    <tr ng-if="$data.length==0">
                        <td colspan="3" align="center">No Records Found...</td>
                    </tr>
                    </table>
</div>

                                    
                                </form>
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