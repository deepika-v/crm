    <!DOCTYPE html>
    <html>
    <head>
      <title>Lurningo | Leads Managment</title>
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
    <body>
      <?php $this->load->view('Header_view'); ?>
      <div class="container">
        <center>
          <h2 class="text-success center">My Leads</h2> 
        </center>
          <h4>Total leads count: <?= $count; ?></h4>
          <div id="alertmessage"></div>
          <?php echo $this->session->flashdata('msg');?>
        <div class="form-group">
          <div class="col-sm-3 col-md-3">
            <form method="post" action="<?= base_url();?>Agent/index">
            
               <select id="myleads" name="myleads" class="form-control" onchange="this.form.submit()">
                <option value="" selected="selected">All Leads</option>
                <option value="1" <?php if(@$this->input->post('myleads') == '1') { echo 'selected = \"selected\"'; } ?>>Today's Follow Ups</option>
                <option value="2" <?php if(@$this->input->post('myleads') == '2') { echo 'selected = \"selected\"'; } ?>>Active Leads</option>
                <option value="3" <?php if(@$this->input->post('myleads') == '3') { echo 'selected = \"selected\"'; } ?>>Fresh Leads</option>
                <option value="4" <?php if(@$this->input->post('myleads') == '4') { echo 'selected = \"selected\"'; } ?>>Closed Leads</option>
                <option value="5" <?php if(@$this->input->post('myleads') == '5') { echo 'selected = \"selected\"'; } ?>>Dropped Leads</option>
              </select> 
          </div>
           
        <div class="col-sm-3 col-md-3">
           <select id="campaign" name="campaign" class="form-control" onchange="this.form.submit()">
              <option value="" disabled selected hidden>All Campaigns</option> 
              <?php
                foreach ($campaign_list as $row) {
              ?>
              <?php
              echo "<option value=\"".$row->CampaignID."\"";
                if($this->input->post('campaign') == $row->CampaignID)
                      echo 'selected';
                echo ">".$row->CampaignName."</option>";   
                }
              ?>
               <option value="">All Campaign</option> 
            </select>  
           </form>
            
          </div>
           <div class="col-md-3"> 
              <?php
                $startdate = @$campaign_details->StartDate;
                if ($startdate != ''){
              ?> 
                <?= word_limiter($campaign_details->Description,10);
                 ?><a data-toggle="modal" data-target="#myModal5">..view more</a><br>
                 <!-- Modal -->
                  <div class="modal fade" id="myModal5" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Title : <?= $campaign_details->CampaignName;?></h4>
                        </div>
                        <div class="modal-body">
                          <p><?= $campaign_details->Description; ?></p>
                          <p> <?= "From:" .@date('d/m/Y',strtotime($campaign_details->StartDate)); ?></p>
                            <?= "To:" .@date('d/m/Y',strtotime($campaign_details->EndDate)); ?>  
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>


                <?= "From:" .@date('d/m/Y',strtotime($campaign_details->StartDate)); ?>
                <?= "To:" .@date('d/m/Y',strtotime($campaign_details->EndDate)); ?>  
                <?php
                  }
                ?>
          </div>
        </div>  
 <?php //echo print_r($myleads);?>
          
        <div class="row" style="margin-top:50px">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
              <thead>
                <tr>
                  <th class="table-checkbox"><input type="checkbox" class="group-checkable" value="0" id ="select_all" name="chk[]" data-set="#sample_1 .checkboxes" checked/>                
                </th>
                 <?php if((@$this->input->post('myleads') == '4'))
                 {
                  echo "<th>Campaign</th>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Closed On</th>
                      <th>Remarks</th>
                      <th>Order ID</th>";                      
                  }elseif (@$this->input->post('myleads') == '5')
                 {
                  echo "<th>Campaign</th>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Dropped On</th>
                      <th>Remarks</th>";
                }else{
                  echo "<th>Campaign</th>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Update Status</th>
                      <th>Discount Coupon</th>";
                 }?>
                </tr>
              </thead>
              <tbody>
                <?php
                  if ($count >0){
                  foreach ($myleads as $row) {
                    //print_r($myleads);
                ?> <tr>
                    <td><input type='checkbox' class='checkboxes' name='chk[]' checked value='"<?= $row->CampaignContactID;?>"'/></td>
                    <td><?= $row->CampaignName; ?></td>
                    <?php if(strtolower($row->LastName)=="null")$row->LastName="";?>
                    <td><?= ucfirst($row->FirstName." ".$row->LastName);?></td>
                    <td><?= $row->Phone; ?></td>
                    <td><?= $row->Email; ?></td>
                    <?php if((@$this->input->post('myleads') == '') && ($row->Status=="4"|| $row->Status=="5"))
                    {?>
                    <td><?= ucfirst($row->LeadStatus); ?></td>
                    <td><a href="" class="btn btn-default btn-small" id="custId" data-toggle="modal" data-id="<?= $row->CampaignContactID; ?>" disabled="true">Update</a></td>
                    <td><a href=""  class="btn btn-default btn-small" id="custId"  data-toggle="modal" data-id="<?= $row->CampaignContactID; ?>" disabled="true">Generate Coupon</a></td>
                    <?php }elseif ((@$this->input->post('myleads') != '') && ($row->Status=="4")) {
                      $date1 = new DateTime($row->FollowupDate);
                     $followupdate = $date1->format("d-m-Y"); 
                    ?>
                    <td><?= ucfirst($row->LeadStatus); ?></td>
                    <td><?= ucfirst($followupdate); ?></td>
                    <td><?= ucfirst($row->Remarks); ?></td>
                    <td><?= $row->OrderID; ?></td>
                    
                    <?php }elseif ((@$this->input->post('myleads') != '') && ($row->Status=="5")) {
                        $date1 = new DateTime($row->FollowupDate);
                        $followupdate = $date1->format("d-m-Y"); 
                      ?>
                    <td><?= ucfirst($followupdate); ?></td>
                    <td><?= $row->Remarks." <br>".$row->DropReason; ?></td>
                    <?php }else
                    {?>
                    <td><?= ucfirst($row->LeadStatus); ?></td>
                    <td><a href="#myModal" class="btn btn-default btn-small" id="custId" data-toggle="modal" data-id="<?= $row->CampaignContactID; ?>">Update</a></td>
                    <td><a href="#myModal1"  class="btn btn-default btn-small" id="custId"  data-toggle="modal" data-id="<?= $row->CampaignContactID; ?>">Generate Coupon</a></td>

                     <?php }?>

                    <div class="modal fade" id="myModal" role="dialog">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Update Status</h4>
                              </div>
                              <div class="modal-body">
                                  <div class="fetched-data">
                                    
                                  </div>
                              </div>
                              
                          </div>
                      </div>
                    </div>


                    <div id="myModal1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Generate Discount Coupon </h4>
              </div>
              <div class="modal-body" id="myModalBody">
               <div id="fetched-data">
                 
               </div>
              </div>
            </div>
          </div>
        </div>



                    
                  </tr>

                <?php
                  }

                }else{

                  echo "<tr><td colspan='8' align='center'><h4>No Record Found</h4></td></tr>";
                }
                ?> 

              </tbody>
            </table>
          </div>
          <?php $current_user_role = $this->session->userdata['logged_in']['user_role'];?>
          <?php if($current_user_role<'3')
          {?>
            <div id="assignagentdiv" class="form-group">
           

       <div class="row">
      
          <div class="col-md-5">
                  <div class="col-md-4">
                     <label class="control-label col-md-04"><strong style="font-size:14px;">Select Agent<span class="required">*</span></strong></label>
                  </div>
              <div class="col-md-8">

               

               <select id="AssignID" name="AssignID" class="bs-select form-control input-circle" style="width:200px;" placeholder="Please select ">
                       <option value='0'>---Select---</option>  
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
                              if($assigndetails[$j]->SystemUserID != $this->session->userdata['logged_in']['userid'])
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
                   <div class="col-md-5">
                   <input type="button" id="assignselectedcontacts" class="btn btn-circle blue " onclick="assignleads_contacts('1');" value="Assign Selected Contacts" />
                   <input type="button" id="assignallcontacts" class="btn btn-circle blue " onclick="assignleads_contacts('2');" value="Assign All Contacts" />
                   </div>               
                  
                  </div>
        </div>
        <?php } ?>
      </div>
