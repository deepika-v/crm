<?php
  
  class Emailtracker extends CI_Controller{

    public function index(){
		$url = 'http://crm.lurningo.com/Emailtracker';
		$obj = json_decode(file_get_contents($url), true);
		var_dump($obj);
		
		
    }
  }

?>
