 <?php
 class Mailtousers extends CI_Controller{
  protected $data = array();
  function __construct()
  {
   parent::__construct();

   $this->load->library('form_validation');
   $this->load->library('session');
   $this->load->model('Campaignmodel');
  }
  public function index()
  { echo "in index";
      $config ['protocol'] = 'smtp';
      $config ['smtp_host'] = 'smtp.sparkpostmail.com';
      $config ['smtp_port'] = 587;
      $config ['mailpath'] = '/usr/sbin/sendmail';
      $config ['smtp_user'] = 'SMTP_Injection'; // change it to yours
      $config ['smtp_pass'] = '8d1b77de17eec9e3a57d7331a3758f5f56cb29c2'; // change it to yours
      $config ['mailtype'] = 'html';
      $config ['charset'] = 'iso-8859-1';
      $config ['wordwrap'] = TRUE;
      $config['smtp_crypto'] = 'tls';
      $config ['smtp_auth'] = 'AUTH LOGIN';
      $this->load->library('email');
      $this->email->initialize($config);
      $this->email->set_newline("\r\n");
      $result = $this->Campaignmodel->Extract_EmailDetails();
      //print_r($result);
      if($result!=FALSE)
      {
         $count = count($result);
           for($i=0; $i<$count; $i++)
           {
              $data["data"][$i] = (array)$result[$i];
           }
         $count_rows = count($data["data"]);
         for($i=0; $i<$count_rows; $i++)
         {
               if($data["data"][$i]['Status']== "0")
               {
                //echo "in if";
                $MailID = $data["data"][$i]['MailID'];
                 //echo $MailID;
                $CampaignContactsID = $data["data"][$i]['CampaignContactsID'];
                //echo $CampaignContactsID;
                $tracker = base_url()."Mailtracker/insert/".$MailID.'/'.$CampaignContactsID;
                //echo $tracker;
                $opentracking = '<img border="0" src="'.$tracker.'" width="1" height="1" />';
                //echo $opentracking;
                $url = base_url().'Unsubscribe/?e='.$data["data"][$i]['Email'].'';
                //echo $url;
                $unsubscribe = '<footer><a href="'.$url.'">Unsubscribe</a><footer>';
                //echo $unsubscribe;
                 
                 //$this->email->set_mailtype("html");
                $is_blacklisted = $this->Campaignmodel->check_blacklist($data["data"][$i]['Email']);
                //print_r($is_blacklisted);
                if($is_blacklisted==FALSE)
                {
                  $this->email->from($data["data"][$i]['SentFrom'], "Lurningo");
                  $this->email->to($data["data"][$i]['Email']);
                  $this->email->subject($data["data"][$i]['Subject']);
                  $body = $data["data"][$i]['Body']."".$opentracking." ".$unsubscribe;
                  $this->email->message($body); // Get the content of the file, and base64 encode it
                  $status = $this->email->send();
                  //echo $status;
                  $result = $this->Campaignmodel->Update_EmailStatus($data["data"][$i]['MailContactID'],$status);                 
                }
              }
          }

      }
  }
}
?>
