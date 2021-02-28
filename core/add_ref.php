<?php
include 'includes/con.php';
$i = $_GET['i'];
$email = $_GET ['email'];
 

$sql =$con->query("SELECT * FROM customers WHERE ref_code='$i'");
$countx = mysqli_num_rows($sql);
if ($countx)
{
$rows = mysqli_fetch_array($sql);
$emailx = $rows['email'];


$month = date("m-Y");
$year = date("Y");

 $sqlc = $con->query("INSERT INTO referral (referral_email, referral_code, referred_email, month, year, date_t)  
      VALUES ('$emailx', '$i',  '$email', '$month', '$year', '$today')") or die("Error4: " . mysqli_error($con));

$suc = "YES";
}



      



$output = array('success'=>$suc);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data
