<?php
  ini_set('max_execution_time', 0);
  ini_set('memory_limit', '-1');

  class Search_contact extends CI_Controller {

     public function __construct() {
        parent:: __construct();
        $CI = &get_instance();
        $this->db = $CI->load->database('connection2', TRUE);
        $this->load->helper("url");
        $this->load->model("Search_model");
        //$this->load->library("pagination");
       // $this->output->enable_profiler(TRUE);

    }

    public function index(){

    $this->load->model('Search_model');
    
    $data['university'] = $this->Search_model->select_university();

    $data['course'] = $this->Search_model->select_course();

    $data['category'] = $this->Search_model->select_category();

    $data['state'] = $this->Search_model->select_state();

    $data['city'] = $this->Search_model->select_city();

    $data['campaign'] = $this->Search_model->select_campaign();

    $this->load->view("Search/Search_contact_view",$data);
    
    }//index end here

    public function search(){

      $data['university'] = $this->input->post('university');
      $university ='';
      if ($this->input->post('university') != ''){
      $university = implode(',', $data['university']);

      }
      
      $course = '';
      $data['course'] = $this->input->post('course');
      if ($this->input->post('course') != ''){
      $course = implode(',', $data['course']);
      }
    

      $category = '';
      $data['category'] = $this->input->post('category');
      if ($this->input->post('category') != ''){
      $category = implode(',', $data['category']);
      }
    
      
      
      $state = '';
      $data['state'] = $this->input->post('State');
      if ($this->input->post('State') != ''){
      $state = implode(',', $data['state']);
      }
      
      

      $from = $this->input->post('from');
      $to = $this->input->post('to');
      $type = $this->input->post('Type');
      $gender = $this->input->post('gender');

      
      $this->load->model('Search_model');
      
      $data['result'] = $this->Search_model->find_university($university,$data['course'],$category,$state,$from,$to,$type,$gender);

      $query = $this->Search_model->find_university($university,$data['course'],$category,$state,$from,$to,$type,$gender);
      
      $count = $this->Search_model->count_result($university,$data['course'],$category,$state,$from,$to,$type,$gender);

	  //echo $count;

      //$data['campaign'] = $this->Search_model->select_campaign();

   

     
     $sessiondata = array(
                      'query' => $query,
                      'count' => $count,
                      'university'=>$university,
                      'course'=>$course,
                      'category'=>$category,
                      'state'=>$state,
                      'from'=>$from,
                      'to'=>$to,
                      'type'=>$type,
                      'gender'=>$gender                     
                    );     
		
	var_dump($sessiondata);
		
      $this->session->set_userdata($sessiondata);

      redirect("pagination");




      //$this->load->view('Search/pagination_result',$data,$university,$course,$category,$city,$from,$to);

    }//function search ends here


    public function add_contact(){
    $CI = &get_instance();
    $this->db2 = $CI->load->database('default', TRUE);
    //print_r($this->input->post());
  
    $checked = $this->input->post('add');
  
    $source = 'Direct';
    
    $count = count($this->input->post('add'));

    if($this->input->post('Add_all_contact') != ''){


      $sql= $this->input->post('query');

      $query = $this->db->query($sql);
     
     //print_r($query->result());

    foreach ($query->result() as $row) {
      
        $CI = &get_instance();
    $this->db2 = $CI->load->database('default', TRUE);



      $firstname= $row->firstname;
      $lastname = $row->lastname;
      $gender =  $row->Gender;
      $dob =  $row->DOB;
      $email =  $row->emailid;
      $email =   $this->db->escape($email);
      $mobile =  $row->mobileno;
      $city =  $row->CityId;
      $source = 'Direct';
      $campaign = $this->input->post('campaign');


      $this->db2->query("insert ignore into crm_contacts (FirstName,LastName,Gender,DateofBirth,Email,EmailStatus,Phone,CityID,SourceID,SourceName,CreatedOn ) values ('$firstname','$lastname','$gender','$dob',$email,'0','$mobile','$city','1','UMS',now())");

      $id = $this->db2->insert_id();

       if ($id==0){
          
          $id = $this->db2->query("select ContactsID from crm_contacts where Phone = '$mobile'");
          if ($id->num_rows() > 0){
            $row = $id->row(); 
            $id = $row->ContactsID;
           // echo $id.'<br>';
          }
        }


        $findcampaigncontact = $this->db2->query("select * from  crm_campaigncontacts where ContactsID = '$id' AND CampaignID = '$campaign'");
        
        if ($findcampaigncontact->num_rows()>0){
          
          $findcampaigncontact = $findcampaigncontact->row();
         
        
        }else{

        $sql = $this->db2->query("insert  into crm_campaigncontacts(CampaignID,ContactsID,ContactType,AssignedTo,Status,DateAdded)
          values('$campaign','$id','Prospect','0','1',now())");

      }

    }

    if ($this->db2->affected_rows() == '1'){
    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><?= $count; ?> Contacts added Successfully</div>');
    redirect('Search_contact');
  }
     $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><?= $count; ?>Already in campaign</div>');
    redirect('Search_contact');

  



    }else{
      $firstname_arr =$this->input->post('firstname') ;
      $lastname_arr = $this->input->post('lastname');
      $gender_arr = $this->input->post('gender') ;
      $dob_arr = $this->input->post('DOB') ;
      $email_arr = $this->input->post('email') ; 
      $mobile_arr = $this->input->post('mobile') ;
      $city_arr = $this->input->post('city') ;
      $campaign_arr = $this->input->post('campaign') ;





      for($i=0;$i<count($checked);$i++){
        
        $firstname = $firstname_arr[$i];
        $lastname = $lastname_arr[$i];
        $gender = $gender_arr[$i];
        $dob = $dob_arr[$i];
        $email = $email_arr[$i];
        $email =   $this->db->escape($email);
        $mobile = $mobile_arr[$i];
        $city = $city_arr[$i];
        $source = 'Direct';
        
        $this->db2->query("insert ignore into crm_contacts (FirstName,LastName,Gender,DateofBirth,Email,EmailStatus,Phone,CityID,SourceID,SourceName,CreatedOn ) values ('$firstname','$lastname','$gender','$dob',$email,'0','$mobile','$city','1','UMS',now())");

        $id = $this->db2->insert_id();

        if ($id==0){
          
          $id = $this->db2->query("select ContactsID from crm_contacts where Phone = '$mobile'");
          if ($id->num_rows() > 0){
            $row = $id->row(); 
            $id = $row->ContactsID;
          }
        }

       // echo $id;

        $findcampaigncontact = $this->db2->query("select * from  crm_campaigncontacts where ContactsID = '$id' AND CampaignID = '$campaign_arr'");
        
        if ($findcampaigncontact->num_rows()>0){
          
          $findcampaigncontact = $findcampaigncontact->row();
         
        
        }else{

        $sql = $this->db2->query("insert  into crm_campaigncontacts(CampaignID,ContactsID,ContactType,AssignedTo,Status,DateAdded)
          values('$campaign_arr','$id','Prospect','0','1',now())");

      }

    

      
    }





    if ($this->db->affected_rows() == '0'){
    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><?= $count; ?> Contacts added Successfully</div>');
    redirect('Search_contact');
  }
     $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><?= $count; ?>Already in campaign</div>');
    redirect('Search_contact');

  }
    
  }//add contact ends here



} 

?>

