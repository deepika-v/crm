  <?php
    class Agentassignleads extends CI_Controller{

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
    		
      	  
      }//function index ends here
    }

public function assignleads() 
{ 
  if($this->session->userdata('logged_in'))
  {  
      //echo "in assignleads";
      $campaignid = $_POST['campaignid'];
      $agent_id = $this->session->userdata['logged_in']['userid'];
      $assignid = $_POST['assignid'];
      $assigndetails = $_POST['assigndetails'];
      $user_id = $_POST['contacts'];
      $addedby = $this->session->userdata['logged_in']['userid'];
      //echo "assigndetails".$assigndetails;
      $count =count($user_id);
      $k=0;
      for($i=0;$i<$count;$i++)
      {
        if($user_id[$i]!='0')
        {
          $user_id_list[$k]=$user_id[$i];
          $k++;

        }
      }
      $flag = "0";
      $result ="";
      $count = count($user_id);
      $agentname =  $this->Campaignmodel->get_agentname($assignid);
      $assignedto = (array)$agentname['0'];
      $campaigncontactID_csv = implode(',', $user_id_list);
     // print_r($campaigncontactID_csv);
      //exit;
          if($assigndetails=="1") 
          {      
            $result =   $this->Campaignmodel->update_assignagent_leads($campaigncontactID_csv,$assignid,$addedby);
             //print_r($result);
             if($result != FALSE)
             {
                for($i=0;$i<$count;$i++)
                {
                    if($user_id[$i]!="0")
                    {          
                       //echo $result;
                       $assignment_log_data = array('CampaignContactID'=>$user_id[$i],
                                                    'AssignedTo'=>$assignid,
                                                    'CreatedBy'=>$addedby); 

                       $insert = $this->Campaignmodel->insert_assignmentlog_leads($assignment_log_data);
                       if($insert!= FALSE) $flag = "1";
                    }          
                }
             }            
          }
          else
          {
            //echo "in else";
            $userid = "-1";
             $this->load->model('Campaignmodel');
            $getcampaigncontactID_all = $this->Campaignmodel->getcampaigncontactID_all($campaignid,$agent_id);
           //print_r($getcampaigncontactID_all);
            if($getcampaigncontactID_all!= FALSE )
            {  //echo "in getcampaigncontactID_all true";
                
                $count = count($getcampaigncontactID_all);
                for($i=0;$i<$count;$i++)
                  {
                     $array[$i] = $getcampaigncontactID_all[$i]->CampaignContactID; 
                  }
                $campaigncontactID_csv = implode(',', $array);
                //echo $campaigncontactID_csv;
                $result =   $this->Campaignmodel->update_assignagent_leads($campaigncontactID_csv,$assignid,$addedby);
                if($result!=FALSE)
                { //echo "in echo result true";
                   for($i=0;$i<$count;$i++)
                   {
                      $assignment_log_data = array('CampaignContactID'=>$array[$i],
                                                    'AssignedTo'=>$assignid,
                                                  'CreatedBy'=>$addedby);
                      $insert = $this->Campaignmodel->insert_assignmentlog_leads($assignment_log_data);
                      if($insert!= FALSE) $flag = "1";
                      
                    }   
                 
                }
            }
          else{
            //echo "in getcampaigncontactID_all false";
            $flag = "2";

          }                
          }              
       if($flag=="1")
        echo '<div id="flash-messages" class="alert alert-success text-center"> Lead successfully assigned to '.ucfirst($assignedto['FirstName']." ".$assignedto['LastName']).'</div>';
       if($flag=="0")
      echo '<div id="flash-messages" class="alert alert-danger text-center"> Failed to assign Leads <br> Try Again!!!</div>';
    if($flag=="2")
      echo '<div id="flash-messages" class="alert alert-danger text-center"> Leads Already assigned <br> Try Again!!!</div>';
     }
    else{
               redirect('login');
        }
    }//END OF assignleads FUNCTION 
}//class Agentassignleads ends here
?>

 