  <?php
    class Agent extends CI_Controller{

      function __construct(){
       parent::__construct();
       $this->load->library('form_validation');
       $this->load->library('session');
       $this->load->model('Campaignmodel');
       $this->load->helper('html');
       $this->load->helper('html');
       $this->load->helper('file');
  }

       public function index(){
 
          if($this->session->userdata('logged_in')){
        
           $this->load->helper('text'); 

            $this->load->model('leads_model');
            $agent_id = $this->session->userdata['logged_in']['userid'];
            $CampaignID = $this->input->post('campaign');
            $leads = $this->input->post('myleads');
            
            $data['campaign_details'] = $this->leads_model->find_campaign($CampaignID);
            $data['campaign_list'] = $this->leads_model->find_campaignlist($agent_id);
            $data['leadstatus'] = $this->leads_model->find_LeadStatus();
            $data["assigndetails"]=$this->Campaignmodel->get_agentdetails(); 
            $data["userroleid"]=$this->Campaignmodel->get_userrole(); 

            if ($CampaignID == ''){

              $query = $this->leads_model->find_myleads($agent_id);

              if ($leads == '1'){

                $query = $query."and crm_campaigncontacts.Status != '4' and crm_campaigncontacts.Status != '5'and crm_followuplog.NewFollowupDate = curdate()";
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());
              
              }elseif ($leads == '2') {

                $query = $query."and crm_campaigncontacts.Status != '4' and crm_campaigncontacts.Status != '5' and crm_campaigncontacts.Status = 3";
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());  
              
              }elseif ($leads == '3') {
				$query = $query."and crm_campaigncontacts.Status != '4' and crm_campaigncontacts.Status != '5' and crm_campaigncontacts.Status = 2";
                
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());

              }
              elseif ($leads == '4') {
                $query = "Select DISTINCT(crm_contacts.FirstName),CampaignName, crm_contacts.LastName,crm_contacts.Email,
                          crm_contacts.Phone,crm_leadstatus.LeadStatus, crm_campaigncontacts.Status,
                          (SELECT OrderId FROM Orders where MobileNo = crm_contacts.Phone LIMIT 1) AS OrderID,
                           Date(crm_followuplog.FollowupDate) As FollowupDate,Remarks,crm_dropreasons.DropReason
                           from crm_campaigncontacts 
                           join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
                          join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
                          LEFT JOIN crm_followuplog ON crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID
                          Left JOIN crm_dropreasons ON crm_dropreasons.DropReasonId = crm_followuplog.DropReasonId
                          left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID 
                          WHERE crm_followuplog.FollowupDate = (Select Max(FollowupDate) FROM crm_followuplog WHERE crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID)
                          AND AssignedTo = '$agent_id' and crm_campaigncontacts.Status = '4'";
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());

              }elseif ($leads == '5') {
                $query = "select DISTINCT(crm_contacts.FirstName),CampaignName, crm_contacts.LastName,crm_contacts.Email,
                          crm_contacts.Phone,crm_leadstatus.LeadStatus, crm_campaigncontacts.Status,
                          Date(crm_followuplog.FollowupDate) As FollowupDate,Remarks,crm_dropreasons.DropReason
                          from crm_campaigncontacts 
                          join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
                          join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
                          LEFT JOIN crm_followuplog ON crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID
                          Left JOIN crm_dropreasons ON crm_dropreasons.DropReasonId = crm_followuplog.DropReasonId
                          left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID 
                          WHERE crm_followuplog.FollowupDate = (Select Max(FollowupDate) FROM crm_followuplog WHERE crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID)
                          AND AssignedTo = '$agent_id' and crm_campaigncontacts.Status = '5'";
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());

              }

              //echo $query;
            
              $data['myleads'] = $this->db->query($query)->result();
              $data['count'] = count($this->db->query($query)->result());
            
            }else{
              $query = $this->leads_model->find_campaignleads($agent_id,$CampaignID);

              if ($leads == '1'){

                $query = $query."and crm_campaigncontacts.Status <> '4' and crm_campaigncontacts.Status <> '5' and crm_followuplog.NewFollowupDate = curdate()";
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());
              
              }elseif ($leads == '2') {

                $query = $query."and crm_campaigncontacts.Status <> '4' and crm_campaigncontacts.Status <> '5' and crm_campaigncontacts.Status = 3";
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());  
              
              }elseif ($leads == '3'){
                $query = $query."and crm_campaigncontacts.Status <> '4' and crm_campaigncontacts.Status <> '5' and crm_campaigncontacts.Status = 2";
                          
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());

              }
               elseif ($leads == '4') {
                $query = "Select DISTINCT(crm_contacts.FirstName),CampaignName, crm_contacts.LastName,crm_contacts.Email,
                          crm_contacts.Phone,crm_leadstatus.LeadStatus, crm_campaigncontacts.Status,
                          (SELECT OrderId FROM Orders where MobileNo = crm_contacts.Phone LIMIT 1) AS OrderID,
                           Date(crm_followuplog.FollowupDate) As FollowupDate,Remarks,crm_dropreasons.DropReason
                           from crm_campaigncontacts 
                           join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
                          join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
                          LEFT JOIN crm_followuplog ON crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID
                          Left JOIN crm_dropreasons ON crm_dropreasons.DropReasonId = crm_followuplog.DropReasonId
                          left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID 
                          WHERE crm_followuplog.FollowupDate = (Select Max(FollowupDate) FROM crm_followuplog WHERE crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID)
                          AND AssignedTo = '$agent_id' and crm_campaigncontacts.CampaignID = '$CampaignID'
                          and crm_campaigncontacts.Status = '4'";
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());

              }elseif ($leads == '5') {
                  $query = "select DISTINCT(crm_contacts.FirstName),CampaignName, crm_contacts.LastName,crm_contacts.Email,
                          crm_contacts.Phone,crm_leadstatus.LeadStatus, crm_campaigncontacts.Status,
                          Date(crm_followuplog.FollowupDate) As FollowupDate,Remarks,crm_dropreasons.DropReason
                          from crm_campaigncontacts 
                          join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
                          join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
                          LEFT JOIN crm_followuplog ON crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID
                          Left JOIN crm_dropreasons ON crm_dropreasons.DropReasonId = crm_followuplog.DropReasonId
                          left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID 
                          WHERE crm_followuplog.FollowupDate = (Select Max(FollowupDate) FROM crm_followuplog WHERE crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID)
                          AND AssignedTo = '$agent_id' and crm_campaigncontacts.CampaignID = '$CampaignID' 
                          and crm_campaigncontacts.Status = '5'";
                
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());
              }

              $data['myleads'] = $this->db->query($query)->result();

              $data['count'] = count($this->db->query($query)->result());
            }
          
          $this->load->view('Agent/Leads.php',$data);
          
          }else{
          redirect(base_url("login"));
        }
      }//function index ends here


      


      public function update(){
        $CampaignContactID = $this->input->post('ContactsID');
        $remark = $this->input->post('remark');
        $newdate = $this->input->post('newdate');
        $p_date = date("Y-m-d") ;

        if($this->input->post('submit') != ''){

            $sql = $this->db->query("insert into crm_followuplog (CampaignContactID,FollowupDate,NewFollowupDate,Remarks,Status) values ('$CampaignContactID','$p_date','$newdate','$remark','3')");
            $query = $this->db->query("update crm_campaigncontacts set Status = '3' where CampaignContactID ='$CampaignContactID'");

            if ($query && $sql){
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Updated Successfully</div>');
            redirect('Agent');
           }  else{
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Record Updated Successfully</div>');
            redirect('Agent');
           }


           }else if($this->input->post('close_succ') != ''){
          
            $sql = $this->db->query("insert into crm_followuplog (CampaignContactID,FollowupDate,NewFollowupDate,Remarks,Status) values ('$CampaignContactID','$p_date','$p_date','$remark','4')");

            $query = $this->db->query("update crm_campaigncontacts set Status = '4' where CampaignContactID ='$CampaignContactID'");

            if ($query && $sql){
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Updated Successfully</div>');
            redirect('Agent');
            } else{
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Record Updated Successfully</div>');
            redirect('Agent');
           }
      
           }else if($this->input->post('close_unsucc') != ''){
            $sql = $this->db->query("insert into crm_followuplog (CampaignContactID,FollowupDate,NewFollowupdate,Remarks,Status) values ('$CampaignContactID','$p_date','$p_date','$remark','5')");

            $query = $this->db->query("update crm_campaigncontacts set Status = '5' where CampaignContactID ='$CampaignContactID'");

            if ($query && $sql){
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Updated Successfully</div>');
            redirect('Agent');
           }  else{
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Record Updated Successfully</div>');
            redirect('Agent');
         }
        }
      
      }//function update ends here


      public function update_conatactstatus(){
         
                  $CampaignContactID = $this->input->post('rowid');
         
         $query = $this->db->query("select * from crm_campaigncontacts join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status where CampaignContactID = '$CampaignContactID'");
         $sql = $this->db->query("select * from crm_followuplog where CampaignContactID = '$CampaignContactID' order by FollowUpID desc")->result();

         $reasons = $this->db->query("select * from crm_dropreasons")->result();

         $count = count($sql);
         
         $datetime = new DateTime('tomorrow');
         $row = $query->row(); 
            

              echo '<div class="row">
                      <div class="col-md-7" style="border-right:1px solid #ccc">
                        <div class="panel-group">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                             Follow-up History
                            </h4>
                          </div>';
                          if ($count>0){
                            foreach ($sql as $result) {
                            echo    '<ul class="list-group">';
                            echo '<li class="list-group-item">"'.$result->Remarks.'"<span style="float:right">'.date('d-m-Y', strtotime($result->NewFollowupDate)).'</span></li>';
                            }
                          }else{
                            echo "<li class='list-group-item'>No History Found</li>";
                          }
              echo      '</ul></div>';
              echo '</div>';  
              echo '</div>';  

              echo '<div class="col-md-4">';
              echo '<form role="form" id="action_form" method="post" action="'.base_url().'Agent/update_status">';
              
              echo '<input type="text" hidden name="ContactsID" value="'. $row->CampaignContactID.'">';
              
              echo '<div class="form-group"><label class="control-label">Current Status:</label><p>'. $row->LeadStatus.'</p></div>';

              echo '<div class="form-group" style="margin-top:10px;">
                          <label for="emailid" class="">Shown Interest :</label><br>
                          <div class="form-group">
                          <label class="radio-inline">
                            <input type="radio" name="interest" value="1" checked="checked"> Yes
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="interest" value="2" id= "No">No
                          </label>
                          </div>
                      </div>';

              echo '<div id="reason_dropdown" class="form-group" style="display:none;margin-top:10px;">
                        <label>Select Reason :</label>
                        <select class="form-control" id="reason" name="reason">';
                       
                        foreach ($reasons as $reasons) {
                           echo '<option value='.$reasons->DropReasonId.'>'.$reasons->DropReason.'</option>';
                          }  
                        
                          
              echo '</select>
                      </div>';
              echo '<div class="form-group" id="comment" style="display:none;margin-top:10px;">
                        <label>Add reason :</label>
                        <textarea id="message" rows="2" placeholder="Add reason" class="form-control" name="other_reason"></textarea>
                      </div>';
                              
              echo '<div class="form-group" style="margin-top:10px;"><label class="control-label">Remark :</label>
                  <textarea class="form-control" placeholder="Add Remark" name="remark" required rows="2"></textarea>
                  </div>';
              echo '<div class="form-group" id="date" style="margin-top:10px;">
                  <label class="control-label">Next Follow-up Date</label>
                  <input type="text" style="width:250px" name="newdate" onkeypress="return false" onkeydown="return false" class="form-control" value="'.$datetime->format('d-m-Y').'" id="datepicker1">
                  </div>
                  <div class="form-group" style="margin-top:10px;">
                  <input type="submit" name="submit" class="pull-right btn btn-primary" value="Submit">
                  </div>';     

              echo '</form>';
              echo '</div>';

              echo '<script type="text/javascript">
                        $(document).ready(function(){
                          $("input[type=radio]").click(function(){
                            if($(this).attr("id")=="No"){
                              $("#reason_dropdown").show();
                              $("#date").hide();
                            }else{
                              $("#reason_dropdown").hide();
                              $("#date").show();
                              $("#comment").hide();
                              $("#message").removeAttr("required");
                            }
                          })
                        });

                        $(document).ready(function(){
                          $("#reason").change(function(){
                            var value = $(this).val();
                            if(value == "10"){
                              $("#comment").show();
                              $("#message").attr("required", true);
                            }else{
                              $("#comment").hide();
                              $("#message").removeAttr("required");
                            }
                          })
                        })
                        
                        $(document).ready(function() {
                          $("#datepicker1").datepicker({
                            minDate: 1,
                            onSelect: function(theDate) {
                              $("#dataEnd").datepicker("option", "minDate", new Date(theDate));
                            },
                            
                            beforeShow: function() {
                              $("#ui-datepicker-div").css("z-index", 9999);
                            },
                            dateFormat: "dd-mm-yy"
                          });
                          $("#dataEnd").datepicker({
                              beforeShow: function() {
                                $("#ui-datepicker-div").css("z-index", 9999);
                                },
                                dateFormat: "dd-mm-yy"
                            });
                        });
                    </script>';
         
      }//function update contact status ends here

       public function new_update_conatactstatus(){
         
         $CampaignContactID = $this->input->post('rowid');
         
         $query = $this->db->query("select * from crm_campaigncontacts join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status where CampaignContactID = '$CampaignContactID'");



         $sql = $this->db->query("select * from crm_followuplog where CampaignContactID = '$CampaignContactID' order by FollowUpID desc")->result();

         $reasons = $this->db->query("select * from crm_dropreasons")->result();

         $count = count($sql);
         
         $datetime = new DateTime('tomorrow');
          
            $row = $query->row(); 
            

              echo '<div class="row">
                      <div class="col-md-7" style="border-right:1px solid #ccc">
                        <div class="panel-group">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                             Follow-up History
                            </h4>
                          </div>';
                          if ($count>0){
                            foreach ($sql as $result) {
                            echo    '<ul class="list-group">';
                            echo '<li class="list-group-item">"'.$result->Remarks.'"<span style="float:right">'.date('d-m-Y', strtotime($result->NewFollowupDate)).'</span></li>';
                            }
                          }else{
                            echo "<li class='list-group-item'>No History Found</li>";
                          }
              echo      '</ul></div>';
              echo '</div>';  
              echo '</div>';  

              echo '<div class="col-md-4">';
              echo '<form role="form" id="action_form" method="post" action="'.base_url().'Agent/update">';
              
              echo '<input type="text" hidden name="ContactsID" value="'. $row->CampaignContactID.'">';
              
              echo '<div class="form-group"><label class="control-label">Current Status:</label><p>'. $row->LeadStatus.'</p>';

              echo '<div class="form-group" style="margin-top:10px;">
                          <label for="emailid" class="">Shown Interest :</label><br>
                          <div class="form-group">
                          <label class="radio-inline">
                            <input type="radio" name="interest"> Yes
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="interest" id= "No">No
                          </label>
                          </div>
                      </div>';

              echo '<div id="reason_dropdown" class="form-group" style="display:none;margin-top:10px;">
                        <label>Select Reason :</label>
                        <select class="form-control" id="reason" name="reason">';
                       
                        foreach ($reasons as $reasons) {
                           echo '<option value='.$reasons->DropReasonId.'>'.$reasons->DropReason.'</option>';
                          }  
                        
                          
              echo '</select>
                      </div>';
              echo '<div class="form-group" id="comment" style="display:none;margin-top:10px;">
                        <label>Add reason :</label>
                        <textarea id="message" rows="2" placeholder="Add reason" class="form-control" required></textarea>
                      </div>';
                              
              echo '<div class="form-group" style="margin-top:10px;"><label class="control-label">Remark :</label>
                  <textarea class="form-control" placeholder="Add Remark" name="remark" required rows="2"></textarea>
                  </div>';
              echo '<div class="form-group" id="date" style="margin-top:10px;">
                  <label class="control-label">Next Follow Date</label>
                  <input type="text" style="width:250px" name="newdate" onkeypress="return false" onkeydown="return false" class="form-control" value="'.$datetime->format('d-m-Y').'" id="datepicker">
                  </div>';        
              echo '<div class="form-group" style="margin-top:10px;">
                  <button type="submit" class="pull-right btn btn-primary">Submit</button>
                  </div>';           
              echo '</form>';
              echo '</div>';

              echo '<script type="text/javascript">
                        $(document).ready(function(){
                          $("input[type=radio]").click(function(){
                            if($(this).attr("id")=="No"){
                              $("#reason_dropdown").show();
                              $("#date").hide();
                            }else{
                              $("#reason_dropdown").hide();
                              $("#date").show();
                            }
                          })
                        });

                        $(document).ready(function(){
                          $("#reason").change(function(){
                            var value = $(this).val();
                            if(value == "10"){
                              $("#comment").show();
                            }else{
                              $("#comment").hide();
                            }
                          })
                        })
                        
                        $(document).ready(function() {
                          $("#datepicker").datepicker({
                            minDate: 1,
                            onSelect: function(theDate) {
                              $("#dataEnd").datepicker("option", "minDate", new Date(theDate));
                            },
                            
                            beforeShow: function() {
                              $("#ui-datepicker-div").css("z-index", 9999);
                            },
                            dateFormat: "dd-mm-yy"
                          });
                          $("#dataEnd").datepicker({
                              beforeShow: function() {
                                $("#ui-datepicker-div").css("z-index", 9999);
                                },
                                dateFormat: "dd-mm-yy"
                            });
                        });
                    </script>';
      }//function new update contact status ends here

      public function coupen(){

        $CampaignContactID = $this->input->post('rowid');

        $query = $this->db->query("select crm_campaigncontacts.CampaignContactID,crm_contacts.FirstName,crm_contacts.Email,crm_campaigncontacts.CampaignID from crm_campaigncontacts 
          join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
          where CampaignContactID = '$CampaignContactID'")->row();

        $CampaignID = $query->CampaignID;

        $Product_list = $this->db->query("select * from crm_campaign_product join Product on Product.ProductID = crm_campaign_product.ProductID where CampaignID = '$CampaignID' and PublishedStatus ='P'")->result();

        $All_products = $this->db->query("select * from Product where PublishedStatus='P' ")->result();
        
        $datetime = new DateTime('tomorrow');
//print_r($datetime);


        echo ' <form class="form-horizontal" id="coupen" method="post">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Selected Contact :</label>
                    <div class="col-sm-9">
                      <input type="text" readonly class="form-control" id="inputEmail3" value="'.$query->FirstName.'  ('.$query->Email.')">
                      <input type="hidden" name="email" class="form-control" id="inputEmail3" value="'.$query->Email.'">
                      <input type="hidden" name="CampaignContactID" class="form-control" id="inputEmail3" value="'.$query->CampaignContactID.'">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Select Product :</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="product" name="ProductID"><option value="" selected hidden disabled>Select Product</option>';
                  foreach ($Product_list as $row) {
                      echo '<option value='.$row->ProductID.'>'.$row->ProductName.'</option>';
                    }
                    
          echo '<optgroup label="Other Products">';    
                    foreach ($All_products as $row) {
                        echo '<option value='.$row->ProductId.'>'.$row->ProductName.'</option>';
                      }
          echo '</optgroup>';    

          echo         '</select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Max Selling Price :</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" readonly id="max_sell_price">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Min Selling Price :</label>
                    <div class="col-sm-9">
                      <input readonly type="text" class="form-control" id="min_sell_price">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Max Discount Applicable :</label>
                    <div class="col-sm-9">
                      <input readonly type="text" class="form-control" id="max_discount_price">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3">Discount Amount(To generate Coupon) :</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" onchange="comparevalue();" id="Discount_price" name="discount_amount" required name="Discount_price" >
                    </div>
                  </div>

                  <h3> Specify Coupon Validity</h3>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2">No of Usage :</label>
                    <div class="col-sm-2">
                      <input type="number" name="number_of_uses" onchange="users_count();" id="uses_count" value="1" required class="form-control" min="1">
                    </div>
                    <label for="inputEmail3" class="col-sm-2">Expiry Date :</label>
                    <div class="col-sm-4">
                  <script>
                   $(document).ready(function() {
                      $("#datepicker2").datepicker({
                          minDate: 1,
                          onSelect: function(theDate) {
                              $("#dataEnd").datepicker("option", "minDate", new Date(theDate));
                          },
                          beforeShow: function() {
                              $("#ui-datepicker-div").css("z-index", 9999);
                          },
                          dateFormat: "dd-mm-yy"
                      });
                      $("#dataEnd").datepicker({
                          beforeShow: function() {
                              $("#ui-datepicker-div").css("z-index", 9999);
                          },
                          dateFormat: "dd-mm-yy"
                      });


                    });

                    function comparevalue(){
                      var maxval = parseInt(document.getElementById("max_discount_price").value);
                      var discountval = parseInt(document.getElementById("Discount_price").value);
                      if(discountval<0) alert("Discount Amount can not be nigative");
                      if(discountval>maxval) alert("Discount Amount exceeds Max. Discount Applicable Amount");
                     
                     }
                     
                     function users_count(){
                     var count = parseInt(document.getElementById("uses_count").value);
                      if (count<=0) alert ("Number of users can not be 0 or less than 0");
                     }
                  </script>
                  <input style="width:250px" required name="newdate" onkeypress="return false" onkeydown="return false" class="form-control" value="'.$datetime->format('d-m-Y').'" id="datepicker2">
                  </div>
                    </div>
                  </div>
                  
                  <div class="form-group modal-footer">
                    <div class="form-group">
                      <div class="" id="Copen_data" style="text-align:center;display:none">
                        <h1 id="coupen_code"></h1>
						<h4 style="text-align:center;display:none" id="msg">Coupon code has been sent on email of selected contact</h4>
                      </div>
                      <div id="coupen_code1" style="display:none">
						<h4 style="text-align:center">Coupon code will send on email of selected contact</h4>
						<center>
							<img align="middle" id="loading-image" src="'.base_url().'assets/images/142.gif" />
						</center>
					  </div>
                      <div style="margin-right:10px">
                      <button type="button" id="submit" class="btn btn-default">Generate Coupon Code</button>
                    </div>
                  </div>
                </form>';

                echo "<script type='text/javascript'>
                        $('#product').change(function(){
                          $.ajax({
                              type:'post',
                              url:'".base_url()."Agent/Fetch_price',
                              data: 'p_id='+ $(this).val(),                 
                              success: function(value){
                                  var data = value.split(',' );
                                  $('#max_sell_price').val(data[0]);
                                  $('#min_sell_price').val(data[1]);
                                  $('#max_discount_price').val(data[2]);
                                  $('#Discount_price').attr('max', data[2]);
                            }
                          }); 
                        });
                      </script>";
                echo '<script type="text/javascript">
                        $(document).ready(function(){

                            var form=$("#coupen");
                            $("#submit").click(function(){

                                $.ajax({
                                    type: "POST",
                                    data:form.serialize(),
                                    url:"'.base_url().'Agent/generate_coupen_code",
                                    beforeSend: function() {
									  $("#coupen_code1").show();
									 },
                                    success: function(data) {
                                        $("#coupen_code").text(data);
                                        $("#coupen_code1").hide();
                                        $("#submit").hide();
                                        $("#msg").show();
                                     }
                                });
                       });
                    });


                    $(document).ready(function(){
                          $("#submit").click(function(){
                             
                              $("#Copen_data").show();
                            })
                        })

                    $("#Discount_price").rules("add", {
                    max: $("#Discount_price").val()
                    });
                    </script>';      
            }//function coupon ends here


      public function Fetch_price(){

         $ProductID = $this->input->post('p_id');
         $result = $this->db-> query("select * from Product where ProductID = '$ProductID'")->row();
         $max_sell_price = $result->Price;
         $min_sell_price = $result->MinPrice;
         $max_discount_price = $max_sell_price - $min_sell_price ;

         echo $max_sell_price.",".$min_sell_price.",".$max_discount_price;
      } //function fetch price ends here

      public function generate_coupen_code(){

         $randomString = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0,5);

         $discount_amount = $this->input->post('discount_amount');
         $ProductID = $this->input->post('ProductID');
         $name = $this->db->query("select ProductName from Product where ProductID = '$ProductID'")->row();
         $ProductName = $name->ProductName;
         $Email = $this->input->post('email');
         $coupen_code = $randomString;
         $valid_till = strtotime($this->input->post('newdate'));
         $number_of_uses = $this->input->post('number_of_uses');
         $created_on = time();
         $user_role = $this->session->userdata['logged_in']['userid'];
         $created_by = $user_role;
         
         $CampaignContactID = $this->input->post('CampaignContactID');
         $p_date = date("Y-m-d") ;
         $remark = "Sent Coupon Code ".$coupen_code;
         $query = $this->db->query("insert into Coupons (Code,DiscountAmount,DiscountRate,ValidTill,CreatedBy,CreatedOn,MaxNumberOfUses,Status,NumberOfUses) value ('$coupen_code','$discount_amount','00.00','$valid_till','$created_by','$created_on','$number_of_uses','1','0')");
          $CoupenID = $this->db->insert_id();
          $sql = $this->db->query("insert into ProductCoupons (CouponID,ProductID) values ('$CoupenID','$ProductID')");
          
          //config for coupons
          $config ['protocol'] = 'smtp';
          $config ['smtp_host'] = 'smtp.sparkpostmail.com';
          $config ['smtp_port'] = 587;
          $config ['mailpath'] = '/usr/sbin/sendmail';
          $config ['smtp_user'] = 'SMTP_Injection'; 
          $config ['smtp_pass'] = 'eeba7b59202366ae3cb85bcd4fb9480027f4217f'; 
          $config ['mailtype'] = 'html';
          $config ['charset'] = 'iso-8859-1';
          $config ['wordwrap'] = TRUE;
          $config['smtp_crypto'] = 'tls';
          $config ['smtp_auth'] = 'AUTH LOGIN';
          $this->load->library('email');
          $this->email->initialize($config);
          $this->email->set_newline("\r\n");
          $data["sender_mail"] = "info@lurningo.in";
          $this->email->from('info@lurningo.com', "Lurningo");
          $this->email->to($Email);
          $this->email->subject("Coupon Code From Lurningo");
          
     
         $body = '<body>
    <table cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; max-width: 600px; width: 100%; background-color: #ffffff; margin-left: auto; margin-right: auto;" align="center">
        <tr>
            <td style="background-color: #333333; padding: 5px; width: 32px;" valign="middle">
                <img src="https://www.lurningo.com/images/logo2.png" width="150" height="36" style="margin-top: 10px;">
            </td>
        </tr>
        <tr>
            <td style="color: #333333; font-family: Arial; font-size: 14px; padding: 20px;">
                Hello,
                <br /><br />
                Here is your special discount coupon for <strong>'.$ProductName.'</strong>.
                <br /><br />
                <div style="text-align:center; padding: 10px; border:1px dashed blue; background-color: ffff99;">
                    <strong>'.$coupen_code.'</strong>
                </div>
                <br />
                Use this coupon to get a discount of <strong>Rs. '.$discount_amount.'</strong>.
                <br /><br />
                <a href="http://lurningo.com/product/details/'.$ProductID.'" style="font-weight: bold; color: blue">Place your order now</a>
                <br /><br />
                If you have any queries call us on <strong>08039658008</strong> or write to us at <a href="mailto:help@lurningo.com">help@lurningo.com</a>.
            </td>
        </tr>
        <tr>
            <td style="background-color: #e0e0e0; padding: 10px; color: #808080; font-family: Arial; font-size: 11px;" align="center">
                This email has been sent to you by Lurningo.
                <br /><br />
                B-903, Western Edge II, Borivali East, Mumbai-400066.    
            </td>
        </tr>
    </table>
</body>
';
        $this->email->message($body);
        try{ 
			$status = $this->email->send();
        }catch( Exception $e ){
		
		} 
        //$status = $this->email->send();
        $sql = $this->db->query("insert into crm_followuplog (CampaignContactID,FollowupDate,NewFollowupDate,Remarks) values ('$CampaignContactID','$p_date','$p_date','$remark')");
        echo $coupen_code;
      }//function generate_coupen_code ends here
      
       public function update_status(){
        $CampaignContactID = $this->input->post('ContactsID');
        $interest = $this->input->post('interest');
        $remark = $this->input->post('remark');
        $n_date = new DateTime($this->input->post('newdate'));
        $newdate = $n_date->format('Y-m-d');
        $reason_id = $this->input->post('reason');
        $other_reason = $this->input->post('other_reason');
        $p_date = date("Y-m-d");


          if($interest == '1'){
           
            $sql = $this->db->query("insert into crm_followuplog (CampaignContactID,FollowupDate,NewFollowupDate,Remarks,Status) values ('$CampaignContactID','$p_date','$newdate','$remark','3')");
            $query = $this->db->query("update crm_campaigncontacts set Status = '3' where CampaignContactID ='$CampaignContactID'");

            if ($query && $sql){
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Updated Successfully</div>');
            redirect('Agent');
           }  else{
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Record Updated Successfully</div>');
            redirect('Agent');
           }
         
          }else{

            $sql = $this->db->query("insert into crm_followuplog (CampaignContactID,FollowupDate,NewFollowupdate,Remarks,Status,DropReasonId,DropReason) values ('$CampaignContactID','$p_date','$p_date','$remark','5','$reason_id','$other_reason')");

            $query = $this->db->query("update crm_campaigncontacts set Status = '5' where CampaignContactID ='$CampaignContactID'");

            if ($query && $sql){
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Updated Successfully</div>');
            redirect('Agent');
           }  else{
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Record Updated Successfully</div>');
            redirect('Agent');
            
          }
      }

      }//update_status ends here

   public function productlink()
      { 
        $this->load->model('Campaignmodel');   
        $this->load->helper('productcategory');
        $data["product"]=$this->Campaignmodel->get_productlist();
        $data["categorydetails"]=$this->Campaignmodel->get_categorylist();
        $data["productdetails"]= productcategory($data["categorydetails"],$data["product"]);          
        $this->load->view('Agent/Sendproductlink_view',$data);       
      }
   public function sendproductlink()
      { 
        $this->load->helper('mail');
        $username = $this->input->post('name');
        $email = $this->input->post('email');
        $products_id = $this->input->post('select2_sample2[]');
        echo $email."<br>";
        $productlink='';
        $products = array_merge(array_unique($products_id));
        print_r($products);
        $count =count($products);        
        for($i=0;$i<$count;$i++)
        { 
          $name = $this->db->query("select ProductName from Product where ProductID = '".$products[$i]."'")->row();
          $ProductName = $name->ProductName;
          $url = "http://staging.lurningo.com/product/details/".$products[$i];
          $productlink.="<br>Please visit <a href='".$url."' target='_blank'>this link</a>  to buy <b>".$ProductName."</b> on Lurningo.<br>";
        }
        echo $productlink;
        $to = $email;
        $subject = "Recommended Courses for You";
        $message = file_get_contents(base_url().'assets/template/send_buy_link.html');
        $message = str_replace('#Name#',$username,$message);
        $message = str_replace('#ProductLink#',$productlink,$message);
        //$message = str_replace('$password',$password,$message);
        $cc = '';
        $bcc = "";
        $altmessage = "";
        print_r($message);
        try
        {
          $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
          echo $status;
          if($status=="1")
          {
            $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-success text-center">Mail Sent Successfully.</div>');
            redirect('Agent/productlink');
          }           
          else
          {
            $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">Failed to send  Mail !!! Please try again.</div>');
            redirect('Agent/productlink');
          }

        }catch(Exception $e)
        {
              //print_r($e);
        }
        


        exit;
              
      }   
      
    }//class Agent ends here


  ?>

 
