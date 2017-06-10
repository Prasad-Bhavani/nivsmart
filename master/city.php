<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

$ptitle='Cities';
include_once('header.php');
?>

            <!-- Page Content -->
            <div class="page-content" ng-controller="cityCtrl">
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
                                            <span class="widget-caption">Add City</span>
                                        </div>
                                        <div class="widget-body">
                                            <div>
                                                <form role="form" method="post" novalidate name="cityForm" id="cityForm" ng-submit="subForm(cityForm.$valid)" class="form-horizontal" autocomplete="off">
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="state_id">State</label>
                                                        <div class="col-lg-10 col-md-10 col-sm-12">
                                                        <select class="form-control" ng-class="{'has-error':submitted && cityForm.state_id.$error.required}" name="state_id" id="state_id" ng-model="obj.state_id" ng-required="true" ng-disabled="obj.id">
                                                            <option value="">Select State</option>
                                                            <option ng-repeat="state in states" value="{{state.id}}">{{state.state}}</option>
                                                        </select>
                                                        <p ng-show="submitted && cityForm.state_id.$error.required" class="error">Please Select State</p>
                                                        </div>
                                                        </div>
                                                        
                                                    <div class="form-group">
                                                        <label class="col-lg-2 col-md-2 col-sm-12 control-label" for="city">City</label>
                                                        <div class="col-lg-10 col-md-10 col-sm-12">
                                                        <input class="form-control" ng-class="{'has-error':submitted && cityForm.city.$error.required || obj.exist}" id="city" name="city"  placeholder="Enter City" onblur="this.placeholder='Enter City'" onfocus="this.placeholder=''" type="text" ng-model="obj.city" ng-required="true">
                                                        <p ng-show="submitted && cityForm.city.$error.required" class="error">Please Enter City</p>
                                                        <p ng-show="submitted && obj.exist && !cityForm.city.$error.required" class="error">City Already Exists</p>
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
                                    <table ng-table="tableParams" class="table" show-filter="true">
                                        <tr ng-repeat="city in $data" ng-if="$data.length>0">
                                            <td title="'Sl.No'" sortable="'sno'">{{city.sno}}.</td>
                                            <td title="'State'" sortable="'state'" filter="{'state':'text'}">{{city.state}}</td>
                                            <td title="'City'" sortable="'city'" filter="{'city':'text'}">{{city.city}}</td>
                                            <td title="'Action'"  style="cursor: pointer;text-align:center">
                                                <a href="#" class="btn btn-success btn-xs" ng-click="getCity(city.id)" ng-attr-title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                                <div class="widget-buttons buttons-bordered">
                                                <label>
                                                    <input class="checkbox-slider slider-icon colored-success" type="checkbox" name="status_{{city.id}}" id="status_{{city.id}}" ng-model="status_city.id" ng-true-value="1" ng-false-value="0" ng-checked="city.status==1" ng-click="changeCityStatus(city.id,status_city.id)">
                                                    <span class="text"></span>
                                                </label>
                                            </div></td>
                                        </tr>
                                        <tr ng-if="$data.length==0">
                                            <td colspan="4" align="center">No Records Found...</td>
                                        </tr>
                                    </table>
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