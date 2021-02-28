<?php
include "includes/con.php";


$id = $_GET['id'];
$sql1 = $con->query("SELECT * FROM product WHERE id = '$id' ") or die("Error2 : " . mysqli_error($connn));


if ($sql1) {

    $rows = mysqli_fetch_array($sql1);

    $id = $rows['id'];
    $photo = $rows['photo'];
    $product = $rows['product'];
    $product_code = $rows['product_code'];
    $price = $rows['price'];
    $pricex = $rows['price'];
    $cashback = $rows['purchase_cashback'];
    $product_sector = $rows['product_sector'];
    $product_category = $rows["product_category"];
    $product_id = $rows['product_id'];
    $brand = $rows['brand'];
    $desc = $rows['description'];
    $overview = $rows['overview'];
    $warranty = $rows['warranty'];
    $shipping = $rows['shipping'];
    $code = $rows['product_code'];

        $price = ($price * 105)/70;
        $pricex = $price;
    
        $market_price = $rows["market_price"];
        
      if($market_price == 0)
      {
          $price = $price;
      }
      else
      {
        $price = $market_price;
      }

$discounted_price = $price - $rows['premium_discount'];
$price = "&#8358;".number_format($discounted_price);
$cashback = "&#8358;".$cashback;
$product_pic = '<img src="https://konnect.link/port5/products/'.$photo.'" class="img-thumbnail" style="padding: 0;width: 100%" />';



}


if(isset($_GET['callback']))
{
header("Content-Type:application/json");
}


$output = array('product' => $product, 'price' => $price, 'pricex' => $pricex, 'cashback' => $cashback, 'code' => $code, 'product_pic' => $product_pic, 'desc' => $desc);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

?>




