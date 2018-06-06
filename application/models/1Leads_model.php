<?php
  class Leads_model extends CI_Model{
    
    
    public function find_LeadStatus(){
      $query = $this->db->get('crm_leadstatus');
      return $query->result();
    }

    public function all_campaign(){
      $query = $this->db->get('crm_campaign');
      return $query->result();
    }

    public function find_campaignlist($agent_id){
      $query = $this->db->query("SELECT DISTINCT crm_campaigncontacts.CampaignID,AssignedTo,CampaignName FROM staging_lurningo.crm_campaigncontacts join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID where AssignedTo ='$agent_id'");
      return $query->result();
    }

    public function find_campaign($CampaignID){
      
      $query = $this->db->query("select * from  crm_campaign where CampaignID = '$CampaignID'");

      return $query->row();

    }

    public function find_myleads($agent_id){
      //$agent_id = '1';

      //$query = $this->db->query("");

      $query = $this->db->query("select * from crm_campaigncontacts join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID where AssignedTo = '$agent_id' and crm_campaigncontacts.Status != '4' and crm_campaigncontacts.Status != '5'");

      return $query->result();

    }

    public function find_campaignleads($agent_id,$CampaignID){

      $query = $this->db->query("select * from crm_campaigncontacts join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID where AssignedTo = '$agent_id' and crm_campaigncontacts.CampaignID = '$CampaignID' and crm_campaigncontacts.Status != '4' and crm_campaigncontacts.Status != '5'");

      return $query->result();


    }


  }

?>
