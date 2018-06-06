<?php defined('BASEPATH')OR exit('No direct script access allowed');
//ini_set('memory_limit', '-1');
class User extends CI_Controller{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
    $this->load->library('session');
    $this->load->model('Usermodel');
    $this->load->library('form_validation');
    $this->load->helper('mail');
    $this->load->helper('reportingagent');   
	}
    public function index()
  { 
    try
    {
      if($this->session->userdata('logged_in'))
      {     
            $data["city"]=$this->Usermodel->get_citydetails();
           $data["state"]=$this->Usermodel->get_statedetails();
           $data["country"]=$this->Usermodel->get_countrydetails();
            $data["userroleid"]=$this->Usermodel->get_user_role();
            $data["agentdetails"]=$this->Usermodel->get_reportinguser();
            $data["reportinguserdetails"]=$this->Usermodel->get_reportinguser();
            $data["flag"]="0";
           $this->load->view('User/CreateUser_view',$data);
      }//END OF INDEX FUNCTION 
    }catch(Exceptions $ex){

    }
     
  }

  public function userrole()
  { 
    try
    {
      if($this->session->userdata('logged_in'))
      {     
           $this->load->view('User/CreateUserrole_view');
      }//END OF INDEX FUNCTION 
    }catch(Exceptions $ex){

    }
     
  }  
  public function createuser()
  { 
    try
    {
       if($this->session->userdata('logged_in'))
      {   
        $this->form_validation->set_rules('userrole', 'User Role','required|greater_than[0]');      
        $this->form_validation->set_rules('reportinguser', 'Reporting To ','required');
        $this->form_validation->set_rules('userfname', 'First Name','required|alpha');
        $this->form_validation->set_rules('userlname', 'Last Name','required|alpha');
        $this->form_validation->set_rules('useremail', 'Email','required|valid_email');
        $this->form_validation->set_rules('username', 'User Name','required|is_unique[SystemUsers.UserName]');
        $this->form_validation->set_rules('userphone', 'Phone no.','required|numeric|max_length[10]|valid_phone_number');
        $this->form_validation->set_rules('userstatus', 'Status','required');
        $this->form_validation->set_rules('userpostalcode', 'Pin Code','numeric|max_length[6]');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
        if ($this->form_validation->run() == FALSE) // validation hasn't been passed
        { 
           $data["city"]=$this->Usermodel->get_citydetails();
           $data["state"]=$this->Usermodel->get_statedetails();
           $data["country"]=$this->Usermodel->get_countrydetails();
           $data["userroleid"]=$this->Usermodel->get_user_role();
           $data["agentdetails"]=$this->Usermodel->get_reportinguser();
           $data["reportinguserdetails"]=$this->Usermodel->get_reportinguser();
           $data["flag"]= "1";
           $data["country_id"] = set_value('Country');
           $data["state_id"] = set_value('State');

           $this->load->view('User/CreateUser_view', $data);
        }
        else // passed validation proceed to post success logic
        {  
          $dob = new DateTime(set_value('userdob'));
          $userdob = $dob->format('Y-m-d');
          $email = set_value('useremail');
          if(set_value('userpostalcode')=="")$userpostalcode = NULL; else $userpostalcode = trim(set_value('userpostalcode'));
          if(set_value('reportinguser')=="-1")
          $form_data = array(
                "FirstName" =>trim(set_value('userfname')),
                "LastName" =>trim(set_value('userlname')),
                "UserName"=>trim(set_value('username')),
                "Hash" => md5(trim((strtolower(set_value('userfname'))))),
                "EmailId" =>trim($email),
                "MobileNo" =>trim(set_value('userphone')),
                "Address" =>trim(set_value('useraddress')),
                "City" => trim(set_value('City')),
                "State" =>trim(set_value('State')),
                "Country"=>trim(set_value('Country')),
                "PostalCode"=>$userpostalcode,
                "DOB"=>$userdob,                
                "UserRoleID"=>trim(set_value('userrole')),
                "IsActive"=>trim(set_value('userstatus')),
                "CreatedBy" => $this->session->userdata['logged_in']['userid'],
                "CreatedOn" => date("Y-m-d H:s:i"),
               );
            else 
             //$reportinguser = set_value('reportinguser'); 
             $form_data = array(
                "FirstName" =>trim(set_value('userfname')),
                "LastName" =>trim(set_value('userlname')),
                "UserName"=>trim(set_value('username')),
                "Hash" => md5(trim((strtolower(set_value('userfname'))))),
                "EmailId" =>trim($email),
                "MobileNo" =>trim(set_value('userphone')),
                "Address" =>trim(set_value('useraddress')),
                "City" => trim(set_value('City')),
                "State" =>trim(set_value('State')),
                "Country"=>trim(set_value('Country')),
                "PostalCode"=>$userpostalcode,
                "DOB"=>$userdob,  
                "UserRoleID"=>trim(set_value('userrole')),
                "ReportingTo"=>trim(set_value('reportinguser')),
                "IsActive"=>trim(set_value('userstatus')),
                "CreatedBy" => $this->session->userdata['logged_in']['userid'],
                "CreatedOn" => date("Y-m-d H:s:i")
               ); 
            $result = $this->Usermodel->createuser($form_data);
            if($result==TRUE)
            { 
              try
              {
                $this->load->helper('mail');
                $user = ucfirst(set_value('userfname'))." ".ucfirst(set_value('userlname'));
                $username = trim(strtolower(set_value('username')));
                $password = trim((strtolower(set_value('userfname'))));
                $to = $email;
                $subject = "Login credentials for Lurningo CRM";
                $message = file_get_contents(base_url().'assets/template/login_credentials_view.html');
                $message = str_replace('$User',$user,$message);
                $message = str_replace('$username',$username,$message);
                $message = str_replace('$password',$password,$message);
                $cc = '';
                $bcc = "";
                $altmessage = "";

                $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
                
              }
              catch(Exceptions $ex)
              {

              }
              
              $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-success text-center">User Created Successfully.<br> Login credentials have been sent to registered Email Id.</div>');
                         redirect('User');
            }
            else
            {
              $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">User(Mobile No) exists. Try with different Mobile No to register.</div>');
              redirect('User');

            }
            //print_r($result);
            //exit;
        }
      }else
      {
               redirect('login');
      }

    }catch(Exceptions $ex)
    {

    }

    

      
      }//END OF INDEX FUNCTION 
