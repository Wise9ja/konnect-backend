<?php
include 'includes/con.php';
$product=$_GET['product'];
$code = $_GET['code'];
$price=$_GET['price'];
$user = $_GET['user'];


     $sql = $con->query("SELECT * FROM saved WHERE user = '$user' AND product_code = '$code' ")  or die ("error: ".mysqli_error($con));
    $exists = mysqli_num_rows($sql);
   
if($exists == 0)
{
$today = date("Y-m-d");
$today1 = date('Y-m-d',strtotime('-1 days',strtotime($today)));
$month = date("m-Y");
$year = date("Y");

    $sqlc = $con->query("INSERT INTO saved (user, product, product_code, price,  date_t)  
      VALUES ('$user', '$product', '$code',  '$price',  '$today')") or die("Error4: " . mysqli_error($con));





if($sqlc)
{
    $suc = "YES";
}
}

if(isset($_GET['callback']))
{
header("Content-Type:application/json");
}


$output = array('success' => $suc);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

?>


