<?php
include 'includes/con.php';
$product_code = $_GET['product_code'];
$user = $_GET['user'];
$id = $_GET['id'];



$sqlw_1 = $con->query("SELECT * FROM product WHERE product_code = '$product_code' AND status != 'Hidden'") or die("Error2 : " . mysqli_error($con));

$product = mysqli_fetch_array($sqlw_1);
$photo = $product["photo"];
$price = $product["price"];
$sector = $product["sector"];
$code = $product["product_code"];
$product = $product['product'];
$discount = $product['premiun_discount'];
$pur_cashback = $product['purchase_cashback'];
$num_of_goods = 1;
$total = $price * $num_of_goods;




$today = date("Y-m-d");
$today1 = date('Y-m-d',strtotime('-1 days',strtotime($today)));
$month = date("m-Y");
$year = date("Y");


    $cart_id   = time();
    $sqlc = $con->query("INSERT INTO cart (user, product, product_code, product_sector,  num_of_goods, payment,  actual_price, discount, pur_cashback, final_total, status, date_t)  
      VALUES ('$user', '$product', '$code',  '$sector', '$num_of_goods', 'Now', '$price', '$discount', '$pur_cashback', '$total', 'Cart',  '$today')") or die("Error4: " . mysqli_error($con));

$sqln = $con->query("DELETE FROM  saved  WHERE id = '$id'") or die("Error2 : " . mysqli_error($con));



if($sqlc)
{
    $suc = "YES";
}


if(isset($_GET['callback']))
{
header("Content-Type:application/json");
}


$output = array('success' => $suc);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

?>