public function createuserrole()
  { 
    try
    {
       if($this->session->userdata('logged_in'))
      {   
        $this->form_validation->set_rules('userrole', 'User Role','required|greater_than[0]');      
        $this->form_validation->set_rules('reportinguser', 'Reporting To ','required');
        $this->form_validation->set_rules('userfname', 'First Name','required|alpha');
        $this->form_validation->set_rules('userlname', 'Last Name','required|alpha');
        $this->form_validation->set_rules('useremail', 'Email','required|valid_email');
        $this->form_validation->set_rules('username', 'User Name','required|is_unique[SystemUsers.UserName]');
        $this->form_validation->set_rules('userphone', 'Phone no.','required|numeric|max_length[10]|valid_phone_number');
        $this->form_validation->set_rules('userstatus', 'Status','required');
        $this->form_validation->set_rules('userpostalcode', 'Pin Code','numeric|max_length[6]');
        //$this->form_validation->set_rules('Country', 'Country','greater_than[0]');
        //$this->form_validation->set_rules('State', 'State','greater_than[0]');
        //$this->form_validation->set_rules('City', 'City','greater_than[0]');
        //$this->form_validation->set_rules('useraddress', 'Address','required');        
        //$this->form_validation->set_rules('userdob', 'Date of Birth','required');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
        if ($this->form_validation->run() == FALSE) // validation hasn't been passed
        { 
           $data["city"]=$this->Usermodel->get_citydetails();
           $data["state"]=$this->Usermodel->get_statedetails();
           $data["country"]=$this->Usermodel->get_countrydetails();
           $data["userroleid"]=$this->Usermodel->get_user_role();
           $data["agentdetails"]=$this->Usermodel->get_reportinguser();
           $data["reportinguserdetails"]=$this->Usermodel->get_reportinguser();
           $this->load->view('User/CreateUser_view', $data);
        }
        else // passed validation proceed to post success logic
        {    $dob = new DateTime(set_value('userdob'));
              $userdob = $dob->format('Y-m-d');
            $email = set_value('useremail');
            if(set_value('userpostalcode')=="")$userpostalcode = NULL; else $userpostalcode = trim(set_value('userpostalcode'));
            if(set_value('reportinguser')=="-1")
                $form_data = array(
                "FirstName" =>trim(set_value('userfname')),
                "LastName" =>trim(set_value('userlname')),
                "UserName"=>trim(set_value('username')),
                "Hash" => md5(trim((strtolower(set_value('userfname'))))),
                "EmailId" =>trim($email),
                "MobileNo" =>trim(set_value('userphone')),
                "Address" =>trim(set_value('useraddress')),
                "City" => trim(set_value('City')),
                "State" =>trim(set_value('State')),
                "Country"=>trim(set_value('Country')),
                "PostalCode"=>$userpostalcode,
                "DOB"=>$userdob,                
                "UserRoleID"=>trim(set_value('userrole')),
                "IsActive"=>trim(set_value('userstatus')),
                "CreatedBy" => $this->session->userdata['logged_in']['userid'],
                "CreatedOn" => date("Y-m-d H:s:i"),

               );
            else 
             //$reportinguser = set_value('reportinguser'); 
             $form_data = array(
                "FirstName" =>trim(set_value('userfname')),
                "LastName" =>trim(set_value('userlname')),
                "UserName"=>trim(set_value('username')),
                "Hash" => md5(trim((strtolower(set_value('userfname'))))),
                "EmailId" =>trim($email),
                "MobileNo" =>trim(set_value('userphone')),
                "Address" =>trim(set_value('useraddress')),
                "City" => trim(set_value('City')),
                "State" =>trim(set_value('State')),
                "Country"=>trim(set_value('Country')),
                "PostalCode"=>$userpostalcode,
                "DOB"=>$userdob,  
                "UserRoleID"=>trim(set_value('userrole')),
                "ReportingTo"=>trim(set_value('reportinguser')),
                "IsActive"=>trim(set_value('userstatus')),
                "CreatedBy" => $this->session->userdata['logged_in']['userid'],
                "CreatedOn" => date("Y-m-d H:s:i")
               ); 
          //if(set_value('usergender')=='1') $gender="M";
          //elseif (set_value('usergender')=='2') $gender="F";
          //elseif (set_value('usergender')=='3') $gender="O";
          
            $result = $this->Usermodel->createuser($form_data);
            if($result==TRUE)
            { 
              try
              {
                $this->load->helper('mail');
                $user = ucfirst(set_value('userfname'))." ".ucfirst(set_value('userlname'));
                $username = trim(strtolower(set_value('username')));
                $password = trim((strtolower(set_value('userfname'))));
                $to = $email;
                $subject = "Login credentials for Lurningo CRM";
                $message = file_get_contents(base_url().'assets/template/login_credentials_view.html');
                $message = str_replace('$User',$user,$message);
                $message = str_replace('$username',$username,$message);
                $message = str_replace('$password',$password,$message);
                $cc = '';
                $bcc = "";
                $altmessage = "";

                $status = sendemail($to,$cc,$bcc,$subject,$message,$altmessage);
                
              }
              catch(Exceptions $ex)
              {

              }
              
              $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-success text-center">User Created Successfully.<br> Login credentials have been sent to registered Email Id.</div>');
                         redirect('User');
            }
            else
            {
              $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">User(Mobile No) exists. Try with different Mobile No to register.</div>');
              redirect('User');

            }
            //print_r($result);
            //exit;
        }
      }else
      {
               redirect('login');
      }

    }catch(Exceptions $ex)
    {

    }

    

      
      }//END OF INDEX FUNCTION 
   

    public function createheader()
  {
    try
    {
       if($this->session->userdata('logged_in'))
      {   
           $data["userrole"]=$this->Usermodel->get_user_role();
           $data["reportinguser"]=$this->Usermodel->get_reportinguser();
           $this->load->view('User/Createheader_view',$data);
      }
      else
      {
               redirect('login');
      }

    }catch(Exceptions $ex)
    {

    }   
    
  }//END OF createheader FUNCTION 

