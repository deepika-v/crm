<?php
	ini_set('max_execution_time', 0);
	ini_set('memory_limit', '-1');
	class Pagination extends CI_Controller{
		 
		 
		 public function __construct(){
			parent::__construct();
	        $this->load->helper('form');
	        $this->load->helper('url');
	        $CI = &get_instance();
	        $this->db = $CI->load->database('connection2',TRUE);
	        $this->load->database();
	        $this->load->library('pagination');
	        

	        $this->load->model('Search_model');		       
		}


		public function index(){
			if($this->session->userdata('logged_in')){
			//var_dump($this->session->userdata('count'));

			$query = $this->session->userdata('query');
			
			$count = $this->session->userdata('count');

		

			//pagination settings
	        $config['base_url'] = site_url('pagination/index');
	        $config['total_rows'] = $count;
	        $config['per_page'] = "200";
	        $config["uri_segment"] = 3;
	        $choice = $config["total_rows"]/$config["per_page"];
	        $config["num_links"] = floor($choice);

	         // integrate bootstrap pagination
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

	        $sql = $this->db->query( $query.'        limit  '.$start.','.$limit);

	       
	        $data['result'] = $sql->result();
	        $data['count'] = $count;

	       
	        
	        $data['pagination'] = $this->pagination->create_links();



	        $data['campaign'] = $this->Search_model->select_campaign();

          $data['query'] =  $this->session->userdata('query');
	        
	        // load view
	        $this->load->view('Search/pagination_result',$data);
			}else{
		  redirect(base_url("login"));
		}
		}
		
		    function generate_csv(){

        $query = $this->session->userdata('query');
        
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');

        $query = $this->db->query($query);
        $row_count=$this->db->affected_rows();
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('Search_contacts.csv', $data);
    }
	}
?>
