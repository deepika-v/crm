    <!DOCTYPE html>

    <!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
    <!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD --> 
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
        </head>
    <style type="text/css">
    .fa-lg:not(.fa-stack), .icon-lg {
        font-size: 32px !important;    
    }
    </style>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
    <!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
    <body>
    <!-- BEGIN HEADER -->
    <?php 
     //print_r($agentjson_array); 
    $this->load->view('Header_view');  ?>
    <!-- END HEADER -->
    <!-- BEGIN PAGE CONTAINER -->
    <div class="page-container">
      <!-- BEGIN PAGE HEAD -->
        <div class="container">
          <!-- BEGIN PAGE TITLE -->
          <div class="page-title">
              <ul class="page-breadcrumb breadcrumb">
                <li><a href="<?php echo base_url('Dashboard');?>" class="linkcss">Home</a><i class="fa fa-circle"></i></li>
                <li>Assign Leads<i class="fa fa-circle"></i></li>
              </ul>
          </div>
          <!-- END PAGE TITLE -->
        </div>  
      <!-- END PAGE HEAD -->
      <!-- BEGIN PAGE CONTENT -->
      <div class="page-content">
        <div class="container">
              <div class="modal fade" id="modalview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                          <h4 class="modal-title" id="modaltitle"></h4>
                                      </div>
                                      <div class="modal-body" id="messagebody">
                                          
                                      </div>
                                      <div class="modal-footer">
                                             <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                      </div>
                                  </div>
                                  <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
              </div>
          <!-- BEGIN PAGE CONTENT INNER -->
          <div class="row">
            <div class="col-md-12">
              <div class='panel panel-default'>
                 <div class='panel-heading'><h4>Assign Leads</h4></div>            
                 <div class='panel-body'>
                   <div id="alertmessage"></div>
                       <?php echo $this->session->flashdata('msg');
                           //print_r($agentdetails);?>
                          <div class="tab-content">
                            <div id="assignleads" class="tab-pane fade in active">
                             <!-- BEGIN PAGE CONTENT INNER -->
                            <div class="row">
                                 <div class="col-md-12">
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                       <div class="portlet-body form">
                                   <!-- BEGIN FORM-->               
                                           <form action="#" class='form-horizontal' method="post" id="leadassignmentform" name="leadassignmentform" >
                                                    <div class="form-body">
                                                       <div class="form-group"> 
                                                           <div class="row">
                                                             <div class="col-md-1"></div>
                                                               <div class="col-md-3">
                                                                  <div class="col-md-4">
                                                                      <label class="control-label col-md-04"><strong style="font-size:14px;">Campaign<span class="required">*</span></strong></label>
                                                                  </div>
                                                                   <div class="col-md-8">
                                                                   <?php 
                                                                        $campaign_attributes = array( 'class'=>"form-control input-circle",
                                                                                                       'style'=>"width:200px;", 
                                                                                                       'onchange'=>"hidedisplaysearch()",
                                                                                                       'id'=> "campaignID");
                                                                        $options = array(  '0'  => '--Select--' );
                                                                        if(!empty($campaigndetails))
                                                                          {
                                                                              foreach($campaigndetails as $campaigndetails)
                                                                                  $options[$campaigndetails->CampaignID] = ucfirst($campaigndetails->CampaignName);
                                                                          }
                                                                          echo form_dropdown('campaignID', $options, set_value('campaignID') ,$campaign_attributes);
                                                                    ?>
                                                                    </div>
                                                                    <span class="help-block"><?php echo form_error('campaignID'); ?> </span>
                                                                  </div>
                                                               <div class="col-md-7">
                                                                    <label class="col-md-4 control-label"><strong style="font-size:14px;">Contact Type<span class="required">*</span></strong></label>
                                                                    <div class="col-md-8">
                                                                       <div class="btn-group" data-toggle="buttons">
                                                                              <label class="btn btn-default active" onclick="hidedisplaysearch()">
                                                                                    <input type="radio" name="Contacttype" id="all" value="0"<?php if(set_value('Status')=='0'){ ?> checked=checked <?php } ?>  checked="true">All
                                                                              </label>
                                                                              <label class="btn btn-default" onclick="hidedisplaysearch()">
                                                                                     <input type="radio" name="Contacttype" id="Active" value="L" <?php if(set_value('Contacttype')=='lead'){ ?> checked=checked <?php } ?>>Lead
                                                                              </label>
                                                                              <label class="btn btn-default" onclick="hidedisplaysearch()">
                                                                                      <input type="radio" name="Contacttype" id="Inactive" value="P" <?php if(set_value('Contacttype')=='prospect'){ ?> checked=checked <?php } ?>>Prospect</label>
                                                                             <span class="help-block"><?php echo form_error('Contacttype'); ?> </span>
                                                                       </div>
                                                                    </div>
                                                               </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="form-group"> 
                                                              <div class="row">
                                                                    <div class="col-md-1"> </div>
                                                                    <div class="col-md-5">
                                                                          <div class="col-md-2">
                                                                                <label class="control-label"><strong style="font-size:14px;">Display<span class="required">*</span></strong></label>
                                                                          </div>
                                                                          <div class="col-md-10">
                                                                              <div class="btn-group" data-toggle="buttons">
                                                                                    <label class="btn btn-default active" onclick="hideassignedleads()" >                      
                                                                                            <input type="radio" name="Status" id="all" value="0"<?php if(set_value('Status')=='0'){ ?> checked=checked <?php } ?> onclick="hideassignedleads()" checked="true">All
                                                                                    </label>
                                                                                    <label class="btn btn-default" onclick="displayassignedleads()">
                                                                                            <input type="radio" name="Status" id="assigned" value="A" <?php if(set_value('Status')=='assigned'){ ?> checked=checked <?php } ?> >Assigned
                                                                                    </label>
                                                                                    <label class="btn btn-default" onclick="hideassignedleads()">                      
                                                                                              <input type="radio" name="Status" id="unassigned" value="U"<?php if(set_value('Status')=='unassigned'){ ?> checked=checked <?php } ?> >Unassigned
                                                                                    </label>
                                                                                    <span class="help-block"><?php echo form_error('Status'); ?> </span>
                                                                          </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4" id="assignlead">
                                                                          <div class="col-md-6">
                                                                                <label class="control-label col-md-04"><strong style="font-size:14px;">Leads Assigned To<span class="required">*</span></strong></label>
                                                                          </div>
                                                                           <div class="col-md-6">
                                                                                <?php $current_user_role = $this->session->userdata['logged_in']['user_role'];?>
                                                                                <select id="AgentID" name="AgentID" class="bs-select form-control input-circle" style="width:200px;" placeholder="Please select" onchange="hidedisplaysearch()">
                                                                                <?php 
                                                                                        echo "<option value =''>----Select---</option>";
                                                                                        echo "<option value ='0'>All</option>";
                                                                                        $userrole_count = count($userroleid);
                                                                                        $agentdetails_count = count($agentdetails);
                                                                                        for($i=0;$i<$userrole_count;$i++)
                                                                                        { 
                                                                                          if($userroleid[$i]->UserRoleID>=$current_user_role)
                                                                                          {
                                                                                             echo '<optgroup label="'.ucfirst($userroleid[$i]->UserRole).'">';
                                                                                                           for($j=0;$j<$agentdetails_count;$j++)
                                                                                            {
                                                                                              if($agentdetails[$j]->UserRoleID==$userroleid[$i]->UserRoleID)
                                                                                              echo "<option value =".$agentdetails[$j]->SystemUserID.">".$agentdetails[$j]->FirstName." ".$agentdetails[$j]->LastName."</option>";
                                                                                            }
                                                                                          }                                               
                                                                                        }
                                                                                  ?>
                                                                                </select>
                                                                            </div>
                                                                      <span class="help-block"><?php echo form_error('AgentID'); ?> </span>
                                                                    </div>
                                                              </div>
                                                               <div class="row">
                                                                     <div class="col-md-12" align="center">
                                                                            <input type="button" class="btn btn-circle blue " style="margin-left:200px;" onclick="displayagenttable();" value="Search" />
                                                                      </div>
                                                                </div>
                                                            </div>
                                                      </form>   
                                                      <div id="classdata"></div>     
     <?php     
                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open('Leadassignment/assignleads', $attributes); 
                  ?>
            <div id="displayonsearch">       
             </div>               
                   
                  <!-- END EXAMPLE TABLE PORTLET-->
               <div id="assignagentdiv" class="form-group">
               

           <div class="row">
              <div class="col-md-5">
                      <div class="col-md-4">
                         <label class="control-label col-md-04"><strong style="font-size:14px;">Select Agent<span class="required">*</span></strong></label>
                      </div>
                  <div class="col-md-8">

                   <?php $current_user_role = $this->session->userdata['logged_in']['user_role'];?>

                   <select id="AssignID" name="AssignID" class="bs-select form-control input-circle" style="width:200px;" placeholder="Please select ">
                          <?php 
                          if(!empty($assigndetails))
                           {


                          $userrole_count = count($userroleid);
                          $assigndetails_count = count($assigndetails);
                          for($i=0;$i<$userrole_count;$i++)
                          { 
                            if($userroleid[$i]->UserRoleID>=$current_user_role)
                            {
                               echo '<optgroup label="'.ucfirst($userroleid[$i]->UserRole).'">';
                            
                              for($j=0;$j<$assigndetails_count;$j++)
                              {
                                if($assigndetails[$j]->UserRoleID==$userroleid[$i]->UserRoleID)
                                echo "<option value =".$assigndetails[$j]->SystemUserID.">".$assigndetails[$j]->FirstName." ".$assigndetails[$j]->LastName."</option>";
                              }

                            }
                                                   
                          }

                          }
                          else{
                            echo "<option value='0'>---Select---</option>";
                          }
                           

                          
                          ?>
                          </select>
                          <?php 
                              /*$assign_attributes = array( 'class'=>"form-control input-circle",
                                                             'style'=>"width:200px;", 
                                                             'id'=> "AssignID"
                                                            
                                );
                        $options = array(  '0'  => '--Select--');
                             if(!empty($assigndetails)) {
                            foreach($assigndetails as $assigndetails) {        
                                    $options[$assigndetails->SystemUserID] = ucfirst($assigndetails->FirstName." ".$assigndetails->LastName);
                              }
                            }
                       echo form_dropdown('AssignID', $options, set_value('AssignID') ,$assign_attributes);*/
                      ?>
                      </div>
                      <span class="help-block"><?php echo form_error('AssignID'); ?> </span>
                      </div>
                        <div class="col-md-5" >                    
                         <input type="button" id="assignselectedcontacts" class="btn btn-circle blue " onclick="assignleads_contacts('1');" value="Assign Selected Contacts" />
                         <input type="button" id="assignallcontacts" class="btn btn-circle blue " onclick="assignleads_contacts('2');" value="Assign All Contacts" />
                         
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
    <?php
    if($flag=="0"){
                          echo '<script type="text/javascript">document.getElementById("assignlead").style.display="block";</script>';

                        } else{
                          echo '<script type="text/javascript">document.getElementById("assignlead").style.display="none";
                               document.getElementById("assigned").checked="false";
                               document.getElementById("unassigned").checked="true";
                          </script>';                      
                        }
     ?>
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



