<?php
session_start();
if(isset($_GET['inv_num']))
{
include 'includes/con.php';
$user = $_GET['user'];
$inv_num = $_GET['inv_num'];

$today = date("Y-m-d");
$month = date("M");
$year = date("Y");


$sql2="SELECT * FROM sales WHERE inv_num ='$inv_num'";
$result2=$con->query($sql2) or die ("error1: ".mysqli_error($con));
if($result2)
{
$rows2 = mysqli_fetch_array($result2);
$total = $rows2['total'];
$cashback = $rows2['purchase_cashback'];
$credit = $rows2['credit'];


$credit = '₦'.number_format($credit);
$cashback = '₦'.number_format($cashback);

 $currency = "NGN"; 

        $query = array(
            "SECKEY" => "FLWSECK_TEST-0557092d8d08d8a2b11ac2ef4132c4e6-X",
            "txref" => $inv_num
        );

        $data_string = json_encode($query);
                
        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);
        
       // var_dump ($resp);

        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];

        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $total)  && ($chargeCurrency == $currency)) {
   
$update2=$con->query("UPDATE sales SET payment_status = 'Successful', order_status = 'Confirmed' WHERE user ='$user' AND inv_num = '$inv_num' AND total = '$total'") or die ("error2: ".mysqli_error($con));


$update3=$con->query("UPDATE cart SET status = 'Checkout' WHERE user ='$user' AND inv_num = '$inv_num'") or die ("error2: ".mysqli_error($con));



$sqlw = $con->query("SELECT * FROM sales WHERE user = '$user' AND  inv_num ='$inv_num' AND payment_status = 'Successful' ") or die("Error2 : " . mysqli_error($con));
$countw = mysqli_num_rows($sqlw);


 while($order = mysqli_fetch_array($sqlw))
                { 

                    $orders .= '<div class="cart_card row">
                        <div class="col-sm-3">
                            <img src="images/cart_icon.png" class="img-fluid"></div>
                        <div class="col-sm-9"><br>
                            <h5>Invoice '.$inv_num.' <span class="float-right">₦ '.$total.'</span></h5>
                            <div><small>Tracking No:  <b>KD '.$order_id.'></b></small></div>

                            <div class="row" style="margin-top:30px">
                                <div class="col-sm-8">
                                    <h5 style="" class="text-success">Order Successful</h5>
                                </div>
                                <div class="col-sm-4">
                                    <a href="#" class="btn-block btn bg-cyan" onclick = "view_order(\''.$inv_num.'\')">Details</a>
                                </div>

                            </div>
                        </div>
                    </div>';
                 }


$suc = "Yes";

}
}



$output = array('success'=>$suc, 'orders' => $orders, 'cashback' => $cashback, 'credit' => $credit);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data
//mysql_close($con);
}
?>