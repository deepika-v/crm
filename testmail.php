<?php
require_once('/var/www/crm.lurningo.com/PHPMailer/PHPMailerAutoload.php');
try {
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = '127.0.0.1';
    //$mail->SMTPAuth = true;
    //$mail->Username = '3f9d71dc06081398b4770615e2558317';
    //$mail->Password = '475d576abb1a419a96102e297cd0bdbf';
    //$mail->SMTPSecure = 'tls';
    $mail->Port = 25;
    $mail->setFrom('tech@schoolguru.in', 'SG Tech');
    $mail->addAddress('yash.gadhiya@schoolguru.in');
    $mail->Subject = 'Test';
    $mail->Body    = 'Hello';

    if(!$mail->send()) {
       echo 'Message could not be sent.';
       echo 'Mailer Error: ' . $mail->ErrorInfo;
       exit;
    }
    echo 'Message has been sent';
}
catch (Exception $e){
    echo $e->getMessage();
}
?> 