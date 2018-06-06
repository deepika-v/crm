<?php $this->load->helper('file');?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Test Mail</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
 <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
 <tr><td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0;">
 <?php  echo '<img src="data:'.get_mime_by_extension(base_url('assets/template/templateimages/logo2.png')).
   ';base64,'.base64_encode(file_get_contents(base_url('assets/template/templateimages/logo2.png'))).'" alt="Test Image" height="50"/>' ;?>
</td></tr>
 <tr>
  <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
 <table border="0" cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td>
   <h4>Hi</h4>
   <p>
Recommendations for you.
We combed our catalog and found courses and Specializations that we think match your interests.
Browse our recommendations below, and start learning something new today! Visit the link 
<a href ="http://192.168.1.112/lurningocrm/">Click Here</a>
   </p>

  </td>
 </tr></table>

</body>
</html>


