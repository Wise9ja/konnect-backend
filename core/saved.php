<?php
include "includes/con.php";

$user = $_GET['user'];

$sqlw = $con->query("SELECT * FROM saved WHERE user = '$user' ") or die("Error2 : " . mysqli_error($con));
$countw = mysqli_num_rows($sqlw);

while($order = mysqli_fetch_array($sqlw))
{
$product_code =  $order['product_code'];
$id =  $order['id'];


$sqlw_1 = $con->query("SELECT * FROM product WHERE product_code = '$product_code' AND status != 'Hidden'") or die("Error2 : " . mysqli_error($con));

$product = mysqli_fetch_array($sqlw_1);
$photo = $product["photo"];
$order_id = $order['id'];

 $price = $product["price"];
        $price = ($price * 105)/70;
        $market_price = $product["market_price"];
        
      if($market_price == 0)
      {
          $price =$price;
      }
      else
      {
        $price = $market_price;
      }

$cashback = number_format($product["purchase_cashback"]);
$product = $product['product'];
$status = $product['status'];


               $saved .= '<div class="cart_card row">
                    <div class="col-sm-3">
                        <img src="https://konnect.link/port5/products/'.$photo.'" class="img-fluid"></div>
                    <div class="col-sm-9"><br>
                        <h5>'.$product.'<span class="float-right text-warning">'.$status.'</span></h5>
                        <h5 style="margin-top: 50px">₦'.number_format($price).'</h5>
                        <div><small class="text-primary">Your cash back is ₦'.$cashback.'</small>

                        <span class="text-danger float-right"  style="color:red!important;font-weight: 700">
                            <a href="#" class="text-danger" onclick="remove_saved(\''.$id.'\');"><i class="fa fa-trash"></i> Delete </a>
                            <a href="#" class="text-danger" onclick="add_basket(\''.$product_code.'\', \''.$id.'\');" style="margin-left: 30px"><i class="fa fa-shopping-bag"></i> Add to Cart </a>
                        </span></div>

                </div>
            </div>';
              } 


 if($countw==0)
{
$saved = '<div>You have no saved item!</div>';
}  

$output = array('saved' => $saved);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

?>