<?php defined('BASEPATH')OR exit('No direct script access allowed');
class Sendmail extends CI_Controller{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
       $this->load->library('form_validation'); 
       $this->load->library('session');
		   $this->load->model('Campaignmodel');
       $this->load->library('pagination'); 
	}
 public function index()
  {
     if($this->session->userdata('logged_in'))
      {      
       $data["campaigndetails"]=$this->Campaignmodel->get_activecampaign();
       $data["templatedetails"]=$this->Campaignmodel->get_activetemplate();
    
    $this->load->view('Campaign/Sendmail_view',$data);
            }else{
               redirect('login');
           }
        }//END OF INDEX FUNCTION 
  function gettotal_contacts($campaignid){
  //echo $campaignid;
  $this->load->model('Campaignmodel');
  $result=$this->Campaignmodel->get_campaigncontacts_total($campaignid);
  $HTML =$result;
 
  echo $HTML; 
  }
 function get_templatesubject($templateid){
  //echo $templateid;
  $this->load->model('Campaignmodel');
  $result=$this->Campaignmodel->get_templateSubject($templateid);
  $array = (array)$result['0'];
  $HTML=$array['Subject'];
  echo ($HTML);
  }  

  function get_templatemessage($templateid){ 
  //echo $campaignid;
  $this->load->model('Campaignmodel');
  $result=$this->Campaignmodel->get_templateMessage($templateid); 
  $array = (array)$result['0'];
  
  //print_r($array); 
  $HTML=$array['Body'];
  echo $HTML;
  }

  function get_templatesendersaddress($templateid){ 
  //echo $campaignid;
  //$this->load->model('Campaignmodel');
  //$result=$this->Campaignmodel->get_templatesenderemail($templateid); 
  //$array = (array)$result['0'];
  //print_r($array);
  $HTML="info@lurningo.in";//$array['Emailfrom'];
  echo $HTML;
  }
function insert_toSentMail(){
    if($this->session->userdata('logged_in')){  
    //set_value('templateID') = "1";    
     $this->form_validation->set_rules('campaignID', 'Campaign Name','required|greater_than[0]');      
      $this->form_validation->set_rules('emailsubject', 'Email Subject','required');
      $this->form_validation->set_rules('sendersemail', 'Email','valid_email');
      $this->form_validation->set_rules('emailhtmlmessage', 'Email Message','required');

      //$this->form_validation->set_rules('emailmessage', 'Email Message','required');
    $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
    if ($this->form_validation->run() == FALSE) // validation hasn't been passed
    {
       $data["campaigndetails"]=$this->Campaignmodel->get_activecampaign();
       $data["templatedetails"]=$this->Campaignmodel->get_activetemplate();
       if(set_value('campaignID')!=""){
        $data['campaignID']=set_value('campaignID');
    }
    if(set_value('templateID')!=""){
       $data['templateID']="1"; 
    }
     $this->load->view('Campaign/Sendmail_view',$data);
    }
    else // passed validation proceed to post success logic
    {
      //echo set_value('totalcontacts');
       if(trim(set_value('totalcontacts'))=='0'|| trim(set_value('totalcontacts'))==" ")
       {
          $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-success text-center">Enter Contacts to Campaign</div>');
          redirect('Sendmail');
       }
      if(set_value('sendersemail')=="")
      {
        $email = "info@lurningo.in";
      }
      else
      {
        
           $email = set_value('sendersemail');
      }
             $form_data = array(
                  'CampaignID' => set_value('campaignID'),
                  'Subject' => set_value('emailsubject'),
                  'SentFrom'=>$email,
                  'SystemUserID' => $this->session->userdata['logged_in']['userid'],
                  'SentOn' => date("Y-m-d H:i:s"),
                  'TotalContacts' => trim(set_value('totalcontacts')),
                  'Body' =>    $this->input->post('emailhtmlmessage'),
                  'PlainText' => $this->input->post('emailtextmessage'),
                  'Status' => '0'               
            );           
      $MailID = $this->Campaignmodel->insert_to_crm_mail($form_data);
      $contact = $this->Campaignmodel->get_campaigncontacts(set_value('campaignID'), set_value('filter_id'));
      $count = count($contact);
      for($i=0;$i<$count;$i++)
      {
        $contact_array["data"][$i] = (array)$contact[$i];
        $form_data_contacts["data"][$i] = array(                
                  'MailID'=>$MailID,
                  'CampaignContactsID' => $contact_array["data"][$i]['CampaignContactID'],
                  'SentOn' => date("Y-m-d H:i:s"),
                  'Status' => '0'               
            );
      }
     // echo "<pre>";
     // print_r($form_data_contacts);
      //echo "</pre>";
      //echo $this->input->post('emailmessage');
      //print_r($form_data);
      $result=  $this->Campaignmodel->insert_MailContacts($form_data_contacts["data"]);
     // echo $result;
      //exit;
      // run insert model to write data to db
     if ($result >0) // the information has therefore been successfully saved in the db
      {
          
         $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-success text-center">Email Sent successfully</div>');
          redirect('Sendmail');
        }
       else{
        $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-success text-center">Failed to send email!! <br> Try again</div>');
          redirect('Sendmail');
       }
     }
    }else{
               redirect('login');
    }
 }  
  
