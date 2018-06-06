<?php
function check_email($email)
{
    $email = trim(strtolower($email));

    //If less than 8 characters, not an email
    if(strlen($email) < 8) return false;

    //Regex validation
    $pattern = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
    if (!preg_match($pattern, $email)) return false;

    //Check for filtered words
    $bad_words = array('nomail','spam','thank','dont','asd','sdf','dsf','abcd','mailnator','bulk','sdf','test','none','noone','nothing','sales','support','abuse','hell','fuck','aaa','bbb','ccc','ddd','eee','fff','ggg','hhh','iii','jjj','kkk','lll','mmm','nnn','ooo','ppp','qqq','rrr','sss','ttt','uuu','vvv','www','xxx','yyy','zzz','asd','qwe','zxc','xyz','sdf','jsd','jkl','djf','111','222','333','444','555','666','777','888','999','000','abc@','aa@','xyz@','need','tobeupdated');
    foreach($bad_words as $bad) {
        if (stripos($email, $bad) !== false) return false;
    }
    return TRUE;//email_verify($email); //TRUE;
}
function email_verify($email)
{
    $key = "WEYyEb2x0Cm6085Xq8DUP";
    $url = "https://app.emaillistverify.com/api/verifEmail?secret=".$key."&email=".$email;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
    
    $response = curl_exec($ch);
    curl_close($ch);

    if($response == 'ok') 
        return true;
    else
        return false;
}
try{      
          //require_once("dbconnect.php");
          $conn = mysqli_connect("138.201.54.226","lurningo","SG@903lur","lurningo");
          $sql = mysqli_query($conn,"SELECT Email  FROM crm_contacts Where EmailStatus='0' Limit 10");
          while ($result = mysqli_fetch_assoc($sql))
          {
              $email = $result['Email']; 
             //echo $email;
             $status =check_email($email) ? '1' : '0';
            //echo $status." ".$email."<br>";
           if($status=="1")
               $update = mysqli_query($conn,"update crm_contacts set EmailStatus = '0' where Email = '$email'");
          else
              $update = mysqli_query($conn,"update crm_contacts set EmailStatus = '-1' where Email = '$email'");
          }
        mysqli_close($conn);   

    }catch(Exceptions $ex)
    {


    }

 //echo $result['Email'];



?>
