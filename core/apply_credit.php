<?php
if(isset($_POST['user']))
{
include 'includes/con.php';
require("mail/class.phpmailer.php");

$user = $_POST['user'];
$email = $_POST['email'];
$phone = $_POST['phone'];
//$bvn = $_POST['bvn'];
$income = $_POST['income'];
$name = $_POST['name'];


$email = stripslashes($email);
$phone = stripslashes($phone);
//$bvn = stripslashes($bvn);
$income = stripslashes($income);

$email = strip_tags($email);
$phone = strip_tags($phone);
//$bvn = strip_tags($bvn);
$income = strip_tags($income);

$email = mysqli_real_escape_string($con, $email);
$phone = mysqli_real_escape_string($con, $phone);
//$bvn =   mysqli_real_escape_string($con, $bvn);
$income = mysqli_real_escape_string($con, $income);


$today = date("Y-m-d");
$today2 = date("D d-M-Y");

 
$file_size=$_FILES['file']['size'];

    $allowed_files=array("image/jpeg","image/jpg","image/png");

    if($file_size > 0)
    {
    $file=$_FILES['file']['name'];
    $file_type=$_FILES['file']['type'];
    $kaboom = explode(".", $file);
    $fileExt = end($kaboom);
    $file = rand(100000000000,999999999999).$user.".".$fileExt;
    if(in_array($file_type, $allowed_files))
    {
     $path="../port5/vaild_id/".$file;
     move_uploaded_file($_FILES['file']['tmp_name'],$path);
    }
    }



 $insert=$con->query("INSERT INTO kredit (user, email, mobile,  valid_id, income, total, status, date_t) 
      VALUES ('$user', '$email', '$phone',  '$file', '$income', '100000', 'Pending',  '$today')") or die("Error: ".mysqli_error($con));
      
$code = rand(00000, 99999);

 
    $date_t = date("d-M-Y"); 

$sqlx="UPDATE kredit set code = '$code' WHERE email='$email'";
$resultx=$con->query($sqlx) or die ("error2: Server error ".mysqli_error($con));

    
$mail2 = new PHPMailer();

$mail2->IsSMTP();        // set mailer to use SMTP
$mail2->Host = "ssl://smtp.dreamhost.com";  // specify main and backup server
$mail2->Port = 465;     // turn on SMTP authentication
$mail2->SMTPAuth = true;     // turn on SMTP authentication
$mail2->Username = "mails@konnect.link";  // SMTP username
$mail2->Password = "Konnect_2020"; // SMTP password
$mail2->From = "mails@konnect.link";
$mail2->FromName = "Konnect";
$mail2->AddAddress($email);
$mail2->AddReplyTo("noreply@konnect.link");


$mail2->WordWrap = 50;                                 // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail2->IsHTML(true);                                  // set email format to HTML

$mail2->Subject = $name.", Purchase Credit Successful with Pin Code";
$mail2->Body    = '<p>Dear '.$name.'</p>

<p> Your purchase credit is successful from this date '.$today2.' </p>

<p> You can use a maximum amount of N100,000 every 30 days with up to 50% credit off your order. </p>

<p> Credit used within 30 days is paid back and roll over at the end the 30 day period. </p>

<p style="color:red; font-size:17px; font-weight:bold;"> Please use this '.$code.' to activate your purchase credit.</p>

 

<p>
Thanks <br>
Konnect Team 
</p>

             
</div>
</body>
</html>';


if($mail2->Send())
{
    $suc="YES";

} 

    
if($insert)
{
$suc = "YES";
}

}

$output = array('success'=>$suc);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data
//mysql_close($con);
?>