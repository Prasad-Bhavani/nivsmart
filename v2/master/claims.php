<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

include_once('header.php');
?>
<!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="#">Home</a>
                        </li>
                        <li class="active">Profile</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                                
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                            Expenses
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
                <div class="page-body" ng-controller="expensesCtrl">
                    
                    <br />
    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="widget-body">
                                            <div class="widget-main "><div class="widget-body no-padding">
                                    <form>
 <div class="table-responsive table-bordered ng-table-settings mar-top-20">
                           <table ng-table="tableParams" class="table" show-filter="true">
                    <tr ng-repeat="rec in $data" ng-if="$data.length>0">
                                <td data-title="'Sl.No'" sortable="'sno'">{{rec.sno}}.</td>
                                <td data-title="'Token No'" sortable="'tokenid'" filter="{'tokenid':'text'}">{{ rec.tokenid }}</td>
                                <td data-title="'Branch'" sortable="'branch_name'" filter="{'branch_name':'text'}">{{ rec.branch_name }}</td>
                                <td data-title="'EMP ID'" sortable="'empid'" filter="{'empid':'text'}">{{ rec.empid }}</td>
                                <td data-title="'EMP Name'" sortable="'emp_name'" filter="{'emp_name':'text'}">{{ rec.emp_name }}</td>
                                <td data-title="'From Date'" sortable="'from_date'" filter="{'from_date':'text'}">{{ rec.from_date }}</td>
                                <td data-title="'To Date'" sortable="'to_date'" filter="{'to_date':'text'}">{{ rec.to_date }}</td>
                                <td data-title="'Actual Amount'" sortable="'actualAmount'" filter="{'actualAmount':'text'}" align="right">{{ rec.actualAmount }}</td>
                                <td data-title="'Paid Amount'" sortable="'paidAmount'" filter="{'paidAmount':'text'}" align="right">{{ rec.paidAmount }}</td>
                                <td data-title="'Payment Status'" sortable="'status'" filter="{'status':'text'}">{{ rec.status }}</td>
                                <td data-title="'Paid Date'" sortable="'paid_date_time'" filter="{'paid_date_time':'text'}">{{ rec.paid_date_time }}</td>
                                <td data-title="'Action'" align="center"><a href="#" class="btn btn-default btn-xs purple" ng-click="getViewExpense(rec)"><i class="fa fa-eye"></i> View</a>
                                </td>                             
                    </tr>
                    <tr ng-if="$data.length==0">
                        <td align="center" colspan="9">No Records Found...</td>
                    </tr>
            </table>
            </div>
            </form>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
<?php
include_once('footer.php');
?>