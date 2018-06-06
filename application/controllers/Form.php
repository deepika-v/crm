<?php defined('BASEPATH')OR exit('No direct script access allowed');
ini_set('memory_limit', '-1');
class Form extends CI_Controller{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
      $this->load->helper("url");
      $this->load->library('form_validation');
      $this->load->library('session');
		  $this->load->model('Campaignmodel');
	}
    public function index()
  {
     if($this->session->userdata('logged_in'))
      {   
      $this->load->view('form_view');
      } else{
               redirect('login');
           }
      }//END OF INDEX FUNCTION 

   
 }  

?>






























                    