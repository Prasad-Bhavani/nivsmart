<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

$ptitle='Branches';
include_once('header.php');
?>
            <!-- Page Content -->
            <div class="page-content" ng-controller="branchCtrl">
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
                                            <span class="widget-caption">Add Branch</span>
                                        </div>
                                        <div class="widget-body">
                                            <div>
                                                <form role="form" method="post" novalidate name="branchForm" id="branchForm" ng-submit="subForm(branchForm.$valid)" class="form-horizontal" autocomplete="off">
                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-md-3 col-sm-12 control-label" for="branch_name">Name</label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                        <input class="form-control" ng-class="{'has-error':submitted && branchForm.branch_name.$error.required || obj.exist}" id="branch_name" name="branch_name"  placeholder="Enter Branch Name" onblur="this.placeholder='Enter Branch Name'" onfocus="this.placeholder=''" type="text" ng-model="obj.branch_name" ng-required="true">
                                                        <p ng-show="submitted && branchForm.branch_name.$error.required" class="error">Please Enter Branch Name</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-md-3 col-sm-12 control-label" for="phno">Phone Number</label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                        <input class="form-control" ng-class="{'has-error':submitted && branchForm.phno.$error.required || submitted && branchForm.phno.$error.pattern}" id="phno" name="phno"  placeholder="Enter Phone Number" onblur="this.placeholder='Enter Phone Number'" onfocus="this.placeholder=''" type="text" ng-model="obj.phno" ng-required="true" ng-pattern="/^\d{10}$/">
                                                        <p ng-show="submitted && branchForm.phno.$error.required" class="error">Please Enter Phone Number</p>
                                                        <p ng-show="submitted && branchForm.phno.$error.pattern" class="error">Please Enter Valid Number</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-md-3 col-sm-12 control-label" for="email">Email</label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                        <input class="form-control" ng-class="{'has-error':submitted && branchForm.email.$error.required || submitted && branchForm.email.$error.pattern}" id="email" name="email"  placeholder="Enter Email" onblur="this.placeholder='Enter Email'" onfocus="this.placeholder=''" type="email" ng-model="obj.email" ng-required="true" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/">
                                                        <p ng-show="submitted && branchForm.email.$error.required" class="error">Please Enter Email</p>
                                                        <p ng-show="submitted && branchForm.email.$error.pattern" class="error">Please Enter Valid Email</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-md-3 col-sm-12 control-label" for="state_id">State</label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                        <select class="form-control" ng-class="{'has-error':submitted && branchForm.state_id.$error.required}" name="state_id" id="state_id" ng-model="obj.state_id" ng-required="true" ng-change="getCities(obj.state_id)">
                                                            <option value="">Select State</option>
                                                            <option ng-repeat="state in states" value="{{state.id}}">{{state.state}}</option>
                                                        </select>
                                                        <p ng-show="submitted && branchForm.state_id.$error.required" class="error">Please Select State</p>
                                                        </div>
                                                        </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-md-3 col-sm-12 control-label" for="city_id">City</label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                        <select class="form-control" ng-class="{'has-error':submitted && branchForm.city_id.$error.required}" name="city_id" id="city_id" ng-model="obj.city_id" ng-required="true" >
                                                            <option value="">Select City</option>
                                                            <option ng-repeat="city in cities" value="{{city.id}}" ng-selected="city.id==obj.city_id">{{city.city}}</option>
                                                        </select>
                                                        <p ng-show="submitted && branchForm.city_id.$error.required" class="error">Please Select City</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-md-3 col-sm-12 control-label" for="addr">Address</label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                        <textarea class="form-control" ng-class="{'has-error':submitted && branchForm.addr.$error.required}" id="addr" name="addr"  placeholder="Enter Address" onblur="this.placeholder='Enter Address'" onfocus="this.placeholder=''" ng-model="obj.addr" ng-required="true"></textarea>
                                                        <p ng-show="submitted && branchForm.addr.$error.required" class="error">Please Enter Address</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-3 col-md-3 col-sm-12 control-label" for="status">Status</label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                        <select class="form-control" ng-class="{'has-error':submitted && branchForm.status.$error.required}" id="status" name="status" onfocus="this.placeholder=''" ng-model="obj.status" ng-required="true"><option value="">Select Status</option><option value="1">Active</option><option value="0">Inactive</option></select>
                                                        <p ng-show="submitted && branchForm.status.$error.required" class="error">Please Select Status</p>
                                                        <p ng-show="submitted && obj.exist" class="error">Branch Already Exist</p>
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
                                            <tr ng-repeat="branch in $data" ng-if="$data.length>0">
                                                <td title="'Sl.No'" sortable="'sno'">{{branch.sno}}.</td>
                                                <td title="'Branch Name'" sortable="'branch_name'" filter="{'branch_name':'text'}">{{branch.branch_name}}</td>
                                                <td title="'Phone Number'" sortable="'phno'" filter="{'phno':'text'}">{{branch.phno}}</td>
                                                <td title="'Email'" sortable="'email'" filter="{'email':'text'}">{{branch.email}}</td>
                                                <td title="'State'" sortable="'state'" filter="{'state':'text'}">{{branch.state}}</td>
                                                <td title="'City'" sortable="'city'" filter="{'city':'text'}">{{branch.city}}</td>
                                                <td title="'Address'" sortable="'addr'" filter="{'addr':'text'}">{{branch.addr}}</td>
                                                <td title="'Action'" style="cursor: pointer;text-align:center">
                                                <a href="#" class="btn btn-success btn-xs" ng-click="getBranch(branch.id)" ng-attr-title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                                <div class="widget-buttons buttons-bordered">
                                                <label>
                                                    <input class="checkbox-slider slider-icon colored-success" type="checkbox" name="status_{{branch.id}}" id="status_{{branch.id}}" ng-model="status_branch.id" ng-true-value="1" ng-false-value="0" ng-checked="branch.status==1" ng-click="changeBranchStatus(branch.id,status_branch.id)">
                                                    <span class="text"></span>
                                                </label>
                                            </div></td>
                                            </tr>
                                            <tr ng-if="$data.length==0">
                                                <td colspan="8" align="center">No Records Found...</td>
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