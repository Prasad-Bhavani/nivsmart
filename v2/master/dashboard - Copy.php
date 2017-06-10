<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

include_once('header.php');
?>
            <!-- Page Content -->
            <div class="page-content" ng-controller="dashboardCtrl">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="#">Home</a>
                        </li>
                        <li class="active">Dashboard</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                            Dashboard
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" ng-if="isDashboard || isLeads">
                            <div class="row">
                            <div class="col-lg-8">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="databox bg-white radius-bordered" style="cursor:pointer" title="All Leads" ng-click="getLeads(11)">
                                        <div class="databox-left btn-info">
                                            <div class="databox-piechart">
                                                <div data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="{{totalLeads!=0 ? '100%' : '0%'}}" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="#337ab7"><span class="white font-90">{{totalLeads!=0 ? '100%' : '0%'}}</span></div>
                                            </div>
                                        </div>
                                        <div class="databox-right">
                                            <span class="databox-number ">{{totalLeads}}</span>
                                            <div class="databox-text">All LEADS</div>
                                            <div class="databox-stat btn-info radius-bordered">
                                                <i class="stat-icon icon-lg fa fa-tasks"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="databox bg-white radius-bordered" style="cursor:pointer" title="Fresh Leads" ng-click="getLeads(0)">
                                        <div class="databox-left btn-info">
                                            <div class="databox-piechart">
                                                <div data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="{{leadsPercent[0]}}" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="#337ab7"><span class="white font-90">{{leadsPercent[0]}}%</span></div>
                                            </div>
                                        </div>
                                        <div class="databox-right">
                                            <span class="databox-number ">{{leadsCount[0]}}</span>
                                            <div class="databox-text">Fresh LEADS</div>
                                            <div class="databox-stat btn-info radius-bordered">
                                                <i class="stat-icon icon-lg fa fa-tasks"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="databox bg-white radius-bordered" style="cursor:pointer" title="Fresh Leads" ng-click="getLeads(6)">
                                        <div class="databox-left btn-danger">
                                            <div class="databox-piechart">
                                                <div data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="{{leadsPercent[6]}}" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="#337ab7"><span class="white font-90">{{leadsPercent[6]}}%</span></div>
                                            </div>
                                        </div>
                                        <div class="databox-right">
                                            <span class="databox-number ">{{leadsCount[6]}}</span>
                                            <div class="databox-text">Cold LEADS</div>
                                            <div class="databox-stat btn-danger radius-bordered">
                                                <i class="stat-icon icon-lg fa fa-tasks"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="databox bg-white radius-bordered" style="cursor:pointer" title="FOLLOW-UP Leads" ng-click="getLeads(3)">
                                        <div class="databox-left btn-warning">
                                            <div class="databox-piechart">
                                                <div id="users-pie" data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="{{leadsPercent[3]}}" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.1)"><span class="white font-90">{{leadsPercent[3]}}%</span></div>
                                            </div>
                                        </div>
                                        <div class="databox-right">
                                            <span class="databox-number">{{leadsCount[3]}}</span>
                                            <div class="databox-text">FOLLOW-UP</div>
                                            <div class="databox-stat btn-warning">
                                                <i class="stat-icon icon-lg fa fa-tasks"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="databox bg-white radius-bordered" style="cursor:pointer" title="Pipeline Leads" ng-click="getLeads(5)">
                                        <div class="databox-left btn-primary">
                                            <div class="databox-piechart">
                                                <div data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="{{leadsPercent[5]}}" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.2)"><span class="white font-90">{{leadsPercent[5]}}%</span></div>
                                            </div>
                                        </div>
                                        <div class="databox-right">
                                            <span class="databox-number">{{leadsCount[5]}}</span>
                                            <div class="databox-text">Pipeline</div>
                                            <div class="databox-stat btn-primary radius-bordered">
                                                <i class="stat-icon icon-lg fa fa-tasks"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="databox bg-white radius-bordered" style="cursor:pointer" title="Droped Leads" ng-click="getLeads(2)">
                                        <div class="databox-left btn-danger">
                                            <div class="databox-piechart">
                                                <div id="users-pie" data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="{{leadsPercent[2]}}" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.1)"><span class="white font-90">{{leadsPercent[2]}}%</span></div>
                                            </div>
                                        </div>
                                        <div class="databox-right">
                                            <span class="databox-number">{{leadsCount[2]}}</span>
                                            <div class="databox-text">Droped</div>
                                            <div class="databox-stat btn-danger">
                                                <i class="stat-icon icon-lg fa fa-tasks"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="databox bg-white radius-bordered" style="cursor:pointer" title="Freezed Leads" ng-click="getLeads(4)">
                                        <div class="databox-left btn-primary">
                                            <div class="databox-piechart">
                                                <div id="users-pie" data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="{{leadsPercent[4]}}" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.1)"><span class="white font-90">{{leadsPercent[4]}}%</span></div>
                                            </div>
                                        </div>
                                        <div class="databox-right">
                                            <span class="databox-number">{{leadsCount[4]}}</span>
                                            <div class="databox-text">Freezed</div>
                                            <div class="databox-stat btn-primary">
                                                <i class="stat-icon icon-lg fa fa-tasks"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="databox bg-white radius-bordered" style="cursor:pointer" title="Completed Leads" ng-click="getLeads(1)">
                                        <div class="databox-left btn-success">
                                            <div class="databox-piechart">
                                                <div id="users-pie" data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="{{leadsPercent[1]}}" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.1)"><span class="white font-90">{{leadsPercent[1]}}%</span></div>
                                            </div>
                                        </div>
                                        <div class="databox-right">
                                            <span class="databox-number">{{leadsCount[1]}}</span>
                                            <div class="databox-text">Completed</div>
                                            <div class="databox-stat btn-success">
                                                <i class="stat-icon icon-lg fa fa-tasks"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div style="margin:0px;padding:0px;max-width:100%">
                                            <br />
                                            <form class="form-horizontal" role="form" name="searchForm" id="searchForm" novalidate ng-submit="subSearchForm(searchForm.$valid)" method="post">
                                                <div class="form-group col-sm-12">
                                                <div class="form-group">
                                                        <label  class="col-sm-2 control-label no-padding-right">Branch</label>
                                                        <div class="col-sm-10">
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
                                            <div class="form-group col-sm-12">
                                                <div class="col-sm-6">
                                                <div class="form-group nobottom">
                                                        <label  class="col-sm-3 control-label no-padding-right">From</label>
                                                        <div class="col-sm-9">
                                                           <input class="form-control" datetime-picker date-format="dd-MMM-yyyy" defaults="true" ng-class="{'has-error':submitted && searchForm.from_date.$error.required}"  type="text" placeholder="Select From Date" onblur="this.placeholder='Select From Date'" onfocus="this.placeholder=''" name="from_date" id="from_date" ng-model="search.from_date" ng-required="search.to_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                <div class="form-group nobottom">
                                                        <label  class="col-sm-3 control-label no-padding-right">To</label>
                                                        <div class="col-sm-9">
                                                           <input class="form-control" datetime-picker date-format="dd-MMM-yyyy" defaults="true" ng-class="{'has-error':submitted && searchForm.to_date.$error.required}"  type="text" placeholder="Select To Date" onblur="this.placeholder='Select To Date'" onfocus="this.placeholder=''" name="to_date" id="to_date" ng-model="search.to_date" ng-required="search.from_date" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <!--<div class="form-group col-sm-3 nobottom">
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
                                                </div>-->
                                                <div class="form-group col-sm-12 nobottom">
                                                    <div class="col-sm-offset-4">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                    <button type="button" class="btn btn-danger" ng-click="resetForm()">Cancel</button>
                                                </div>
                                                </div>
                                                </form>
                                                </div>
                            </div>
                                <div class="clearfix"></div>

                            </div>
                        </div>
                        <div ng-if="isLeads">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="widget-body" ng-show="isLeads">
                    <div class="widget-header bordered-bottom bordered-blue">
                        <span class="widget-caption" style="font-size: 15px">
                        <span ng-repeat="leadstatus in LEADSTATUS">{{leadstatus.id==status ? leadstatus.label.replace('Lead','')+' Leads' : ''}}</span>  <span>{{status==11 ? 'All Leads' : ''}} </span> [{{statusLeadsCount}}]</span> <span style="float:right;margin-top:5px;margin-right:5px;"><a href="#" class="btn btn-default btn-xs purple" ng-click="leadsClosed()"> Close</a></span>
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
                    <div class="row" ng-if="isDashboard">
                       
					    <div class="col-lg-12 col-sm-12 col-xs-12">                          
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="widget-body  no-padding">
                                        <div style="background-color:white;padding:120px 15px;font-size:20px;text-align:center;font-weight:bold;margin: 10px;">WELCOME TO NIV SMART</div>
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