<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>CRM | Create Contact </title> 
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
  input[readonly].default-cursor 
  {
    cursor: default;
    background-color: #fff;
  }
</style>
</head>
<body>
<?php  
$this->load->view('Header_view');?><br>
   <div class="container">
      <div class='panel panel-default'>
        <div class='panel-heading'>Create User </div>
        <div class='panel-body'>
        <?php echo $this->session->flashdata('msg');?>
         <div class="tab-content">
              <div id="createcampaign" class="tab-pane fade in active">
                 <div class="portlet-body form">
                <?php     
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open('User/createuser', $attributes); 
                $userrole = $userroleid;
                ?>

                      <div class="form-body">
                        <div class="form-group">
                          <label class="col-md-2 control-label">First Name<span class="required">*</span></label>
                          
                          <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Enter First Name" name="userfname"  id="userfname" value="<?php echo set_value('userfname');  ?>"  >
                           <span class="help-block"><?php echo form_error('userfname'); ?> </span>
                            <span class="help-block"><?php echo form_error('userlname'); ?> </span>
                           </div> 
                           <label class="col-md-2 control-label">Last Name<span class="required">*</span></label>
                           <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Enter Last Name" name="userlname"  id="userlname" value="<?php echo set_value('userlname');  ?>" onchange="displayusername()" >
                            </div>
                           <br>                     
                          </div>
                          <div class="form-group">
                          <label class="col-md-2 control-label">User Name<span class="required">*</span></label>
                          <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Enter User Name" name="username"  id="username"  value="<?php echo trim(set_value('username'))  ?>">
                            <span class="help-block"><?php echo form_error('username'); ?> </span>
                          </div>
                           <label class="col-md-2 control-label">Email<span class="required">*</span></label>
                          <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Enter Email Id" name="useremail"  id="useremail"  value="<?php echo set_value('useremail'); ?>">
                            <span class="help-block"><?php echo form_error('useremail'); ?> </span>
                          </div>
                        </div>    
                         <div class="form-group">                        
                          <label class="col-md-2 control-label">Phone<span class="required">*</span></label>
                          <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Enter phone number" name="userphone"  id="userphone" value="<?php echo set_value('userphone'); ?>" >
                            <span class="help-block"><?php echo form_error('userphone'); ?> </span>
                          </div>
                           <label class="col-md-2 control-label">Country</label>
                          <div class="col-md-3">
                            <?php 
                          $campaign_attributes = array( 'class'=>"form-control",
                                                        'onchange'=>'selectstate(this.options[this.selectedIndex].value)');

                         $options = array(  '0'  => '----Select----');   

                        if(!empty($country)) {
                        foreach($country as $country) {         
                                $options[$country->CountryId] = ucfirst($country->CountryName);
                          }
                        }
                        echo form_dropdown('Country', $options, set_value('Country') ,$campaign_attributes);
                        ?>
                            <span class="help-block"><?php echo form_error('Country'); ?> </span>
                          </div> 
                        </div>  
                            <div class="form-group">
                           <label class="col-md-2 control-label">State</label>
                          <div class="col-md-3">
                            <?php 
                          $campaign_attributes = array( 'class'=>"form-control",
                                                        'id'=>'State',
                                                         'onchange'=>'selectcity(this.options[this.selectedIndex].value)');

                         $options = array(  '0'  => '----Select----');  
                         if($flag=="1")
                         {
                          if(!empty($state)) {
                        foreach($state as $state) {         
                                $options[$state->StateId] = ucfirst($state->StateName);
                          }
                        }

                         }                  
                        echo form_dropdown('State', $options, set_value('State') ,$campaign_attributes);
                              
                            ?>
                            <span class="help-block"><?php echo form_error('State'); ?> </span>
                          </div>
                           <label class="col-md-2 control-label">City</label>
                          <div class="col-md-3">
                            <?php 
                          $campaign_attributes = array( 'class'=>'form-control',
                                                         'id'=>'City' );
 
                         $options = array(  '0'  => '----Select----');   
                          if($flag=="1")
                         {
                          if(!empty($city)) {
                        foreach($city as $city) {         
                                $options[$city->CityId] = ucfirst($city->CityName);
                          }
                        }

                         }                   
                        
                          echo form_dropdown('City', $options, set_value('City') ,$campaign_attributes);
                              
                            ?>
                            <span class="help-block"><?php echo form_error('City'); ?> </span>
                          </div>
                        </div>
                           <div class="form-group">                         
                          <label class="col-md-2 control-label">Address</label>
                          <div class="col-md-3">
                          <textarea row= "5" class="form-control" placeholder="Enter Address" name="useraddress"  id="useraddress" value="<?php echo set_value('useraddress'); ?>" ></textarea>
                            <span class="help-block"><?php echo form_error('useraddress'); ?> </span>
                          </div>
                           <label class="col-md-2 control-label ">Postal Code</label>
                          <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Enter Postal Code" name="userpostalcode" id="userpostalcode"  value="<?php echo set_value('userpostalcode');?>">
                            <span class="help-block"><?php echo form_error('userpostalcode'); ?> </span>
                          </div>
                        </div>
                           <div class="form-group">
                           <label class="col-md-2 control-label">Date of Birth</label>
                          <div class="col-md-3">
                           <input class="form-control form-control-inline input-medium date-picker default-cursor" data-date-format="dd-mm-yyyy" data-date-end-date="+0d" size="16" type="text" value="<?php echo set_value('userdob'); ?>" name='userdob' id="userdob"  readonly/>
                            <span class="help-block"><?php echo form_error('userdob'); ?> </span>
                          </div>
                          <label class="col-md-2 control-label">User Role<span class="required">*</span></label>
                          <div class="col-md-3">
                         <?php 
                          $campaign_attributes = array( 'class'=>"form-control",
                                                         'onchange'=>'displayreportinguser(this.options[this.selectedIndex].value)');

                        $options = array(  ''  => '----Select----');                    
                        if(!empty($userroleid)) {
                        foreach($userroleid as $userroleid) {         
                                $options[$userroleid->UserRoleID] = ucfirst($userroleid->UserRole);
                          }
                        }
                        echo form_dropdown('userrole', $options, set_value('userrole') ,$campaign_attributes);
                              
                            ?>
                            <span class="help-block"><?php echo form_error('userrole'); ?></span>
                          </div>
                        </div>
                         <div class="form-group">                        
                           <label class="col-md-2 control-label">Reporting To<span class="required">*</span></label>
                          <div class="col-md-3">
                           <?php $current_user_role = $this->session->userdata['logged_in']['user_role'];?>
                            <select id="reportinguser" name="reportinguser" class="bs-select form-control" placeholder="Please select">
                            <?php 
                           echo "<option value =''>----Select---</option>";
                           echo "<option value ='-1'>----None---</option>";

                           $userrole_count = count($userrole);
                           $reportinguser_count = count($reportinguserdetails);
                           for($i=0;$i<$userrole_count;$i++)
                           { 
                             if($userrole[$i]->UserRoleID>=$current_user_role && $userrole[$i]->UserRoleID<"3" )
                               {
                                 echo '<optgroup label="'.ucfirst($userrole[$i]->UserRole).'">';
                                   for($j=0;$j<$reportinguser_count;$j++)
                                   {
                                     if($reportinguserdetails[$j]->UserRoleID==$userrole[$i]->UserRoleID)
                                     {  
                                      echo "<option value =".$reportinguserdetails[$j]->SystemUserID.">".$reportinguserdetails[$j]->FirstName." ".$reportinguserdetails[$j]->LastName."</option>";
                                      
                                     }
                                   }
                                }                                               
                            }
                            ?>
                            </select>
                            <span class="help-block"><?php echo form_error('reportinguser'); ?></span>
                          </div>
                           <label class="col-md-2 control-label">Status<span class="required">*</span></label>
                          <div class="col-md-3">
                           <label class="radio-inline">
                           <input type="radio" name="userstatus" id="active" value="1" checked> Active &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio" name="userstatus" id="Inactive" value="0" > Inactive </label>                            
                            <span class="help-block"><?php echo form_error('userstatus'); ?> </span>
                          </div>
                        </div>
                        
                        <hr>
                        <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-circle blue" id="createuser">Create User</button>
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
<div class="page-footer">
  <div class="container">
     2016 &copy; Lurningo CRM. <a href="#" target="_blank"></a>
  </div>
