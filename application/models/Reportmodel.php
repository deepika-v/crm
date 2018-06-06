<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportmodel extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     //get the username & password from tbl_usrs
    function get_campaign($userrole,$userid)
    {
      $sql='';
      if($userrole!="1")
    $sql = "SELECT distinct (crm_campaign.CampaignID), crm_campaign.CampaignName
            FROM `crm_campaign`
            Join crm_campaigncontacts ON crm_campaigncontacts.CampaignID = crm_campaign.CampaignID
            WHERE crm_campaign.Status='active'
            And crm_campaigncontacts.AssignedTo = '$userid' 
           ORDER BY CampaignName";
     else 
     $sql = "SELECT * FROM `crm_campaign`
             WHERE crm_campaign.Status='active'
             ORDER BY CampaignName";     
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
  function get_totalcount_leads($CampaignID,$date1,$date2){
    $sql = "SELECT COUNT(*) AS count 
            FROM `crm_campaigncontacts` 
            WHERE CampaignID='$CampaignID' 
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')";
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
   function get_totalclosed_leads($CampaignID,$date1,$date2){
    $sql = "SELECT COUNT(*) AS count 
            FROM `crm_campaigncontacts` 
            WHERE Status='4' and CampaignID='$CampaignID' 
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')";
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
   function get_totaldropped_leads($CampaignID,$date1,$date2){
    $sql = "SELECT COUNT(*) AS count 
            FROM `crm_campaigncontacts` 
            WHERE Status='5' 
            AND CampaignID='$CampaignID' 
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')";
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
   function get_totalfollowups($CampaignID,$date1,$date2){

    $sql = "SELECT COUNT(*) As count 
            FROM `crm_campaigncontacts` 
            WHERE (Status='3'||Status='2'||Status='1') 
            AND CampaignID='$CampaignID'
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')";
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
   function get_campaigntotalcontactdetails($campaignid,$date1,$date2){

    $sql = "SELECT crm_contacts.FirstName, crm_contacts.LastName,crm_contacts.Email,
            crm_contacts.Phone,crm_leadstatus.LeadStatus, crm_campaigncontacts.Status,
            SystemUsers.FirstName as agentfname, SystemUsers.LastName as agentlname,
            SystemUsers.SystemUserID as agentid, StateMst.StateName 
            FROM crm_campaigncontacts
            JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
            LEFT JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaigncontacts.AssignedTo
            JOIN crm_leadstatus ON crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status
            LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
            LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
           WHERE CampaignID='$campaignid' 
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')
            ORDER BY crm_contacts.FirstName";
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
   function get_campaignfollowup_contactdetails($campaignid,$date1,$date2){

    $sql = "SELECT crm_contacts.FirstName, crm_contacts.LastName,crm_contacts.Email,
            crm_contacts.Phone,crm_leadstatus.LeadStatus, crm_campaigncontacts.Status,
            SystemUsers.FirstName as agentfname, SystemUsers.LastName as agentlname,
            SystemUsers.SystemUserID as agentid, StateMst.StateName 
            FROM crm_campaigncontacts
            JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
            LEFT JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaigncontacts.AssignedTo
            JOIN crm_leadstatus ON crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status
            LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
            LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
            WHERE (Status='3'||Status='2'||Status='1') 
            AND CampaignID='$campaignid'
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')
            ORDER BY crm_contacts.FirstName";
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
   function get_campaignclosedcontactdetails($campaignid,$date1,$date2){
    $sql = "SELECT DISTINCT(crm_contacts.FirstName), crm_contacts.LastName,crm_contacts.Email,
            crm_contacts.Phone,crm_leadstatus.LeadStatus, crm_campaigncontacts.Status,
            SystemUsers.FirstName as agentfname, SystemUsers.LastName as agentlname,
            SystemUsers.SystemUserID as agentid, StateMst.StateName ,
            Date(crm_followuplog.FollowupDate) As FollowupDate,Remarks,
            crm_dropreasons.DropReason
            FROM crm_campaigncontacts
            JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
            LEFT JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaigncontacts.AssignedTo
            LEFT JOIN crm_followuplog ON crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID
            Left JOIN crm_dropreasons ON crm_dropreasons.DropReasonId = crm_followuplog.DropReasonId
            JOIN crm_leadstatus ON crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status
            LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
            LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
            WHERE crm_followuplog.FollowupDate = (Select Max(FollowupDate) FROM crm_followuplog WHERE crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID)
            AND crm_campaigncontacts.Status='4' and crm_campaigncontacts.CampaignID='$campaignid' 
            AND (crm_campaigncontacts.DateLeadConverted BETWEEN  '$date1' AND '$date2')
            ORDER BY crm_contacts.FirstName";
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
   function get_campaigndroppedcontactdetails($campaignid,$date1,$date2)
   {

           $sql = "SELECT  crm_contacts.FirstName, crm_contacts.LastName,crm_contacts.Email,
            crm_contacts.Phone,crm_leadstatus.LeadStatus, crm_campaigncontacts.Status,
            SystemUsers.FirstName as agentfname, SystemUsers.LastName as agentlname,
            SystemUsers.SystemUserID as agentid, StateMst.StateName ,
            Date(crm_followuplog.FollowupDate) As FollowupDate, crm_followuplog.NewFollowupDate,Remarks,
            crm_dropreasons.DropReason
            FROM crm_campaigncontacts
            JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
            LEFT JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaigncontacts.AssignedTo
            LEFT JOIN crm_followuplog ON crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID
            Left JOIN crm_dropreasons ON crm_dropreasons.DropReasonId = crm_followuplog.DropReasonId
            JOIN crm_leadstatus ON crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status
            LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
            LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
            WHERE crm_campaigncontacts.Status='5'
            AND crm_followuplog.FollowupDate = (Select Max(FollowupDate) FROM crm_followuplog WHERE crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID)
            AND CampaignID='$campaignid' 
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')
            ORDER BY crm_contacts.FirstName";
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
 function get_agentdetails($userrole)
 {
    $sql = "SELECT *  FROM `SystemUsers` WHERE IsActive='1' AND UserRoleID >='$userrole' ORDER BY FirstName";
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
      else
      {
        return FALSE;
      }
   } 
   function get_agenttotalcount_leads($agentid,$date1,$date2){
    $sql = "SELECT COUNT(*) AS count 
            FROM `crm_campaigncontacts` 
            WHERE  AssignedTo='$agentid' 
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')";
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
   function get_agenttotalcontactdetails($agentid,$date1,$date2){

    $sql = "SELECT crm_contacts.FirstName, crm_contacts.LastName,crm_contacts.Email,
            crm_contacts.Phone,crm_leadstatus.LeadStatus, crm_campaigncontacts.Status,
            SystemUsers.FirstName as agentfname, SystemUsers.LastName as agentlname,
            SystemUsers.SystemUserID as agentid, StateMst.StateName 
            FROM crm_campaigncontacts
            JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
            LEFT JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaigncontacts.AssignedTo
            JOIN crm_leadstatus ON crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status
            LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
            LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
            WHERE  AssignedTo='$agentid' 
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')
            ORDER BY crm_contacts.FirstName";
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
   function get_agenttotalclosed_leads($agentid,$date1,$date2){
    $sql = "SELECT COUNT(*) AS count 
            FROM `crm_campaigncontacts` 
            WHERE Status='4'
            AND AssignedTo='$agentid'
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')";
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
    function get_agenttotalclosed_contactdetails($agentid,$date1,$date2){

    $sql = "SELECT  DISTINCT(crm_contacts.FirstName), crm_contacts.LastName,crm_contacts.Email,
            crm_contacts.Phone,crm_leadstatus.LeadStatus, crm_campaigncontacts.Status,
            SystemUsers.FirstName as agentfname, SystemUsers.LastName as agentlname,
            SystemUsers.SystemUserID as agentid, StateMst.StateName ,
            Date(crm_followuplog.FollowupDate) As FollowupDate,Remarks,
            crm_dropreasons.DropReason
            FROM crm_campaigncontacts
            JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
            LEFT JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaigncontacts.AssignedTo
            LEFT JOIN crm_followuplog ON crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID
            Left JOIN crm_dropreasons ON crm_dropreasons.DropReasonId = crm_followuplog.DropReasonId
            JOIN crm_leadstatus ON crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status
            LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
            LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
            WHERE crm_followuplog.FollowupDate = (Select Max(FollowupDate) FROM crm_followuplog WHERE crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID)
            AND AssignedTo='$agentid' 
            AND crm_campaigncontacts.Status='4'
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')
            ORDER BY crm_contacts.FirstName";
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
   function get_agenttotaldropped_leads($agentid,$date1,$date2){
    $sql = "SELECT COUNT(*) AS count 
            FROM `crm_campaigncontacts` 
            WHERE Status='5' 
            AND AssignedTo='$agentid'
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')";
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
    function get_agenttotaldropped_contactdetails($agentid,$date1,$date2)
    {

    $sql = "SELECT  crm_contacts.FirstName, crm_contacts.LastName,crm_contacts.Email,
            crm_contacts.Phone,crm_leadstatus.LeadStatus, crm_campaigncontacts.Status,
            SystemUsers.FirstName as agentfname, SystemUsers.LastName as agentlname,
            SystemUsers.SystemUserID as agentid, StateMst.StateName ,
            Date(crm_followuplog.FollowupDate) As FollowupDate, crm_followuplog.NewFollowupDate,Remarks,
            crm_dropreasons.DropReason
            FROM crm_campaigncontacts
            JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
            LEFT JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaigncontacts.AssignedTo
            LEFT JOIN crm_followuplog ON crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID
            Left JOIN crm_dropreasons ON crm_dropreasons.DropReasonId = crm_followuplog.DropReasonId
            JOIN crm_leadstatus ON crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status
            LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
            LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
            WHERE crm_campaigncontacts.Status='5'
            AND crm_followuplog.FollowupDate = (Select Max(FollowupDate) FROM crm_followuplog WHERE crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID)
            AND AssignedTo='$agentid' 
            AND crm_campaigncontacts.Status='5'
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')
            ORDER BY crm_contacts.FirstName";
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
   function get_agenttotalfollowups($agentid,$date1,$date2){

    $sql = "SELECT COUNT(*) As count 
            FROM `crm_campaigncontacts` 
            WHERE (Status='3'||Status='2'||Status='1') 
            AND AssignedTo='$agentid'
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')";
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
   function get_agenttotalfollowup_contactdetails($agentid,$date1,$date2){

    $sql = "SELECT crm_contacts.FirstName, crm_contacts.LastName,crm_contacts.Email,
            crm_contacts.Phone,crm_leadstatus.LeadStatus, crm_campaigncontacts.Status,
            SystemUsers.FirstName as agentfname, SystemUsers.LastName as agentlname,
            SystemUsers.SystemUserID as agentid, StateMst.StateName 
            FROM crm_campaigncontacts
            JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
            LEFT JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaigncontacts.AssignedTo
            JOIN crm_leadstatus ON crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status
            LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
            LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
            WHERE  AssignedTo='$agentid' 
            AND (Status='3'||Status='2'||Status='1')
            AND (DateLeadConverted BETWEEN  '$date1' AND '$date2')
            ORDER BY crm_contacts.FirstName";
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