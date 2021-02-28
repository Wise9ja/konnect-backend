<?php
include "includes/con.php";

$user = $_GET['user'];

$sqlw = $con->query("SELECT * FROM sales WHERE user = '$user' AND  order_status !='Delivered' AND payment_status = 'Successful' ") or die("Error2 : " . mysqli_error($con));
$countw = mysqli_num_rows($sqlw);


 while($order = mysqli_fetch_array($sqlw))
{ 
$inv_num = $order['inv_num'];
$order_id =  $order['id'];
$total = number_format($order['total'],2);

 $sqlx = $con->query("SELECT * FROM product WHERE product_code = '$code'") or die("Error2 : " . mysqli_error($con));
        if ($sqlx) {

            $rowsx = mysqli_fetch_array($sqlx);
            $photo = $rowsx['photo'];
        }
       

                    $orders .= '<div class="cart_card row">
                        <div class="col-sm-3">
                            <img src="images/cart_icon.png" class="img-fluid"></div>
                        <div class="col-sm-9"><br>
                            <h5>Invoice '.$inv_num.' <span class="float-right">₦ '.$total.'</span></h5>
                            <div><small>Tracking No:  <b>KD '.$order_id.'</b></small></div>

                            <div class="row" style="margin-top:30px">
                                <div class="col-sm-8">
                                    <h5 style="" class="text-warning">Pending</h5>
                                </div>
                                <div class="col-sm-4">
                                    <a href="#" onclick = "view_order(\''.$inv_num.'\')" class="btn-block btn bg-cyan">Details</a>
                                </div>

                            </div>
                        </div>
                    </div>';
                 }

                 if($countw==0)
                    {
                $orders = '<div>You have no Pending order!</div>';
                 }
         

$output = array('order' => $orders);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data
