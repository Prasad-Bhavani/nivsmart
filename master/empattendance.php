<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

$ptitle='Attendance';
include_once('header.php');
?>
            <!-- Page Content -->
            <div class="page-content" ng-controller="EMPAttendanceCtrl">
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
                        <div class="col-xs-12 col-md-12">
                            <div class="widget">
                                <div class="widget-header bordered-bottom bordered-yellow">
                                    <span class="widget-caption">Search on All Columns</span>
                                </div>
                                <div class="widget-body no-padding">
                                    <form>
 <div class="table-responsive table-bordered ng-table-settings mar-top-20">
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