<?php 
  
  class Mailtracker extends CI_Controller{

    public function insert(){

      header( 'Content-Type: image/gif' );

      $mailid = $this->uri->segment(3);
      $CampaignContactsID = $this->uri->segment(4);

      $count = $this->db->query("select OpenedOn from crm_mailcontacts where MailID = '$mailid' and CampaignContactsID = '$CampaignContactsID'")->row();

      $result = $count->OpenedOn;
      
      if ($result == '') {
        
        $query = $this->db->query("update crm_mailcontacts set OpenedOn = current_timestamp where MailID = '$mailid' and CampaignContactsID = '$CampaignContactsID'");
      }
      $graphic_http = base_url().'assets/images/blank.gif';
      $filesize = filesize(base_url().'assets/images/blank.gif');
      //Now actually output the image requested, while disregarding if the database was affected
      header( 'Pragma: public' );
      header( 'Expires: 0' );
      header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
      header( 'Cache-Control: private',false );
      header( 'Content-Disposition: attachment; filename="blank.gif"' );
      header( 'Content-Transfer-Encoding: binary' );
      header( 'Content-Length: '.$filesize );
      readfile( $graphic_http );
      exit;
    }
  }

?>