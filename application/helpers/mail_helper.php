<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('sendemail'))
{
    function sendemail($to, $cc,$bcc,$subject,$message, $altmessage)
    {
        try{

                  require_once('PHPMailer/class.phpmailer.php');
                  require_once('PHPMailer/PHPMailerAutoload.php');
                  $status='';
                  $mail = new PHPMailer(true); 
                  $mail->CharSet="windows-1251";
                  $mail->CharSet="utf-8";
                  $mail->IsSMTP();
                  $mail->Host = "email-smtp.us-east-1.amazonaws.com";
                  $mail->SMTPAuth   = true;                  // enable SMTP authentication
                  $mail->Port       = 25;                    // set the SMTP port for the server
                  $mail->Username   = "AKIAJYAHF52FNKPLQOHA"; // SMTP account username
                  $mail->Password   = "Ag0DxNVIbllmbvulyONYuEbnLNs76lhnFZk6SyWT8TxA";        // SMTP account password
                  $mail->AddAddress($to); //email address of receiver
                  $mail->SetFrom('info@lurningo.com', 'Lurningo'); //email address of sender
                  $mail->isHTML(true);  
                  $mail->SMTPSecure = 'tls';
                  $mail->Subject = $subject;
                  $mail->Body = ($message);
                  $mail->AltBody  = $altmessage;
            
                  $status = $mail->send();
                  //$mail->SMTPDebug = 2;
                  return $status;
            }catch (phpmailerException $e)
            { //echo "<pre>"; 
              //print_r($e);
              //echo "</pre>";
                    //echo $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch(Execptions $ex)
            {
   

            }  
        
    }
}

if ( ! function_exists('send_couponmail'))
{
    function send_couponmail($to, $cc,$bcc,$subject,$message, $altmessage)
    {
        try{
           //config for coupons
          $config ['protocol'] = 'smtp'; 
          $config ['smtp_host'] = 'smtp.sparkpostmail.com'; //SMTP Server
          $config ['smtp_port'] = 587;          //SMTP Port
          $config ['mailpath'] = '/usr/sbin/sendmail';
          $config ['smtp_user'] = 'SMTP_Injection';                 //SMTP user name
          $config ['smtp_pass'] = 'eeba7b59202366ae3cb85bcd4fb9480027f4217f'; //SMTP password
          $config ['mailtype'] = 'html';
          $config ['charset'] = 'iso-8859-1';
          $config ['wordwrap'] = TRUE;
          $config['smtp_crypto'] = 'tls';
          $config ['smtp_auth'] = 'AUTH LOGIN';
          $this->load->library('email');
          $this->email->initialize($config);
          $this->email->set_newline("\r\n");
          //$data["sender_mail"] = "info@lurningo.com";
          $this->email->from('info@lurningo.com', "Lurningo");//email address of sender
          $this->email->to($to); //email address of receiver
          $this->email->subject($subject);
          $body = $message;
        $this->email->message($body);
        try{ 
      $status = $this->email->send();
        }catch( Exception $e ){
    
    } 
            }catch (phpmailerException $e)
            { //echo "<pre>"; 
              //print_r($e);
              //echo "</pre>";
                    //echo $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch(Execptions $ex)
            {
   

            }  
        
    }
}




/* End of file mail_helper.php */
/* Location: ./system/helpers/mail_helper.php */
