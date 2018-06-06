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
      $query = $this->db->query("SELECT DISTINCT crm_campaigncontacts.CampaignID,AssignedTo,CampaignName FROM lurningo.crm_campaigncontacts join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID where AssignedTo ='$agent_id'");
      return $query->result();
    }

    public function find_campaign($CampaignID){
      
      $query = $this->db->query("select * from  crm_campaign where CampaignID = '$CampaignID'");

      return $query->row();

    }
    public function select_counsellor(){
      $query = $this->db->query("select * from SystemUsers where IsActive = 1 and UserRoleID = 3");
      return $query->result();
    }

    public function find_myleads($agent_id){
      //$agent_id = '1';

      //$query = $this->db->query("");
      /*
      $sql = "select * from crm_campaigncontacts 
                join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
                join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
                left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID 
                left join crm_followuplog on crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID 

                where AssignedTo = '$agent_id' and crm_campaigncontacts.Status != '4' 
                and crm_campaigncontacts.Status != '5'";
      */

      $query = "select distinct crm_campaigncontacts.CampaignContactID,crm_campaigncontacts.ContactsID,crm_contacts.FirstName,crm_contacts.LastName,crm_contacts.Phone,crm_contacts.Email,crm_campaigncontacts.ContactType,crm_campaigncontacts.Status,crm_campaign.CampaignName,
crm_leadstatus.LeadStatus,StateMst.StateName from crm_campaigncontacts join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID left join crm_followuplog on crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID
left join CityMst ON CityMst.CityId = crm_contacts.CityID 
left join StateMst ON StateMst.StateId = CityMst.StateId  where AssignedTo = '$agent_id'";          

      return $query;

    }

    public function find_campaignleads($agent_id,$CampaignID){
      
      $query = "select distinct crm_campaigncontacts.CampaignContactID,crm_campaigncontacts.ContactsID,crm_contacts.FirstName,crm_contacts.LastName,crm_contacts.Phone,crm_contacts.Email,crm_campaigncontacts.Status,crm_campaigncontacts.ContactType,crm_campaign.CampaignName,
crm_leadstatus.LeadStatus,StateMst.StateName from crm_campaigncontacts 
                join crm_contacts on crm_contacts.ContactsID = crm_campaigncontacts.ContactsID 
                join crm_leadstatus on crm_leadstatus.LeadStatusID = crm_campaigncontacts.Status 
                left join crm_campaign on crm_campaign.CampaignID = crm_campaigncontacts.CampaignID
                left join crm_followuplog on crm_followuplog.CampaignContactID = crm_campaigncontacts.CampaignContactID 
left join CityMst ON CityMst.CityId = crm_contacts.CityID 
left join StateMst ON StateMst.StateId = CityMst.StateId 
                where AssignedTo = '$agent_id' and crm_campaigncontacts.CampaignID = '$CampaignID'";
      



      return $query;


    }
    
    public function Coupons_list($user_id){
      $query = $this->db->query("SELECT 
									Coupons.CouponID,	
                                    Coupons.Code,
                                    Product.ProductName,
                                    Coupons.CreatedOn,
                                    Coupons.DiscountAmount,
                                    Coupons.ValidTill,
                                    Coupons.NumberOfUses,
                                    Coupons.MaxNumberOfUses,
                                    Coupons.CouponID,
                                    Coupons.DiscountRate,
                                    ProductCoupons.CategoryID,
                                    ProductCategory.CategoryName,
                                    Coupons.CreatedFor,
                                    SystemUsers.FirstName,
                                    SystemUsers.LastName
                                FROM
                                    lurningo.Coupons
                                        LEFT JOIN
                                    ProductCoupons ON ProductCoupons.CouponID = Coupons.CouponID
                                        LEFT JOIN
                                    Product ON Product.ProductID = ProductCoupons.ProductID
                                        LEFT JOIN
                                    ProductCategory ON ProductCategory.CategoryID = ProductCoupons.CategoryID
										LEFT JOIN
									SystemUsers ON SystemUsers.SystemUserID = Coupons.CreatedFor
                                WHERE
                                    Coupons.CreatedBy = '$user_id'
                                        AND Status = '1'
                                ORDER BY Coupons.CouponID DESC");
      return $query->result();
    }

    public function All_category(){
      $query = $this->db->query("select * from ProductCategory");
      return $query->result();
    }

    public function All_products(){
      $query = $this->db->query("select * from Product where PublishedStatus = 'P'");
      return $query->result();
    }

    public function product_list($categoryid){
      $query = $this->db->query("select * from Product where PublishedStatus = 'P' and CategoryIds = '$categoryid'");
      return $query->result();
    }


  }

?>
