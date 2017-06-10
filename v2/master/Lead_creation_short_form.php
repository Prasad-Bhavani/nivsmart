<?php
include_once('../db/config.php');
include_once('../db/functions.php');
include_once('../db/user_functions.php');
include_once('session.php');
?>
<script src='assets/js/jquery-customselect.js'></script>
    <link href='assets/css/jquery-customselect.css' rel='stylesheet' />
    
    
<!-- Page Content -->
            <div class="page-content">
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
                    
                    <br />
   
            

<div class="row">
                        
                        
                        
               <div class="col-lg-8 ">
                                    <div class="widget">
                                        <div class="widget-header bordered-bottom bordered-blue">
                                            <span class="widget-caption">Lead Creation Short Form </span>
                                        </div>
                                        <div class="widget-body">
                                            <div>
                                                <form class="form-horizontal" role="form">
                                                    
                                                    
                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Contact No 1</label>
                                                        <div class="col-sm-7">
                                                           <input class="form-control"  type="text" placeholder="Contact"/>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Contact No II</label>
                                                        <div class="col-sm-7">
                                                           <input class="form-control"  type="text" placeholder="Contact"/>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Company Name</label>
                                                        <div class="col-sm-7">
                                                           <input class="form-control"  type="text" placeholder="Company Name"/>
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Person Name</label>
                                                        <div class="col-sm-7">
                                                           <input class="form-control"  type="text" placeholder="Person Name"/>
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Existing Tally Customer</label>
                                                        <div class="col-sm-7">
                                                           <select class="form-control">
                                                            <option>Yes</option>
                                                           <option>No</option>
                                                           </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Tally Serial No(If  Existing Tally Yes) </label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control"  type="text" placeholder="Tally Serial No"/>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Opportunity for Renewal or Upgrade </label>
                                                        <div class="col-sm-7">
                                                         <select class="form-control">
                                                           <option>Yes</option>
                                                           <option>No</option>
                                                           </select>
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Version Details </label>
                                                        <div class="col-sm-7">
                                                             <input class="form-control"  type="text" placeholder="Version Details"/>
                                                        </div>
                                                    </div>
                                                    
                                                      <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Prospect for Tally</label>
                                                        <div class="col-sm-7">
                                                         <select class="form-control">
                                                           <option>Yes</option>
                                                           <option>No</option>
                                                           </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Prospect Type</label>
                                                        <div class="col-sm-7">
                                                         <select class="form-control">
                                                           <option>Yes</option>
                                                           <option>No</option>
                                                           </select>
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Prospect Details</label>
                                                        <div class="col-sm-7">
                                                         <select class="form-control">
                                                           <option>Yes</option>
                                                           <option>No</option>
                                                           </select>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                     <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Interested for Demo</label>
                                                        <div class="col-sm-7">
                                                         <select class="form-control">
                                                           <option>Yes</option>
                                                           <option>No</option>
                                                           </select>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group">
                                                        <label  class="col-sm-3 control-label no-padding-right">Remarks</label>
                                                        <div class="col-sm-7">
                                                            <input class="form-control"  type="text" placeholder="Remarks"/>
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-4 col-sm-10">
                                                            <button type="submit" class="btn btn-danger">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>         
                        
                <div class="col-lg-4 ">
                                    <div class="well">
                                    
                                    
                                    Photo
                                    
                                    </div>
                                   <input multiple="" type="file">
                                </div>        
                        
                        
                        
                        
                        
                    </div>








                   
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
       <script type="text/javascript">
      window.onload=function(){
      $('.selectpicker').selectpicker();
      $('.rm-mustard').click(function() {
        $('.remove-example').find('[value=Mustard]').remove();
        $('.remove-example').selectpicker('refresh');
      });
      $('.rm-ketchup').click(function() {
        $('.remove-example').find('[value=Ketchup]').remove();
        $('.remove-example').selectpicker('refresh');
      });
      $('.rm-relish').click(function() {
        $('.remove-example').find('[value=Relish]').remove();
        $('.remove-example').selectpicker('refresh');
      });
      $('.ex-disable').click(function() {
          $('.disable-example').prop('disabled',true);
          $('.disable-example').selectpicker('refresh');
      });
      $('.ex-enable').click(function() {
          $('.disable-example').prop('disabled',false);
          $('.disable-example').selectpicker('refresh');
      });

      // scrollYou
      $('.scrollMe .dropdown-menu').scrollyou();

      prettyPrint();
      };
    </script>
    <script src="assets/js/bootstrap-select.js" />      
           
<?php
include_once('footer.php');
?>

