<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaignmodel extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     //get the username & password from tbl_usrs
     function get_UsersList(){
      {
   $q= $this->db->get('SystemUsers');
       $this->db->order_by("FirstName","asc"); 
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

     }
 function create_campaign($data)
 {
   $this->db->where('CampaignName',$data['CampaignName']);
   $q= $this->db->get('crm_campaign');
    if($q->num_rows() > 0)
    {
     return FALSE ;
    }
    else
    {
      $this->db->insert('crm_campaign', $data);     // Inserting in Table(CourseMaster) of Database(Digivarisity)
       if ($this->db->affected_rows() == '1')
         {
         return TRUE;
         }
         else{
          return FALSE; 
         }
    }
  } 
 function get_campaignID($CampaignName){
  $this->db->where('CampaignName',$CampaignName);
  $q= $this->db->get('crm_campaign');
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
function map_campaign($campaign_array)
{
$this->db->insert('crm_campaignowners', $campaign_array);      
       if ($this->db->affected_rows() == '1')
         {
         return TRUE;
         }
         else{
          return FALSE; 
         }
}
function get_activecampaign()
{
   $this->db->where('Status','active'); 
   $this->db->order_by("CampaignName","asc");   
  $q= $this->db->get('crm_campaign');
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
  function get_activecampaign_foruser($assignid)
{  
   $sql = "SELECT DISTINCT (crm_campaign.CampaignID), crm_campaign.CampaignName 
           FROM crm_campaign
           JOIN crm_campaigncontacts ON crm_campaigncontacts.CampaignID = crm_campaign.CampaignID
           JOIN crm_campaignteam ON crm_campaignteam.CampaignID = crm_campaign.CampaignID
           WHERE crm_campaigncontacts.AssignedTo = '$assignid'  
           UNION
           SELECT DISTINCT (crm_campaign.CampaignID), crm_campaign.CampaignName 
           FROM crm_campaign
           JOIN crm_campaignteam ON crm_campaignteam.CampaignID = crm_campaign.CampaignID
           WHERE crm_campaignteam.SystemUserID = '$assignid' ";
           
  $q = $this->db->query($sql);
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
  function get_userrole(){
    $this->db->order_by("UserRoleID","asc");
   $q= $this->db->get('system_user_roles');
    if($q->num_rows() > 0)
    {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
  }

  
  function get_agentdetails(){
   $this->db->order_by("FirstName","asc");
   $this->db->where("IsActive","1");
   $q= $this->db->get('SystemUsers');
 

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
function get_activetemplate(){

   $this->db->where('Status','active');
   $this->db->where('ActionName','_campaign');  
  $q= $this->db->get('crm_template');
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

function get_campaigncontacts_total($campaign_id){
  
    $this->db->where('CampaignID',$campaign_id);
    $result = $this->db->count_all_results("crm_campaigncontacts");
  


  return $result;
}
function get_campaigncontacts($campaign_id,$filterid){
  if($filterid=='0' || $filterid=='1'){
    $this->db->where('CampaignID',$campaign_id);
    $q = $this->db->get("crm_campaigncontacts");

  }
  else if($filterid == '2'){
    $this->db->where('CampaignID',$campaign_id);
    $this->db->like('ContactType','Prospect');
    $q = $this->db->get("crm_campaigncontacts");
  }
  else if($filterid == '3'){
    $this->db->where('CampaignID',$campaign_id);
    $this->db->like('ContactType','Lead');
    $q = $this->db->get("crm_campaigncontacts");
  }
  else if($filterid == '4'){
    $this->db->where('CampaignID',$campaign_id);
    $this->db->where('Status','4');    
    $q = $this->db->get("crm_campaigncontacts");
  }
    else if($filterid == '5'){
    $this->db->where('CampaignID',$campaign_id);
    $this->db->where('Status','5');    
    $q = $this->db->get("crm_campaigncontacts");
  }

  
if($q->num_rows() > 0)
    {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
     //print_r($data);
      return $data;
    }
  
}

function get_campaigncontacts_filtered_count($campaign_id,$filterid){
  if($filterid=='0' || $filterid=='1'){
    $this->db->where('CampaignID',$campaign_id);
        $result = $this->db->count_all_results("crm_campaigncontacts");

  }
  else if($filterid == '2'){
    $this->db->where('CampaignID',$campaign_id);
    $this->db->like('ContactType','Prospect');
        $result = $this->db->count_all_results("crm_campaigncontacts");
  }
  else if($filterid == '3'){
    $this->db->where('CampaignID',$campaign_id);
    $this->db->like('ContactType','Lead');
        $result = $this->db->count_all_results("crm_campaigncontacts");
  }
  else if($filterid == '4'){
    $this->db->where('CampaignID',$campaign_id);
    $this->db->where('Status','4');    
        $result = $this->db->count_all_results("crm_campaigncontacts");
  }
    else if($filterid == '5'){
    $this->db->where('CampaignID',$campaign_id);
    $this->db->where('Status','5');    
    $result = $this->db->count_all_results("crm_campaigncontacts");
  }
  return $result;
    
  
}
function get_templateSubject($templateid){
  //echo $templateid;
   $this->db->select('Subject');
   $this->db->where('TemplateID',$templateid);    
  $q= $this->db->get('crm_template');
    /* all the queries relating to the data we want to retrieve will go in here. */

    /* after we've made the queries from the database, we will store them inside a variable called $data, and return the variable to the controller */
    if($q->num_rows() > 0)
    {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
     // print_r($data);
      return $data;
    }
  }
function get_templateMessage($templateid){
   $this->db->select('Body');
   $this->db->where('TemplateID',$templateid);    
  $q= $this->db->get('crm_template');

    /* all the queries relating to the data we want to retrieve will go in here. */

    /* after we've made the queries from the database, we will store them inside a variable called $data, and return the variable to the controller */
    if($q->num_rows() > 0)
    {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
     //print_r($data);
      return $data;
    } 
  }
  function get_templatesenderemail($templateid){
   $this->db->select('Emailfrom');
   $this->db->where('TemplateID',$templateid);    
   $q= $this->db->get('crm_template');

    /* all the queries relating to the data we want to retrieve will go in here. */

    /* after we've made the queries from the database, we will store them inside a variable called $data, and return the variable to the controller */
    if($q->num_rows() > 0)
    {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
     //print_r($data);
      return $data;
    } 
  }

function insert_MailContacts($form_data){
  //echo "<pre>";
 // print_r($form_data);
  //echo "</pre>";

  $q= $this->db->insert_batch('crm_mailcontacts', $form_data);
   $row_count =  $this->db->affected_rows();
   //echo "<br>row_count :-".$row_count;

    return $row_count;
}
function Extract_EmailDetails(){
  $sql="SELECT crm_mailcontacts.MailContactID,crm_mailcontacts.MailID,crm_mailcontacts.CampaignContactsID,crm_mailcontacts.SentOn,crm_mailcontacts.Status,
crm_mail.Subject,crm_mail.SentFrom,crm_mail.Body,crm_mail.TotalContacts,crm_mail.Status as MailID_Status, crm_contacts.FirstName,crm_contacts.Email,crm_contacts.ContactsID
FROM crm_mailcontacts 
Join crm_mail ON crm_mail.MailID = crm_mailcontacts.MailID
JOIN crm_campaigncontacts ON crm_campaigncontacts.CampaignContactID = crm_mailcontacts.CampaignContactsID
JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
WHERE crm_mailcontacts.Status='0' 
AND crm_mail.Status = '0'
ORDER BY crm_mailcontacts.MailContactID";
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
  function Update_EmailStatus($id, $data){
    $dataarray = array(
        'Status' => $data );

$this->db->where('MailContactID', $id);
$this->db->update('crm_mailcontacts', $dataarray);
 } 
 function check_blacklist($email)
 {
    $sql = "SELECT * FROM `crm_mail_blacklist` WHERE Email = '$email'";
    $q = $this->db->query($sql);
    if($q->num_rows() > 0)
    {    
      //print_r($q->num_rows());
       return TRUE;
    }
    else
    {
        return FALSE;
    }

 }
 
function get_agent_table_details($agent_id,$campaignID,$contact_type,$lead_status,$status) {
  //echo "agent_id:- ".$agent_id;
  //echo "campaign ID:-".$campaignID;
  //echo "contact_type:-".$contact_type;
  //echo "lead_status:-".$lead_status;

  
  if($contact_type=="0" && $lead_status=="0"){//All contacts
    $sql = "SELECT  crm_contacts.ContactsID, crm_contacts.FirstName,crm_contacts.LastName,
        crm_contacts.Email,  crm_contacts.Phone,CityMst.CityName, StateMst.StateName,
        crm_campaigncontacts.AssignedTo,crm_campaigncontacts.ContactType
        FROM `crm_contacts`    
        JOIN crm_campaigncontacts ON crm_campaigncontacts.ContactsID = crm_contacts.ContactsID 
        LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
        LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
        WHERE crm_campaigncontacts.CampaignID = '$campaignID'";
  }
  elseif($contact_type!="0" && $lead_status=="0")
  { //unassigned Leads or prospects
       if($contact_type=="L") $contact_type= "lead";
       elseif ($contact_type=="P") $contact_type= "Prospect";
       if($contact_type=="OP")
         { 
                  $contact_type= "Prospect"; 
                  $sql ="SELECT DISTINCT(crm_contacts.ContactsID), crm_contacts.FirstName,crm_contacts.LastName,
        crm_contacts.Email,  crm_contacts.Phone,CityMst.CityName, StateMst.StateName,
        crm_campaigncontacts.AssignedTo,crm_campaigncontacts.ContactType  FROM crm_mailcontacts 
                  JOIN crm_mail ON crm_mail.MailID = crm_mailcontacts.MailID
                  JOIN crm_campaigncontacts ON crm_campaigncontacts.CampaignContactID = crm_mailcontacts.CampaignContactsID
                  JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
                  LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
                  LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
                  Where OpenedOn <> ''
                  AND crm_mail.CampaignID ='$campaignID'";
           
         }
         else
         {
           $sql = " SELECT  crm_contacts.ContactsID, crm_contacts.FirstName,crm_contacts.LastName,
        crm_contacts.Email,  crm_contacts.Phone,CityMst.CityName, StateMst.StateName,
        crm_campaigncontacts.AssignedTo,crm_campaigncontacts.ContactType
        FROM `crm_contacts`    
        JOIN crm_campaigncontacts ON crm_campaigncontacts.ContactsID = crm_contacts.ContactsID 
        LEFT  JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
        LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
        WHERE crm_campaigncontacts.CampaignID = '$campaignID' 
        AND crm_campaigncontacts.ContactType LIKE '%$contact_type%'" ;

         } 

        
  }
   elseif($contact_type!="0" && $lead_status!="0")
  {
    if($contact_type=="L") $contact_type= "lead";
    elseif ($contact_type=="P") $contact_type= "Prospect";
    if($lead_status=="A")
    {
      if($agent_id!="0")
      {
        if($contact_type=="OP")
        {
           $contact_type= "Prospect"; 
           $sql ="SELECT DISTINCT(crm_contacts.ContactsID), crm_contacts.FirstName,crm_contacts.LastName,
           crm_contacts.Email,  crm_contacts.Phone,CityMst.CityName, StateMst.StateName,
           crm_campaigncontacts.AssignedTo,crm_campaigncontacts.ContactType  FROM crm_mailcontacts 
                  JOIN crm_mail ON crm_mail.MailID = crm_mailcontacts.MailID
                  JOIN crm_campaigncontacts ON crm_campaigncontacts.CampaignContactID = crm_mailcontacts.CampaignContactsID
                  JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
                  LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
                  LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
                  Where OpenedOn <> ''
                  AND crm_mail.CampaignID ='$campaignID'
                  AND crm_campaigncontacts.AssignedTo = '$agent_id'";
                  

        }
        else
        {
        $sql= "SELECT  crm_contacts.ContactsID, crm_contacts.FirstName,crm_contacts.LastName,
        crm_contacts.Email,  crm_contacts.Phone,CityMst.CityName, StateMst.StateName,
        crm_campaigncontacts.AssignedTo,crm_campaigncontacts.ContactType  
        FROM `crm_contacts`    
        JOIN crm_campaigncontacts ON crm_campaigncontacts.ContactsID = crm_contacts.ContactsID 
        LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
        LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
        WHERE crm_campaigncontacts.CampaignID = '$campaignID' 
        AND crm_campaigncontacts.AssignedTo = '$agent_id'
        AND crm_campaigncontacts.ContactType LIKE '%$contact_type%'";

        }  
          
         
      }
      elseif($agent_id=="0")
      {
        if($contact_type=="OP")
        {
          $contact_type= "Prospect"; 
           $sql ="SELECT DISTINCT(crm_contacts.ContactsID), crm_contacts.FirstName,crm_contacts.LastName,
           crm_contacts.Email,  crm_contacts.Phone,CityMst.CityName, StateMst.StateName,
           crm_campaigncontacts.AssignedTo,crm_campaigncontacts.ContactType  FROM crm_mailcontacts 
                  JOIN crm_mail ON crm_mail.MailID = crm_mailcontacts.MailID
                  JOIN crm_campaigncontacts ON crm_campaigncontacts.CampaignContactID = crm_mailcontacts.CampaignContactsID
                  JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
                  LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
                  LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
                  Where OpenedOn <> ''
                  AND crm_mail.CampaignID ='$campaignID'
                 AND crm_campaigncontacts.AssignedTo <> '0'";
                 


        }
        else
         {
              $sql= "SELECT  crm_contacts.ContactsID, crm_contacts.FirstName,crm_contacts.LastName,
            crm_contacts.Email,  crm_contacts.Phone,CityMst.CityName, StateMst.StateName,
            crm_campaigncontacts.AssignedTo,crm_campaigncontacts.ContactType  
            FROM `crm_contacts`    
            JOIN crm_campaigncontacts ON crm_campaigncontacts.ContactsID = crm_contacts.ContactsID 
            LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
            LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
            WHERE crm_campaigncontacts.CampaignID = '$campaignID'
            AND crm_campaigncontacts.AssignedTo <> '0'
            AND crm_campaigncontacts.ContactType LIKE '%$contact_type%'";
         } 
        
      }
    } 
    else if($lead_status=="U")
    {
      if($contact_type=="L") $contact_type= "lead";
    elseif ($contact_type=="P") $contact_type= "Prospect";
     if($contact_type=="OP")
     {
           $contact_type= "Prospect"; 
           $sql ="SELECT DISTINCT(crm_contacts.ContactsID), crm_contacts.FirstName,crm_contacts.LastName,
           crm_contacts.Email,  crm_contacts.Phone,CityMst.CityName, StateMst.StateName,
           crm_campaigncontacts.AssignedTo,crm_campaigncontacts.ContactType  FROM crm_mailcontacts 
                  JOIN crm_mail ON crm_mail.MailID = crm_mailcontacts.MailID
                  JOIN crm_campaigncontacts ON crm_campaigncontacts.CampaignContactID = crm_mailcontacts.CampaignContactsID
                  JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
                  LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
                  LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
                  Where OpenedOn <> ''
                  AND crm_mail.CampaignID ='$campaignID'
                 AND crm_campaigncontacts.AssignedTo = '0'";
                

     }
    else
    {
      $sql ="SELECT  crm_contacts.ContactsID, crm_contacts.FirstName,crm_contacts.LastName,
        crm_contacts.Email,  crm_contacts.Phone,CityMst.CityName, StateMst.StateName,
        crm_campaigncontacts.AssignedTo,crm_campaigncontacts.ContactType  
        FROM `crm_contacts`    
        JOIN crm_campaigncontacts ON crm_campaigncontacts.ContactsID = crm_contacts.ContactsID 
        LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
        LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
        WHERE crm_campaigncontacts.CampaignID = '$campaignID' 
        AND crm_campaigncontacts.AssignedTo = '0'
        AND crm_campaigncontacts.ContactType LIKE '%$contact_type%'";

    }

      
    }    

} elseif($contact_type=="0" && $lead_status!="0")
  { //unassigned
   if($lead_status=="A")
    {
     if($agent_id!="0")
      {
          $sql= "SELECT  crm_contacts.ContactsID, crm_contacts.FirstName,crm_contacts.LastName,
        crm_contacts.Email,  crm_contacts.Phone,CityMst.CityName, StateMst.StateName,
        crm_campaigncontacts.AssignedTo,crm_campaigncontacts.ContactType  
        FROM `crm_contacts`    
        JOIN crm_campaigncontacts ON crm_campaigncontacts.ContactsID = crm_contacts.ContactsID 
        LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
        LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
        WHERE crm_campaigncontacts.CampaignID = '$campaignID' 
        AND crm_campaigncontacts.AssignedTo = '$agent_id'";
      }
      elseif($agent_id=="0")
      {
        $sql= "SELECT  crm_contacts.ContactsID, crm_contacts.FirstName,crm_contacts.LastName,
        crm_contacts.Email,  crm_contacts.Phone,CityMst.CityName, StateMst.StateName,
        crm_campaigncontacts.AssignedTo,crm_campaigncontacts.ContactType  
        FROM `crm_contacts`    
        JOIN crm_campaigncontacts ON crm_campaigncontacts.ContactsID = crm_contacts.ContactsID 
        LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
        LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
        WHERE crm_campaigncontacts.CampaignID = '$campaignID'
        AND crm_campaigncontacts.AssignedTo <> '0'";
      }
    } 
    else if($lead_status=="U")
    {
    
      $sql ="SELECT  crm_contacts.ContactsID, crm_contacts.FirstName,crm_contacts.LastName,
        crm_contacts.Email,  crm_contacts.Phone,CityMst.CityName, StateMst.StateName,
        crm_campaigncontacts.AssignedTo,crm_campaigncontacts.ContactType  
        FROM `crm_contacts`    
        JOIN crm_campaigncontacts ON crm_campaigncontacts.ContactsID = crm_contacts.ContactsID 
        LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
        LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
        WHERE crm_campaigncontacts.CampaignID = '$campaignID' 
        AND crm_campaigncontacts.AssignedTo = '0'";
    }
        
  }
  //echo $sql;
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

function getcandidates_othercampaign($agent_id,$campaignID,$contact_type,$lead_status){
  $sql = "SELECT crm_campaigncontacts.CampaignID, crm_campaigncontacts.ContactsID, 
          crm_campaigncontacts.AssignedTo 
          FROM `crm_campaigncontacts` 
          WHERE crm_campaigncontacts.CampaignID <> '$campaignID' 
          AND crm_campaigncontacts.Status <> '1' " ;

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
function update_assignmentstatus($campaignid, $contacttype,$status,$addedby,$userid,$assignid,$assigndetails,$dateleadconverted){
  $sql="";
  //echo "in update_assignmentstatus";
    
if($contacttype=="0")
{
  if($userid!="-1")
  {
       $sql = "UPDATE `crm_campaigncontacts`
                SET `AssignedTo` = '$assignid',
                `Status` = '2',
                `DateModified` = '$dateleadconverted',
                `ModifiedBy` = '$addedby',
                `DateLeadConverted` = '$dateleadconverted'
                 WHERE  crm_campaigncontacts.ContactsID = '$userid'
                 AND crm_campaigncontacts.CampaignID = '$campaignid'";
   }
  else
  {
      $sql = "UPDATE `crm_campaigncontacts`
           SET `AssignedTo` = '$assignid',
          `Status` = '2',
          `DateModified` = '$dateleadconverted',
           `ModifiedBy` = '$addedby',
           `DateLeadConverted` = '$dateleadconverted'
           WHERE crm_campaigncontacts.CampaignID = '$campaignid'";
           
  }
}
else
{
  if($contacttype=="L") $contacttype= "lead";
    elseif ($contacttype=="P") $contacttype= "Prospect";
      if($userid!="-1")
      {
           if($contacttype=="OP")
              {
                 $sql = "UPDATE `crm_campaigncontacts`
                        SET `AssignedTo` = '$assignid',
                        `Status` = '2',
                        `DateModified` = '$dateleadconverted',
                        `ModifiedBy` = '$addedby',
                         `DateLeadConverted` = '$dateleadconverted'
                         WHERE  crm_campaigncontacts.ContactsID = '$userid'
                         AND crm_campaigncontacts.CampaignID = '$campaignid'";
               
              }
              else
              {
                $sql = "UPDATE `crm_campaigncontacts`
                        SET `AssignedTo` = '$assignid',
                        `Status` = '2',
                        `DateModified` = '$dateleadconverted',
                        `ModifiedBy` = '$addedby',
                         `DateLeadConverted` = '$dateleadconverted'
                         WHERE  crm_campaigncontacts.ContactsID = '$userid'
                         AND crm_campaigncontacts.ContactType = '$contacttype'
                         AND crm_campaigncontacts.CampaignID = '$campaignid'";
              }
      }
      else
      {
         $sql = "UPDATE `crm_campaigncontacts`
              SET `AssignedTo` = '$assignid',
             `Status` = '2',
              `DateModified` = '$dateleadconverted',
              `ModifiedBy` = '$addedby',
              `DateLeadConverted` = '$dateleadconverted'
                WHERE crm_campaigncontacts.ContactType = '$contacttype'
                AND crm_campaigncontacts.CampaignID = '$campaignid'";
      }
  }
  $q = $this->db->query($sql); 
            if($this->db->affected_rows()  > "0")
           {
            return TRUE;
           }
           else
           {
             return FALSE;
           }
}


function get_agentname($assignid){
  $sql = "SELECT FirstName, LastName FROM `SystemUsers` where SystemUserID='$assignid'";
  $q = $this->db->query($sql); 
  /* all the queries relating to the data we want to retrieve will go in here. */
  /* after we've made the queries from the database, we will store them inside a variable called $data, and return the variable to the controller */
    if($q->num_rows() > 0)
    {
      foreach ($q->result() as $row)
      {
        $data[] = $row;
      }
     //print_r($data);
      return $data;
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

 function insert_newlead($form_data,$id){
  $this->db->where('Phone',$form_data['Phone']);
   $q= $this->db->get('crm_contacts');
    if($q->num_rows() > 0)
    {
      $phone = $form_data['Phone'];
      if($id='0')
      $sql="SELECT crm_contacts.ContactsID FROM `crm_contacts`
            JOIN crm_campaigncontacts ON crm_campaigncontacts.ContactsID = crm_contacts.ContactsID
            where Phone = '$phone' AND AssignedTo <> '0'";
      else
      $sql="SELECT crm_contacts.ContactsID FROM `crm_contacts`
            JOIN crm_campaigncontacts ON crm_campaigncontacts.ContactsID = crm_contacts.ContactsID
            where Phone = '$phone'";      
        $q = $this->db->query($sql);
           //print_r($q);
          if($q->num_rows() > 0)
          {
            //echo "num_rows".$q->num_rows();
            foreach ($q->result() as $row)
             {
               $data1[] = $row;
             }
             $data_value = (array)$data1['0'];
             $data = $data_value['ContactsID'];
             //print_r($data_value);

           return $data;
          }
          else
          {
            return 0;
          } 
       }
    else
    {

         $this->db->insert('crm_contacts', $form_data);     // Inserting in Table(CourseMaster) of Database(Digivarisity)
           if ($this->db->affected_rows() == '1')
             {
             return $this->db->insert_id();
             }
             else
             {
              return FALSE; 
             }
    }
 }

 function add_to_campaigncontacts($form_data)
 {
  $this->db->where('CampaignID',$form_data['CampaignID']);
  $this->db->where('ContactsID',$form_data['ContactsID']);
   $q= $this->db->get('crm_campaigncontacts');
    if($q->num_rows() > 0)
    {
      return FALSE;
    }
    else
    {
      $this->db->insert('crm_campaigncontacts', $form_data);     // Inserting in Table(CourseMaster) of Database(Digivarisity)
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
 function displaymodal_details($campaignID, $AssignedTo,$ContactsID){
$sql = "SELECT crm_campaigncontacts.CampaignID, crm_campaigncontacts.AssignedTo,
        crm_campaigncontacts.Status, crm_campaign.CampaignName,SystemUsers.FirstName as agentfname,SystemUsers.LastName as agentlname,
         crm_contacts.FirstName, crm_contacts.LastName, crm_leadstatus.LeadStatus,crm_campaigncontacts.DateAdded 
        FROM crm_campaigncontacts 
        JOIN crm_campaign ON crm_campaign.CampaignID = crm_campaigncontacts.CampaignID
        JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaigncontacts.AssignedTo 
        Join crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
        JOIN crm_leadstatus ON crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status
         WHERE crm_campaigncontacts.CampaignID <> '$campaignID'
         AND crm_campaigncontacts.ContactsID = '$ContactsID'";
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
 function get_campaigndetails( $campaignID){
  if($campaignID=='0'){
$sql ="SELECT crm_campaign.CampaignID,crm_campaign.CampaignName, crm_campaign.Description, 
                crm_campaign.StartDate,crm_campaign.EndDate, crm_campaign.Status,
                SystemUsers.UserName, SystemUsers.SystemUserID
         FROM `crm_campaign`
        JOIN crm_campaignowners ON crm_campaignowners.CampaignID = crm_campaign.CampaignID
        JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaignowners.UserID 
        ORDER BY crm_campaign.CampaignName";

  }else if($campaignID!='0'){
 
 $sql ="SELECT crm_campaign.CampaignID,crm_campaign.CampaignName, crm_campaign.Description, 
                crm_campaign.StartDate,crm_campaign.EndDate, crm_campaign.Status,
                SystemUsers.UserName, SystemUsers.SystemUserID
         FROM `crm_campaign`
        JOIN crm_campaignowners ON crm_campaignowners.CampaignID = crm_campaign.CampaignID
        JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaignowners.UserID 
        WHERE crm_campaign.CampaignID = '$campaignID'
        ORDER BY crm_campaign.CampaignName";
  }  
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
function get_campaignData($campaignstatus)
{
  if($campaignstatus=="1")
  $sql ='SELECT crm_campaign.CampaignID,crm_campaign.CampaignName, crm_campaign.Description, 
                crm_campaign.StartDate,crm_campaign.EndDate, crm_campaign.Status,
                SystemUsers.UserName, SystemUsers.SystemUserID
         FROM `crm_campaign`
        JOIN crm_campaignowners ON crm_campaignowners.CampaignID = crm_campaign.CampaignID
        JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaignowners.UserID
        WHERE  crm_campaign.Status = "active"
        ORDER BY crm_campaign.CampaignName';
  else 
    $sql ='SELECT crm_campaign.CampaignID,crm_campaign.CampaignName, crm_campaign.Description, 
                crm_campaign.StartDate,crm_campaign.EndDate, crm_campaign.Status,
                SystemUsers.UserName, SystemUsers.SystemUserID
         FROM `crm_campaign`
        JOIN crm_campaignowners ON crm_campaignowners.CampaignID = crm_campaign.CampaignID
        JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaignowners.UserID
        WHERE  crm_campaign.Status = "inactive"
        ORDER BY crm_campaign.CampaignName';   
         
  
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
function get_campaigncontact_count($campaignID){
  $sql = "SELECT COUNT(*) AS Contacts FROM `crm_campaigncontacts` Where CampaignID = '$campaignID'";
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
function get_campaigncontact_lead($campaignID,$contacttype){
  $sql = "SELECT COUNT(*) AS Contacts FROM `crm_campaigncontacts` Where CampaignID = '$campaignID' AND ContactType='$contacttype'";
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
function update_campaign($campaignID,$form_data){
$this->db->where('CampaignID', $campaignID);
$query =$this->db->update('crm_campaign', $form_data);
//echo "query".$query;
return $query;


}
function update_campaignowner($campaignID,$form_data){
$this->db->where('CampaignID', $campaignID);
$query = $this->db->update('crm_campaignowners', $form_data);
//$i= $this->db->affected_rows();
return $query;//$i;
}
function update_campaignteam($campaignID,$campaign_array){
$sql = "DELETE FROM `crm_campaignteam` WHERE CampaignID = $campaignID";
$q = $this->db->query($sql);
//echo $q;
if($q==1){
   $q= $this->db->insert_batch('crm_campaignteam', $campaign_array);
   $row_count =  $this->db->affected_rows();
   return $row_count;

}
//exit;
//$i= $this->db->affected_rows();
//return $query;//$i;
//$q= $this->db->insert_batch('crm_campaignteam', $campaign_array);
  // $row_count =  $this->db->affected_rows();
   //return $row_count;
}

function generate_csv($campaignID){
  //echo $campaignID;
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $query = $this->db->query("SELECT crm_campaign.CampaignName,crm_contacts.FirstName, crm_contacts.LastName, crm_contacts.Gender,
          date_format(crm_contacts.DateofBirth, '%d/%m/%Y') AS DateofBirth,crm_contacts.Email, crm_contacts.Phone, crm_leadstatus.LeadStatus
          FROM `crm_contacts`
          JOIN crm_campaigncontacts ON crm_campaigncontacts.ContactsID = crm_contacts.ContactsID
          JOIN crm_campaign ON crm_campaign.CampaignID = crm_campaigncontacts.CampaignID
          JOIN crm_leadstatus ON crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status
           WHERE crm_campaigncontacts.CampaignID ='$campaignID'");
       // $row_count=$this->db->affected_rows();
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        //print_r($data);
        force_download('Campaign_contacts.csv', $data);
}
function sendmail_grid_display($limit,$start){

  if($limit=='0'&& $start=='0'){
  $sql='SELECT crm_mail.MailID, crm_mail.CampaignID,crm_mail.SentFrom,
        crm_mail.Subject,crm_mail.SystemUserID, crm_mail.SentOn,
        crm_campaign.CampaignName,crm_mail.TotalContacts,crm_mail.SentCount,crm_mail.FailedCount,crm_mail.BlockedCount
        From crm_mail
        Join crm_campaign ON crm_campaign.CampaignID = crm_mail.CampaignID
        WHERE crm_campaign.Status = "active"
        ORDER By (crm_mail.SentOn) DESC';
}
else{
  $sql='SELECT crm_mail.MailID, crm_mail.CampaignID,crm_mail.SentFrom,
        crm_mail.Subject,crm_mail.SystemUserID, crm_mail.SentOn,
        crm_campaign.CampaignName,crm_mail.TotalContacts,crm_mail.SentCount,crm_mail.FailedCount,crm_mail.BlockedCount
        From crm_mail
        Join crm_campaign ON crm_campaign.CampaignID = crm_mail.CampaignID
        WHERE crm_campaign.Status = "active"
        ORDER By (crm_mail.SentOn) DESC
         limit ' . $start . ', ' . $limit;
}
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
function gettotalopencontacts($CampaignID,$MailID){
  $sql ="SELECT Count(*) As Opencount  
FROM crm_mailcontacts 
JOIN crm_mail ON crm_mail.MailID = crm_mailcontacts.MailID
Where OpenedOn <> ''
AND crm_mail.CampaignID = '$CampaignID'
AND crm_mailcontacts.MailID = '$MailID'
group by DATE(crm_mail.SentOn), crm_mailcontacts.MailID";
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
function gettotalsentcontacts($CampaignID,$MailID){
  $sql ="SELECT Count(*) As Sentcount  
FROM crm_mailcontacts 
JOIN crm_mail ON crm_mail.MailID = crm_mailcontacts.MailID
Where crm_mailcontacts.Status <> '0'
AND crm_mail.CampaignID = '$CampaignID'
AND crm_mailcontacts.MailID = '$MailID'
group by DATE(crm_mail.SentOn), crm_mailcontacts.MailID";
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
function gettotalfailedcontacts($CampaignID,$MailID){
  $sql ="SELECT Count(*) As Failedcount  
FROM crm_mailcontacts 
JOIN crm_mail ON crm_mail.MailID = crm_mailcontacts.MailID
Where crm_mailcontacts.Status = '-1'
AND crm_mail.CampaignID = '$CampaignID'
AND crm_mailcontacts.MailID = '$MailID'
group by DATE(crm_mail.SentOn), crm_mailcontacts.MailID";
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
function gettotalsucceedcontacts($CampaignID,$MailID){
  $sql ="SELECT Count(*) As Succeedcount  
FROM crm_mailcontacts 
JOIN crm_mail ON crm_mail.MailID = crm_mailcontacts.MailID
Where crm_mailcontacts.Status = '1'
AND crm_mail.CampaignID = '$CampaignID'
AND crm_mailcontacts.MailID = '$MailID'
group by DATE(crm_mail.SentOn), crm_mailcontacts.MailID";
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
function gettotalclickthrough($CampaignID,$MailID){
  $sql ="SELECT Count(*) As clickthrough  
FROM crm_mail_clicks 
JOIN crm_mail ON crm_mail.MailID = crm_mail_clicks.MailID
Where  crm_mail.CampaignID = '$CampaignID'
AND crm_mail_clicks.MailID = '$MailID'
group by DATE(crm_mail.SentOn), crm_mail_clicks.MailID";
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
function update_redirecturl($url,$campaignID){
  $sql = "UPDATE crm_campaign SET redirect_url ='$url' WHERE CampaignID ='$campaignID'";
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

function insert_campaignteam($campaign_array){
  $q= $this->db->insert_batch('crm_campaignteam', $campaign_array);
   $row_count =  $this->db->affected_rows();
   return $row_count;
}
function get_Campaignteam($campaignID){
  $sql = "SELECT crm_campaignteam.SystemUserID ,crm_campaignteam.CampaignID, 
  crm_campaignteam.CampaignTeamID , SystemUsers.FirstName,SystemUsers.LastName 
  FROM `crm_campaignteam` 
  JOIN SystemUsers ON SystemUsers.SystemUserID = crm_campaignteam.SystemUserID 
  Where crm_campaignteam.CampaignID ='$campaignID'";
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
function get_productlist()
{
  $sql = "SELECT a.ProductId, a.ProductName, a.CategoryIds,a.PublishedStatus, a.TypeId
          FROM Product as a 
          INNER JOIN ProductCategory as b
          WHERE a.PublishedStatus='P' 
          GROUP BY a.ProductId";
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
function get_categorylist()
{
  $sql = "SELECT DISTINCT CategoryId, CategoryName,ParentCategoryId FROM `ProductCategory`";
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
function insert_campaignproduct($campaignID,$campaign_product_array)
{
  //echo "in function";
  $this->db->where('CampaignID', $campaignID);
  $q = $this->db->get('crm_campaign_product');
  if($q->num_rows() > 0){
    return false;
   
  }else{
    //echo "in else";
    $q= $this->db->insert_batch('crm_campaign_product', $campaign_product_array);
   $row_count =  $this->db->affected_rows();
   return $row_count;


  }
  
}
function update_campaignproduct($campaignID,$campaignproduct_array){
$sql = "DELETE FROM `crm_campaign_product` WHERE CampaignID = $campaignID";
$q = $this->db->query($sql);
//echo $q;
if($q==1){
   $q= $this->db->insert_batch('crm_campaign_product', $campaignproduct_array);
   $row_count =  $this->db->affected_rows();
   return $row_count;
}
//exit;
//$i= $this->db->affected_rows();
//return $query;//$i;
//$q= $this->db->insert_batch('crm_campaignteam', $campaign_array);
  // $row_count =  $this->db->affected_rows();
   //return $row_count;
}
function get_selectedProducts($campaignID)
{
  $sql = "SELECT * FROM `crm_campaign_product` WHERE CampaignID = '$campaignID'";
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
function insert_to_crm_mail($form_data)
{
  $this->db->insert('crm_mail', $form_data);     // Inserting in Table(CourseMaster) of Database(Digivarisity)
           if ($this->db->affected_rows() == '1')
             {
             return $this->db->insert_id();
             }
             else
             {
              return FALSE; 
             }
}
function get_campaigncontactID($CampaignID,$userid)
{
  //echo "in get_campaigncontactID";
  $sql = "SELECT CampaignContactID
FROM crm_campaigncontacts
Where CampaignID = '$CampaignID'
AND ContactsID = '$userid'";
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
function insert_assignmentlog($form_data)
{
  $campaigncontactID = $form_data['CampaignContactID'];
  $AssignedTo = $form_data['AssignedTo'];
  $CreatedBy=$form_data['CreatedBy'];
 $sql = "SELECT * FROM crm_assignmentlog WHERE  CampaignContactID  = $campaigncontactID";
 $q = $this->db->query($sql);
 if($q->num_rows() > 0)
  {
    $sql = "UPDATE `crm_assignmentlog` SET `IsActive` = '0'
        WHERE  CampaignContactID  = $campaigncontactID";
        $q = $this->db->query($sql);
        $sql = "INSERT INTO `crm_assignmentlog` 
                (`CampaignContactID`,`AssignedTo`,`AssignedOn`,`CreatedOn`,`CreatedBy`,`IsActive`)
                VALUES($campaigncontactID,'$AssignedTo',now(),now(),'$CreatedBy','1')";
                $q = $this->db->query($sql);
                if($this->db->affected_rows() == '1')
                {
                  return TRUE;

                }
                else
                {
                  return FALSE;

                }
           
         }
       else
      {
        $sql = "INSERT INTO `crm_assignmentlog`
      (`CampaignContactID`,`AssignedTo`,`AssignedOn`,`CreatedOn`,`CreatedBy`,`IsActive`)
      VALUES($campaigncontactID,$AssignedTo,now(),now(),'$CreatedBy','1')";
       $q = $this->db->query($sql);
           if($this->db->affected_rows()  > 0)
           {
            return TRUE;
           }
           else
           {
             return FALSE;
           }
      }

 }
 function insert_statuslog($form_data){
  $campaigncontactID = $form_data['CampaignContactID'];
  $LeadStatusID = $form_data['LeadStatusID'];
  $CreatedBy=$form_data['CreatedBy'];
   $sql = "SELECT * FROM crm_statuslog WHERE  CampaignContactID  = $campaigncontactID";
 $q = $this->db->query($sql);
 if($q->num_rows() > 0)
  {
    $sql = "UPDATE `crm_statuslog` SET `IsActive`='0' WHERE CampaignContactID  = $campaigncontactID ";
        $q = $this->db->query($sql);
        $sql = "INSERT INTO `crm_statuslog` (`CampaignContactID`, `LeadStatusID`, `CreatedOn`, `CreatedBy`, `IsActive`)
         VALUES ( $campaigncontactID,$LeadStatusID,now(),$CreatedBy,'1')";
                $q = $this->db->query($sql);
                if($this->db->affected_rows() == '1')
                {
                  return TRUE;

                }
                else
                {
                  return FALSE;

                }
           
         }
       else
      {
        $sql = "INSERT INTO `crm_statuslog` (`CampaignContactID`, `LeadStatusID`, `CreatedOn`, `CreatedBy`, `IsActive`)
         VALUES ( $campaigncontactID,$LeadStatusID,now(),$CreatedBy,'1')";
       $q = $this->db->query($sql);
           if($this->db->affected_rows()  > 0)
           {
            return TRUE;
           }
           else
           {
             return FALSE;
           }
      }

 }

 function update_assignagent_leads($campaigncontactID_csv,$assignid,$AddedBy)
{
  $sql = "UPDATE `crm_campaigncontacts`
         SET `AssignedTo`='$assignid',
             `DateAdded`= now(),
             `AddedBy`='$AddedBy' 
             WHERE `CampaignContactID` IN ($campaigncontactID_csv)";
      //echo $sql;
             $q = $this->db->query($sql);
             if($this->db->affected_rows()  > 0)
           {
            return TRUE;
           }
           else
           {
             return FALSE;
           }

}
function insert_assignmentlog_leads($form_data)
{
  $campaigncontactID = $form_data['CampaignContactID'];
  $AssignedTo = $form_data['AssignedTo'];
  $CreatedBy=$form_data['CreatedBy'];
 $sql = "SELECT * FROM crm_assignmentlog WHERE  CampaignContactID  = $campaigncontactID";
 $q = $this->db->query($sql);
 if($q->num_rows() > 0)
  {
    $sql = "UPDATE `crm_assignmentlog` SET `IsActive` = '0'
        WHERE  CampaignContactID  = $campaigncontactID";
        $q = $this->db->query($sql);
        $sql = "INSERT INTO `crm_assignmentlog` 
                (`CampaignContactID`,`AssignedTo`,`AssignedOn`,`CreatedOn`,`CreatedBy`,`IsActive`)
                VALUES($campaigncontactID,'$AssignedTo',now(),now(),'$CreatedBy','1')";
                $q = $this->db->query($sql);
                if($this->db->affected_rows()> '0')
                {
                  return TRUE;

                }
                else
                {
                  return FALSE;

                }
           
         }
       else
      {
        $sql = "INSERT INTO `crm_assignmentlog`
      (`CampaignContactID`,`AssignedTo`,`AssignedOn`,`CreatedOn`,`CreatedBy`,`IsActive`)
      VALUES($campaigncontactID,$AssignedTo,now(),now(),'$CreatedBy','1')";
       $q = $this->db->query($sql);
           if($this->db->affected_rows()  > 0)
           {
            return TRUE;
           }
           else
           {
             return FALSE;
           }
      }

 }
 function getcampaigncontactID_all($campaignid,$agent_id){
  //echo "in model";
  //echo $campaignid;
  //echo $agent_id;
  $sql='';
  if($campaignid=="0")
  {
    $sql = "select distinct crm_campaigncontacts.CampaignContactID,crm_campaigncontacts.ContactsID,crm_contacts.FirstName,crm_contacts.LastName,crm_contacts.Phone,crm_contacts.Email,crm_campaigncontacts.Status,crm_campaign.CampaignName,
crm_leadstatus.LeadStatus,StateMst.StateName from crm_campaigncontacts 
                join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
                join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
                left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID
                left join crm_followuplog on crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID 
join CityMst ON CityMst.CityId = crm_contacts.CityID 
join StateMst ON StateMst.StateId = CityMst.StateId 
                where AssignedTo = '$agent_id'
                and crm_campaigncontacts.Status != '4' and crm_campaigncontacts.Status != '5'";

  }
  else{
    $sql = "select distinct crm_campaigncontacts.CampaignContactID,crm_campaigncontacts.ContactsID,crm_contacts.FirstName,crm_contacts.LastName,crm_contacts.Phone,crm_contacts.Email,crm_campaigncontacts.Status,crm_campaign.CampaignName,
crm_leadstatus.LeadStatus,StateMst.StateName from crm_campaigncontacts 
                join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
                join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
                left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID
                left join crm_followuplog on crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID 
join CityMst ON CityMst.CityId = crm_contacts.CityID 
join StateMst ON StateMst.StateId = CityMst.StateId 
                where AssignedTo = '$agent_id' and crm_campaigncontacts.CampaignID = '$campaignid' 
                and crm_campaigncontacts.Status != '4' and crm_campaigncontacts.Status != '5'";
  }
//echo $sql;
$q = $this->db->query($sql);
      if($q->num_rows() > 0)
          {
            foreach ($q->result() as $row)
            {
               $data[] = $row;
            }
            //echo "row count".$q->num_rows()."<br>";
             //print_r($data);
            return $data;
          }
          else
          {
            return FALSE;
          } 
 }
 function get_campaignIDdetails($phone,$campaignname)
 {
  $this->db->where('Phone',$phone);
   $q= $this->db->get('crm_campaign');
    if($q->num_rows() > 0)
    {
      //$phone = $form_data['Phone'];
      $sql="SELECT crm_campaign.CampaignID FROM `crm_campaign`
            where Phone = '$phone'";
        $q = $this->db->query($sql);
       // print_r($q);
          if($q->num_rows() > 0)
          {
            //echo "num_rows".$q->num_rows();
            foreach ($q->result() as $row)
            {
               $data1[] = $row;
            }
             $data_value = (array)$data1['0'];
             $data = $data_value['CampaignID'];
             //print_r($data_value);

           return $data;
          }
          else{
            return 0;
          } 
       }
       else{
         $sql="SELECT crm_campaign.CampaignID FROM `crm_campaign`
            where CampaignName LIKE  '%$campaignname%'";
        $q = $this->db->query($sql);
       // print_r($q);
          if($q->num_rows() > 0)
          {
            //echo "num_rows".$q->num_rows();
            foreach ($q->result() as $row)
            {
               $data1[] = $row;
            }
             $data_value = (array)$data1['0'];
             $data = $data_value['CampaignID'];
             //print_r($data_value);

           return $data;
          }
          else{
            return 0;
          } 

       }
    
 }
function get_openclicked_contacts($MailID)
{
  $sql = "SELECT *  
FROM crm_mailcontacts 
JOIN crm_mail ON crm_mail.MailID = crm_mailcontacts.MailID
JOIN crm_campaigncontacts ON crm_campaigncontacts.CampaignContactID = crm_mailcontacts.CampaignContactsID
JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
Where OpenedOn <> ''
AND crm_mailcontacts.MailID ='$MailID'";
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
function get_clicked_contacts($MailID)
{
  $sql = "SELECT *  
FROM crm_mail_clicks 
JOIN crm_mail ON crm_mail.MailID = crm_mail_clicks.MailID
JOIN crm_campaigncontacts ON crm_campaigncontacts.CampaignContactID = crm_mail_clicks.CampaignContactID
JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
LEFT JOIN CityMst ON CityMst.CityId = crm_contacts.CityID 
LEFT JOIN StateMst ON StateMst.StateId = CityMst.StateId
AND crm_mail_clicks.MailID ='$MailID'";
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
