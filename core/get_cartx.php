<?php
include "includes/con.php";

$user = $_GET['user'];
$sql1 = $con->query("SELECT * FROM cart WHERE  user = '$user' AND  status = 'Cart' ORDER BY id DESC") or die("Error2 : ". mysqli_error($con));
$nums_row = mysqli_num_rows($sql1);
if($sql1) {
    $sum1 = 0;
    while ($rows1 = mysqli_fetch_array($sql1)) {
        $id = $rows1['id'];
        $cart_id = $rows1['cart_id'];
        $code = $rows1['product_code'];
        $num_goods = $rows1['num_of_goods'];
        $product = $rows1['product'];
       // $price = $rows1['actual_price'];
        $product_sector = $rows1['product_sector'];
        $discount = $rows1['discount'];
        $num_of_goods = $rows1['num_of_goods'];
        $discounted_price = $price - $discount;
        
        

        $sqlx = $con->query("SELECT * FROM product WHERE product_code = '$code'") or die("Error2 : " . mysqli_error($con));
        if ($sqlx) {

            $rowsx = mysqli_fetch_array($sqlx);
// $id=$rowsx['id'];
            $photo = $rowsx['photo'];
            $price = $rowsx["price"];
        $price = ($price * 105)/70;
        $market_price = $rowsx["market_price"];
        
      if($market_price == 0)
      {
          $price =$price;
      }
      else
      {
        $price = $market_price;
      }

$final_total = $price * $num_of_goods;
$sum1 = $sum1 + $final_total;


         $price = number_format($price);
 
            $sid = "s" . $id;
            $mid = "m" . $id;
            $pid = "p" . $id;


            $qid2 = "#q" . $id;
            $mid2 = "#m" . $id;

            $tid = "t" . $id;

        }
        
            $cart .= '<div class="cart_card row" style="background-color:white; padding-bottom: 0.5em; font-size:17px; border-bottom:solid; border-bottom-color: #cccccc; border-bottom-width:thin;">
            <div class="col-sm-3">
            <span><i class="fa fa-trash" style="color:red; cursor:pointer" onclick="update_cart( \''.$id.'\', \'delete\' )"></i></span>
                <img src="https://konnect.link/port5/products/'.$photo.'" class="img-fluid" width="120" /></div>
            <div class="col-sm-9"><br>
                <h5>'.$product.'</h5>
                <div class="row control_box">
                    <div class="col-sm-6" style="cursor: pointer">
                       <!-- <div class="control_box_control">
                           <!-- <span class="control"><i class="fa fa-minus" onclick="update_cart(\''.$num_goods.'\', \''.$id.'\', \'reduce\' )"></i></span>-->
        <select  id="'.$sid.'" onchange = "update_cart(\''.$id.'\', \'add\')"  style="height:30px; font-size:18px; width: 100px;">

                          <option selected="selected">'.$num_of_goods.'</option>
                          <option value="'.$num_of_goods.'">-------------------</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                            
                            </select>
                           <!-- <span class="control"><i class="fa fa-plus" onclick="update_cart(\''.$num_goods.'\', \''.$id.'\',  \'add\' )"></i></span>-->
                       <!-- </div>-->
                    </div>
                    <div class="col-sm-6 text-right" style="margin-top:-20px;">
                        <h4 style="font-size:20px;" id = "'.$pid.'" class="font-weight-bold">x &nbsp;&nbsp; &#8358;'.$price.'</h4>
                    </div>
                </div>
            </div>
        </div>';

        }

    }


$sqld = $con->query("SELECT * FROM discount") or die("Error2 : " . mysqli_error($con));
        if ($sqld) {

            $rowsd = mysqli_fetch_array($sqld);
            $pay_now = $rowsd['pay_now'];
            $delivery = $rowsd["free_delivery"];

            $delivery = "&#8358;".number_format($delivery);
        }

$sum1 = '&#8358;'.number_format($sum1);
if(isset($_GET['callback']))
{
header("Content-Type:application/json");
}


$output = array('cart' => $cart, 'total' => $sum1, 'cart_id' => $cart_id, 'cartx' => $nums_row, 'delivery'=>$delivery);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

//echo $cart;


   ?>

