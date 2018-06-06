<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>CRM | Edit user </title> 
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
$this->load->view('Header_view');?><br>
<div class="container">
        <div class='panel panel-default'>
        <div class='panel-heading'>Edit User</div>
        <div class='panel-body'>
        <?php echo $this->session->flashdata('msg');?>
         <!-- BEGIN FORM-->
                     <?php     
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open('User/updateuser'.'/'.$id.'',$attributes);
                // if($campaignid!=""){
                //print_r($campaignid);
                $userrole = $userroleid;
                $array = (array) $agentdetails['0'];
               // print_r($array);?>
                
                     
              
                      <div class="form-body">
                        <div class="form-group">
                          <label class="col-md-2 control-label">First Name<span class="required">*</span></label>                          
                          <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Enter First Name" name="userfname"  id="userfname" value="<?php echo trim($array['FirstName']);  ?>"  >
                           <span class="help-block"><?php echo form_error('userfname'); ?> </span>
                            <span class="help-block"><?php echo form_error('userlname'); ?> </span>
                           </div> 
                           <label class="col-md-2 control-label">Last Name<span class="required">*</span></label>
                           <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Enter Last Name" name="userlname"  id="userlname" value="<?php echo trim($array['LastName']);  ?>" >
                           </div>
                           <br>                     
                          </div>

                          <div class="form-group">
                          <label class="col-md-2 control-label">User Name<span class="required">*</span></label>
                          <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Enter User Name" name="username"  id="username"  value="<?php echo trim($array['UserName']);  ?>">
                            <span class="help-block"><?php echo form_error('username'); ?> </span>
                          </div>
                           <label class="col-md-2 control-label">Email<span class="required">*</span></label>
                          <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Enter Email Id" name="useremail"  id="useremail"  value="<?php echo trim($array['EmailId']); ?>">
                            <span class="help-block"><?php echo form_error('useremail'); ?> </span>
                          </div>
                        </div> 
                         <div class="form-group">                        
                          <label class="col-md-2 control-label">Phone<span class="required">*</span></label>
                          <div class="col-md-3">
                            <input type="text" class="form-control " placeholder="Enter phonenumber" name="userphone"  id="userphone" value="<?php echo trim($array['MobileNo']); ?>" >
                            <span class="help-block"><?php echo form_error('userphone'); ?> </span>
                          </div>
                           <label class="col-md-2 control-label">Country<span class="required">*</span></label>
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
                        echo form_dropdown('Country', $options, $array['Country'] ,$campaign_attributes);
                              
                            ?>
                            <span class="help-block"><?php echo form_error('Country'); ?> </span>
                          </div> 
                        </div>  

                         <div class="form-group">
                           <label class="col-md-2 control-label">State<span class="required">*</span></label>
                          <div class="col-md-3">
                            <?php 
                          $campaign_attributes = array( 'class'=>"form-control",
                                                        'id'=>'State',
                                                         'onchange'=>'selectcity(this.options[this.selectedIndex].value)');

                         $options = array(  '0'  => '----Select----');  
                         if(!empty($state)) {
                        foreach($state as $state) {         
                                $options[$state->StateId] = ucfirst($state->StateName);
                          }
                        }                  
                        echo form_dropdown('State', $options, $array['State'] ,$campaign_attributes);
                              
                            ?>
                            <span class="help-block"><?php echo form_error('State'); ?> </span>
                          </div>
                           <label class="col-md-2 control-label">City<span class="required">*</span></label>
                          <div class="col-md-3">
                            <?php 
                          $campaign_attributes = array( 'class'=>'form-control input-circle',
                                                         'id'=>'City' );

                         $options = array(  '0'  => '----Select----');    
                           if(!empty($city)) {
                        foreach($city as $city) {         
                                $options[$city->CityId] = ucfirst($city->CityName);
                          }
                        }                  
                        echo form_dropdown('City', $options, $array['City'] ,$campaign_attributes);
                              
                            ?>
                            <span class="help-block"><?php echo form_error('City'); ?> </span>
                          </div>
                        </div>
                         <div class="form-group">                         
                          <label class="col-md-2 control-label">Address<span class="required">*</span></label>
                          <div class="col-md-3">
                          <textarea row= "5" class="form-control" placeholder="Enter address" name="useraddress"  id="useraddress"><?php echo $array['Address']; ?></textarea>
                            <span class="help-block"><?php echo form_error('useraddress'); ?> </span>
                          </div>
                           <label class="col-md-2 control-label">Postal Code<span class="required">*</span></label>
                          <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Enter Postal Code" name="userpostalcode"  id="userpostalcode"  value="<?php echo $array['PostalCode']; ?>">
                            <span class="help-block"><?php echo form_error('userpostalcode'); ?> </span>
                          </div>
                        </div>
                        <?php  $startdate = new DateTime($array['DOB']);
                                $s_date = $startdate->format('d-m-Y');?>
                          <div class="form-group">
                             <label class="col-md-2 control-label">Date of Birth<span class="required">*</span></label>
                          <div class="col-md-3">
                           <input class="form-control input-medium date-picker default-cursor" data-date-format="dd-mm-yyyy" data-date-end-date="+0d" size="16" type="text" value="<?php echo $s_date; ?>" name='userdob' id="userdob"  readonly/>
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
                        echo form_dropdown('userrole', $options, $array['UserRoleID'] ,$campaign_attributes);
                         ?>
                            <span class="help-block"><?php echo form_error('userrole'); ?></span>
                          </div>
                        </div>

                         <div class="form-group">                        
                           <label class="col-md-2 control-label">Reporting To</label>
                          <div class="col-md-3">
                           <?php $current_user_role = $this->session->userdata['logged_in']['user_role'];?>
                            <select id="reportinguser" name="reportinguser" class="bs-select form-control" placeholder="Please select">
                     <?php 
                           
                           
                           if($array['ReportingTo']=="" && $array['UserRoleID']=="1")
                           {
                            echo "<option value =''>----Select---</option>";
                            echo "<option value ='-1' selected>----None---</option>";
                           }                            
                           else
                           {
                             {
                               $current_user_role = $this->session->userdata['logged_in']['user_role'];
                               $userrole=$this->Usermodel->get_user_role();
                               $reportinguserdetails=$this->Usermodel->get_reportinguser();
                               $HTML .= "<option value =''>----Select---</option>";
                               $HTML .= "<option value ='-1'>----None---</option>";      
                               $userrole_count = count($userrole);
                              $reportinguser_count = count($reportinguserdetails);
                         for($i=0;$i<$userrole_count;$i++)
                    { 
                      if($userrole[$i]->UserRoleID>=$current_user_role && $userrole[$i]->UserRoleID<$userroleid && $userrole[$i]->UserRoleID<"3")
                        {
                          $HTML .= '<optgroup label="'.ucfirst($userrole[$i]->UserRole).'">';
                          for($j=0;$j<$reportinguser_count;$j++)
                          {
                           if($reportinguserdetails[$j]->UserRoleID==$userrole[$i]->UserRoleID)
                            {  
                              $HTML .= "<option value =".$reportinguserdetails[$j]->SystemUserID.">".$reportinguserdetails[$j]->FirstName." ".$reportinguserdetails[$j]->LastName."</option>";
                            }
                          }
                        }                                               
                     }
                   echo $HTML;    
         }

                           }

                       
                            ?>
                            </select>
                            <span class="help-block"><?php echo form_error('reportinguser'); ?></span>
                          </div>
                              <label class="col-md-2 control-label">Status<span class="required">*</span></label>
                          <div class="col-md-3">
                           <label class="radio-inline">
                           <?php  if($array['IsActive']=="1"){
                            echo '<input type="radio" name="userstatus" id="userstatus" value="1" checked> Active &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio" name="userstatus" id="userstatus" value="0"> Inactive </label>';
                           }else
                           {
                           echo '<input type="radio" name="userstatus" id="userstatus" value="1" > Active &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input type="radio" name="userstatus" id="userstatus" value="0" checked> Inactive </label>';

                            } ?>
                            <span class="help-block"><?php echo form_error('userstatus'); ?> </span>
                          </div>
                        </div>
                        
                        
                        <hr>
                        <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn blue" id="createuser">Update User</button>
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
//Metronic.init(); // init metronic core components
//Layout.init(); // init current layout
//Demo.init(); // init demo features
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
  document.getElementById('username').value=userfname.trim()+"."+userlname.trim();
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
