<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

include_once('header.php');
?>
<style type="text/css">
.well
{
    margin-bottom: 0px;
}
.statustable td
{
    padding: 10px;
}
.tdhead
{
    background-color: #427fed;
    color: white;
}
</style>
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
                                    <div class="widget-body" ng-if="isDashboard">
                <span ng-if="isTargets" style="float:right;margin-top:5px;margin-right:5px;"><a href="#" class="btn btn-default btn-xs purple" ng-click="getTargets()"> Leads</a></span>
                <span ng-if="!isTargets" style="float:right;margin-top:5px;margin-right:5px;"><a href="#" class="btn btn-default btn-xs purple" ng-click="getTargets()"> Targets</a></span>
                                    <div ng-if="isTargets" ng-include="'../template/dashboard.html'"></div>
                                    <div class="row" ng-if="!isTargets">
                                    <div class="col-lg-12">
                                    <div ng-class="type=='Branch' ? 'col-lg-8' : 'col-lg-4'">
                                    <div class="well">
                                    <h4><b>Total Leads</b></h4>
                                        <table class="statustable" border="1" rules="all" cell-padding="5" cell-spacing="5">
                                            <tr>
                                                <td class="tdhead"><b>Branch/Status</b></td>
                                                <td class="tdhead" ng-repeat="status in LEADSTATUS" ng-if="status.id!=7 && type=='Branch'"><b>{{status.label}}</b></td>
                                                <td class="tdhead"><b>Total</b></td>
                                            </tr>
                                            <tr ng-repeat="data in leadsCount">
                                                <td>{{data.branch_name}}</td>
                                                <td ng-repeat="status in LEADSTATUS" ng-if="status.id!=7 && type=='Branch'" style="cursor:pointer" ng-click="getLeads(data.branchid,status.id)" ng-class="{'btn-info':branchid==data.branchid && statusid==status.id && type=='Branch'}">{{data.count[status.id]}}</td>
                                                <td style="cursor:pointer" ng-click="getLeads(data.branchid,'All')" ng-class="{'btn-info':branchid==data.branchid && statusid=='All' && type=='Branch'}">{{data.alltotal}}</td>
                                            </tr>
                                            <tr>
                                                <td class="tdhead"><b>Total</b></td>
                                                <td ng-repeat="status in LEADSTATUS" ng-if="status.id!=7 && type=='Branch'" style="cursor:pointer" ng-click="getLeads('All',status.id)" ng-class="{'btn-info':branchid=='All' && statusid==status.id && type=='Branch'}">{{statusCount[status.id]}}</td>
                                                <td style="cursor:pointer" ng-click="getLeads('All','All')" ng-class="{'btn-info':branchid=='All' && statusid=='All' && type=='Branch'}">{{getTotal}}</td>
                                            </tr>
                                        </table>
                                        </div>
                                        </div>
                                        <div ng-class="type=='Product' ? 'col-lg-8' : 'col-lg-4'">
                                        <div class="col-lg-12">
                                        <div class="well">
                                        <h4><b>Employee Attendance</b></h4>
                                        <button class="btn btn-success" ng-click="getEMPSbyAttendance(counts.present.empids,'status')" ng-disabled="counts.present.present==0">Present [{{counts.present.present}}]</button>
                                        <button class="btn btn-danger" ng-click="getEMPSbyAttendance(counts.absent.empids,'status')" ng-disabled="counts.absent.absent==0">Absent [{{counts.absent.absent}}]</button>
                                        <button class="btn btn-info" ng-click="getEMPSbyAttendance(counts.pending.pendingempids,'pending')" ng-disabled="counts.pending.pending==0">Pending [{{counts.pending.pending}}]</button>
                                        </div>
                                        </div>

                                        <div class="col-lg-12" style="margin-top: 15px;">
                                        <div class="well">
                                        <table class="statustable" border="1" rules="all" cell-padding="5" cell-spacing="5">
                                            <tr>
                                                <td class="tdhead"><b>Status</b></td>
                                                <td class="tdhead" ng-repeat="status in LEADSTATUS" ng-if="status.id!=7 && status.id!=0 && status.id!=6 && type=='Product'"><b>{{status.label}}</b></td>
                                                <td class="tdhead"><b>Total</b></td>
                                            </tr>
                                            <tr ng-repeat="data in prodcutleadsCount">
                                                <td>{{data.product_name}}</td>
                                                <td ng-repeat="status in LEADSTATUS" ng-if="status.id!=7 && status.id!=0 && status.id!=6 && type=='Product'" style="cursor:pointer" ng-click="getLeadsbyProduct(data.productid,status.id)" ng-class="{'btn-info':productid==data.productid && statusid==status.id && type=='Product'}">{{data.count[status.id]}}</td>
                                                <td style="cursor:pointer" ng-click="getLeadsbyProduct(data.productid,'All')" ng-class="{'btn-info':productid==data.productid && statusid=='All' && type=='Product'}">{{data.alltotal}}</td>
                                            </tr>
                                            <tr>
                                                <td class="tdhead"><b>Total</b></td>
                                                <td style="cursor:pointer" ng-repeat="status in LEADSTATUS" ng-if="status.id!=7 && status.id!=0 && status.id!=6 && type=='Product'" ng-click="getLeadsbyProduct('All',status.id)" ng-class="{'btn-info':productid=='All' && statusid==status.id && type=='Product'}">{{prodcutstatusCount[status.id]}}</td>
                                                <td style="cursor:pointer" ng-click="getLeadsbyProduct('All','All')" ng-class="{'btn-info':productid=='All' && statusid=='All' && type=='Product'}">{{getProductTotal}}</td>
                                            </tr>
                                            </table>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="clear-fix"></div>
                                        </div>
                                        </div>

                    <div class="row" ng-if="isEMPS" style="margin-top: 25px;">
                       
                        <div class="col-lg-12 col-sm-12 col-xs-12">                          
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="widget-body no-padding">
                                            <div class="widget-main ">
                                                 <div class="widget-header bordered-bottom bordered-blue titlebottom">
                                                    <div></div>
                                            <span class="widget-caption ">Leads </span><span style="float:right;margin-top:5px;margin-right:5px;"><a href="#" class="btn btn-default btn-xs purple" ng-click="leadsClosed()"> Close</a></span>
                                        </div>
                                        </div>

                                        <table ng-table="tableParams" class="table" show-filter="true">
                    <tr ng-repeat="emp in $data" ng-if="$data.length>0">
                                <td title="'Sl.No'" sortable="'sno'">{{emp.sno}}.</td>
                                <td title="'EMP ID'" sortable="'empid'" filter="{ 'empid': 'text' }">{{emp.empid}}</td>
                                <td title="'EMP Name'" sortable="'emp_name'" filter="{ 'emp_name': 'text' }">{{emp.emp_name}}</td>
                                <td title="'Status'" sortable="'status'" filter="{ 'status': 'text' }">{{emp.attend.status}}</td>
                                <td title="'Absent Session'" sortable="'absent_session'" filter="{ 'absent_session': 'text' }">{{emp.attend.absent_session}}</td>
                                <td title="'Remarks'" sortable="'remarks'" filter="{ 'remarks': 'text' }">{{emp.attend.remarks}}</td>
                                <td title="'Submited Time'" sortable="'time'" filter="{ 'time': 'text' }">{{emp.attend.time}}</td>
                                        </tr>
                    <tr ng-if="$data.length==0">
                        <td colspan="6" align="center">No Records Found...</td>
                    </tr>
                    </table>
        </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="row" ng-if="isLeads" style="margin-top: 25px;">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                <form class="form-horizontal" role="form" name="searchForm" id="searchForm" novalidate ng-submit="subSearchForm(searchForm.$valid)" method="post">
                <div ng-if="type=='Products'">
                        <div class="form-group col-sm-3">
                                                <div class="form-group">
                                                        <label  class="col-sm-4 control-label no-padding-right">Branch</label>
                                                        <div class="col-sm-8">
                                                        <select class="form-control" name="dept_id" id="dept_id" ng-model="search.dept_id" ng-required="true" ng-change="getRolesbyDept(search.dept_id)">
                                                            <option value="All">All</option>
                                                            <option value="{{dept.id}}" ng-repeat="dept in DEPT" ng-selected="dept.id==search.dept_id">{{dept.dept}}</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-2">
                                                <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Role</label>
                                                        <div class="col-sm-9">
                                                        <select class="form-control" name="role_id" id="role_id" ng-model="search.role_id" ng-required="true"ng-change="getEMPSbyRole(search.role_id)">
                                                            <option value="All">All</option>
                                                            <option value="{{role.id}}" ng-repeat="role in roles" ng-selected="role.id==lead.role_id">{{role.role}}</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>    

                                                <div class="form-group col-sm-3">
                                                <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">EMP ID</label>
                                                        <div class="col-sm-9">
                                                        <select class="form-control" name="emp_id" id="emp_id" ng-model="search.emp_id" ng-required="true">
                                                            <option value="All">All</option>
                                                            <option value="{{emp.id}}" ng-repeat="emp in EMPS" ng-selected="emp.id==search.emp_id">{{emp.emp_id}} - {{emp.emp_name}}</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            <div class="form-group">
                                            <div class="col-sm-4">
                                                <div class="col-sm-6">
                                                <label  class="col-sm-3">Type</label>
                                                <div class="col-sm-9">
                                                <select class="form-control" name="type" id="type" ng-model="search.type" ng-required="true">
                                                <option value="0">Process</option>
                                                <option value="1">Created</option>
                                                </select>  
                                                </div>       
                                                </div>
                                                <div class="col-sm-6">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                    <button type="button" class="btn btn-danger" ng-click="leadsClosed()">Cancel</button>
                                                </div>
                                            </div>
                                            </div>
                                                </form>
                                        </div>           
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="widget-body no-padding">
                                            <div class="widget-main ">
                                                 <div class="widget-header bordered-bottom bordered-blue titlebottom">
                                                    <div></div>
                                            <span class="widget-caption ">Leads </span><span style="float:right;margin-top:5px;margin-right:5px;"><a href="#" class="btn btn-default btn-xs purple" ng-click="leadsClosed()"> Close</a></span>
                                        </div>
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
                        </div>
                    </div> 
                                    </div>
                <div ng-if="isLeadView" ng-include="'../template/leadview.html'"></div>
                                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
<?php
include_once('footer.php');
?>