<?php defined('BASEPATH')OR exit('No direct script access allowed');
//ini_set('memory_limit', '-1');
class Api extends CI_Controller{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
    $this->load->model('Campaignmodel');
    //$this->load->helper('mail');
      
	}
    public function index()
  {
     if($this->session->userdata('logged_in'))
      {   
      
      }//END OF INDEX FUNCTION 

   
 }  
    public function exotel()
  {
    try
    {  $phone = $_GET['From'];
       $to = $_GET['To'];
       $userphone = substr($phone, 1);
       $campaignname = "Exotel North";
       $campaignID = $this->Campaignmodel->get_campaignIDdetails(substr($to, 1),$campaignname);
       //echo "result:-".$campaignID;
      // exit;
       $userphone = substr($phone, 1);
       //Details for mail
        $form_data = array(
        //"campaignID" =>set_value('campaignID'),
        "FirstName" =>"NA",
        "LastName" =>"NA",
        "Gender" =>"NA",
        "DateofBirth" =>"NA",
        "Email" =>"NA",
        "Phone" =>$userphone,
        "CreatedOn"=> date("Y-m-d H:i:s"),
        "SourceName"=>"Callcenter",
        "SourceID"=>"3"
         );
        //print_r($form_data);
        $result = $this->Campaignmodel->insert_newlead($form_data,0);
        //echo "result:- ". $result;
        if($result!=FALSE || $result!='0')
        {
             $form_data = array(
            "CampaignID" =>$campaignID,
            "ContactsID" =>$result,
            "ContactType" =>'Lead',
            "AssignedTo" => '0',
            "DateAdded"=>date("Y-m-d H:i:s"),
            "Status"=>'1'
             );
             $res = $this->Campaignmodel->add_to_campaigncontacts($form_data);
        }
  }
  catch(Execptions $ex)
  {

  } 
}
}

?>






























                    
