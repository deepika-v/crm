<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Querymodel extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }
 
 function createresult(){
  echo "in model";
    $sql = "SELECT * FROM ums.v_leads";
    $q = $this->db->query($sql);
    print_r($q);
    if($q->num_rows>0){
  foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      print_r($data);
 }
 } 

}?>