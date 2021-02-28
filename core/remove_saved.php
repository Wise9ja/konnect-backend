<?php
if(isset($_GET['id']))
{
include 'includes/con.php';
$id=$_GET['id'];

$sqln = $con->query("DELETE FROM saved WHERE id = '$id'") or die("Error2 : " . mysqli_error($con));

if(isset($_GET['callback']))
{
header("Content-Type:application/json");
}

$output = array('success' => "Yes");
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data
}

?>
