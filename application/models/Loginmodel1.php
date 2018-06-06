<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loginmodel extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     //get the username & password from tbl_usrs
     function get_user($usr, $pwd)
     {
           //echo $usr;           
           $this->db->where('username',$usr);
           $this->db->where('hash',md5($pwd));                   
           $this->db->where('IsActive',"1");
   $q= $this->db->get('SystemUsers');  
      if($q->num_rows() > 0)
     {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      //print_r($data);
      return $data;
    }
    else{
      return FALSE;
    }
     }
   function get_totalprospect(){
    $sql = "SELECT COUNT(*) AS count FROM `crm_campaigncontacts` WHERE ContactType='prospect'";
    $q = $this->db->query($sql);
     if($q->num_rows() > 0)
     {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      //print_r($data);
      return $data;
    }
    else{
      return FALSE;
    }
   } 

   function get_totalleads(){
    $sql = "SELECT COUNT(*) AS count FROM `crm_campaigncontacts` WHERE ContactType='lead'";
    $q = $this->db->query($sql);
     if($q->num_rows() > 0)
     {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      //print_r($data);
      return $data;
    }
    else{
      return FALSE;
    }

   }
   function get_totalfollowups(){

    $sql = "SELECT COUNT(*) As count FROM `crm_campaigncontacts` WHERE Status='3'";
    $q = $this->db->query($sql);
     if($q->num_rows() > 0)
     {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      //print_r($data);
      return $data;
    }
    else{
      return FALSE;
    }

   } 

     
}?>