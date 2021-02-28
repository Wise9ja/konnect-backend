<?php
include "includes/con.php";

$inv_num = $_GET['inv_num'];

$sqlw = $con->query("SELECT * FROM cart WHERE  inv_num = '$inv_num' ") or die("Error2 : " . mysqli_error($con));
$countw = mysqli_num_rows($sqlw);


 while($order = mysqli_fetch_array($sqlw))
{ 
$inv_num = $order['inv_num'];
$order_id =  $order['id'];
$product =  $order['product'];
$code =  $order['product_code'];
$price = number_format($order['actual_price'],2);
$total = number_format($order['final_total'],2);
$units = number_format($order['num_of_goods']);


 $sqlx = $con->query("SELECT * FROM product WHERE product_code = '$code'") or die("Error2 : " . mysqli_error($con));
        if ($sqlx) {

            $rowsx = mysqli_fetch_array($sqlx);
            $photo = $rowsx['photo'];
        }
       

                    $details .= '<div class="cart_card row">
                        <div class="col-sm-3">
                            <img src="https://konnect.link/port5/products/'.$photo.'" class="img-fluid"></div>
                        <div class="col-sm-9"><br>
                            <h5>'.$product.' <span class="float-right">₦ '.$total.'</span></h5>
                            <div><small>₦'.$price.' x '.$units.'  </small></div>

                           <!-- <div class="row" style="margin-top:30px">
                                <div class="col-sm-8">
                                    <h5 style="" class="text-warning">Pending</h5>
                                </div>-->
                                <!--<div class="col-sm-4">
                                    <a href="#" onclick = "view_order(\''.$inv_num.'\')" class="btn-block btn bg-cyan">Details</a>
                                </div>-->

                            </div>
                        </div>
                    </div>';
                 }

                 

$output = array('details' => $details);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data
