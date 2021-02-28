<?php
include "includes/con.php";

$user = $_GET['user'];


 $sqlx =$con->query("SELECT * FROM referral WHERE referal_email ='$user'");
 $count = mysqli_num_rows ($sqlx);


 $sql ="SELECT * FROM customers WHERE email='$user'";
        $sql1 = $con->query($sql);
        $countx = mysqli_num_rows($sql1);

        if($countx >= 1)
        {
        $row = mysqli_fetch_array($sql1);
        {
        $ref_code = $row['ref_code'];

        $ref = "Hi, I use KONNECT to shop. Cheapest Prices + Free Delivery etc. 
Click below to enjoy up to NGN 5,000 credit.<br>
Click - https://konnect.link/ref?i=".$ref_code;

        }
        }
       


$output = array('ref' => $ref,  'count' => $count);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data
