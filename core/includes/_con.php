<?php
$host="mysql.konnect.link"; //hostname
$username="davis_567"; //mysql username
$password="Davis_567_2020"; //mysql password
$db_name="konnect"; //Database name
//connect to database
$con=mysqli_connect($host,$username,$password, $db_name);
if(!$con)
{die('could not connect1:'.mysqli_error());}
//mysql_select_db($db_name,$con)
//or die("could not connect2: ".mysql_error());
?>
