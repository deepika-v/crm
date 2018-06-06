<?php defined('BASEPATH')OR exit('No direct script access allowed');
class Dashboard extends CI_Controller{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
		$this->data['pagetitle']= 'Digivarisity';
    $this->load->model('Loginmodel');
	}
  
  public function index()
        {
          try {
                 if($this->session->userdata('logged_in'))
                {       
                  $user_id = $this->session->userdata['logged_in']['userid'];
                  $data["total_prospect"]=$this->Loginmodel->get_totalprospect($user_id);
                  //print_r($data["total_prospect"]);               
                   $data["total_leads"]=$this->Loginmodel->get_totalleads($user_id);
                  $data["total_follow_up"]=$this->Loginmodel->get_totalfollowups($user_id);
                        $this->load->view('Dashboard_view',$data);
                }
                else
                {
                   redirect('login');
                 }
            
              } catch (Exception $e)
              {
            
              }
            
        } 
   public function logout()
   {
      try
       {
          $this->session->unset_userdata('logged_in');
         $this->session->sess_destroy();
         redirect(base_url("login"));
            
          } catch (Exception $e) {
            
          }

           //remove all session data
        
     
   } 
   
 }  

?>