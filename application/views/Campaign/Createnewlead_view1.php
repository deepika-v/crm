<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>CRM | Create Lead</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/global/plugins/uniform/css/uniform.default.css');?>" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url('assets/global/css/components-rounded.css');?>" id="style_components" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/global/css/plugins.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/admin/layout3/css/layout.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/admin/layout3/css/themes/default.css');?>" rel="stylesheet" type="text/css" id="style_color">
<link href="<?php echo base_url('assets/admin/layout3/css/custom.css');?>" rel="stylesheet" type="text/css">

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/clockface/css/clockface.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/layout3/css/lurningo.css');?>"/>
<!-- END THEME STYLES -->
<!-- END PAGE LEVEL STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<style type="text/css">
  input[readonly].default-cursor {
    cursor: default;
    background-color: #fff;
}
</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body>
<!-- BEGIN HEADER -->
<?php //phpinfo(); 
$this->load->view('Header_view');?>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
  <!-- BEGIN PAGE HEAD -->
    <div class="container">
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
      <ul class="page-breadcrumb breadcrumb">
        <li>
          <a href="<?php echo base_url('Dashboard');?>" class="linkcss">Home</a><i class="fa fa-circle"></i>
        </li>
        <li>Create New Lead<i class="fa fa-circle"></i>
        </li>
      </ul>
      </div>
      <!-- END PAGE TITLE -->
    </div>
  
  <!-- END PAGE HEAD -->
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="container">
      <!-- BEGIN PAGE CONTENT INNER -->
      <div class="row">
        <div class="col-md-12">
        <div class='panel panel-default'>
        <div class='panel-heading'>
        <h4>Create New Leads</h4>
        </div>
        <div class='panel-body'>
        <?php echo $this->session->flashdata('msg');?>
         <div class="tab-content">
              <div id="createcampaign" class="tab-pane fade in active">
                 <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                     <?php     
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open('Leadcreation/insert', $attributes); 
               // if($campaignid!=""){
                //print_r($campaignid);
              //}
              ?>
                      <div class="form-body">
                         <div class="form-group">
                          <label class="col-md-3 control-label">Select Campaign<span class="required">*</span></label>
                          <div class="col-md-3">
                         <?php 
                          $campaign_attributes = array( 'class'=>"form-control input-circle",
                                                        'onchange'=>'displaytotalcount(this.options[this.selectedIndex].value)'       
                            );

                         $options = array(  '0'  => 'Please Select');                    
                        if(!empty($campaigndetails)) {
                        foreach($campaigndetails as $campaigndetails) {        
                                $options[$campaigndetails->CampaignID] = ucfirst($campaigndetails->CampaignName);
                          }
                        echo form_dropdown('campaignID', $options, set_value('campaignID') ,$campaign_attributes);
                              }
                            ?>
                            <span class="help-block"><?php echo form_error('campaignID'); ?> </span>
                          </div>
                        </div>
                         <div class="form-group">
                          <label class="col-md-3 control-label">Candidate's Name<span class="required">*</span></label>
                          
                          <div class="col-md-3">
                            <input type="text" class="form-control input-circle" placeholder="Enter First Name" name="userfname"  id="userfname" value="<?php echo set_value('userfname'); ?>" >
                           <span class="help-block"><?php echo form_error('userfname'); ?> </span>
                            <span class="help-block"><?php echo form_error('userlname'); ?> </span>
                           </div> 
                           <div class="col-md-3">
                            <input type="text" class="form-control input-circle" placeholder="Enter Last Name" name="userlname"  id="userlname" value="<?php echo set_value('userlname'); ?>" >
                           
                           </div>
                           <br>
                           
                                                     
                        </div>  
                        <div class="form-group">
                          <label class="col-md-3 control-label">Gender<span class="required">*</span></label>
                          <div class="col-md-3">
                         <?php 
                          $campaign_attributes = array( 'class'=>"form-control input-circle"                           );

                         $options = array(  '0'  => 'Please Select',
                                             '1' => 'Male',
                                             '2' => 'Female',
                                             '3' => 'Other');                    
                        
                        echo form_dropdown('usergender', $options, set_value('usergender') ,$campaign_attributes);?>
                            <span class="help-block"><?php echo form_error('usergender'); ?> </span>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Date of Birth<span class="required">*</span></label>
                          <div class="col-md-3">
                           <input class="form-control input-circle form-control-inline input-medium date-picker default-cursor" data-date-format="dd-mm-yyyy" data-date-end-date="+0d" size="16" type="text" value="<?php echo set_value('userdob'); ?>" name='userdob' id="userdob"  readonly/>
                            <span class="help-block"><?php echo form_error('userdob'); ?> </span>
                          </div>
                        </div>
                           <div class="form-group">
                          <label class="col-md-3 control-label">Email<span class="required">*</span></label>
                          <div class="col-md-3">
                            <input type="text" class="form-control input-circle" placeholder="Enter text" name="useremail"  id="useremail"  value="<?php echo set_value('useremail'); ?>">
                            <span class="help-block"><?php echo form_error('useremail'); ?> </span>
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-md-3 control-label">Phone<span class="required">*</span></label>
                          <div class="col-md-3">
                            <input type="text" class="form-control input-circle" placeholder="Enter text" name="userphone"  id="userphone" value="<?php echo set_value('userphone'); ?>" >
                            <span class="help-block"><?php echo form_error('userphone'); ?> </span>
                          </div>
                        </div>
                         <div class="form-group">
                           <label class="col-md-3 control-label">City<span class="required">*</span></label>
                          <div class="col-md-3">
                         <?php 
                          $city_attributes = array( 'class'=>"form-control input-circle" );

                         $options = array(  '0'  => '--Select--');  

                        
                        foreach($citydetails as $citydetails) {        
                                $options[$citydetails->CityId] = ucfirst($citydetails->CityName);
                          }                  
                        
                        echo form_dropdown('usercity', $options, set_value('usercity') ,$city_attributes);
                              
                            ?>
                            <span class="help-block"><?php echo form_error('usercity'); ?> </span>
                          </div>
                        </div>
                         
                        <hr>
                    
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-circle blue" id="sendemail">Submit</button>
                            </div>
                        </div>
                      </div>
                    </form>
                    <!-- END FORM-->
                  </div>
              </div>
              <div id="Search" class="tab-pane fade">
              </div>
          </div>
        </div>
      </div>
      </div>
      </div>
      <!-- END PAGE CONTENT INNER -->
    </div>
  </div>
  <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="page-footer">
  <div class="container">
     2016 &copy; Lurningo CRM. <a href="#" target="_blank"></a>
  </div>
</div>
<div class="scroll-to-top">
  <i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url('assets/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-migrate.min.js');?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('assets/global/plugins/jquery-ui/jquery-ui.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.blockui.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.cokie.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/uniform/jquery.uniform.min.js');?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="<?php echo base_url('assets/global/scripts/metronic.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout3/scripts/layout.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout3/scripts/demo.js');?>" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {    
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Demo.init(); // init demo features
ComponentsPickers.init();
});
   </script>


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/clockface/js/clockface.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/moment.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js');?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url('assets/global/scripts/metronic.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout3/scripts/layout.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/layout3/scripts/demo.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/components-pickers.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/ckeditor/ckeditor.js');?>"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>