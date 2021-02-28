<?php
$mail4 = new PHPMailer();

$mail4->IsSMTP();        // set mailer to use SMTP
$mail4->Host = "smtp.1and1.com";  // specify main and backup server
$mail4->SMTPAuth = true;     // turn on SMTP authentication
$mail4->Port = 587;     // Set the SMTP port number
$mail4->Username = "mails@konnect.one";  // SMTP username
$mail4->Password = "!@AKonnect.One001"; // SMTP password

$mail4->From = "training@agilep3.com";
$mail4->FromName = "Agile P3";
$mail4->AddAddress($email, $fname);
$mail4->AddBcc("training@agilep3.com");
$mail4->AddReplyTo("hello@agilep3.com", "AgileP3");

$mail4->WordWrap = 50;                                 // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail4->IsHTML(true);                                  // set email format to HTML

$mail4->Subject = $fname.",  Your SEAT is CONFIRMED - Project Management Training (PRINCE2)";
$mail4->Body    = '<!DOCTYPE HTML>     
    <html>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
</head>
<body>
<div style="background-color:white; width: 80%; margin:auto; dborder:solid; dborder-width:thin; bdorder-color:#EEE; position: relative; font-size:15px; padding-top:2em; padding:1em; font-family:Verdana, Geneva, sans-serif">
<img src="http://www.agilep3.com/reg/logo.png"><br><br>


<p style="font-size:15px; dtext-align:center;">
Hello '.$fname.',
</p>
<p style="font-size:15px; dtext-align:center;">
Congratulations, your seat is now CONFIRMED for the Project Management Training (PRINCE2 Foundation).  <a href="https://www.konnect.one/action/admission_letter.php?a='.$email.'"> Please download your admission letter here. </a>
</p>

<p> <b> See the training details below. </b></p>

<p>Date: <b>'.$train_date.'</b></p>
<p>Time: <b>8am to 5pm </b>  <i>(PLEASE NOTE LATENESS IS NOT ENCOURAGED)</i> </p>
<p>Venue: <b>'.$addr.'.</b></p>

<!--<p><b>Training slot is very limited and if you decide to reschedule to a new class date, you will be required to PAY a registration fee. </b></p>-->


<p> <a href="https://goo.gl/gPCrp6"> For testimonials click https://goo.gl/gPCrp6   </a> </p>

<p style="color: red; font-weight: bold;">The training is offered for FREE with full access to the training portal. Note; </p>
<p>1.	Kindly come with your write pen and a note pad. </p>
<p>2.	Refreshment is available at a discounted rate. </p>

<p>After this class you will have access to our Professional Mentoring & Experience (PME) programme that will help you develop into a brilliant project manager. </p>


<p style="font-weight: bold;">Key Reasons Why You MUST ATTEND this class </p>
<ul style="line-height: 25px"> 
<li> This class will help you kick start skills required to manage projects within ALL sectors. </li>	
<li> This class provides a platform to become a Brilliant Project Manager. </li>
<li> Provides FREE voucher to Attend professional course/s of your choice (click http://bit.ly/2CJRGz9). </li>
<li> FREE access to 50+ online courses. </li>
<li> Opportunity to earn a 30% referral fee as an affiliate. </li>
</ul>


<p> Also, you can refer your friends and families to attend this FREE training by forwarding the message below to them, click, copy and paste to any medium (we have inserted your referral link). </p>

<p> 
Hello, I attended a FREE Project Management training (worth N55k) & I have few referral slots. Click https://www.konnect.one/i/'.$ref_code.' . Also click http://bit.ly/2CJRGz9 on why you MUST attend </p>
<p>Please note that there is limited parking space at the training venue. </p>

<p>
Regards,</p>
<p><b>Olumide Fashina</b><br>Managing Consultant</p>

</div>
</div>

</body>
</html>';

if($mail4->Send())
{
}