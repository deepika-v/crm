<?php
$rawdata = file_get_contents("php://input");
$postdata = print_r($_POST, true);
$getdata = print_r($_GET, true);

$data = "Raw Input Data \n\n$rawdata \n\nPOST \n\n$postdata \n\nGET \n\n$getdata";

require_once('/var/www/crm.lurningo.com/PHPMailer/PHPMailerAutoload.php');

try {
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'in-v3.mailjet.com';
    $mail->SMTPAuth = true;
    $mail->Username = '3f9d71dc06081398b4770615e2558317';
    $mail->Password = '475d576abb1a419a96102e297cd0bdbf';
    $mail->Port = 25;
    $mail->setFrom('tech@schoolguru.in', 'SG Tech');
    $mail->addAddress('tech@schoolguru.in');

    $mail->Subject = 'Data posted';
    $mail->Body    = $data;

    if(!$mail->send()) {
       echo 0;
       exit;
    }

    echo 1;
}
catch (Exception $e){
    echo $e;
}

echo "\n\n$data";
?>