<?php
  ini_set('max_execution_time', 0);
  ini_set('memory_limit', '-1');
  defined('BASEPATH')OR exit('No direct script access allowed');

  class Lurningo_search extends CI_Controller{
    function __construct(){
      
      parent::__construct();
      $this->load->library('form_validation'); 
      $this->load->library('session');
      $this->load->library('pagination');
      $this->load->model('Search_model'); 
    }
    
    public function index(){

      if($this->session->userdata('logged_in')){

        $this->load->model('Lurningo_search_model');
        $data['campaign_list'] = $this->Lurningo_search_model->Search_campaign();
        $data['Lead_status'] = $this->Lurningo_search_model->Lead_status();
        $data['state'] = $this->Lurningo_search_model->State_list();
        $data['university'] = $this->Search_model->select_university();
        $data['course'] = $this->Search_model->select_course();
        $data['city'] = $this->Search_model->select_city();
        $data['campaign'] = $this->Search_model->select_campaign();
        $data['State'] = $this->Search_model->select_state();
		$data['Reason'] = $this->Search_model->select_dropreason();	


        $this->load->view('Search/Lurningo_search_view',$data);
      

      }else{
        
        redirect('login');
      }

    }//index function ends here

    public function Search(){

      $data['campaign_id'] = $this->input->post('campaign');
      $campaign_id ='';
      if ($this->input->post('campaign') != ''){
        $campaign_id = implode(',', $data['campaign_id']);
      }
      
      $type = $this->input->post('Type');
      
      $data['lead_status'] = $this->input->post('lead_status');
      
      $lead_status ='';
      if ($this->input->post('lead_status') != ''){
        $lead_status = implode(',', $data['lead_status']);
      }

      $gender = $this->input->post('gender');
      
      $data['state'] = $this->input->post('State');
      
      $state ='';
      
      if ($this->input->post('State') != ''){
        $state = implode(',', $data['state']);
      }
      
      $drop_reason = '';
      $data['drop_reason'] = $this->input->post('drop_reason');
      if ($this->input->post('drop_reason') != ''){
        $drop_reason = implode(',', $data['drop_reason']);
      }

      $ContactsID ='';

      $this->load->model('Lurningo_search_model');
      
      $data['result'] = $this->Lurningo_search_model->Search($campaign_id,$state,$lead_status,$gender,$type,$drop_reason);
      
      $data['campaign'] = $this->Lurningo_search_model->select_campaign();
      $sessiondata = array(
                      'query' => $data['result']['query'],
                      'count' => $data['result']['count'],
                      'campaign' => $campaign_id,
                      'lead_status' => $lead_status,                 
                      'state' => $state,                
                      'drop_reason' => $drop_reason,                
                      'type' => $type,                
                      'gender' => $gender                 
                    );
                    
      $this->session->set_userdata($sessiondata);
      
      redirect("Lurningo_search/result");
      
      //var_dump($data['result']);

      //$this->load->view("Search/Search_result",$data);

    }//function search ends here
    
    public function result(){
          $query = $this->session->userdata('query');
          $count = $this->session->userdata('count');
          
          
          $config['base_url'] = site_url('Lurningo_search/result');
          $config['total_rows'] = $count;
          $config['per_page'] = "200";
          $config["uri_segment"] = 3;
          $choice = $config["total_rows"]/$config["per_page"];
          $config["num_links"] = floor($choice);
          $config['full_tag_open'] = '<ul class="pagination">';
          $config['full_tag_close'] = '</ul>';
          $config['first_link'] = false;
          $config['last_link'] = false;
          $config['first_tag_open'] = '<li>';
          $config['first_tag_close'] = '</li>';
          $config['prev_link'] = '«';
          $config['prev_tag_open'] = '<li class="prev">';
          $config['prev_tag_close'] = '</li>';
          $config['next_link'] = '»';
          $config['next_tag_open'] = '<li>';
          $config['next_tag_close'] = '</li>';
          $config['last_tag_open'] = '<li>';
          $config['last_tag_close'] = '</li>';
          $config['cur_tag_open'] = '<li class="active"><a href="#">';
          $config['cur_tag_close'] = '</a></li>';
          $config['num_tag_open'] = '<li>';
          $config['num_tag_close'] = '</li>';
          $this->pagination->initialize($config);
          $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
          $limit = $config['per_page'];
          $start = $data['page'];
          $sql = $this->db->query( $query.'limit  '.$start.','.$limit);
          $data['result'] = $sql->result();
          $data['count'] = $count;
          $data['pagination'] = $this->pagination->create_links();
          $data['campaign'] = $this->Search_model->select_campaign();
          $data['query'] =  $this->session->userdata('query');
          $data['campaign_name'] =  $this->session->userdata('campaign');
          $data['lead_status'] =  $this->session->userdata('lead_status');
          $data['state'] =  $this->session->userdata('state');
          $data['drop_reason'] =  $this->session->userdata('drop_reason');
          $data['type'] =  $this->session->userdata('type');
          $data['gender'] =  $this->session->userdata('gender');
          
          $this->load->view('Search/Search_result',$data);
    }

    public function Add_Campaign_Contacts(){
      
       if($this->input->post('Add_all_contact') != ''){
          
          $sql= $this->input->post('query');
          $campaign_id = $this->input->post('campaign');
          $query = $this->db->query($sql)->result();
          foreach ($query as $row) {
            
            $ContactsID = $row->ContactsID;
            $findcampaigncontact = $this->db->query("select * from  crm_campaigncontacts where ContactsID = '$ContactsID' AND CampaignID = '$campaign_id'");

            if ($findcampaigncontact->num_rows()>0){
              $findcampaigncontact = $findcampaigncontact->row();
             
            }else{
              $sql = $this->db->query("insert  into crm_campaigncontacts(CampaignID,ContactsID,ContactType,AssignedTo,Status,DateAdded)
                                      values('$campaign_id','$ContactsID','Prospect','0','1',now())");
            }
          }
          
        if ($this->db->affected_rows() == '1'){
          $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><?= $count; ?> Contacts added Successfully</div>');
          redirect('Lurningo_search');
        }
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><?= $count; ?>Already in campaign</div>');
          redirect('Lurningo_search');

      }else{

        $data['ContactsID'] = $this->input->post('ContactsID');
        $ContactsID ='';
        if ($this->input->post('ContactsID') != ''){
          $ContactsID = implode(',', $data['ContactsID']);
        }

        $campaign_id = $this->input->post('campaign');

        $sql = $this->db->query("select crm_contacts.ContactsID from crm_contacts where crm_contacts.ContactsID IN ($ContactsID)")->result();
      
        foreach ($sql as $row) {
          $ContactsID = $row->ContactsID;
          $findcampaigncontact = $this->db->query("select * from  crm_campaigncontacts where ContactsID = '$ContactsID' AND CampaignID = '$campaign_id'");

          if ($findcampaigncontact->num_rows()>0){
            $findcampaigncontact = $findcampaigncontact->row();
           
          }else{
            $sql = $this->db->query("insert  into crm_campaigncontacts(CampaignID,ContactsID,ContactType,AssignedTo,Status,DateAdded)
                                      values('$campaign_id','$ContactsID','Prospect','0','1',now())");
          }
        }

        if ($this->db->affected_rows() == '1'){
          $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><?= $count; ?> Contacts added Successfully</div>');
          redirect('Lurningo_search');
        }
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><?= $count; ?>Already in campaign</div>');
          redirect('Lurningo_search');
        
        }
      }
    
    }

?>
