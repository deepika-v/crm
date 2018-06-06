<?php
  class Search_model extends CI_Model {

    function __construct(){
    $CI = &get_instance();
    $this->db = $CI->load->database('connection2', TRUE);  
  }

    public function select_university(){
      $query = $this->db->get('v_gen_university');
      return $query->result();
    }

    public function select_course(){
       $this->db->select("DISTINCT(CourseName)");
       $this->db->order_by("CourseName","asc");
      $query = $this->db->get('v_acd_course');

      return $query->result();
    }

    public function select_category(){

     // $query = $this->db->get('v_acd_category');

      //return $query->result();
    }

    public function select_state(){
	   $this->db->from('v_gen_state');
       $this->db->order_by("StateName","asc");
       $query = $this->db->get();
	   return $query->result();
    }

    public function select_city(){

       $this->db->from('v_gen_city');
       $this->db->order_by("CityName","asc");
      $query = $this->db->get();
      return $query->result();
    }

    public function select_campaign(){
      $db = $this->load->database('default',TRUE);
      $db->select('*');
      $db->from('crm_campaign');
      $db->where('Status','active');
      $query = $db->get();
      return $query->result();
    }
    
    public function select_dropreason(){
      $db = $this->load->database('default',TRUE);
      $db->select('*');
      $db->from('crm_dropreasons');
      $query = $db->get();
      return $query->result();
    }

    public function find_user($limit, $start){
      $this->db->limit($limit, $start);
      $University = 'ANU';
      $this->db->select('*');
      $this->db->from('v_leads');
      $this->db->join('v_gen_city','v_gen_city.CityID = v_leads.CityID','left');
      $this->db->where('University',$University);
      $query = $this->db->get();
      
      if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    
    public function result_count(){
      $University = 'ANU';
      $this->db->select('*');
      $this->db->from('v_leads');
      $this->db->join('v_gen_city','v_gen_city.CityID = v_leads.CityID','left');
      $this->db->where('University',$University);
      $num_results = $this->db->count_all_results();
      
      return $num_results;
    }

    public function getuser($params) 
        {

        $university = $params['university'];
        $course = $params['course'];
        $category = $params['category'];
        //$state = $params['state'];
        $city = $params['city'];
        $from = $params['from'];
        $to = $params['to'];
                
        //echo $from , $to;

        $this->db->select('*');
        $this->db->from('v_leads');
        $this->db->where('1 = 1');


        if ($city != '') {
            $this->db->where('CityName', $city);
        }

        if ($university != '') {
            $this->db->where('University', $university);
        }
        if ($course != '') {
            $this->db->where('Course', $course);
        }
        if ($category != '') {
            $this->db->where('Category', $category);
        }

         if ($from != ''){

          //echo "in model".$from;
          $this->db->query('SELECT * FROM v_leads WHERE TIMESTAMPDIFF(YEAR, DOB, CURDATE()) >= "$from"');
        }

        if ($to != '') {
          $this->db->query('SELECT * FROM v_leads WHERE TIMESTAMPDIFF(YEAR, DOB, CURDATE()) <= "$to"');
        }
        
        
        $data = $this->db->get();
        return $data->result();
        }

        public function count($params){
        $university = $params['university'];
        $course = $params['course'];
        $category = $params['category'];
        //$state = $params['state'];
        
        $city = $params['city'];
        $from = $params['from'];
        $to = $params['to'];
        

        $this->db->select('*');
        $this->db->from('v_leads');
        $this->db->where('1 = 1');


        if ($city != '') {
            $this->db->where('CityName', $city);
        }

        if ($university != '') {
            $this->db->where('University', $university);
        }
        if ($course != '') {
            $this->db->where('Course', $course);
        }
        if ($category != '') {
            $this->db->where('Category', $category);
        }
        

        $num_results = $this->db->count_all_results();
      
      return $num_results;
        }


        public function insert($dataSet,$campaign){

          $db = $this->load->database('default',TRUE);
          $db->insert_batch('crm_contacts', $dataSet);



          return $this->db->insert_id();

          $data = array(
         'ContactsID' => $this->db->insert_id(),
         'CampaignID' => $campaign
            );
          $db = $this->load->database('default',TRUE);
          $db->insert('crm_campaigncontacts',$data);
          print_r($data);
          
        }



        public function find_university($university,$course,$category,$state,$from,$to,$type,$gender){

          $result = array();
          
          $keyword_tokens = explode(',', $university);

          //$course_tokens = explode(',', $course);

          $category_tokens = explode(',', $category);

          $state_tokens = explode(',', $state);
          
          $sql = "SELECT * FROM v_leads ";
          
          $sql .="WHERE Gender LIKE '%$gender' AND Type LIKE '%$type' AND (University LIKE'%";
        
          $sql .= implode("%' OR University LIKE '%", $keyword_tokens) ."') AND (Course LIKE '%";

          $sql .= implode("%' OR Course LIKE '%", $course) ."') AND (Category LIKE '%";

          $sql .= implode("%' OR Category LIKE '%", $category_tokens) ."'";
          
          if(!empty($state)){
				
				$sql .= ") AND (StateName LIKE '%";
				$sql .= implode("' OR StateName LIKE '%", $state_tokens) . "'";
			  }

         // $sql .= implode("' OR StateName LIKE '%", $state_tokens) . "'";

          
       

          if(!empty($from) && !empty($to)){

          $sql .= ")AND TIMESTAMPDIFF(YEAR, DOB, CURDATE()) >= $from AND TIMESTAMPDIFF(YEAR, DOB, CURDATE()) <= $to  ";
          
          }
          
          else{
            $sql .= ")";
          }

          return $sql;

         // $query =  $this->db->query($sql);

          //return $query->result();
        }

        public function count_result($university,$course,$category,$state,$from,$to,$type,$gender){

          $result = array();
          
          $keyword_tokens = explode(',', $university);

          //$course_tokens = explode(',', $course);

          $category_tokens = explode(',', $category);

          $state_tokens = explode(',', $state);
          
          $sql = "SELECT * FROM v_leads ";
          
          $sql .="WHERE Gender LIKE '%$gender' AND Type LIKE '%$type' AND (University LIKE'%";
        
          $sql .= implode("%' OR University LIKE '%", $keyword_tokens) ."') AND (Course LIKE '%";

          $sql .= implode("%' OR Course LIKE '%", $course) ."') AND (Category LIKE '%";

          $sql .= implode("%' OR Category LIKE '%", $category_tokens) ."'";
          
          if(!empty($state)){
				
				$sql .= ") AND (StateName LIKE '%";
				$sql .= implode("' OR StateName LIKE '%", $state_tokens) . "'";
			  }

          //$sql .= implode("' OR StateName LIKE '%", $state_tokens) . "'";

          if(!empty($from) && !empty($to)){

          $sql .= ")AND TIMESTAMPDIFF(YEAR, DOB, CURDATE()) >= $from AND TIMESTAMPDIFF(YEAR, DOB, CURDATE()) <= $to";
          
          }else{
            $sql .= ")";
          }

          

         $query =  $this->db->query($sql);

          return $query->num_rows();
        }

}
?>




