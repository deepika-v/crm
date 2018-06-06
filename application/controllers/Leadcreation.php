<?php defined('BASEPATH')OR exit('No direct script access allowed');
class Leadcreation extends CI_Controller
{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
       $this->load->library('form_validation'); 
       $this->load->library('session');
		   $this->load->model('Campaignmodel');
  }  
  public function index()
  {
     if($this->session->userdata('logged_in'))
      {      
       $data["flag"]="0"; 
       if($this->session->userdata['logged_in']['user_role']=="1")
       {
          $data["campaigndetails"]=$this->Campaignmodel->get_activecampaign();
       }
       else
       { $userid = $this->session->userdata['logged_in']['userid'];
        $data["campaigndetails"]=$this->Campaignmodel->get_activecampaign_foruser($userid);
       }
       
       $data["citydetails"] = $this->Campaignmodel->get_citydetails(); 
       
           
    $this->load->view('Campaign/Createnewlead_view',$data);
            }else{
               redirect('login');
           }
        }//END OF INDEX FUNCTION  

   function insert() 
   { 
      if($this->session->userdata('logged_in'))
      {      
        $this->form_validation->set_rules('campaignID', 'Campaign Name','required|greater_than[0]');      
        $this->form_validation->set_rules('userfname', 'First Name','required|alpha');
        $this->form_validation->set_rules('userlname', 'Last Name','required|alpha');
        $this->form_validation->set_rules('usergender', 'Gender','required|greater_than[0]');
        $this->form_validation->set_rules('userdob', 'Date of Birth','required|valid_date');
        $this->form_validation->set_rules('useremail', 'Email','required|valid_email');
        $this->form_validation->set_rules('userphone', 'Phone no.','required|numeric|min_length[10]|max_length[12]|valid_phone_number');
        $this->form_validation->set_rules('usercity', 'City','required|greater_than[0]');
        $this->form_validation->set_rules('Contacttype', 'Contact type','required');

         $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
        if ($this->form_validation->run() == FALSE) // validation hasn't been passed
        { 
           $this->load->model('Campaignmodel');
             if($this->session->userdata['logged_in']['user_role']=="1")
             {
                $data["campaigndetails"]=$this->Campaignmodel->get_activecampaign();
             }
             else
             { $userid = $this->session->userdata['logged_in']['userid'];
              $data["campaigndetails"]=$this->Campaignmodel->get_activecampaign_foruser($userid);
             }
                 $data["agentdetails"]=$this->Campaignmodel->get_agentdetails();
                 $data["citydetails"] = $this->Campaignmodel->get_citydetails(); 
                $this->load->view('Campaign/Createnewlead_view', $data);
        }
        else // passed validation proceed to post success logic
        {
              $dob = new DateTime(set_value('userdob'));
              $userdob = $dob->format('Y-m-d');
              if(set_value('usergender')=='1') $gender="M";
              elseif (set_value('usergender')=='2') $gender="F";
              elseif (set_value('usergender')=='3') $gender="O";
              $form_data = array(
                //"campaignID" =>set_value('campaignID'),
                    "FirstName" =>set_value('userfname'),
                    "LastName" =>set_value('userlname'),
                    "Gender" =>$gender,
                    "DateofBirth" =>$userdob,
                    "Email" =>set_value('useremail'),
                    "EmailStatus"=>"0",
                    "SourceID"=>"5",
                    "SourceName"=>"Web",   
                    "Phone" =>set_value('userphone'),
                    "CityID" => set_value('usercity'),
                    "CreatedOn"=> date("Y-m-d H:i:s"),   
                    "CreatedBy" => $this->session->userdata['logged_in']['userid']

                 );
                $result = $this->Campaignmodel->insert_newlead($form_data,1);
                //print_r($result);
                //exit;
                if($result!=FALSE || $result!=0)
                  {
                    if(set_value('Contacttype')=="L")
                      $c_type = "Lead";
                    else
                      $c_type = "Prospect";
                   if($this->session->userdata['logged_in']['user_role']=="1"){
                      $assignto = "0";
                      $status ="1";
                   }
                    else{
                      $assignto = $this->session->userdata['logged_in']['userid']; 
                      $status = "2";
                    }
                         $form_data = array(
                                  "CampaignID" =>set_value('campaignID'),
                                  "ContactsID" =>$result,
                                  "ContactType" =>$c_type,
                                  "AssignedTo" => $assignto,
                                  "Status"=>$status,
                                  "DateAdded"=>date("Y-m-d H:i:s"),
                                  "DateLeadConverted"=>date("Y-m-d H:i:s"),
                                  "AddedBy" => $this->session->userdata['logged_in']['userid']
                          );
                         //print_r($form_data);
                      $res = $this->Campaignmodel->add_to_campaigncontacts($form_data);
                      //echo $res;
                      if($res==TRUE)
                      {
                        $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-success text-center">Lead successfully Created</div>');
                         redirect('Leadcreation');
                      }
                      else
                      {

                        $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">This user(mobile number) is already  mapped with campaign</div>');
                         redirect('Leadcreation');

                      }
                  }
                  else{
                    $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">This user(mobile number) is already  mapped with campaign</div>');
                         redirect('Leadcreation');
                  }

                    
            }
      }else
      {
               redirect('login');
      }
   }//END OF INDEX FUNCTION      
  
}  
?>
