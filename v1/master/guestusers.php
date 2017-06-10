<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');

$ptitle='Guest Users';
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
            <div class="page-content" ng-controller="guestUserCtrl">
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
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="widget-body">
                                        <div class="widget-header bordered-bottom bordered-blue">
                                            <span class="widget-caption" style="font-size: 15px">Guest User </span>
                                        </div>
 <div class="table-responsive table-bordered ng-table-settings mar-top-20">
            <table ng-table="tableParams" class="table" show-filter="true">
                    <tr ng-repeat="user in $data" ng-if="$data.length>0">
                                <td title="'Sl.No'" sortable="'sno'">{{user.sno}}.</td>
                                <td data-title="'Company name'" sortable="'org_name'" filter="{ 'org_name': 'text' }">{{ user.org_name }}</td>
                                <td data-title="'Person Name'" sortable="'contact_person'" filter="{ 'contact_person': 'text' }">{{ user.contact_person }}</td>
                                <td data-title="'Mobile No'" sortable="'mobile_no'" filter="{ 'mobile_no': 'text' }">{{ user.mobile_no }}</td>
                                <td data-title="'City'" sortable="'city'" filter="{ 'city': 'text' }">{{ user.city }}</td>
                                <td data-title="'Roll'" width="12%" sortable="'roll'" filter="{ 'roll': 'text' }">{{ user.roll }}</td>
                                <td data-title="'Tally User'" width="12%" sortable="'if_tally'" filter="{ 'if_tally': 'text' }">{{ user.if_tally }}</td>
                                <td data-title="'Registered Date'" width="12%" sortable="'created_date_time'" filter="{ 'created_date_time': 'text' }">{{user.created_date_time}}</td>
                                        </tr>
                                    <tr ng-if="$data.length==0">
                                        <td colspan="8" align="center">No Records Found...</td>
                                    </tr>
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

