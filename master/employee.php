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
            <div class="row">
                                               
               <div class="col-lg-12 ">
                                    <div class="widget">
                                        <div class="widget-header bordered-bottom bordered-blue">
                                            <span class="widget-caption" style="font-size: 15px">Create Employee </span> <span style="float:right;margin-top:5px;margin-right:5px;"><a href="#" class="btn btn-default btn-xs purple" ng:href="employees.php"> Employees</a></span>
                                        </div>
                                        <div class="widget-body">
                                            <div>
                                                <form class="form-horizontal" role="form" name="employeeForm" id="employeeForm" novalidate ng-submit="subForm(employeeForm.$valid)" method="post" enctype="multipart/form-data">
                                    <div class="col-lg-6 ">

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right"> Employee ID</label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control" type="text" placeholder="Automatically Generated..." onblur="this.placeholder='Automatically Generated...'" onfocus="this.placeholder=''" name="emp_id" id="emp_id" ng-model="obj.emp_id" ng-disabled="true"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Department</label>
                                                        <div class="col-sm-7">
                                                           <select class="form-control" name="emp_dept_id" id="emp_dept_id" ng-model="obj.emp_dept_id" ng-required="true" ng-class="{'has-error':submitted && employeeForm.emp_dept_id.$error.required}" ng-change="getEmpRolesByDeptID(obj.emp_dept_id)" ng-disabled="not_allow.nochange">
                                                           <option value="">Select Department</option>
                                                            <option ng-repeat="dept in departments" value="{{dept.id}}" ng-selected="obj.emp_dept_id==dept.id">{{dept.dept}}</option>
                                                           </select>
                                                             <p ng-show="submitted && employeeForm.emp_dept_id.$error.required" class="error">Please Select Department</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Role</label>
                                                        <div class="col-sm-7">
                                                           <select class="form-control" name="emp_role_id" id="emp_role_id" ng-model="obj.emp_role_id" ng-required="true" ng-class="{'has-error':submitted && employeeForm.emp_role_id.$error.required}" ng-options="role.id as role.role for role in roles" ng-change="obj.emp_role_id===undefined || getActiveBranchesByRoles(obj.emp_dept_id,obj.emp_role_id)" ng-disabled="not_allow.nochange">
                                                           <option value="" ng-selected="true">Select Role</option>
                                                            <option value="role.id">{{role.role}}</option>
                                                           </select>
                                                             <p ng-show="submitted && employeeForm.emp_role_id.$error.required" class="error">Please Select Role</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" ng-show="branchshow">
                                                        <label class="col-sm-3 control-label no-padding-right">Branches</label>
                                                        <div class="col-sm-7">
                                                            <div ng-if="multibranch==1">
                                                            <div class="brachlist well" style="padding-top:0px;padding-bottom:0px;margin-bottom:0px;">
                                                            <div class="checkbox" ng-repeat="branch in branches">
                                                            <label>
                                                            <input type="checkbox" class="colored-success" ng-model="selected.branch[branch.id]" ng-value="{{branch.id}}" ng-click="checkBranchCount(branch.id)" ng-disabled="not_allow.branches[branch.id]">
                                                            <span class="text">{{branch.branch_name}}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                             <p ng-show="submitted && branchesCount==0" class="error" style="margin-top: 5px">Please Select Atleast one Branch</p>
                                                         </div>
                                                         <div ng-if="multibranch==0">
                                                            <select class="form-control"  name="emp_branch_ids" id="emp_branch_ids" ng-disabled="true">
                                                                <option ng-selected="true" value="1">Main Branch</option></select>
                                                         </div>
                                                                <div ng-show="branchMSG" style="margin-top:10px;color:red;font-size:12px;">All Branches {{EMProle}}s are Created.</div>

                                                        </div>
                                                    </div>

                             <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right"> Employee Name</label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control" ng-class="{'has-error':submitted && employeeForm.emp_name.$error.required}"  type="text" placeholder="Enter Employee Name" onblur="this.placeholder='Enter Employee Name'" onfocus="this.placeholder=''" name="emp_name" id="emp_name" ng-model="obj.emp_name" ng-required="true"/>
                                                             <p ng-show="submitted && employeeForm.emp_name.$error.required" class="error">Please Enter Name</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right"> Email</label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control" ng-class="{'has-error':submitted && employeeForm.emp_email.$error.required || submitted && employeeForm.emp_email.$error.pattern || obj.exist}"  type="text" placeholder="Enter Email" onblur="this.placeholder='Enter Email'" onfocus="this.placeholder=''" name="emp_email" id="emp_email" ng-model="obj.emp_email" ng-required="true" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/"/>
                                                             <p ng-show="submitted && employeeForm.emp_email.$error.required" class="error">Please Enter Email</p>
                                                        <p ng-show="submitted && employeeForm.emp_email.$error.pattern" class="error">Please Enter Valid Email</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right"> Phone number</label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control" ng-class="{'has-error':submitted && employeeForm.emp_phone_no.$error.required || submitted && employeeForm.emp_phone_no.$error.pattern}"  type="text" placeholder="Enter Phone Number" onblur="this.placeholder='Enter Phone Number'" onfocus="this.placeholder=''" name="emp_phone_no" id="emp_phone_no" ng-model="obj.emp_phone_no" ng-required="true" ng-pattern="/^\d{10}$/"/>
                                                             <p ng-show="submitted && employeeForm.emp_phone_no.$error.required" class="error">Please Enter Phone Number</p>
                                                        <p ng-show="submitted && employeeForm.emp_phone_no.$error.pattern" class="error">Please Enter Valid Number</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right">State</label>
                                                        <div class="col-sm-7">
                                                        <select class="form-control" ng-class="{'has-error':submitted && employeeForm.emp_state_id.$error.required}" name="emp_state_id" id="emp_state_id" ng-model="obj.emp_state_id" ng-required="true" ng-change="getCities(obj.emp_state_id)">
                                                            <option value="">Select State</option>
                                                            <option ng-repeat="state in states" value="{{state.id}}" ng-selected="obj.emp_state_id==state.id">{{state.state}}</option>
                                                        </select>
                                                        <p ng-show="submitted && employeeForm.emp_state_id.$error.required" class="error">Please Select State</p>
                                                        </div>
                                                      </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right">City</label>
                                                        <div class="col-sm-7">
                                                        <select class="form-control" ng-class="{'has-error':submitted && employeeForm.emp_city_id.$error.required}" name="emp_city_id" id="emp_city_id" ng-model="obj.emp_city_id" ng-required="true">
                                                            <option value="">Select City</option>
                                                            <option ng-repeat="city in cities" value="{{city.id}}" ng-selected="city.id==obj.emp_city_id">{{city.city}}</option>
                                                        </select>
                                                        <p ng-show="submitted && employeeForm.emp_city_id.$error.required" class="error">Please Select City</p>
                                                        </div>
                                                      </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right">Address</label>
                                                        <div class="col-sm-7">
                                                           <textarea class="form-control" ng-class="{'has-error':submitted && employeeForm.emp_addr.$error.required}" placeholder="Enter Address" onblur="this.placeholder='Enter Address'" onfocus="this.placeholder=''" name="emp_addr" id="emp_addr" ng-model="obj.emp_addr" ng-required="true"></textarea>
                                                        </div>
                                                    </div>                                  
                                            </div>

                                            <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right"> Education Qualification</label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control" ng-class="{'has-error':submitted && employeeForm.emp_education.$error.required}"  type="text" placeholder="Enter Employee Education" onblur="this.placeholder='Enter Employee Education'" onfocus="this.placeholder=''" name="emp_education" id="emp_education" ng-model="obj.emp_education" ng-required="true"/>
                                                             <p ng-show="submitted && employeeForm.emp_education.$error.required" class="error">Please Enter Education Qualification</p>
                                                        </div>
                                                    </div>  

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right"> Employee Grade</label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control"  type="text" placeholder="Enter Employee Grade" onblur="this.placeholder='Enter Employee Grade'" onfocus="this.placeholder=''" name="emp_grade_id" id="emp_grade_id" ng-model="obj.emp_grade_id"/>
                                                        </div>
                                                    </div>     

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right"> Adhar NO</label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control"  type="text" ng-class="{'has-error':(submitted && employeeForm.emp_adhar_no.$error.required) || (submitted && employeeForm.emp_adhar_no.$error.pattern)}"  placeholder="Enter Adhar Number" onblur="this.placeholder='Enter Adhar Number'" onfocus="this.placeholder=''" name="emp_adhar_no" id="emp_adhar_no" ng-model="obj.emp_adhar_no" ng-required="true" ng-pattern="/^\d{12}$/"/>
                                                             <p ng-show="submitted && employeeForm.emp_adhar_no.$error.required" class="error">Please Enter Adhar Number</p>
                                                             <p ng-show="submitted && employeeForm.emp_adhar_no.$error.pattern" class="error">Please Enter Valid Adhar Number</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right"> PAN NO</label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control"  type="text" placeholder="Enter PAN Number" onblur="this.placeholder='Enter PAN Number'" onfocus="this.placeholder=''" name="emp_pan_no" id="emp_pan_no" ng-model="obj.emp_pan_no"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right"> Bank Name</label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control" ng-class="{'has-error':submitted && employeeForm.emp_bank_name.$error.required}"  type="text" placeholder="Enter Bank Name" onblur="this.placeholder='Enter Bank Name'" onfocus="this.placeholder=''" name="emp_bank_name" id="emp_bank_name" ng-model="obj.emp_bank_name" ng-required="true"/>
                                                             <p ng-show="submitted && employeeForm.emp_bank_name.$error.required" class="error">Please Enter Bank Name</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right"> Bank Account Number</label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control" ng-class="{'has-error':submitted && employeeForm.emp_bank_ac_no.$error.required}"  type="text" placeholder="Enter Account Number" onblur="this.placeholder='Enter Account Number'" onfocus="this.placeholder=''" name="emp_bank_ac_no" id="emp_bank_ac_no" ng-model="obj.emp_bank_ac_no" ng-required="true"/>
                                                             <p ng-show="submitted && employeeForm.emp_bank_ac_no.$error.required" class="error">Please Enter Account Name</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right"> Bank Branch</label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control" ng-class="{'has-error':submitted && employeeForm.emp_bank_branch.$error.required}"  type="text" placeholder="Please Enter Bank Branch" onblur="this.placeholder='Please Enter Bank Branch'" onfocus="this.placeholder=''" name="emp_bank_branch" id="emp_bank_branch" ng-model="obj.emp_bank_branch" ng-required="true"/>
                                                             <p ng-show="submitted && employeeForm.emp_bank_branch.$error.required" class="error">Please Enter Bank Branch</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right"> Bank IFSC Code</label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control" ng-class="{'has-error':submitted && employeeForm.emp_bank_ifsc_code.$error.required}"  type="text" placeholder="Enter Bank IFSC Code" onblur="this.placeholder='Enter Bank IFSC Code'" onfocus="this.placeholder=''" name="emp_bank_ifsc_code" id="emp_bank_ifsc_code" ng-model="obj.emp_bank_ifsc_code" ng-required="true"/>
                                                             <p ng-show="submitted && employeeForm.emp_bank_ifsc_code.$error.required" class="error">Please Enter Bank IFSC Code</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Status</label>
                                                        <div class="col-sm-7">
                                                           <select class="form-control" name="emp_status" id="emp_status" ng-model="obj.emp_status" ng-required="true" ng-class="{'has-error':submitted && employeeForm.emp_status.$error.required}">
                                                           <option value="" ng-selected="true">Select Status</option>
                                                           <option value="1">Active</option>
                                                           <option value="0">Inactive</option>
                                                           </select>
                                                             <p ng-show="submitted && employeeForm.emp_status.$error.required" class="error">Please Select Status</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-offset-3 col-sm-10">
                                                           <button type="submit" name="sub" id="sub" class="btn btn-primary">{{obj.emp_id!=undefind ? 'Update' : 'Create'}}</button>
                                                            <button type="reset" class="btn btn-default" ng-click="resetForm()" ng-if="!obj.emp_id">Clear</button>
                                                            <button type="button" class="btn btn-default" onclick="window.location.href='employees.php'" ng-if="obj.emp_id">Cancel</button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="clearfix"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>         
                        
                
                <!--<div class="col-lg-4 ">
                                    <div class="well">
                                    
                                    
                                    Photo
                                    
                                    </div>
                                   <input multiple="" type="file">
                                </div>        -->
                        
                        
                        
                        
                        
                    </div>



<script type="text/javascript">
$('.checkboxdisplay').click(function()
{
    alert($(this).val());
});
</script>

                   
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->    
           
<?php
include_once('footer.php');
?>

