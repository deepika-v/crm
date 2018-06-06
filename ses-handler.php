<?php

$conn = mysqli_connect("138.201.54.226","lurningo","SG@903lur","lurningo");
$json = file_get_contents("php://input");

$a = json_decode($json);
$b = json_decode($a->Message);
$email = $b->mail->destination[0];
$status = $b->notificationType;

if($status == 'Complaint'){
	$query = mysqli_query($conn,"insert into crm_mail_blacklist (Email, BlockedOn , CategoryID) values('$email', CURRENT_TIMESTAMP(), '3')");
}
if($status == 'Bounce'){
	$query = mysqli_query($conn,"insert into crm_mail_blacklist (Email, BlockedOn , CategoryID) values('$email', CURRENT_TIMESTAMP(), '4')");
}

if($status == 'Complaint' && $status == 'Bounce'){
	require_once('/var/www/crm.lurningo.com/PHPMailer/PHPMailerAutoload.php');
	try {
		$mail = new PHPMailer;

		//This is required for gmail
		/*
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);*/

		$mail->isSMTP();
		$mail->Host = 'in-v3.mailjet.com';
		$mail->SMTPAuth = true;
		$mail->Username = '3f9d71dc06081398b4770615e2558317';
		$mail->Password = '475d576abb1a419a96102e297cd0bdbf';
		//$mail->SMTPSecure = 'tls';
		$mail->Port = 25;
		$mail->setFrom('tech@schoolguru.in', 'SG Tech');
		$mail->addReplyTo('schoolgurutech@gmail.com', 'SG Tech');
		$mail->addAddress('yash.gadhiya@schoolguru.in');
		$mail->Subject = 'SNS Post';
		$mail->Body    = 'Here is the data - ' . $json;

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
}
?>
