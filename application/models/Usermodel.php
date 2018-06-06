<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

  function get_user_role()
  {
    $sql = "SELECT * FROM system_user_roles";
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
  function get_reportinguser()
  {
    $sql = "SELECT * FROM SystemUsers WHERE UserRoleID <> '3'";
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

    function get_agentdetailslist()
  {
    
   $sql = "SELECT S.SystemUserID, S.UserName, S.EmailId,S.FirstName,S.LastName,S.MobileNo,S.Address,S.DOB,S.IsActive,
            S.Address, S.City,S.State,S.Country,S.ReportingTo,S.UserRoleID,
            (SELECT UserRole From system_user_roles Where UserRoleID = S.UserRoleID) as UserRole,
            (SELECT FirstName From SystemUsers Where SystemUserID = S.ReportingTo) as ReportingFName,
            (SELECT LastName From SystemUsers Where SystemUserID = S.ReportingTo) as ReportingLName
             From SystemUsers  S";
           
   $q= $this->db->query($sql);
 

    /* all the queries relating to the data we want to retrieve will go in here. */

    /* after we've made the queries from the database, we will store them inside a variable called $data, and return the variable to the controller */
    if($q->num_rows() > 0)
    {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
  }
  function get_editagentdetails($agent_id){
    $sql = "SELECT *  From SystemUsers  Where SystemUserID = '$agent_id'";
           
   $q= $this->db->query($sql);
    /* all the queries relating to the data we want to retrieve will go in here. */
    /* after we've made the queries from the database, we will store them inside a variable called $data, and return the variable to the controller */
    if($q->num_rows() > 0)
    {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      return $data;
    }    
 }
 function createuser($form_data){
  $this->db->where('MobileNo',$form_data['MobileNo']);
   $q= $this->db->get('SystemUsers');
   if($q->num_rows() > 0)
   {
       return FALSE;
    }          
    else
    {

         $this->db->insert('SystemUsers', $form_data);     
           if ($this->db->affected_rows() == '1')
             {
             return TRUE;
             }
             else
             {
              return FALSE; 
             }
    }
 } 
 function get_citydetails(){
    $this->db->order_by("CityName","asc");  
    $q= $this->db->get('CityMst');
    /* all the queries relating to the data we want to retrieve will go in here. */
    /* after we've made the queries from the database, we will store them inside a variable called $data, and return the variable to the controller */
    if($q->num_rows() > 0)
    {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      return $data;
    }       
 }
 function get_statedetails(){
    $this->db->order_by("StateName","asc");  
    $q= $this->db->get('StateMst');
    /* all the queries relating to the data we want to retrieve will go in here. */
    /* after we've made the queries from the database, we will store them inside a variable called $data, and return the variable to the controller */
    if($q->num_rows() > 0)
    {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      return $data;
    }       
 }
 function get_countrydetails(){
    $this->db->order_by("CountryName","asc");  
    $q= $this->db->get('CountryMst');
    /* all the queries relating to the data we want to retrieve will go in here. */
    /* after we've made the queries from the database, we will store them inside a variable called $data, and return the variable to the controller */
    if($q->num_rows() > 0)
    {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      return $data;
    }       
 }

  function get_city($state_id){
    $this->db->order_by("CityName","asc");
    $this->db->where('StateId', $state_id);  
    $q= $this->db->get('CityMst');
    /* all the queries relating to the data we want to retrieve will go in here. */
    /* after we've made the queries from the database, we will store them inside a variable called $data, and return the variable to the controller */
    if($q->num_rows() > 0)
    {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      return $data;
    }       
 }
 function get_state($country_id){
    $this->db->order_by("StateName","asc");
    $this->db->where('CountryId', $country_id);  
    $q= $this->db->get('StateMst');
    /* all the queries relating to the data we want to retrieve will go in here. */
    /* after we've made the queries from the database, we will store them inside a variable called $data, and return the variable to the controller */
    if($q->num_rows() > 0)
    {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      return $data;
    }       
 }
function updateuser($form_data,$agent_id)
{
  $this->db->where('SystemUserID', $agent_id);
$query = $this->db->update('SystemUsers', $form_data);
//$i= $this->db->affected_rows();
return $query;//$i; 
}
     
}?>