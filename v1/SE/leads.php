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
            <div class="page-content" ng-controller="leadCtrl">
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
                 <div class="widget-body" ng-show="isLeads">
                                            <div class="widget-main "><div class="widget-body no-padding">
                                    <form>
 <div class="table-responsive table-bordered ng-table-settings mar-top-20">
            <table ng-table="tableParams" class="table" show-filter="true">
                    <tr ng-repeat="lead in $data" ng-if="$data.length>0">
                                <td title="'Sl.No'" ng-dblclick="getUpdateBox(lead.id,lead.lead_id,lead.qid,lead.lead_verified,lead.nature_of_business_type)" sortable="'sno'" style="cursor:pointer">{{lead.sno}}.</td>
                                <td data-title="'Lead ID'" ng-dblclick="getUpdateBox(lead.id,lead.lead_id,lead.qid,lead.lead_verified,lead.nature_of_business_type)" style="cursor:pointer" sortable="'lead_id'" filter="{'lead_id':'text'}">{{ lead.lead_id }}</td>
                                <td data-title="'Company name'" ng-dblclick="getUpdateBox(lead.id,lead.lead_id,lead.qid,lead.lead_verified,lead.nature_of_business_type)" style="cursor:pointer" sortable="'company_name'" filter="{'company_name':'text'}">{{ lead.company_name }}</td>
                                <td data-title="'Contact Person'" ng-dblclick="getUpdateBox(lead.id,lead.lead_id,lead.qid,lead.lead_verified,lead.nature_of_business_type)" style="cursor:pointer" sortable="'contact_person'" filter="{'contact_person':'text'}">{{ lead.contact_person }}</td>
                                <td data-title="'Contact Number'" ng-dblclick="getUpdateBox(lead.id,lead.lead_id,lead.qid,lead.lead_verified,lead.nature_of_business_type)" style="cursor:pointer" sortable="'contact_no_1'" filter="{'contact_no_1':'text'}">{{ lead.contact_no_1 }}</td>
                                <td data-title="'Demo Date and Time'" align="center" ng-dblclick="getUpdateBox(lead.id,lead.lead_id,lead.qid,lead.lead_verified,lead.nature_of_business_type)" style="cursor:pointer" sortable="'demo_date_time'" filter="{'demo_date_time':'text'}">{{ lead.demo_date_time }}</td>
                                <td data-title="'Action'" align="center"><a href="#" class="btn btn-default btn-xs purple" ng-click="getLead(lead.id,lead.status)"><i class="fa fa-eye"></i> View</a></td>
                    </tr>
                    <tr ng-if="$data.length==0">
                        <td colspan="7" align="center">No Leads Found...</td>
                    </tr>
            </table>

</div>       
                                </form>
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