public function changepassword()
  {
      try
      {

        if($this->session->userdata('logged_in'))
        {   
             $this->load->view('User/Changepassword_view');
        }
        else
        {
                 redirect('login');
        }

      }
      catch(Exceptions $ex)
      {


      }   
  }//END OF INDEX FUNCTION 
  public function modifyuser()
  {
    try
    {
          if($this->session->userdata('logged_in'))
          {   
               $userroleid=$this->Usermodel->get_user_role();
               $data["reportinguser"] = $this->Usermodel->get_reportinguser();
               $assigndetails  =  $this->Usermodel->get_agentdetailslist(); 
               //echo "<pre>";
               //print_r($assigndetails);
               //echo "<pre>";
               $current_user_role = $this->session->userdata['logged_in']['user_role'];
               $userid = $this->session->userdata['logged_in']['userid'];
               $data["agentdetails"]= reportingto($userroleid,$assigndetails,$current_user_role,$userid);
               //echo "<pre>";
               //print_r($data["agentdetails"]);
               //echo "<pre>";
               $this->load->view('User/ModifyUser_view',$data);
          }
          else
          {
                   redirect('login');
          }
        }catch(Exceptions $ex)
        {
            
        }    
  }//END OF modifyuser FUNCTION     

  public function edituser($agent_id)
  {  
    try
    {
          if($this->session->userdata('logged_in'))
          {    
            $data['id']=$agent_id;
           $data["userroleid"]=$this->Usermodel->get_user_role();
           //$data["userrole"]=$this->Usermodel->get_user_role();
           $data["city"]=$this->Usermodel->get_citydetails();
           $data["state"]=$this->Usermodel->get_statedetails();
           $data["country"]=$this->Usermodel->get_countrydetails();
           $data["reportinguserdetails"]=$this->Usermodel->get_reportinguser(); 
          // print_r($data["reportinguser"]);
           $data["agentdetails"]  =  $this->Usermodel->get_editagentdetails($agent_id);
           $this->load->view('User/EditUser_view',$data);
          }
          else
          {
                   redirect('login');
          }

    }catch(Exceptions $ex)
    {

    }
 }//END OF Edituser FUNCTION
   public function updateuser($agent_id)
   {
        try
        {
          if($this->session->userdata('logged_in'))
          {    
            $this->form_validation->set_rules('userrole', 'User Role','required|greater_than[0]');      
            $this->form_validation->set_rules('reportinguser', 'Reporting To ','required');
            $this->form_validation->set_rules('userfname', 'First Name','required|alpha');
            $this->form_validation->set_rules('userlname', 'Last Name','required|alpha');
            $this->form_validation->set_rules('useremail', 'Email','required|valid_email');
            $this->form_validation->set_rules('username', 'User Name','required');
            $this->form_validation->set_rules('userphone', 'Phone no.','required|numeric|max_length[10]|valid_phone_number');
            $this->form_validation->set_rules('Country', 'Country','required|greater_than[0]');
            $this->form_validation->set_rules('State', 'State','required|greater_than[0]');
            $this->form_validation->set_rules('City', 'City','required|greater_than[0]');
            $this->form_validation->set_rules('useraddress', 'Address','required');
            $this->form_validation->set_rules('userstatus', 'Status','required');
            $this->form_validation->set_rules('userpostalcode', 'Pin Code','required|numeric|max_length[6]');
            $this->form_validation->set_rules('userdob', 'Date of Birth','required');

            $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
            if ($this->form_validation->run() == FALSE) // validation hasn't been passed
            { 
               $this->edituser($agent_id);
            }
            else // passed validation proceed to post success logic
            {    $dob = new DateTime(set_value('userdob'));
                  $userdob = $dob->format('Y-m-d');
                $email = set_value('useremail');
                if(set_value('reportinguser')=="-1")
                    $form_data = array(
                    "FirstName" =>set_value('userfname'),
                    "LastName" =>set_value('userlname'),
                    "UserName"=>trim(set_value('username')),
                    "Hash" => md5(trim((strtolower(set_value('userfname'))))),
                    "EmailId" =>$email,
                    "MobileNo" =>set_value('userphone'),
                    "Address" =>set_value('useraddress'),
                    "City" => set_value('City'),
                    "State" =>set_value('State'),
                    "Country"=>set_value('Country'),
                    "PostalCode"=>set_value('userpostalcode'),
                    "DOB"=>$userdob,                
                    "UserRoleID"=>set_value('userrole'),
                    "IsActive"=>set_value('userstatus'),
                    "CreatedBy" => $this->session->userdata['logged_in']['userid'],
                    "CreatedOn" => date("Y-m-d H:s:i"),

                   );
                else 
                 //$reportinguser = set_value('reportinguser'); 
                 $form_data = array(
                    "FirstName" =>set_value('userfname'),
                    "LastName" =>set_value('userlname'),
                    "UserName"=>trim(set_value('username')),
                    "Hash" => md5(trim((strtolower(set_value('userfname'))))),
                    "EmailId" =>$email,
                    "MobileNo" =>set_value('userphone'),
                    "Address" =>set_value('useraddress'),
                    "City" => set_value('City'),
                    "State" =>set_value('State'),
                    "Country"=>set_value('Country'),
                    "PostalCode"=>set_value('userpostalcode'),
                    "DOB"=>$userdob,  
                    "UserRoleID"=>set_value('userrole'),
                    "ReportingTo"=>set_value('reportinguser'),
                    "IsActive"=>set_value('userstatus'),
                    "CreatedBy" => $this->session->userdata['logged_in']['userid'],
                    "CreatedOn" => date("Y-m-d H:s:i"),
                   ); 
              //if(set_value('usergender')=='1') $gender="M";
              //elseif (set_value('usergender')=='2') $gender="F";
              //elseif (set_value('usergender')=='3') $gender="O";
              
                $result = $this->Usermodel->updateuser($form_data,$agent_id);
                //echo $result;
                if($result=="1")
                { 
                  $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-success text-center">User details updated successfully.</div>');
                             redirect('User/edituser/'.$agent_id.'/');
                }
                else
                {
                  $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">Failed to update user details. Try again later</div>');
                  redirect('User/edituser'.$agent_id.'/');
                }
                
            }
          }
          else
          {
                   redirect('login');
          }

      }catch(Exceptions $ex)
      {

      }   
   }        
  function getstate($country_id)
  {
    try
    {
        //echo $country_id;
        $this->load->model('Usermodel');
        $result=$this->Usermodel->get_State($country_id);
        $HTML="<option value='0'>Please Select</option>";
          
              foreach($result as $result){

              $HTML.="<option value='".$result->StateId."'>".ucfirst($result->StateName)."</option>";
            }
          
          echo $HTML;

    }catch(Exceptions $ex)
    {

    }

  }
  function getcity($state_id)
  {
  //echo $state_id;
   try{
         $this->load->model('Usermodel');
         $result=$this->Usermodel->get_City($state_id);
         $HTML="<option value='0'>Please Select</option>";
        foreach($result as $result)
        $HTML.="<option value='".$result->CityId."'>".ucfirst($result->CityName)."</option>";
        echo $HTML;
      }catch(Exceptions $ex)
      {

      }
  
  }
  function get_reportinguser($userroleid)
  {
      try
         {
                $current_user_role = $this->session->userdata['logged_in']['user_role'];
                $userrole=$this->Usermodel->get_user_role();
                $reportinguserdetails=$this->Usermodel->get_reportinguser();

                $HTML .= "<option value =''>----Select---</option>";
                $HTML .= "<option value ='-1'>----None---</option>";

                  $userrole_count = count($userrole);
                  $reportinguser_count = count($reportinguserdetails);
                  for($i=0;$i<$userrole_count;$i++)
                    { 
                      if($userrole[$i]->UserRoleID>=$current_user_role && $userrole[$i]->UserRoleID<$userroleid)
                        {
                          $HTML .= '<optgroup label="'.ucfirst($userrole[$i]->UserRole).'">';
                          for($j=0;$j<$reportinguser_count;$j++)
                          {
                           if($reportinguserdetails[$j]->UserRoleID==$userrole[$i]->UserRoleID)
                            {  
                              $HTML .= "<option value =".$reportinguserdetails[$j]->SystemUserID.">".$reportinguserdetails[$j]->FirstName." ".$reportinguserdetails[$j]->LastName."</option>";
                            }
                          }
                        }                                               
                     }
                   echo $HTML;    
         }
      catch(Exceptions $ex)
         {

         }   
  }  
    public function modifyuserrole()
  {
    try
    {
          if($this->session->userdata('logged_in'))
          {   
               $data['userroleid']=$this->Usermodel->get_user_role();
               //$data["reportinguser"] = $this->Usermodel->get_reportinguser();
               //$assigndetails  =  $this->Usermodel->get_agentdetailslist(); 
               //echo "<pre>";
               //print_r($assigndetails);
               //echo "<pre>";
               //$current_user_role = $this->session->userdata['logged_in']['user_role'];
               //$userid = $this->session->userdata['logged_in']['userid'];
               //$data["agentdetails"]= reportingto($userroleid,$assigndetails,$current_user_role,$userid);
               //echo "<pre>";
               //print_r($data["agentdetails"]);
               //echo "<pre>";
               $this->load->view('User/ModifyUserrole_view',$data);
          }
          else
          {
                   redirect('login');
          }
        }catch(Exceptions $ex)
        {
            
        }    
  }//END OF modifyuser FUNCTION     

  public function edituserrole($agent_id)
  {  
    try
    {
          if($this->session->userdata('logged_in'))
          {    
            $data['id']=$agent_id;
           $data["userroleid"]=$this->Usermodel->get_user_role();
           //$data["userrole"]=$this->Usermodel->get_user_role();
           $data["city"]=$this->Usermodel->get_citydetails();
           $data["state"]=$this->Usermodel->get_statedetails();
           $data["country"]=$this->Usermodel->get_countrydetails();
           $data["reportinguserdetails"]=$this->Usermodel->get_reportinguser(); 
          // print_r($data["reportinguser"]);
           $data["agentdetails"]  =  $this->Usermodel->get_editagentdetails($agent_id);
           $this->load->view('User/EditUser_view',$data);
          }
          else
          {
                   redirect('login');
          }

    }catch(Exceptions $ex)
    {

    }
 }//END OF Edituser FUNCTION
   public function updateuserrole($agent_id)
   {
        try
        {
          if($this->session->userdata('logged_in'))
          {    
            $this->form_validation->set_rules('userrole', 'User Role','required|greater_than[0]');      
            $this->form_validation->set_rules('reportinguser', 'Reporting To ','required');
            $this->form_validation->set_rules('userfname', 'First Name','required|alpha');
            $this->form_validation->set_rules('userlname', 'Last Name','required|alpha');
            $this->form_validation->set_rules('useremail', 'Email','required|valid_email');
            $this->form_validation->set_rules('username', 'User Name','required');
            $this->form_validation->set_rules('userphone', 'Phone no.','required|numeric|max_length[10]|valid_phone_number');
            $this->form_validation->set_rules('Country', 'Country','required|greater_than[0]');
            $this->form_validation->set_rules('State', 'State','required|greater_than[0]');
            $this->form_validation->set_rules('City', 'City','required|greater_than[0]');
            $this->form_validation->set_rules('useraddress', 'Address','required');
            $this->form_validation->set_rules('userstatus', 'Status','required');
            $this->form_validation->set_rules('userpostalcode', 'Pin Code','required|numeric|max_length[6]');
            $this->form_validation->set_rules('userdob', 'Date of Birth','required');

            $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
            if ($this->form_validation->run() == FALSE) // validation hasn't been passed
            { 
               $this->edituser($agent_id);
            }
            else // passed validation proceed to post success logic
            {    $dob = new DateTime(set_value('userdob'));
                  $userdob = $dob->format('Y-m-d');
                $email = set_value('useremail');
                if(set_value('reportinguser')=="-1")
                    $form_data = array(
                    "FirstName" =>set_value('userfname'),
                    "LastName" =>set_value('userlname'),
                    "UserName"=>trim(set_value('username')),
                    "Hash" => md5(trim((strtolower(set_value('userfname'))))),
                    "EmailId" =>$email,
                    "MobileNo" =>set_value('userphone'),
                    "Address" =>set_value('useraddress'),
                    "City" => set_value('City'),
                    "State" =>set_value('State'),
                    "Country"=>set_value('Country'),
                    "PostalCode"=>set_value('userpostalcode'),
                    "DOB"=>$userdob,                
                    "UserRoleID"=>set_value('userrole'),
                    "IsActive"=>set_value('userstatus'),
                    "CreatedBy" => $this->session->userdata['logged_in']['userid'],
                    "CreatedOn" => date("Y-m-d H:s:i"),

                   );
                else 
                 //$reportinguser = set_value('reportinguser'); 
                 $form_data = array(
                    "FirstName" =>set_value('userfname'),
                    "LastName" =>set_value('userlname'),
                    "UserName"=>trim(set_value('username')),
                    "Hash" => md5(trim((strtolower(set_value('userfname'))))),
                    "EmailId" =>$email,
                    "MobileNo" =>set_value('userphone'),
                    "Address" =>set_value('useraddress'),
                    "City" => set_value('City'),
                    "State" =>set_value('State'),
                    "Country"=>set_value('Country'),
                    "PostalCode"=>set_value('userpostalcode'),
                    "DOB"=>$userdob,  
                    "UserRoleID"=>set_value('userrole'),
                    "ReportingTo"=>set_value('reportinguser'),
                    "IsActive"=>set_value('userstatus'),
                    "CreatedBy" => $this->session->userdata['logged_in']['userid'],
                    "CreatedOn" => date("Y-m-d H:s:i"),
                   ); 
              //if(set_value('usergender')=='1') $gender="M";
              //elseif (set_value('usergender')=='2') $gender="F";
              //elseif (set_value('usergender')=='3') $gender="O";
              
                $result = $this->Usermodel->updateuser($form_data,$agent_id);
                //echo $result;
                if($result=="1")
                { 
                  $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-success text-center">User details updated successfully.</div>');
                             redirect('User/edituser/'.$agent_id.'/');
                }
                else
                {
                  $this->session->set_flashdata('msg', '<div id="flash-messages" class="alert alert-danger text-center">Failed to update user details. Try again later</div>');
                  redirect('User/edituser'.$agent_id.'/');
                }
                
            }
          }
          else
          {
                   redirect('login');
          }

      }catch(Exceptions $ex)
      {

      }   
   }
} 
?>






























                    
