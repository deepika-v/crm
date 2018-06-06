<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>CRM | Campaign</title>
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/layout3/css/lurningo.css');?>"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url('assets/global/css/components-rounded.css');?>" id="style_components" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/global/css/plugins.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/admin/layout3/css/layout.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/admin/layout3/css/themes/default.css');?>" rel="stylesheet" type="text/css" id="style_color">
<link href="<?php echo base_url('assets/admin/layout3/css/custom.css');?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-select/bootstrap-select.min.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/select2/select2.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/jquery-multi-select/css/multi-select.css');?>"/>
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/clockface/css/clockface.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css');?>"/>
<script src="<?php echo base_url('assets/global/scripts/jquery.sumoselect.js')?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/css/sumoselect.css');?>">
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
<?php $this->load->view('Header_view');
$campaigndetails_array = (array)$campaigndetails['0'];
//print_r($campaign_products);
//print_r($productdetails);
//print_r($Selected_team);
//print_r($team);
 ?>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
  <!-- BEGIN PAGE HEAD -->
    <div class="container">
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
      <ul class="page-breadcrumb breadcrumb">
        <li>
          <a href="<?php echo base_url('Dashboard');?>">Home</a><i class="fa fa-circle"></i>
        </li>
        <li>
          Edit Campaign<i class="fa fa-circle"></i>
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
        <div class='panel-heading'> Edit Campaign Details
        </div>
        <div class='panel-body'>
        <?php echo $this->session->flashdata('msg');?>
         <div class="tab-content">
              <div id="createcampaign" class="tab-pane fade in active">
                 <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                     <?php     
                     
                     //print_r($campaigndetails_array);
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open('Displaycampaign/update/'.$campaigndetails_array['CampaignID'], $attributes); 
               // if($campaignid!=""){
                //print_r($campaignid);
              //}
              ?>
                      <div class="form-body">
                      <h4><strong>General:</strong></h4>
                       <div class="form-group">
                          <label class="col-md-3 control-label">Campaign Name<span class="required">*</span></label>
                          <div class="col-md-4">
                            <input type="text" class="form-control input-circle" placeholder="Enter text" name="campaignname"  id="campaignname" value="<?php echo $campaigndetails_array['CampaignName'];?>">
                            <span class="help-block"><?php echo form_error('campaignname'); ?> </span>
                          </div>
                        </div>
                          <div class="form-group">
                          <label class="col-md-3 control-label">Description<span class="required">*</span></label>
                          <div class="col-md-4">
                            <textarea name="description" rows="2" class="form-control input-circle" placeholder="Enter text"><?php echo $campaigndetails_array["Description"];?></textarea>
                            <span class="help-block"><?php echo form_error('description'); ?> </span>
                          </div>
                        </div>
                         <div class="form-group">
                          <label class="col-md-3 control-label">Owner<span class="required">*</span></label>
                          <div class="col-md-4">
                            <?php $options = array(  '0'  => 'Please Select');
                    
           if(!empty($owner)) {
                        foreach($owner as $owner) {        
                                $options[$owner->SystemUserID] = ucfirst($owner->UserName);        
                              }
                            }
                        echo form_dropdown('owner', $options, $campaigndetails_array['SystemUserID'] ,'class="form-control input-circle"');
                              
                            ?>
                            <span class="help-block"> <?php echo form_error('owner'); ?></span>
                          </div>
                        </div>
                            <div class="form-group">
                          <label class="col-md-3 control-label">Edit Campaign Team<span class="required">*</span></label>
                          <div class="col-md-4">
                            <?php 
                            $options = array(  '0'  => 'Please Select');
                        if(!empty($team)){
                          //print_r($team);
                        foreach($team as $team) {        
                                $options[$team->SystemUserID] = ucfirst($team->FirstName." ".$team->LastName);        
                              }
                            }
                        echo form_multiselect('team[]', $options, $Selected_team ,'class="form-control input-circle"');
                            ?>
                            <span class="help-block"> <?php echo form_error('team[]'); ?></span>
                          </div>
                        </div>
                                <div class="form-group">
                    <label class="control-label col-md-3">Products</label>
                    <div class="col-md-4">
                      <select id="select2_sample2" name="select2_sample2[]" class="form-control select2 input-circle" placeholder="Please select " multiple>
                      <?php 
                      $k=0;
                      //$count=0;
                      $categorylist_count = count($categorylist);
                      $product_details_count = count($productdetails);
                      $campaign_products_count = count($campaign_products);
                      for($i=0;$i<$categorylist_count;$i++)
                      { 
                        echo '<optgroup label="'.$categorylist[$i]["CategoryName"].'">';
                        
                          for($j=0;$j<$product_details_count;$j++)
                          {
                            if($productdetails[$j]["categoryid1"]==$categorylist[$i]["CategoryId"])
                            {
                              for($k=0;$k<$campaign_products_count;$k++)
                              {
                                if($productdetails[$j]["productid"]==$campaign_products[$k])
                                   {
                                    echo "<option value =".$productdetails[$j]["productid"]." selected>".$productdetails[$j]["productname"]."</option>";
                                  
                                   }                               
                              }
                              for($k=0;$k<$campaign_products_count;$k++){
                                if($productdetails[$j]["productid"]!=$campaign_products[$k])
                                  echo "<option value =".$productdetails[$j]["productid"].">".$productdetails[$j]["productname"]."</option>";                           
                                  break;
                              }
                              
                            }
                          }                           
                      }                                                 
                    ?>
                      </select>
                    </div>
                    <span class="help-block"> <?php echo form_error('select2_sample2[]'); ?></span>
                  </div>
                       <hr>
                       <h4><strong>Dates:</strong></h4>

                        <div class="form-group">
                    <label class="control-label col-md-3">Planned </label>
                    <div class="col-md-4">
                      <div class="input-group input-large date-picker input-daterange" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                       <?php 
                            $startdate = new DateTime($campaigndetails_array['StartDate']);
                            $s_date = $startdate->format('d-m-Y');
                            $enddate = new DateTime($campaigndetails_array['EndDate']);
                            $e_date = $enddate->format('d-m-Y');
                       ?>
                        <span class="input-group-addon">From</span>
                        <input type="text" class="form-control" name="datefrom" value="<?php echo $s_date;?>">
                        <span class="input-group-addon">  to </span>
                        <input type="text" class="form-control" name="dateto" value="<?php echo $e_date;?>">
                      </div>
                      <!-- /input-group -->
                      <span class="help-block">  <?php echo form_error('datefrom'); ?><?php echo form_error('dateto'); ?> </span>
                    </div>
                  </div>
                   <hr>
                   <h4><strong>Status:</strong></h4>
                   <div class="form-group">
                   <label class="col-md-3 control-label"></label>
                          <div class="radio-list">
                          <?php if($campaigndetails_array['Status']=="active"){?>
                      <label class="radio-inline">
                      <input type="radio" name="Status" id="Active" value="active" checked> Active </label>
                      <label class="radio-inline">
                      <input type="radio" name="Status" id="Inactive" value="inactive"> Inactive </label>
                      <?php } elseif ($campaigndetails_array['Status']=="inactive") {?>
                         <label class="radio-inline">
                      <input type="radio" name="Status" id="Active" value="active" > Active </label>
                      <label class="radio-inline">
                      <input type="radio" name="Status" id="Inactive" value="inactive" checked> Inactive </label>
                      <?php }?>
                  </div>
                     </div>
                        </div> 
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-circle blue">Submit</button>
                            <a href="<?php echo base_url('Displaycampaign');?>" class="btn btn-circle default">Cancel</a>
                          </div>
                        </div>
                      </div>
                    </form>
                    <!-- END FORM-->
                  </div>
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
ComponentsDropdowns.init();
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
<script src="<?php echo base_url('assets/admin/pages/scripts/components-dropdowns.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/bootstrap-select/bootstrap-select.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/global/plugins/select2/select2.min.js');?>"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>