function display_grid(){

  if($this->session->userdata('logged_in'))
      {  
      $data["sendmaildetails"]=$this->Campaignmodel->sendmail_grid_display('0','0');
       $count= count($data['sendmaildetails']);
        // echo $data['sendmaildetails']['0']->CampaignID;
         for($i=0;$i<$count;$i++){
           $opencount = $this->Campaignmodel->gettotalopencontacts($data["sendmaildetails"][$i]->CampaignID,$data["sendmaildetails"][$i]->MailID);
           if($opencount=='') $data["sendmaildetails"][$i]->openedmails = "0";
           else  $data["sendmaildetails"][$i]->openedmails = $opencount['0']->Opencount;

           $sentcount = $this->Campaignmodel->gettotalsentcontacts($data["sendmaildetails"][$i]->CampaignID,$data["sendmaildetails"][$i]->MailID);
           if($sentcount=='') $data["sendmaildetails"][$i]->sentmails = "0";
           else  $data["sendmaildetails"][$i]->sentmails = $sentcount['0']->Sentcount; 

            $failedcount = $this->Campaignmodel->gettotalfailedcontacts($data["sendmaildetails"][$i]->CampaignID,$data["sendmaildetails"][$i]->MailID);
           if($failedcount=='') $data["sendmaildetails"][$i]->failedmails = "0";
           else  $data["sendmaildetails"][$i]->failedmails = $failedcount['0']->Failedcount;  

            $succeedcount = $this->Campaignmodel->gettotalsucceedcontacts($data["sendmaildetails"][$i]->CampaignID,$data["sendmaildetails"][$i]->MailID);
           if($succeedcount=='') $data["sendmaildetails"][$i]->succeedmails = "0";
           else  $data["sendmaildetails"][$i]->succeedmails = $succeedcount['0']->Succeedcount;   
           
           $clickthroughcount = $this->Campaignmodel->gettotalclickthrough($data["sendmaildetails"][$i]->CampaignID,$data["sendmaildetails"][$i]->MailID);
           if($clickthroughcount=='') $data["sendmaildetails"][$i]->clickthrough = "0";
           else  $data["sendmaildetails"][$i]->clickthrough = $clickthroughcount['0']->clickthrough;         

         }
        // echo"<pre>";
        //print_r($data["sendmaildetails"]);
        //echo "</pre>";

         //$count = count($data['sendmaildetails']);

         $data["totalsentmail"] = $this->db->count_all("crm_mailcontacts");
       // print_r($data["campaigndetails"]);
         $this->load->view('Campaign/Sendmail_grid_view',$data);
           } 
           else
           {
               redirect('login');
           }
}
function display_campaigncontact_list($campaignID){
  $contact = $this->Campaignmodel->get_campaigncontacts($campaignID);
   print_r($contact);
  }
function getfiltered_contacts_number($campaignid, $filter_id){
  $this->load->model('Campaignmodel');
  $result=$this->Campaignmodel->get_campaigncontacts_filtered_count($campaignid,$filter_id);
  $HTML=$result;
  echo $HTML;
}  

function display_openclicked_contacts($mailID)
{
  $data = $this->Campaignmodel->get_openclicked_contacts($mailID);
  $this->tableview($data);
}

function display_clicked_contacts($mailID)
{
  $data = $this->Campaignmodel->get_clicked_contacts($mailID);
  $this->tableview($data);
}

function tableview($data)
{ 
  $HTML='';   
         $HTML .= '<table class="table table-striped table-bordered table-hover" id="sample_1">
              <thead>
              <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone no</th>
                <th>State </th>
                </tr>
              </thead>
              <tbody>';
              if(!empty($data))
                 //echo "<pre>";
                 //print_r($data);
                 //echo "</pre>";
    {
      $j='0';//$page++;
      $j++;
      foreach($data as $data) // user is a class, because we decided in the model to send the results as a class.
      {
        //$agentid = $array["data"]->SystemUserID;
        //$todate = $to_date;
        $HTML .= "<tr>"; 
        $HTML .="<td>".$j."</td>";             
        $HTML .="<td>".ucfirst($data->FirstName." ".$data->LastName)."</td>";
        $HTML .= "<td>".$data->Email."</td>";
        $HTML .= "<td>".($data->Phone)."</td>";
        $HTML .= "<td>".ucfirst(($data->StateName))."</td>";
        $HTML .= "</tr>"; 
        $j++;
      }
      $HTML .="</tbody>
              </table>";
    }
                //echo "array list <br><pre>";
                //print_r($array);
                //echo "</pre>";
                //$this->load->view('Reports/Campaignreport_view',$array);
          echo $HTML;



}



}?>

