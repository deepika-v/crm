<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>CRM |Create Email Template</title>
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
          <a href="#">Home</a><i class="fa fa-circle"></i>
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
        <h4>Send Mail</h4>
        </div>
        <div class='panel-body'>
        <?php echo $this->session->flashdata('msg');?>
         <div class="tab-content">
              <div id="createcampaign" class="tab-pane fade in active">
                 <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                     <?php     
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open('Sendmail/insert_toSentMail', $attributes); 
               // if($campaignid!=""){
                //print_r($campaignid);
              //}
              ?>
                      <div class="form-body">
                         <div class="form-group">
                          <label class="col-md-3 control-label">Select Campaign<span class="required">*</span></label>
                          <div class="col-md-4">
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
                          <label class="col-md-3 control-label">Total Contacts<span class="required">*</span></label>
                          <div class="col-md-4">
                            <p class="form-control-static" id="total_contacts"></p>
                            <span class="help-block"><?php //echo form_error('campaignname'); ?> </span>
                          </div>
                        </div>
                         <div class="form-group">
                          <label class="col-md-3 control-label">Select Template<span class="required">*</span></label>
                          <div class="col-md-4">
                            <?php
                            $template_attributes = array( 'class'=>"form-control input-circle",
                                                        'onchange'=>'displayDetails(this.options[this.selectedIndex].value)'       
                            );
                             $options = array(  '0'  => 'Please Select');
                    
                        if(!empty($templatedetails)) {
                        foreach($templatedetails as $templatedetails) {        
                                $options[$templatedetails->TemplateID] = ucfirst($templatedetails->Name);
        
                              }
                        echo form_dropdown('templateID', $options, set_value('templateID') ,$template_attributes);
                              }
                            ?>
                            <span class="help-block"><?php echo form_error('templateID'); ?> </span>
                          </div>
                        </div>
                         <div class="form-group">
                          <label class="col-md-3 control-label">Sender's Email<span class="required">*</span></label>
                          <div class="col-md-4">
                            <input type="text" class="form-control input-circle" placeholder="Enter text" name="sendersemail"  id="sendersemail" >
                            <span class="help-block"><?php echo form_error('sendersemail'); ?> </span>
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-md-3 control-label">Email Subject<span class="required">*</span></label>
                          <div class="col-md-4">
                            <input type="text" class="form-control input-circle" placeholder="Enter text" name="emailsubject"  id="emailsubject" >
                            <span class="help-block"><?php echo form_error('emailsubject'); ?> </span>
                          </div>
                        </div>
                        <hr>
                       <div class="form-body">
                  <div class="form-group last">
                    <label class="control-label col-md-3">Message</label>
                    <div class="col-md-9">
                    <?php $textarea_attributes = array('class' =>'ckeditor form-control',
                                                        'name'=>'emailmessage',
                                                         'id'=> 'emailmessage',
                                                         'rows'=>"6"                                                        
                    );
                    echo form_textarea($textarea_attributes);?> 
                    </div>
                  </div>
                </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-circle blue" id="sendemail" onclick="disabledbutton()" >Send</button>
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
<script type="text/javascript">
  function displaytotalcount(campaign_id){
 //alert(campaign_id);
 url = '<?php echo base_url()."Sendmail/gettotal_contacts/'+campaign_id+'";?>';
 $.ajax({
        type: 'POST',
        url: url,
        data: {campaignid: campaign_id},
        success: function(response) {
            $('#total_contacts').html(response);
            //alert(response);
        }
    });
  }

 function displayDetails(template_id){
  displayEmailsubject(template_id);
  displayMessage(template_id);
  displaySendersEmail(template_id);

 }
function displayEmailsubject(template_id){
 //alert(template_id);
 url = '<?php echo base_url()."Sendmail/get_templatesubject/'+template_id+'";?>';
 $.ajax({
        type: 'POST',
        url: url,
        data: {templateid: template_id},
        success: function(response) {
            $('#emailsubject').val(response);
            
        }
    });
  } 
  function displaySendersEmail(template_id){
 //alert(template_id);
 url = '<?php echo base_url()."Sendmail/get_templatesendersaddress/'+template_id+'";?>';
 $.ajax({
        type: 'POST',
        url: url,
        data: {templateid: template_id},
        success: function(response) {
            $('#sendersemail').val(response);            
        }
    });
  }
  function displayMessage(template_id){
 //alert(template_id);
 url = '<?php echo base_url()."Sendmail/get_templatemessage/'+template_id+'";?>';
 $.ajax({
        type: 'POST',
        url: url,
        data: {templateid: template_id},
        success: function(response) {
               CKEDITOR.instances.emailmessage.setData(response);
          //document.getElementById('emailmessage').value = response;
            
            //$('#emailmessage').text(response);
           // alert(response);
            
        }
    });
  } 
  function disablebutton(){
    document.getElementById('sendemail').disabled = 'true';
  }
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