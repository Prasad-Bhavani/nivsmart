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
            <div class="page-content" ng-controller="leadCreationCtrl">
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
                            <i class="glyphicon glyphicon-refresh" ng-click="getLeads()"></i>
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
                 <div class="widget-body" ng-show="isLeads">
                                            <div class="widget-main ">
                                                 <div class="widget-header bordered-bottom bordered-blue titlebottom">
                                                    <div></div>
                                            <span class="widget-caption ">Leads </span>
                                            <!--<span style="margin-top: 150px;padding-right:15px;"><a href="#" class="btn btn-default btn-xs purple" ng-click="openSearch()" ng-if="!isSearch"> Search</a> <a href="#" class="btn btn-default btn-xs purple" ng-click="closeSearch()" ng-if="isSearch"> Close</a></span>-->
                                        </div>
                                        </div>
                                        <div style="margin:0px;padding:0px;max-width:100%" ng-if="isSearch">
                                            <br />
                                            <form class="form-horizontal" role="form" name="searchForm" id="searchForm" novalidate ng-submit="subsearchForm(searchForm.$valid)">
                                                <div class="form-group col-sm-3">
                                                <div class="form-group">
                                                        <label  class="col-sm-6 control-label no-padding-right">Branch</label>
                                                        <div class="col-sm-6">
                                                        <select class="form-control" name="branch_id" id="branch_id" ng-model="search.branch_id" ng-required="true">
                                                            <option value="all">All</option>
                                                            <option value="{{branch.id}}" ng-repeat="branch in branches" ng-selected="branch.id==lead.lead_branch_id">{{branch.branch_name}}</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-3">
                                                <div class="form-group">
                                                        <label  class="col-sm-6 control-label no-padding-right">Department</label>
                                                        <div class="col-sm-6">
                                                        <select class="form-control" name="dept_id" id="dept_id" ng-model="search.dept_id" ng-required="true" ng-change="getRolesbyDept(search.dept_id)">
                                                            <option value="all">All</option>
                                                            <option value="{{dept.id}}" ng-repeat="dept in DEPT" ng-selected="dept.id==search.dept_id">{{dept.dept}}</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-3">
                                                <div class="form-group">
                                                        <label  class="col-sm-6 control-label no-padding-right">Role</label>
                                                        <div class="col-sm-6">
                                                        <select class="form-control" name="role_id" id="role_id" ng-model="search.role_id" ng-required="true">
                                                            <option value="all">All</option>
                                                            <option value="{{branch.id}}" ng-repeat="role in roles" ng-selected="role.id==lead.role_id">{{role.role}}</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-3">
                                                <div class="form-group">
                                                        <label  class="col-sm-6 control-label no-padding-right">EMP ID</label>
                                                        <div class="col-sm-6">
                                                        <select class="form-control" name="emp_id" id="emp_id" ng-model="search.emp_id" ng-required="true">
                                                            <option value="all">All</option>
                                                            <option value="{{emp.id}}" ng-repeat="emp in EMPS" ng-selected="emp.id==search.emp_id">{{emp.emp_id}} - {{emp.emp_name}}</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="form-group col-sm-3 nobottom">
                                                <div class="form-group nobottom">
                                                        <label  class="col-sm-6 control-label no-padding-right">From</label>
                                                        <div class="col-sm-6">
                                                           <input class="form-control" datetime-picker date-format="dd-MMM-yyyy hh:mm a" defaults="true" ng-class="{'has-error':submitted && searchForm.from_date.$error.required && search.date_type!='all'}"  type="text" placeholder="Select From Date" onblur="this.placeholder='Select From Date'" onfocus="this.placeholder=''" name="from_date" id="from_date" ng-model="search.from_date" ng-required="true" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-3 nobottom">
                                                <div class="form-group nobottom">
                                                        <label  class="col-sm-6 control-label no-padding-right">To</label>
                                                        <div class="col-sm-6">
                                                           <input class="form-control" datetime-picker date-format="dd-MMM-yyyy hh:mm a" defaults="true" ng-class="{'has-error':submitted && searchForm.to_date.$error.required && search.date_type!='all'}"  type="text" placeholder="Select To Date" onblur="this.placeholder='Select To Date'" onfocus="this.placeholder=''" name="to_date" id="to_date" ng-model="search.to_date" ng-required="true" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-3 nobottom">
                                                <div class="form-group nobottom">
                                                        <label  class="col-sm-6 control-label no-padding-right">Date Type</label>
                                                        <div class="col-sm-6">
                                                        <select class="form-control" name="date_type" id="date_type" ng-model="search.date_type" ng-required="true">
                                                            <option value="all">All</option>
                                                            <option value="1">Created Date</option>
                                                            <option value="2">Completed Date</option>
                                                            <option value="3">Follow-up Date</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-4 nobottom">
                                                    <div class="col-sm-offset-3">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                    <button type="button" class="btn btn-danger" ng-click="resetForm()">Cancel</button>
                                                </div>
                                                </div>
                                                </form>
                                                </div>
            <table ng-table="tableParams" class="table" show-filter="true">
                    <tr ng-repeat="lead in $data" ng-if="$data.length>0">
                                <td title="'Sl.No'" sortable="'sno'" width="2%">{{lead.sno}}.</td>
                                <td data-title="'Lead ID'" sortable="'lead_id'" filter="{'lead_id':'text'}" width="15%">{{ lead.lead_id }}</td>
                                <td data-title="'Company name'" sortable="'company_name'" filter="{'company_name':'text'}" width="20%">{{ lead.company_name }}</td>
                                <td data-title="'Contact Person'" sortable="'contact_person'" filter="{'contact_person':'text'}" filter-data="statuslabel(contact_person)" width="20%">{{ lead.contact_person }}</td>
                                <td data-title="'Contact Number'" sortable="'contact_no_1'" filter="{'contact_no_1':'text'}" width="10%">{{ lead.contact_no_1 }}</td>
                                <td data-title="'Present At'" sortable="'is_present'" filter="{'is_present':'text'}" width="10%">{{lead.is_present}}</td>
                                <td data-title="'Status'" sortable="'status'" filter="{'status':'text'}" width="10%">{{lead.status}}</td>
                                <td data-title="'Created Date'" sortable="'created_date_time'" filter="{'created_date_time':'text'}" width="10%"><span>{{ lead.created_date_time }}</span></td>
                                <td data-title="'Action'" align="center"><a href="#" class="btn btn-default btn-xs purple" ng-click="getLead(lead.id,lead.status)" width="2%"><i class="fa fa-eye"></i> View</a>
                                </td>                                
                    </tr>
                        <tr>
                            <td colspan="9" align="center" ng-if="$data.length==0">No Leads Found...</td>
                        </tr>
            </table>
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

