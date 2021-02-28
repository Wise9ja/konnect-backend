<?php
include "includes/con.php";

if(isset($_GET['user']))

{

$user = $_GET['user'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$street = $_GET['street'];
$landmark = $_GET['landmark'];
$lga = $_GET['lga'];
$state = $_GET['state'];
$inv_num = $_GET['inv_num'];


$fulname = $fname." ".$lname;


$date_t = date("Y-m-d");

        
$sql = $con->query("UPDATE shipping SET status = '' WHERE user ='$user'");

 $insert=$con->query("INSERT INTO shipping (user, fname, lname, phone, email, addr, landmark, lga, state, status,  date_t) 
      VALUES ('$user', '$fname', '$lname', '$phone', '$email', '$street', '$landmark', '$lga', '$state', 'Default', '$today')") or die("Error: ".mysqli_error($con));



$del_addr = '<h5><b>'.$fulname.'</b></h5>

                '.$email.'<br>
                '.$phone.'<br>
                 '.$street.'<br>
                 '.$landmark.'<br>
                 '.$state.'<br>';
             
$sqlx = $con->query("UPDATE sales SET delivery_addr = '$del_addr' WHERE  inv_num = '$inv_num' AND  user ='$user'");

if($sqlx)
{
    $suc = "Yes";
}
        
$output = array('del_addr' => $del_addr, 'sucess' => $suc);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

}

 ?>