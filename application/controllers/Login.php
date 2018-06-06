<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Login extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->database();
          $this->load->library('form_validation');
          //load the login model
          $this->load->model('Loginmodel');
     }

     public function index()
     {
          //get the posted values
          //set validations
          $this->form_validation->set_rules("txt_username", "User Name", "trim|required");
          $this->form_validation->set_rules("txt_password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
               //validation fails
               $this->load->view('Login_view');
          }
          else
          {
               //validation succeeds
              
                  $username = $this->input->post("txt_username");
                  $password = $this->input->post("txt_password"); 
                  //echo $username;
                    //check if username and password is correct
                    $usr_result = $this->Loginmodel->get_user($username, $password);
                    print_r($usr_result);
                    
                    if ($usr_result != FALSE) //active user record is present
                    {
                         //set the session variables
                         $sessiondata = array(
                              'username' => $usr_result['0']->UserName,
                              'loginuser' => TRUE,
                              'user_role' => $usr_result['0']->UserRoleID,
                              'FirstName' => $usr_result['0']->FirstName,
                              'LastName' => $usr_result['0']->LastName,
                              'userid' => $usr_result['0']->SystemUserID
                         );
                          $this->session->set_userdata('logged_in', $sessiondata);
                          //$this->load->view('Dashboard_view');
                         //$this->session->set_userdata($sessiondata);
                         
                         redirect("dashboard");
                         //print_r($sessiondata);
                    }
                    else
                    {
                         $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">Invalid Credentials!</div>');
                         redirect('Login');
                    }
               }
     }
     public function logout() {

      // Removing session data
      $this->session->unset_userdata('logged_in', $sess_array);
      $this->session->sess_destroy();
      redirect('Login');
      }

    }
?>