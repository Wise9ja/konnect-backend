<?php

include 'includes/functions.php';
include 'includes/connection.php';
$loc=$_GET['loc'];
$date_t=$_GET['date'];
$product=$_GET['product'];
$code = $_GET['code'];
$price=$_GET['price'];
$discount=$_GET['discount'];
$total=$_GET['total'];
$num_of_goods=$_GET['num_of_goods'];
$product_id=$_GET['product_id'];
$user = $_GET['user'];
$payment = $_GET['payment'];
$total = $total * $num_of_goods;


     $sql = $connn->query("SELECT * FROM cart WHERE user = '$user' AND product_code = '$code' ")  or die ("error: ".mysqli_error($connn));
    $exists = mysqli_num_rows($sql);
$sqlx3 =$exists?$exists:null;



$today = date("Y-m-d");
$today1 = date('Y-m-d',strtotime('-1 days',strtotime($today)));
$month = date("m-Y");
$year = date("Y");


//$sqlx3=$connn->query("SELECT * FROM product WHERE product_code ='$code'") or die("Error2 : ". mysqli_error($connn));

if($sqlx3)
{

    $rowsx3=mysqli_fetch_array($sql);

    $sector=$rowsx3['product_sector'];
    $pur_cashback=$rows3['purchase_cashback'];
 $cart_id =$rowsx3['id'];
    $sqlc = $connn->query("UPDATE cart SET  num_of_goods='$num_of_goods',final_total ='$total'  WHERE  id='$cart_id' ")
    or die("Error4: " . mysqli_error($connn));
}

else {
    $cart_id   = time();
    $sqlc = $connn->query("INSERT INTO cart (user, cart_id, product, product_code, product_sector,  num_of_goods, payment,  actual_price, discount, pur_cashback, final_total, date_t)  
      VALUES ('$user', '$cart_id', '$product', '$code',  '$sector', '$num_of_goods', 'Now', '$price', '$discount', '$pur_cashback', '$total',  '$today')") or die("Error4: " . mysqli_error($connn));


}


if($sqlc)
{
    $output = array('success'=>"YES");
    echo json_encode($output); //output JSON data


}
?>


