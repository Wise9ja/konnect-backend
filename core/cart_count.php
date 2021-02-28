<?php
include "includes/con.php";

$user = $_GET['user'];
$sql1 = $con->query("SELECT * FROM cart WHERE  user = '$user' AND  status = 'Cart' ORDER BY id DESC") or die("Error2 : ". mysqli_error($con));
$nums_row = mysqli_num_rows($sql1);



if(isset($_GET['callback']))
{
header("Content-Type:application/json");
}

$output = array('cart' => $nums_row);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

?>
