<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

if($_SESSION['niv_roleid']==3)
{
$ptitle='Employees';
include_once('header.php');
?>    
<style type="text/css">
.brachlist
{
    max-height: 100px;
    overflow-y: scroll;
}
legend
{
    font-size: 15px;
}
</style>
<!-- Page Content -->
            <div class="page-content" ng-controller="employeeCtrl">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="#">Home</a>
                        </li>
                        <li class="active"><?php echo $ptitle; ?></li>
                    </ul>
<div class="clear"></div>
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
                    
                    <br />
   
            

<div class="row" ng-show="EMPS">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="widget-body">
                                        <div class="widget-header bordered-bottom bordered-blue">
                                            <span class="widget-caption" style="font-size: 15px">Employees </span></span>
                                        </div>
 <div class="table-responsive table-bordered ng-table-settings mar-top-20">
            <table ng-table="tableParams" class="table" show-filter="true">
                    <tr ng-repeat="emp in $data" ng-if="$data.length>0">
                                <td title="'Sl.No'" sortable="'sno'">{{emp.sno}}.</td>
                                <td data-title="'Employee ID'" sortable="'emp_id'" filter="{ 'emp_id': 'text' }">{{ emp.emp_id }}</td>
                                <td data-title="'Name'" sortable="'emp_name'" filter="{ 'emp_name': 'text' }">{{ emp.emp_name }}</td>
                                <td data-title="'Phone No'" sortable="'emp_phone_no'" filter="{ 'emp_phone_no': 'text' }">{{ emp.emp_phone_no }}</td>
                                <td data-title="'Department'" sortable="'emp_dept'" filter="{ 'emp_dept': 'text' }">{{ emp.emp_dept }}</td>
                                <td data-title="'Role'" width="12%" sortable="'emp_role'" filter="{ 'emp_role': 'text' }">{{ emp.emp_role }}</td>
                                <td data-title="'Action'" width="12%" align="center"><a href="#" class="btn btn-default btn-xs purple" ng-click="getEMPProfile(emp.id)"><i class="fa fa-eye"></i> View</a>
                                </td>
                                        </tr>
                        <tr>
                            <td colspan="7" align="center" ng-if="$data.length==0">No Records Found...</td>
                        </tr>
                    </table>
</div>                    
</div>   
                     </div>   
                        
                    </div>
                    <div class="row" ng-show="EMP">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="well with-header">
            <div class="header bordered-warning">Employee Profile <span style="float:right"><a href="#" class="btn btn-default btn-xs purple" ng-click="getBack()"> Back</a></span></div>
                           <div class="well">
                                                           <table class="table table-striped table-bordered table-hover">
                                  
                                    <tbody>
                                            <tr>
                                            <td colspan="4" style="color: #2dc3e8"><b>Company Details</b></td>
                                            </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <b>Employee ID</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_id}}</td>
                                            <td class="profilelabel">
                                                <b>Department</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.dept}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <b>Email</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_email}}</td>
                                            <td class="profilelabel">
                                                <b>Role</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.role}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <b>Branches</b>
                                            </td>
                                            <td class="hidden-xs profiletext" colspan="3"><span style="display: block;" ng-repeat="branch in branches">{{branch.branch_name}}</span></td>
                                            </tr>
                                        <tr ng-if="profile.emp_grade_id!=''">
                                            <td class="profilelabel">
                                                <b>Employee Grade</b>
                                            </td>
                                            <td colspan="3" class="hidden-xs profiletext">{{profile.emp_grade_id}}</td>
                                        </tr>
                                            <tr>
                                            <td colspan="4" style="color: #2dc3e8"><b>Personal Detail</b></td>
                                            </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <b>Name</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_name}}</td>
                                            <td class="profilelabel">
                                                <b>State</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.state}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <b>Email</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_email}}</td>
                                            <td class="profilelabel">
                                                <b>City</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.city}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                Phone Number</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_phone_no}}</td>
                                            <td class="profilelabel">
                                               <b>Address</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_addr}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <b>Education</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_education}}</td>
                                            <td class="profilelabel">
                                                <b>PAN Number</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_pan_no}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <b>Adhar Number</b>
                                            </td>
                                            <td colspan="3" class="hidden-xs profiletext">{{profile.emp_adhar_no}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="color: #2dc3e8"><b>Bank Details</b></td>
                                            </tr>
                                            <tr>
                                            <td class="profilelabel">
                                                <b>Bank Name</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_name}}</td>
                                            <td class="profilelabel">
                                                <b>Brank Branch</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_branch}}</td>
                                            </tr>
                                            <tr>
                                            <td class="profilelabel">
                                                <b>Bank Account Number</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_ac_no}}</td>
                                            <td class="profilelabel">
                                                <b>Brank IFSC Code</b>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_ifsc_code}}</td>
                                            </tr>
                                    </tbody>
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
}
else
    header('Location: dashboard.php');
    exit;
?>

