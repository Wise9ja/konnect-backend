<?php
require("mail/class.phpmailer.php");

 
    
$mail2 = new PHPMailer();

$mail2->IsSMTP();        // set mailer to use SMTP
$mail2->Host = "ssl://smtp.dreamhost.com";  // specify main and backup server
$mail2->SMTPAuth = true;     // turn on SMTP authentication
$mail2->Port = 465;     // turn on SMTP authentication
$mail2->Username = "mails@konnect.link";  // SMTP username
$mail2->Password = "Konnect_2020"; // SMTP password
$mail2->From = "mails@konnect.link";
$mail2->FromName = "Konnect";
$mail2->AddAddress("daviscool567@gmail.com");
$mail2->AddReplyTo("noreply@konnect.link");


$mail2->WordWrap = 50;                                 // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail2->IsHTML(true);                                  // set email format to HTML

$mail2->Subject = "Verification Code";
$mail2->Body    = '<!DOCTYPE HTML>     
    <html>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
</head>
<body>
<div style="dbackground-color:#eee; border:solid; border-width:thin; border-color:#EEE; position: relative; font-size:15px; padding-top:2em; padding:1em; font-family:Verdana, Geneva, sans-serif">


<h2>
YOUR VERIFICATION CODE IS '.$code.'
</h2>

			
</div>
</body>
</html>';


if($mail2->Send())
{
	$suc="YES";

} 

    
?>