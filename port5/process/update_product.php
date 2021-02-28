<?php
include 'config/config.php';
if(isset($_GET['set']))
{
$p_code = $_GET['p_code'];
$id = $_GET['id'];
$set = $_GET['set'];

if($set == "Available")
    {
        $stat = "Hidden";
    }
    else
    {
        $stat = "Available";
    }
 

$sqlx = $con->query("UPDATE product SET status = '$stat' WHERE  product_code ='$p_code' AND id='$id'") or die("Error2 : ". mysqli_error($con));
 
 if($sqlx)
 {
 $suc = "Yes";
 }
 else
 {
 $suc = "No";
 }
 
$output = array('success'=>$suc);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data	
}

else
{
$v_cost  = $_GET['v_cost'];
$price = $_GET['price'];
$market_price = $_GET['market_price'];
$p_code = $_GET['p_code'];
$id = $_GET['id'];



$sqlx = $con->query("UPDATE product SET price = '$price', market_price = '$market_price'  WHERE  id='$id'") or die("Error2 : ". mysqli_error($con));

 
 if($sqlx)
 {
 $suc = "Yes";
 }
 else
 {
 $suc = "No";
 }
 
$output = array('success'=>$suc);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

}
             
      ?>