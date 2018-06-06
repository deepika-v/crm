<?php defined('BASEPATH')OR exit('No direct script access allowed');
class Leadapi extends CI_Controller{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
       $this->load->library('form_validation'); 
       $this->load->library('session');
		   $this->load->model('Campaignmodel');
       //date_default_timezone_set('Asia/Kolkata');
       
  }
  
  public function index()
  { 
    try{
      $campaignID = $this->input->get_post('campaignid');
      $userfname = $this->input->get_post('userfname');
      $userlname = $this->input->get_post('userlname');
      $usergender = $this->input->get_post('usergender');
      $userdob = $this->input->get_post('userdob');
      $useremail = $this->input->get_post('useremail');
      $userphone = $this->input->get_post('userphone');
      $redirecturl = $this->input->get_post('redirecturl');
      //echo $userdob;
      $dob1 = new DateTime($userdob);
      //echo $dob1;
      //echo $userdob;
      $userdob1 = $dob1->format('Y-m-d');  
      //echo $userdob1;    
      $form_data = array(
        //"campaignID" =>set_value('campaignID'),
        "FirstName" =>$userfname,
        "LastName" =>$userlname,
        "Gender" =>$usergender,
        "DateofBirth" =>$userdob1,
        "Email" =>$useremail,
        "EmailStatus"=>"0",
        "SourceID"=>"5",
        "SourceName"=>"Web", 
        "Phone" =>$userphone,
         );
        //print_r($form_data);
        $result = $this->Campaignmodel->insert_newlead($form_data,1);
        if($result!=FALSE)
        {
             $form_data = array(
            "CampaignID" =>$campaignID,
            "ContactsID" =>$result,
            "ContactType" =>'Lead',
            "AssignedTo" => '0',
            "DateAdded"=>date("Y-m-d H:i:s"),
            "DateLeadConverted"=>date("Y-m-d H:i:s"),
            "Status"=>'1'
             );
             $res = $this->Campaignmodel->add_to_campaigncontacts($form_data);
             $this->load->helper('url'); 
             //redirect($redirecturl);

             header('Location:'.prep_url($redirecturl));
             //header($redirecturl);
         }
         header('Location:'.prep_url($redirecturl));
          
      }
      catch(Execptions $ex){
        //echo $ex;
       }
  }//END OF INDEX FUNCTION      
          
  
  }  
?>
