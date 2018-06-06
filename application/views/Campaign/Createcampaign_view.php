<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <title>Lurningo CRM</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/> 
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/plugins/uniform/css/uniform.default.css');?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/layout3/css/lurningo.css');?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/select2/select2.css');?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css');?>"/>
    <link href="<?php echo base_url('assets/global/css/components-rounded.css');?>" id="style_components" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/global/css/plugins.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/admin/layout3/css/layout.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/admin/layout3/css/themes/default.css');?>" rel="stylesheet" type="text/css" id="style_color">
    <link href="<?php echo base_url('assets/admin/layout3/css/custom.css');?>" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="favicon.ico"/>

    <script src="<?php echo base_url('assets/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/jquery-migrate.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/jquery-ui/jquery-ui.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/jquery.blockui.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/jquery.cokie.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/uniform/jquery.uniform.min.js');?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js');?>"></script>
    <script src="<?php echo base_url('assets/global/scripts/metronic.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin/layout3/scripts/layout.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin/layout3/scripts/demo.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin/pages/scripts/table-managed.js');?>"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js');?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css');?>"/>
    <script type="text/javascript" src="<?php echo base_url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-select/bootstrap-select.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js');?>"></script>
  </head>
  <body>
    <?php $this->load->view('Header_view'); $datetime = new DateTime('tomorrow');
    
   
    
      
     ?><br>
     
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-heading">Create Campaign</div>
        <div class="panel-body">
        <form class="form-horizontal" id="" method="post" action="<?= base_url();?>Campaign/createcampaign">
            <div class="form-group">
              <label class="control-label col-md-2">Campaign Name</label>
              <div class="col-md-5 col-sm-5">
               <input type="text" class="form-control" placeholder="Enter text" name="campaignname"  id="campaignname"  value="<?php echo set_value('campaignname'); ?>">
                            <span class="help-block"><?php echo form_error('campaignname'); ?> </span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Description:</label>
                <div class="col-sm-5">
                   <textarea name="description" rows="2" class="form-control" placeholder="Enter text" value="<?php echo set_value('description'); ?>"></textarea>
                            <span class="help-block"><?php echo form_error('description'); ?> </span>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Owner</label>
                <div class="col-sm-5">
                  <?php $options = array(  '0'  => 'Please Select');
                        if(!empty($owner)){
                        foreach($owner as $owner) {        
                                $options[$owner->SystemUserID] = ucfirst($owner->FirstName." ".$owner->LastName);        
                              }
                            }
                        echo form_dropdown('owner', $options, set_value('owner') ,'class="form-control"');
                              
                            ?>
                            <span class="help-block"> <?php echo form_error('owner'); ?></span>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Campaign Team:</label>
              <div class="col-sm-5">
                 <?php 
                            $options = array(  '0'  => 'Please Select');
                        if(!empty($team)){
                        foreach($team as $team) {        
                                $options[$team->SystemUserID] = ucfirst($team->FirstName." ".$team->LastName);        
                              }
                            }
                        echo form_multiselect('team[]', $options, set_value('team[]') ,'class="form-control "');
                            ?>
                            <span class="help-block"> <?php echo form_error('team[]'); ?></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Products</label>
              <div class="col-sm-5">
                <select id="select2_sample2" name="select2_sample2[]" class="form-control select2 " placeholder="Please select " multiple>
                  <?php echo $productdetails;
                      
                    
                      ?>
                  </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" >Planned:</label>
                <div class="col-sm-10">
                    <div class="input-group input-large date-picker input-daterange" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                        <span class="input-group-addon">From</span>
                        <input type="text" class="form-control" name="datefrom" value="<?php echo set_value('datefrom'); ?>">
                        <span class="input-group-addon">  to </span>
                        <input type="text" class="form-control" name="dateto" value="<?php echo set_value('dateto'); ?>">
                      </div>
                </div>
            </div>
               <div class="form-group">
              <label class="control-label col-sm-2" >Status</label>
                <div class="col-sm-10">
                    <div class="radio-list">
                      <label class="radio-inline">
                      <label class="radio-inline">
                      <input type="radio" name="Status" id="active" checked="checked" value="active">Active</label>
                  <label class="radio-inline">
                  <input type="radio" name="Status" id="Inactive" value="inactive">Inactive</label>
                      

                  </div>
                </div>
            </div>
            <div class="form-group"> 
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn blue">Submit</button>
                <a href="<?php echo base_url('Displaycampaign');?>" class="btn btn default">Cancel</a>
              </div>
            </div>       
                <div id="coupon"></div>
          </form>
          <hr>
        
        </div>
      </div>
    </div>

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
<script src="<?php echo base_url('assets/admin/pages/scripts/components-pickers.js');?>"></script>
<script src="<?php echo base_url('assets/admin/pages/scripts/components-dropdowns.js');?>"></script>
<script type="text/javascript">
  
jQuery(document).ready(function() {    
//Metronic.init(); // init metronic core components
//Layout.init(); // init current layout
//Demo.init(); // init demo features
ComponentsPickers.init();
ComponentsDropdowns.init();
});
   
</script>

<!-- END PAGE LEVEL SCRIPTS -->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>