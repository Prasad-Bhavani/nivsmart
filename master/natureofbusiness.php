<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

$ptitle='Nature of Business';
include_once('header.php');
?>



            <!-- Page Content -->

            <div class="page-content" ng-controller="natureofBusinessCtrl">

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

                                            <span class="widget-caption">Add Business Name</span>

                                        </div>

                                        <div class="widget-body">

                                            <div>

                                                <form role="form" method="post" novalidate name="businessForm" id="businessForm" ng-submit="subForm(businessForm.$valid)" class="form-horizontal" autocomplete="off">
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-md-3  col-sm-12 control-label" for="business_type_id">Business Type</label>
                                                        <div class="col-lg-9 col-md-9  col-sm-12">
                                                        <select class="form-control" ng-class="{'has-error':submitted && businessForm.business_type_id.$error.required}" name="business_type_id" id="business_type_id" ng-model="obj.business_type_id" ng-required="true" ng-disabled="obj.id">
                                                           <option value="" selected="selected">Select Nature of Business</option>
                                                           <option value="{{business.id}}" ng-repeat="business in business_type_id" ng-selected="business.id==lead.nature_of_business">{{business.label}}</option>
                                                        </select>
                                                        <p ng-show="submitted && businessForm.business_type_id.$error.required" class="error">Please Select Business Type</p>
                                                        </div>
                                                        </div>

                                                    <div class="form-group">
                                                        <label <div class="col-lg-3 col-md-3  col-sm-12 control-label" for="business_name">Business Name</label>
                                                        <div class="col-lg-9 col-md-9  col-sm-12">
                                                        <input class="form-control" ng-class="{'has-error':submitted && businessForm.business_name.$error.required || obj.exist}" id="business_name" name="business_name"  placeholder="Enter Business Name" onblur="this.placeholder='Enter Business Name'" onfocus="this.placeholder=''" type="text" ng-model="obj.business_name" ng-required="true">
                                                        <p ng-show="submitted && businessForm.business_name.$error.required" class="error">Please Enter Business Name</p>
                                                        <p ng-show="submitted && obj.exist && !businessForm.business_name.$error.required" class="error">Business Name Already Exists</p>
                                                        </div>
                                                    </div>

                                                   <div class="col-lg-offset-3 col-md-offset-3">

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

                                <div class="widget-body no-padding">

                                    <table ng-table="tableParams" class="table" show-filter="true">
                                            <tr ng-repeat="business in $data" ng-if="$data.length>0">

                                                <td title="'Sl.No'" sortable="'sno'">{{business.sno}}.</td>

                                                <td title="'Type'" sortable="'business_type_id'" filter="{'business_type_id':'text'}">{{business.business_type_id}}</span></td>

                                                <td title="'Name'" sortable="'business_name'" filter="{'business_name':'text'}">{{business.business_name}}</td>

                                                <td title="'Action'" style="cursor: pointer;text-align:center">
                                                <a href="#" class="btn btn-success btn-xs" ng-click="getBusinessName(business.id)" ng-attr-title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                                <div class="widget-buttons buttons-bordered">
                                                <label>
                                                    <input class="checkbox-slider slider-icon colored-success" type="checkbox" name="status_{{business.id}}" id="status_{{business.id}}" ng-model="status_business.id" ng-true-value="1" ng-false-value="0" ng-checked="business.status==1" ng-click="changeBusinessStatus(business.id,status_business.id)">
                                                    <span class="text"></span>
                                                </label>
                                            </div></td>
                                            </tr>
                                            <tr ng-if="$data.length==0">
                                                <td align="center" colspan="4">No Records Found...</td>
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