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
   function get_totalprospect($userid){
    $sql = "select Count(*) as count from crm_campaigncontacts 
                          join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
                          join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
                          left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID 
                          where AssignedTo = '$userid' 
                          and crm_campaigncontacts.Status != '4' and crm_campaigncontacts.Status != '5'
                          and crm_campaigncontacts.Status = '2'";
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

   function get_totalleads($userid){
    $sql = "select Count(distinct crm_campaigncontacts.CampaignContactID) AS count
from crm_campaigncontacts 
join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID
left join crm_followuplog on crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID
join CityMst ON CityMst.CityId = crm_contacts.CityID 
join StateMst ON StateMst.StateId = CityMst.StateId
where AssignedTo = '$userid'
and crm_campaigncontacts.Status != '4' 
and crm_campaigncontacts.Status != '5'
and crm_campaigncontacts.Status = '3'";
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
   function get_totalfollowups($userid){ 

    $sql = "select Count(distinct crm_campaigncontacts.CampaignContactID) AS count
from crm_campaigncontacts 
join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID
left join crm_followuplog on crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID
join CityMst ON CityMst.CityId = crm_contacts.CityID 
join StateMst ON StateMst.StateId = CityMst.StateId
where AssignedTo = '$userid'
and crm_campaigncontacts.Status != '4' 
and crm_campaigncontacts.Status != '5'
and crm_followuplog.NewFollowupDate = curdate()";
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