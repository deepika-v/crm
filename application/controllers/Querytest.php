<?php defined('BASEPATH')OR exit('No direct script access allowed');
class Querytest extends CI_Controller{
	protected $data = array();
	function __construct()
	{
		parent::__construct();
       $this->load->library('form_validation');
       $this->load->library('session');
		   $this->load->model('Querymodel');
	}
  
  public function index()
  {
         
       $insertdata["Hash"] = password_hash("@!urning0", PASSWORD_BCRYPT);
       //print_r($insertdata);



$string = "u=TNOU&v=8888&s=12029";
$secret_key = "1296ac3ca7fb4df6b6332c1516225a96";

// Create the initialization vector for added security.
$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);

// Encrypt $string
$encrypted_string = bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $secret_key, $string, MCRYPT_MODE_CBC, $iv));
// Decrypt $string
$decrypted_string = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $secret_key, hex2bin($encrypted_string), MCRYPT_MODE_CBC, $iv);

echo "Original string : " . $string . "<br />\n";
echo "Encrypted string : " . $encrypted_string . "<br />\n";
echo "Decrypted string : " . $decrypted_string . "<br />\n";
$encrypted_string =  encrypt($string);
$decrypted = decrypt($encrypted_string);

echo "Original string : " . $string . "<br />\n";
echo "Encrypted string : " . $encrypted_string . "<br />\n";
echo "Decrypted string : " . $decrypted . "<br />\n";
}


 function encrypt($pure_string) {
    $dirty = array("+", "/", "=");
    $clean = array("_PLUS_", "_SLASH_", "_EQUALS_");
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $_SESSION['iv'] = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $_SESSION['encryption-key'], utf8_encode($pure_string), MCRYPT_MODE_ECB, $_SESSION['iv']);
    $encrypted_string = base64_encode($encrypted_string);
    return str_replace($dirty, $clean, $encrypted_string);
}

function decrypt($encrypted_string) { 
    $dirty = array("+", "/", "=");
    $clean = array("_PLUS_", "_SLASH_", "_EQUALS_");

    $string = base64_decode(str_replace($clean, $dirty, $encrypted_string));

    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $_SESSION['encryption-key'],$string, MCRYPT_MODE_ECB, $_SESSION['iv']);
    return $decrypted_string;
}

            
 //       }//END OF INDEX FUNCTION 
  
   
 }  

?>