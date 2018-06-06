<?php
require_once('/var/www/crm.lurningo.com/PHPMailer/class.phpmailer.php');
require_once('/var/www/crm.lurningo.com/PHPMailer/PHPMailerAutoload.php');

$conn = mysqli_connect("138.201.54.226","lurningo","SG@903lur","lurningo");

$sql = mysqli_query($conn,"SELECT crm_mailcontacts.MailContactID,crm_mailcontacts.MailID,crm_mailcontacts.CampaignContactsID,crm_mailcontacts.SentOn,crm_mailcontacts.Status,       crm_mail.Subject,crm_mail.SentFrom,crm_mail.Body,crm_mail.PlainText,crm_mail.TotalContacts,crm_mail.Status as MailID_Status, crm_contacts.FirstName,crm_contacts.Email,crm_contacts.ContactsID
FROM crm_mailcontacts
Join crm_mail ON crm_mail.MailID = crm_mailcontacts.MailID 
JOIN crm_campaigncontacts ON crm_campaigncontacts.CampaignContactID = crm_mailcontacts.CampaignContactsID
JOIN crm_contacts ON crm_contacts.ContactsID = crm_campaigncontacts.ContactsID
Where crm_contacts.Email NOT IN(SELECT Email FROM crm_mail_blacklist)
AND crm_mailcontacts.Status='0' 
AND crm_mail.Status = '0'
AND crm_contacts.EmailStatus= '1'
ORDER BY crm_mailcontacts.MailContactID LIMIT 50");

$mail = new PHPMailer(true);
$mail->CharSet="utf-8";
$mail->IsSMTP();
$mail->Host = "email-smtp.us-east-1.amazonaws.com";
$mail->SMTPAuth   = true;
$mail->Port       = 25;
$mail->Username   = "AKIAJYAHF52FNKPLQOHA";
$mail->Password   = "Ag0DxNVIbllmbvulyONYuEbnLNs76lhnFZk6SyWT8TxA";
$mail->SetFrom('info@lurningo.com', 'Lurningo');
$mail->SMTPSecure = 'tls';
$mail->isHTML(true);
//$mail->SMTPDebug = true;


while ($result = mysqli_fetch_assoc($sql)) {
    $MailID = $result['MailID'];
    $CampaignContactsID = $result['CampaignContactsID'];
    $MailContactID = $result['MailContactID'];
    $tracker = "http://crm.lurningo.com/Mailtracker/insert/".$MailID.'/'.$CampaignContactsID ;
    $opentracking = '<img border="0" src="'.$tracker.'" width="1" height="1" />';
    $message = $result['Body']."".$opentracking;
    $Altmessage = $result['PlainText']."".$opentracking;
    $message = str_replace('$cci$',$CampaignContactsID,$message);
    $message = str_replace('$email$',$result['Email'],$message);

    try {
        $mail->ClearAllRecipients();
        $mail->AddAddress($result['Email']);
        $mail->Subject = $result['Subject'];
        $mail->Body = $message;
        $mail->AltBody  = $Altmessage;
        $status = $mail->send();    
        if ($status) {
            $update = mysqli_query($conn,"update crm_mailcontacts set Status = 1 where MailContactID = $MailContactID");
            //echo "$MailContactID \n";
        }
        else {
            $update = mysqli_query($conn,"update crm_mailcontacts set Status = -1 where MailContactID = $MailContactID");
            //echo "Mailer Error: " . $mail->ErrorInfo;
            
        }

        //update sent mails count in crm_mails
    } 
    catch (Exception $e) {
        echo $e->getMessage() . "\n";
        $update = mysqli_query($conn,"update crm_mailcontacts set Status = -1 where MailContactID = $MailContactID");
    }
        //mysqli_close($conn); 
}
?>
