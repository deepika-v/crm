<?php 
class Test extends CI_Controller{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
		 $this->load->library('form_validation');
       $this->load->library('session');
		   $this->load->model('Campaignmodel');
       $this->load->helper('html');
       $this->load->helper('html');
       $this->load->helper('file');
	}
 public function index()
  {
     $config ['protocol'] = 'smtp';
     $config ['smtp_host'] = 'email-smtp.us-east-1.amazonaws.com';
     $config ['smtp_port'] = 25;
     $config ['mailpath'] = '/usr/sbin/sendmail';
     $config ['smtp_user'] = 'AKIAJYAHF52FNKPLQOHA'; // change it to yours
     $config ['smtp_pass'] = 'Ag0DxNVIbllmbvulyONYuEbnLNs76lhnFZk6SyWT8TxA'; // change it to yours
     $config ['mailtype'] = 'html';
     $config ['charset'] = 'iso-8859-1';
     $config ['wordwrap'] = TRUE;
     $config['smtp_crypto'] = 'tls';
     $config ['smtp_auth'] = 'AUTH LOGIN';
     $this->load->library('email');
     $this->email->initialize($config);
     //$body="";
     //$data['url'] = base_url('assets/admin/layout3/img/avatar10.jpg');
     //echo $data['url'];
     $this->email->set_newline("\r\n");
     $data["sender_mail"] = "info@lurningo.com";
     $this->email->from('info@lurningo.com', "Admin Team");
     $this->email->to("pratik.thakur@schoolguru.net");//to($data["data"][$i]['Email']);
     $this->email->subject("SD Card");
     $filename = "Template1.php";
     if (@file_exists(APPPATH.'views/Template/'.$filename)){
           $body=  $this->load->view('Template/' . $filename, $data,TRUE);
     }else{
     $body = "<pre> Hi User,
                 Welcome to Lurningo.
                 This is  a Campaign.
              </pre> ";
       }
   $this->email->message($body); // Get the content of the file, and base64 encode it
   $data['message'] = "Sorry Unable to send email..."; 
   $status = $this->email->send();
   $data['message'] = "Mail sent"; 
   echo $status;//$data['message']; 
   echo $this->email->print_debugger();
  //$this->load->view('Template/Template1');
  
   }
}
 ?>
