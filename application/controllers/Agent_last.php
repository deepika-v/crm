  <?php
    class Agent extends CI_Controller{

      public function index(){

    		  if($this->session->userdata('logged_in')){
    		
      	   $this->load->helper('text');	

            $this->load->model('leads_model');

            //$agent_id = '1';

            $agent_id = $this->session->userdata['logged_in']['userid'];
            $CampaignID = $this->input->post('campaign');
            $leads = $this->input->post('myleads');
            
            $data['campaign_details'] = $this->leads_model->find_campaign($CampaignID);
            $data['campaign_list'] = $this->leads_model->find_campaignlist($agent_id);
            $data['leadstatus'] = $this->leads_model->find_LeadStatus();

            if ($CampaignID == ''){

              $query = $this->leads_model->find_myleads($agent_id);

              if ($leads == '1'){

                $query = $query.'and crm_followuplog.NewFollowupDate = curdate()';
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());
              
              }elseif ($leads == '2') {

                $query = $query.'and crm_campaigncontacts.Status = 3';
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());  
              
              }elseif ($leads == '3') {

                $query = "select * from crm_campaigncontacts 
                          join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
                          join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
                          left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID 
                          where AssignedTo = '$agent_id' 
                          and crm_campaigncontacts.Status != '4' and crm_campaigncontacts.Status != '5'
                          and crm_campaigncontacts.Status = 2";
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());

              }

              //echo $query;
            
              $data['myleads'] = $this->db->query($query)->result();
              $data['count'] = count($this->db->query($query)->result());
            
            }else{
              $query = $this->leads_model->find_campaignleads($agent_id,$CampaignID);

              if ($leads == '1'){

                $query = $query.'and crm_followuplog.NewFollowupDate = curdate()';
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());
              
              }elseif ($leads == '2') {

                $query = $query.'and crm_campaigncontacts.Status = 3';
                $data['myleads'] = $this->db->query($query)->result();
                $data['count'] = count($this->db->query($query)->result());  
              
              }elseif ($leads == '3') {

                $query = "select * from crm_campaigncontacts 
                          join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
                          join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
                          left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID 
                          where AssignedTo = '$agent_id' and crm_campaigncontacts.CampaignID = '$CampaignID' 
                          and crm_campaigncontacts.Status != '4' and crm_campaigncontacts.Status != '5'
                          and crm_campaigncontacts.Status = 2";
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
        $p_date = date("Y/m/d") ;

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

         $sql = $this->db->query("select * from crm_followuplog where CampaignContactID = '$CampaignContactID'")->result();
          
         $count = count($sql);
         

         $datetime = new DateTime('tomorrow');
          
            $row = $query->row(); 
            

              echo '<div class="row">
                    <div class="col-md-6" style="border-right:1px solid #ccc">';
              echo '<div class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                           Follow-up History
                          </h4>
                        </div>';
                          if ($count>0){
                            foreach ($sql as $result) {
                            echo    '<ul class="list-group">';
                            echo '<li class="list-group-item">"'.$result->Remarks.'"<span style="float:right">'.date('Y-m-d', strtotime($result->NewFollowupDate)).'</span></li>';
                            }
                          }else{
                            echo "<li class='list-group-item'>No History Found</li>";
                          }
                            
              echo      '</ul></div>';
              echo '</div>';  
              echo '</div>';  

              echo '<div class="col-md-6">';
              echo '<form role="form" id="action_form" method="post" action="'.base_url().'Agent/update">';
              echo '<input type="text" hidden name="ContactsID" value="'. $row->CampaignContactID.'">';
              echo '<div class="form-group"><label class="control-label">Current Status:</label><input type="text" class="form-control" readonly  value="'. $row->LeadStatus.'">';
              echo '<div class="form-group"><label class="control-label">Remark :</label>
                  <textarea class="form-control" name="remark" required rows="4"></textarea>
                  </div>';
              echo '<div class="form-group">
                  <label class="control-label">Next Follow Date</label>
                  <script>
                   $(document).ready(function() {
                      $("#datepicker").datepicker({
                          minDate: 1,
                          onSelect: function(theDate) {
                              $("#dataEnd").datepicker("option", "minDate", new Date(theDate));
                          },
                          beforeShow: function() {
                              $("#ui-datepicker-div").css("z-index", 9999);
                          },
                          dateFormat: "yy/mm/dd"
                      });
                      $("#dataEnd").datepicker({
                          beforeShow: function() {
                              $("#ui-datepicker-div").css("z-index", 9999);
                          },
                          dateFormat: "yy/mm/dd"
                      });

                    });
                  </script>
                  <input type="text" style="width:250px" name="newdate" class="form-control" value="'.$datetime->format('Y-m-d').'" id="datepicker">
                  </div>';        
              echo ' <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-sm btn-primary" value="Schedule follow-up " />
                  
                  <input type="submit" name="close_unsucc" class="btn btn-sm btn-danger" value="Close-Unsuccess" />
                  </div>';           
              echo '</form>';
              echo '</div>';
      }//function update contact status ends here
    }//class Agent ends here
  ?>