</div>
<div class="scroll-to-top">
  <i class="icon-arrow-up"></i>
</div>
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
<script type="text/javascript">
function displayusername()
{
  userfname = document.getElementById('userfname').value;
  userlname = document.getElementById('userlname').value;
  document.getElementById('username').value=(userfname.toLowerCase()).trim()+"."+(userlname.toLowerCase()).trim();
  //alert(document.getElementById('username').value);
}
function displayreportinguser(userrole)
{
     //alert(userrole);
     url = '<?php echo base_url()."User/get_reportinguser/'+userrole+'";?>';
     $.ajax({
            type: 'POST',
            url: url,
            data: {userrole: userrole},
            success: function(response)
            {
              //alert(respons_e);
               $('#reportinguser').html(response);

            }
        });
  }
  function selectstate(country)
  {
  
     url = '<?php echo base_url()."User/getstate/'+country+'";?>';
     $.ajax({
            type: 'POST',
            url: url,
            data: {countryid: country},
            success: function(response) {
              //alert(respons_e);
               $('#State').html(response);

            }
        });
  }
   function selectcity(state)
  {

  
     url = '<?php echo base_url()."User/getcity/'+state+'";?>';
     $.ajax({
            type: 'POST',
            url: url,
            data: {stateid: state},
            success: function(response) {
              //alert(respons_e);
               $('#City').html(response);

            }
        });
  }
</script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>