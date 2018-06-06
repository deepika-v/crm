<?php
  
  class Lurningo_search_model extends CI_Model{
    
    public function Search_campaign(){
      $sql = $this->db->query("select * from crm_campaign");
      return $sql->result();
    }

    public function Lead_status(){
      $sql = $this->db->query("select * from crm_leadstatus");
      return $sql->result();
    }

    public function State_list(){
      $sql = $this->db->query("select * from StateMst");
      return $sql->result();
    }

    public function Search($campaign_id,$state,$lead_status,$gender,$type,$drop_reason){
      $query = "SELECT crm_contacts.ContactsID, crm_contacts.FirstName ,crm_contacts.LastName ,crm_contacts.CityId , CityMst.StateId , 
                StateMst.StateName , crm_contacts.Gender ,crm_campaigncontacts.ContactType , crm_campaigncontacts.Status , 
                crm_leadstatus.LeadStatus , crm_campaigncontacts.CampaignID , crm_campaign.CampaignName,crm_campaigncontacts.CampaignContactID
                FROM lurningo.crm_contacts
                LEFT JOIN
                  crm_campaigncontacts ON crm_campaigncontacts.ContactsID = crm_contacts.ContactsID
                LEFT JOIN 
                  CityMst on CityMst.CityID = crm_contacts.CityID
                LEFT JOIN 
                  StateMst on StateMst.StateId = CityMst.StateId  
                LEFT JOIN 
                  crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID 
                LEFT JOIN 
                  crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
                LEFT JOIN 
                  crm_followuplog  on crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID  ";  

      $query .="WHERE crm_contacts.ContactsID LIKE '%' ";            
        
        if(!empty($campaign_id)){
          $query .= "AND crm_campaigncontacts.CampaignID IN ($campaign_id)";
        }
        
        if(!empty($state)){
          $query .= "AND StateMst.StateId IN ($state)";
        }
     
        if (!empty($lead_status)){
          $query .= "AND crm_campaigncontacts.Status IN ($lead_status)";
        }

        if (!empty($gender)){
          $query .= "AND crm_contacts.Gender LIKE '%$gender'";
        }

        if (!empty($type)){
          $query .= "AND crm_campaigncontacts.ContactType LIKE '%$type'";
        }
        
        if (!empty($drop_reason)){
          $query .= "AND crm_followuplog.DropReasonID IN ($drop_reason)";
        }


        $sql = $this->db->query($query);

        $data['result'] =  $sql->result();

        $data['query'] = $query;
        
        $data['count'] = $sql->num_rows();
 
        return $data;
    }
    public function select_campaign(){
      $db = $this->load->database('default',TRUE);
      $db->select('*');
      $db->from('crm_campaign');
      $db->where('Status','active');
      $query = $db->get();
      return $query->result();
    }
  }
?>
