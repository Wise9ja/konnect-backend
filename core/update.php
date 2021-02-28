<?php
include "includes/con.php";

if (isset($_GET['email']))
{

//print_r($_GET);
    $id = $_GET['id'];
    $fname=$_GET['fname'];
    $lname=$_GET['lname'];
    $email=$_GET['email'];

    $phone=$_GET['phone'];
   
    $password = $_GET['password'];
    $password = sha1($password);

$sqln = $con->query("UPDATE customers set fname = '$fname', lname = '$lname', email = '$email', phone = '$phone', password = '$password', verify = 'YES' WHERE id = '$id'") or die("Error2 : " . mysqli_error($con));

$output = array('success'=>'YES');
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

}

?>