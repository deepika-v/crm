<?php $this->load->helper('file');?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lurningo</title>
</head>
<?php $image1 = base_url("mails/sd-card-mail1/lurningo-logo.png");?>
<?php $image2 = base_url("mails/sd-card-mail1/sd-card.jpg");?>
<?php $image3 = base_url("mails/sd-card-mail1/lurningo-logo-f.png");?>
<?php $fileExt1 = get_mime_by_extension($image1);?>
<?php $fileExt2 = get_mime_by_extension($image2);?>
<?php $fileExt3 = get_mime_by_extension($image3);?>

<body style=" margin:0px;">
<table width="800" border="0" cellspacing="0" cellpadding="0" style="font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif; border:1px solid #D0D0D0; margin:0px auto;">
  <tbody>
    <tr>
      <td width="420" bgcolor="#131313" style="padding:10px 20px; color:#fff; font-size:16px;">Infinite learning –Infinite Possibilities</td>
      <td width="380" align="right" bgcolor="#131313" style="padding:10px 10px 5px;">
       <?php  echo '<img src="data:'.$fileExt1.';base64,'.base64_encode(file_get_contents($image1)).'" width="120" height="36" alt="lurningo"/>' ;?></td>
    </tr>
    <tr>
      <td colspan="2" style="background:#00aeef; text-align:center;"><h2 style="line-height:30px; font-size:30px; font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif; font-weight:normal; text-transform:uppercase; color:#ffffff;">Don’t let slow internet<br>
hamper your scores. </h2><h1 style="font-size:60px; font-weight:bold; text-transform:uppercase; margin-top:10px; color:#ffffff;">Learn  offline</h1></td>
    </tr>
    <tr>
      <td>
      <?php echo '<img src="data:'.$fileExt2.';base64,'.base64_encode(file_get_contents($image2)).'" width="420" height="333" alt="lurningo"/>' ;?>
        <h4 style="text-align:center; text-transform:uppercase; font-size:28px; text-align:center; margin:10px;">Plug in, Play & Learn.</h4>
      </td>
      <td valign="top" style="padding:20px;">
      	<h3 style="font-size:36px; line-height:36px; text-transform:uppercase; color:#094a5d; text-align:right;">Introducing<br>
        user-friendly<br>
      <span style="color:#61ac00;">SD cards!</span></h3>
      	<table>
        	<tr>
        	<td style="padding:15px; background:#f3f3f3; color:#000;">
            	<ul style="margin:0px; margin-left:20px; padding:0px; font-size:18px;">
                	<li style="padding-bottom:15px;">Learning in offline mode.
No Internet connection required.</li>
                	<li style="padding-bottom:15px;">Access to premium quality
video lectures by Experts.</li>
                	<li style="padding-bottom:15px;">Practice quiz based on
previous year question paper.</li>
                </ul>
            </td>
            </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td bgcolor="#0F0F0F" style="padding:10px 20px; color:#fff; font-size:16px;">www.lurningo.com</td>
      <td bgcolor="#0F0F0F" style="padding:10px 20px; color:#f6a20e; font-size:16px; text-align:right;">Call: 0800 000 0008</td>
    </tr>
    <tr>
      <td colspan="2" style="padding:50px; text-align:justify;">
      Dear Sir,<br>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Why do we use it?</p>
      <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
      <p>Regards</p>
      <p><?php  echo '<img src="data:'.$fileExt3.';base64,'.base64_encode(file_get_contents($image3)).'" width="105" alt="lurningo"/>' ;?>  
      </p></td>
    </tr>
  </tbody>
</table>

</body>
</html>