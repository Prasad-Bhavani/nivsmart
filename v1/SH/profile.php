<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

include_once('header.php');
?>
<style type="text/css">
.profilelabel
{
    width: 25%;
}
.text
{
    width: 25%;
}
</style>
<!-- Page Content -->
            <div class="page-content" ng-controller="profileCtrl">
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
                            Profile
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
   
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="well with-header">
            <div class="header bordered-warning">Profile</div>
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
                                            <td colspan="4" style="color: #2dc3e8">Bank Details</td>
                                            </tr>
                                            <tr>
                                            <td class="profilelabel">
                                                <a href="#">Bank Name</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_name}}</td>
                                            <td class="profilelabel">
                                                <a href="#">Brank Branch</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_branch}}</td>
                                            </tr>
                                            <tr>
                                            <td class="profilelabel">
                                                <a href="#">Bank Account Number</a>
                                            </td>
                                            <td class="hidden-xs profiletext">{{profile.emp_bank_ac_no}}</td>
                                            <td class="profilelabel">
                                                <a href="#">Brank IFSC Code</a>
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
        </div>
<?php
include_once('footer.php');
?>