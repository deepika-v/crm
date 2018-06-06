<?php
  
  class Unsubscribe extends CI_Controller{

    public function index (){

      $email =  $this->input->get('e');
      if ($email != ''){
      $query = $this->db->query("insert into crm_mail_blacklist (Email, BlockedOn , CategoryID) values('$email', CURRENT_TIMESTAMP(), '1')");
	
	  //echo "You have been successfully unsubscribed from email communications.";
	  echo '<!doctype html>
			<html>
			 <head>
			  <meta charset="UTF-8">
			  <title>Unsubscribe from Lurningo</title>
			 </head>
			 <body>
				<div style="text-align: center; padding-top: 100px; font-family: Arial; font-size: 14px;">
					<img src="http://crm.lurningo.com/assets/images/lurningo-w-300.png" width="200">
					<br /><br /><br />
					You have been successfully unsubscribed from our mailing list.
					<br /><br /><br />
					Go to <a href="https://www.lurningo.com/" style="color:blue; text-decoration: none;">Lurningo.com</a>
				</div>
			 </body>
			</html>';
      
	}else{
	  //echo "You have been successfully unsubscribed from email communications.";
	}
  }
}
  
?>
