<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

$ptitle='Products';
include_once('header.php');
?>



            <!-- Page Content -->

            <div class="page-content" ng-controller="productCtrl">

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

                                            <span class="widget-caption">Add Product Name</span>

                                        </div>

                                        <div class="widget-body">

                                            <div>

                                                <form role="form" method="post" novalidate name="productForm" id="productForm" ng-submit="subForm(productForm.$valid)" class="form-horizontal" autocomplete="off">

                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-md-3  col-sm-12 control-label" for="product_type_id">Product Type</label>
                                                        <div class="col-lg-9 col-md-9  col-sm-12">
                                                        <select class="form-control" ng-class="{'has-error':submitted && productForm.product_type_id.$error.required}" name="product_type_id" id="product_type_id" ng-model="obj.product_type_id" ng-required="true" ng-disabled="obj.id">
                                                            <option value="">Select Product Type</option>
                                                            <option ng-repeat="productType in productTypes" value="{{productType.id}}">{{productType.type}}</option>
                                                        </select>
                                                        <p ng-show="submitted && productForm.product_type_id.$error.required" class="error">Please Select Product Type</p>
                                                        </div>
                                                        </div>

                                                    <div class="form-group">
                                                        <label <div class="col-lg-3 col-md-3  col-sm-12 control-label" for="product_name">Product Name</label>
                                                        <div class="col-lg-9 col-md-9  col-sm-12">
                                                        <input class="form-control" ng-class="{'has-error':submitted && productForm.product_name.$error.required || obj.exist}" id="product_name" name="product_name"  placeholder="Enter Product Name" onblur="this.placeholder='Enter Product Name'" onfocus="this.placeholder=''" type="text" ng-model="obj.product_name" ng-required="true">
                                                        <p ng-show="submitted && productForm.product_name.$error.required" class="error">Please Enter Product Name</p>
                                                        <p ng-show="submitted && obj.exist && !productForm.product_name.$error.required" class="error">Product Name Already Exists</p>
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

                                <div class="widget-header bordered-bottom bordered-yellow">

                                    <span class="widget-caption">Search on All Columns</span>

                                   

                                </div>

                                <div class="widget-body no-padding">

                                    <table ng-table="tableParams" class="table" show-filter="true">

                                            <tr ng-repeat="product in $data" ng-if="$data.length>0">

                                                <td title="'Sl.No'" sortable="'sno'">{{product.sno}}.</td>

                                                <td title="'Type'" sortable="'type'" filter="{'type':'text'}">{{product.type}}</td>

                                                <td title="'Name'" sortable="'product_name'" filter="{'product_name':'text'}">{{product.product_name}}</td>

                                                <td title="'Action'" style="cursor: pointer;text-align:center">
                                                <a href="#" class="btn btn-success btn-xs" ng-click="getProduct(product.id)" ng-attr-title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                                <div class="widget-buttons buttons-bordered">
                                                <label>
                                                    <input class="checkbox-slider slider-icon colored-success" type="checkbox" name="status_{{product.id}}" id="status_{{product.id}}" ng-model="status_product.id" ng-true-value="1" ng-false-value="0" ng-checked="product.status==1" ng-click="changeProductStatus(product.id,status_product.id)">
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