<script type="text/javascript">
$(document).ajaxStart(function(){
    $('#loading').show();
 }).ajaxStop(function(){
    $('#loading').hide();
 });
 function hidedisplaysearch()
 {
   if(document.getElementById('displayonsearch').style.display == 'block')
   {
        document.getElementById('displayonsearch').style.display = 'none';
        document.getElementById('assignagentdiv').style.display = 'none';
   }
    

 }
  function displayagenttable()
  {
        //alert("in function");
        document.getElementById('displayonsearch').style.display = 'none';
        document.getElementById('classdata').style.display = 'none';
        document.getElementById('assignagentdiv').style.display = 'none';
        var e = document.getElementById("campaignID");
        var campaignID = e.options[e.selectedIndex].value;
        var text = e.options[e.selectedIndex].text;
        //alert(campaignID); 
        var contact_type = "";
        var radios = document.getElementsByName('Contacttype');
        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                contact_type =radios[i].value;
                break;
            }
        } 
        //alert(contact_type);
        var lead_status  = "";
        var radios1 = document.getElementsByName('Status');
        length = radios1.length;
        for (var i = 0;  i < length; i++) {
            if (radios1[i].checked) {
                    lead_status =radios1[i].value;
                break;
            }
        } 
        var e = document.getElementById("AgentID");
        var agent_id = e.options[e.selectedIndex].value;
        var text = e.options[e.selectedIndex].text;
        //alert(lead_status);
        var error = "";
        if(campaignID=="0") error += "Select Campaign<br>";
        if(agent_id=="" && lead_status=="A")  error += "Select Agent<br>";        
         if(error != ""){
          $("#messagebody").html(error);
                    jQuery("#modalview").modal('show'); 
         }
      else
      {  
        if(lead_status!="A" ) agent_id="0";
        url = '<?php echo base_url()."Leadassignment/Search/";?>';
        document.getElementById('classdata').style.display = 'block';
        document.getElementById('classdata').innerHTML="<img src='<?php echo base_url('assets/images/142.gif');?>'><h4>Loading....</h4> ";
        //alert(url);
        $.ajax({
            type: 'POST',
            url: url,
            data: {agentid: agent_id, campaignid: campaignID, contacttype: contact_type, leadstatus: lead_status},
            success: function(response)
             {            //alert(response);
                document.getElementById('classdata').style.display = 'none';
                if(response=="0")
                {
                  document.getElementById('displayonsearch').style.display = 'block';
                  var textdata =  ' <table class="table table-striped table-bordered table-hover" id="sample_1">'+
                      '<thead>'+
                      '<tr>'+
                       '<th class="table-checkbox"><input type="checkbox" class="group-checkable" value="0" id ="select_all" name="chk[]" data-set="#sample_1 .checkboxes" checked/>'+                
                        '</th>'+
                        '<th> Candidate Name </th>'+
                        '<th>Email</th>'+
                        '<th>Phone No.</th>'+
                        '<th>State </th>'+
                         '</tr>'+
                      '</thead>'+
                      '<tbody><tr><td colspan="5" align=center>No records available</td></tr>';
                       document.getElementById('displayonsearch').innerHTML = textdata;
                        $("#assignagentdiv").hide();            
                }
                else
                {
                    document.getElementById('classdata').style.display = 'none';
                    document.getElementById('displayonsearch').style.display = 'block';
                    document.getElementById('displayonsearch').innerHTML = response;
                      $.fn.dataTable.ext.errMode = 'none';
                    $("#sample_1").DataTable(
                    {
                      "pageLength": 50,
                       "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]]//,
                      //"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 1 ] } ] 

                    });
                    $('#select_all').click(function(event)
                     {
                       if (this.checked) 
                        {
                          // Iterate each checkbox
                          $(':checkbox').each(function()
                           {
                              this.checked = true;
                           });
                        }
                        else
                        {
                          $(':checkbox').each(function()
                           {
                              this.checked = false;
                           });
                        }
                     }); 
                      //alert(response);
                   var rowCount = $('#sample_1').rowCount();  
                   //alert(rowCount);
                   displayassign_agent(agent_id);
                   $("#assignagentdiv").show();
                }
            }
        });
      }
   }
    $.fn.rowCount = function() {
        return $('tr', $(this).find('tbody')).length;
    };
    function displaymodal(campaignID, assignedID,contactsID){
        url = '<?php echo base_url()."Leadassignment/display_assignment_details/'+campaignID+'/'+assignedID+'/'+contactsID+'";?>';
      //alert(url);
     $.ajax({
            type: 'POST',
            url: url,
            data: {campaignID: campaignID},
            success: function(response) {
            $("#modaltitle").html("<i class='fa fa-info-circle fa-lg big-icon'  aria-hidden='true'></i>&nbsp;&nbsp; Assignment Log");  
           $("#messagebody").html(response);
        jQuery("#modalview").modal('show');                       
          }
        });
    }
    function hideassignedleads()
    {
      document.getElementById('assignlead').style.display="none";
      hidedisplaysearch();
    } 
     function displayassignedleads()
     {
      document.getElementById('assignlead').style.display="block";
      hidedisplaysearch();
     } 
    function assignleads_contacts(assign_details)
    {
      //alert("in assignlead");
        var e = document.getElementById("campaignID");
        var campaignID = e.options[e.selectedIndex].value;
        var text = e.options[e.selectedIndex].text;
        //alert(campaignID); 
        var contact_type = "";
        var radios = document.getElementsByName('Contacttype');

        for (var i = 0, length = radios.length; i < length; i++)
         {
            if (radios[i].checked)
             {
                // do whatever you want with the checked radio
                contact_type =radios[i].value;

                // only one radio can be logically checked, don't check the rest
                break;
            }
         } 
        //alert(contact_type);
        var lead_status  = "";
        var radios1 = document.getElementsByName('Status');
        for (var i = 0, length = radios1.length; i < length; i++)
        {
            if (radios1[i].checked)
             {
                // do whatever you want with the checked radio
                lead_status =radios1[i].value;

                // only one radio can be logically checked, don't check the rest
                break;
              }
        } 
        var e = document.getElementById("AgentID");
        var agent_id = e.options[e.selectedIndex].value;
        var text = e.options[e.selectedIndex].text;

        //alert(agent_id);

      
        //alert(assign_details);
        var e = document.getElementById("AssignID");
        var assign_id = e.options[e.selectedIndex].value;
        var text = e.options[e.selectedIndex].text;
        //alert(assign_id);
        var data1 = new Array();
        $("input[name='chk[]']:checked").each(function(i)
         {
            data1.push($(this).val());
         });
        //alert(data1);
          var error = "";
        if(campaignID=="0" && lead_status=="A" && agent_id=="0" ){
               error += "Select Campaign \n Select Agent";
               //alert(error);
                $("#messagebody").html(error);
                    jQuery("#modalview").modal('show');
        }
        else if(campaignID=="0"&& lead_status=="U"){
          error += "Select Campaign";
          //alert(error);
           $("#messagebody").html(error);
                    jQuery("#modalview").modal('show');
          }
          else if(assign_id =="0"){
          error += "Select agent to assign leads";
           $("#messagebody").html(error);
                    jQuery("#modalview").modal('show');
          //alert(error);
          }
          else if(data1 =="0" || data1=="")
          {
          error += "Select Contacts to assign";
           $("#messagebody").html(error);
                    jQuery("#modalview").modal('show');
          //alert(error);
          }
          else {  
            url = '<?php echo base_url()."Leadassignment/assignleads/";?>';
            if(assign_details=="1"){
               document.getElementById('assignselectedcontacts').value="Loading.... ";
               $('#assignallcontacts').attr("disabled", true);
               $('#assignselectedcontacts').attr("disabled", true);
            }
            else{
              document.getElementById('assignallcontacts').value="Loading.... ";
               $('#assignselectedcontacts').attr("disabled", true);
               $('#assignallcontacts').attr("disabled", true);
            }           
           $.ajax({
                type: 'POST',
                url: url,
                data: {agentid: agent_id, campaignid: campaignID, contacttype: contact_type, leadstatus: lead_status, assigndetails: assign_details, assignid: assign_id, contacts:data1},
                success: function(response)
                     {   //alert(response);  
                      $("#alertmessage").html(response);
                        $('#assignallcontacts').attr("disabled", false);
                        $('#assignselectedcontacts').attr("disabled", false);
                        document.getElementById('assignselectedcontacts').value="Assign Selected Contacts";
                        document.getElementById('assignallcontacts').value="Assign All Contacts";
                        document.getElementById('displayonsearch').style.display="none";
                        document.getElementById('assignagentdiv').style.display="none";
                      }
                  });
                }
      }
    //$(".btn-group button").click(function () {
      //  $("#buttonvalue").val($(this).val());
    //});
 function displayassign_agent(agent_id){
  //alert(agent_id);
  url = '<?php echo base_url()."Leadassignment/get_assign_agent/'+agent_id+'";?>';
  //alert(url);
 $.ajax({
        type: 'POST',
        url: url,
        data: {agentid: agent_id},
        success: function(response) {
        
$('#AssignID').html(response);

            
          //alert(response);
                       
        }
    });
}
    </script>
    <script>
    jQuery(document).ready(function() {  

       //TableManaged.init();
       $("#draggable").draggable({
          handle: ".modal-header"
      });
       $("#assignlead").hide();
       //$("#displayonsearch").hide();
       $("#assignagentdiv").hide();
    });

    </script>

    </body>
    <!-- END BODY -->
    </html>