<?php 
   if($count==0 || @$this->input->post('myleads') == '4'|| @$this->input->post('myleads') == '5'){?>
<script type="text/javascript">
  $("#assignagentdiv").hide();
</script>
   <?php }
   ?>
        


      <script type="text/javascript">
        $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {


            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : '<?= base_url()?>Agent/update_conatactstatus',
                data :  'rowid='+ rowid, 
                success : function(data){
                $('.fetched-data').html(data);
                }
            });
         });
      });

      </script>
      <script type="text/javascript">

        $(document).ready(function(){
        $('#myModal1').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
                type : 'post',
                url : '<?= base_url()?>Agent/coupen',
                data :  'rowid='+ rowid, 
                success : function(data){
                $('#fetched-data').html(data);
                }
            });
         });
      });

        $('#myModal1').on('hidden.bs.modal', function(){
    $(this).find('form')[0].reset();
});
$.fn.dataTable.ext.errMode = 'none';
$("#sample_1").DataTable({
    "pageLength": 50,
     "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]]//,
    //"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 1 ] } ] 

  });
   $('#select_all').click(function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        }); 
function assignleads_contacts(assign_details){
  //alert("in assignlead");
  var e = document.getElementById("campaign");
var campaignID = e.options[e.selectedIndex].value;
var text = e.options[e.selectedIndex].text;
//alert(campaignID); 
var contact_type = "0";
var lead_status  = "";
var agent_id = "";

//alert(assign_details);
var e = document.getElementById("AssignID");
var assign_id = e.options[e.selectedIndex].value;
var text = e.options[e.selectedIndex].text;
//alert(assign_id);
var data1 = new Array();
$("input[name='chk[]']:checked").each(function(i) {
  data1.push($(this).val());
});
//alert(data1);
var error = "";
 if(assign_id =="0"){
  error += "Select agent to assign leads";
   $("#messagebody").html(error);
            jQuery("#modalview").modal('show');
  alert(error);
  }
  else if(data1 =="0" && assigndetails=="1"  || data1=="" && assigndetails=="1" )
  {
  error += "Select Contacts to assign";
   $("#messagebody").html(error);
            jQuery("#modalview").modal('show');
alert(error);
  }
  else {  
        url = '<?php echo base_url()."Agentassignleads/assignleads/";?>';
        if(assign_details=="1")
        {
               document.getElementById('assignselectedcontacts').value="Loading.... ";
               $('#assignallcontacts').attr("disabled", true);
               $('#assignselectedcontacts').attr("disabled", true);
        }
        else
        {
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
                 document.getElementById('assignagentdiv').style.display="none";
                 $('#assignallcontacts').attr("disabled", false);
                 $('#assignselectedcontacts').attr("disabled", false);
                 document.getElementById('assignselectedcontacts').value="Assign Selected Contacts";
                 document.getElementById('assignallcontacts').value="Assign All Contacts";
                //window.location = '<?php echo base_url()."Leadassignment/";?>';
             }
        });
      }
}
</script>
      </body>
    </html>
