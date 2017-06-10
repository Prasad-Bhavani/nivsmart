<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

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
                                            <span class="widget-caption" style="font-size: 15px">Employees </span> <span style="float:right;margin-top:5px;margin-right:5px;"><a href="#" class="btn btn-default btn-xs purple" ng:href="employee.php"> Create Employee</a></span>
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
                                <a class="btn btn-default btn-xs purple" ng-href="employee.php#?id={{emp.id}}"><i class="fa fa-edit"></i> Edit</a>
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
                                            <td colspan="4" style="color: #2dc3e8">Company Details</td>
                                            </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Employee ID</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_id}}</td>
                                            <td class="profilelabel">
                                                <a href="#">Department</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.dept}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Email</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_email}}</td>
                                            <td class="profilelabel">
                                                <a href="#">Role</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.role}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Branches</a>
                                            </td>
                                            <td class="hidden-xs profiletext" colspan="3"><span style="display: block;" ng-repeat="branch in branches">{{branch.branch_name}}</span></td>
                                            </tr>
                                        <tr ng-if="profile.emp_grade_id!=''">
                                            <td class="profilelabel">
                                                <a href="#">Employee Grade</a>
                                            </td>
                                            <td colspan="3" class="hidden-xs profiletext">{{profile.emp_grade_id}}</td>
                                        </tr>
                                            <tr>
                                            <td colspan="4" style="color: #2dc3e8">Personal Detail</td>
                                            </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Name</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_name}}</td>
                                            <td class="profilelabel">
                                                <a href="#">State</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.state}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Email</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_email}}</td>
                                            <td class="profilelabel">
                                                <a href="#">City</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.city}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Phone Number</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_phone_no}}</td>
                                            <td class="profilelabel">
                                                <a href="#">Address</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_addr}}</td>
                                        </tr>
                                        <tr>
                                            <td class="profilelabel">
                                                <a href="#">Education</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_education}}</td>
                                            <td class="profilelabel">
                                                <a href="#">PAN Number</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_pan_no}}</td>
                                        </tr>
                                        <tr>
                                            <td class="hidden-xs profiletext">
                                                <a href="#">Adhar Number</a>
                                            </td>
                                            <td colspan="3" class="hidden-xs profiletext">{{profile.emp_adhar_no}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="color: #2dc3e8">Bank Details</td>
                                            </tr>
                                            <tr>
                                            <td class="profilelabel">
                                                <a href="#">Bank Name</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_name}}</td>
                                            <td class="profilelabel">
                                                <a href="#">Bank Branch</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_branch}}</td>
                                            </tr>
                                            <tr>
                                            <td class="profilelabel">
                                                <a href="#">Bank Account Number</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_ac_no}}</td>
                                            <td class="profilelabel">
                                                <a href="#">Bank IFSC Code</a>
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
?>

