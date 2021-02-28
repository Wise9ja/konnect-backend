<?php
include 'includes/functions.php';
include 'includes/connection.php';

require("mail/class.phpmailer.php");


$period=$_GET['plan'];
$payment = $_GET['payment'];
$cart_id = $_GET['cart_id'];
$con = $connn;
$user =  $_SESSION['user'];
if(isset($user))
{
    $email =  $user['email'];

}
if(isset($_SESSION['cart_id']))
{
    $cart_id =  $_SESSION['cart_id'];

    $sqlx=$con->query("UPDATE cart SET user = '$email'  WHERE user  = '$cart_id'") or die("Error2 : ". mysqli_error($con));

}


$train = $_GET['train'];


$coupon=$_GET['coupon'];
$j = date("j");



$sqln=$con->query("SELECT * FROM customers  WHERE  email = '$email'") or die("Error2 : ". mysqli_error($con));
$rowsn=mysqli_fetch_array($sqln);
{
    $lname=$rowsn['lname'];
    $fname = $rowsn['fname'];
    $fulname = $fname." ".$lname;
}


$total = $total * $num_of_goods;


$del_code = rand(100000,999999);

$today = date("Y-m-d");
$today1 = date('Y-m-d',strtotime('-1 days',strtotime($today)));

function check_number(){
global $con;
    $unique_number = rand(100000, 999999);

    $sql = $con->query("SELECT * FROM sales WHERE inv_num = '$unique_number'")  or die ("error: ".mysqli_error($con));
    $exists = mysqli_num_rows($sql);

    if ($exists >0){
        $results = check_number();
    }
    else{
        $results = $unique_number;
        return $results;
    }
}




if($train=="Yes")
{
    $j = date("j");
    $month = date("m-Y");
    $year = date ("Y");
    $today = date("Y-m-d");
    $date_t = date("Y-m-d");
//$today1 = date('Y-m-d',strtotime('-1 days',strtotime($today)));
    $sql1=$con->query("SELECT * FROM training  WHERE cart_id = '$cart_id' ORDER BY date_t DESC") or die("Error2 : ". mysqli_error($con));



    if($sql1)
    {
        $sum1 = 0;
        $actual = 0;




    }
}





$sqla=$con->query("SELECT * FROM coupon WHERE coupon = '$coupon'") or die("Error1a : ". mysqli_error($con));

if($sqla)
{

    $rows=mysqli_fetch_array($sqla);

    $c_value=$rows['c_value'];
    //$coupon = $rows['coupon'];
    // $date_t=$rows['date_t'];
}



$sql1=$con->query("SELECT * FROM cart WHERE user = '$email' AND payment = 'Now'  ORDER BY id DESC") or die("Error1b : ". mysqli_error($con));

if($sql1)
{
    $sum1 = 0;
    $actual = 0;

if($_SESSION['inv_num'])
{
    $inv_num =  $_SESSION['inv_num'];
}else {
    $inv_num = check_number();
      $_SESSION['inv_num'] =$inv_num ;


}

    $purchase_cashback = 0;
    $ref_cashback = 0;

    while ($rows1=mysqli_fetch_array($sql1))
    {
        $id=$rows1['id'];

        $num_of_goods=$rows1['num_of_goods'];
        $cart_id = $rows1['cart_id'];
        $product = $rows1['product'];
        $product_code = $rows1['product_code'];
        $price = $rows1['actual_price'];
        $discount = $rows1['discount'];
        $final_total = $rows1['final_total'];
        $num_of_goods = $rows1['num_of_goods'];

        $product_sector = $rows1['product_sector'];
        $discounted_price = $price - $discount;
        $sum1 = $sum1 + $final_total;




        $sql3=$con->query("SELECT * FROM product WHERE product_code = '$product_code'") or die("Error2 : ". mysqli_error($con));

        $rows3=mysqli_fetch_array($sql3);


        $purchase_cash=$rows3['purchase_cashback'];
        $ref_cash=$rows3['ref_cashback'];


        $ref_cash = $ref_cash * $num_of_goods;
        $purchase_cash = $purchase_cash * $num_of_goods;


        $purchase_cashback = $purchase_cashback +  $purchase_cash;
        $ref_cashback = $ref_cashback + $ref_cash;





        $sql3x=$con->query("SELECT * FROM product_vendors  WHERE product_code = '$product_code'") or die("Error2 : ". mysqli_error($con));
        $rows3x=mysqli_fetch_array($sql3x);
        $vendor_price=$rows3['price'];

        $vendor_cost = $vendor_price * $num_of_goods;


        $sql4=$con->query("SELECT * FROM referral  WHERE referred_email = '$email'") or die("Error3 : ". mysqli_error($con));
        $rows4=mysqli_fetch_array($sql4);
        $referral_email=$rows4['referral_email'];



        $year = date("Y");
        $month = date("m-Y");

        $sqlc=$con->query("INSERT INTO trans_items (user, inv_num, product, product_code, actual_price, units, final_price, vendor_cost,  delivery_code, month, year, date_t)  
      VALUES ( '$email', '$inv_num', '$product', '$product_code', '$discounted_price', '$num_of_goods', '$final_total',  '$vendor_cost', '$del_code', '$month', '$year', '$today')") or die("Error4: ".mysqli_error($con));


    }

    if($coupon == "SP60%" && $j < 7)
    {
        $c_value = (50/100)*$sum1;
    }




    $final_total = $sum1 - $c_value;



    if($final_total <= 10000)
    {
        $delivery = 650;
    }
    elseif($final_total <= 30000)
    {
        $delivery = 800;
    }
    elseif($final_total <= 60000)
    {
        $delivery = 1200;
    }
    elseif($final_total <= 100000)
    {
        $delivery = 1500;
    }
    elseif($final_total <= 200000)
    {
        $delivery = 3000;
    }
    elseif($final_total > 200000)
    {
        $delivery = 5000;
    }



    $final_total = $final_total + $delivery;
    $year = date("Y");
    $month = date("m-Y");




    $sqlt=$con->query("INSERT INTO sales (cart_id, product_cat, inv_num, user, fname, lname,  actual_value, coupon,  paid, balance, final_total, purchase_cashback, ref_cashback, delivery, payment_status, order_status, month, year,  date_t)  
      VALUES ('$cart_id', 'Non-Training',  '$inv_num', '$email', '$fname', '$lname', '$sum1',  '$c_value', '0', '$final_total', '$final_total', '$purchase_cashback', '$ref_cashback', '$delivery', 'Pending', 'Pending',  '$month', '$year', '$today')") or die("Error5xx: ".mysqli_error($con));

    $month = date("m-Y");
    $year = date("Y");
    $date_t = date("Y-m-d");

    $expiry = date('Y-m-d',strtotime('+60 days',strtotime(str_replace('/', '-', $date_t))));



    $sqlc=$con->query("INSERT INTO cashback_trans (user, trans_ref, amount, type, method, balance, status,  month, year,  date_t)  
      VALUES ('$referral_email', '$inv_num', '$ref_cashback', 'WFund', 'Referral', '$balancex', 'Pending',  '$month', '$year',  '$date_t')") or die("Error7: ".mysqli_error($con));


    $sqlc2=$con->query("INSERT INTO cashback_trans (user, trans_ref, amount, type, method, balance,  status,  month, year,   date_t)  
      VALUES ('$email', '$inv_num', '$purchase_cashback', 'WFund', 'Purchase', '$balance',  'Pending', '$month', '$year', '$date_t')") or die("Error7: ".mysqli_error($con));


//$sqlc2=$con->query("DELETE  FROM cart WHERE user= '$email'") or die("Error7: ".mysqli_error($con));


    $_SESSION['inv_num'] = $inv_num;


    if($sqlc && $sqlt)
    {
        $output = array('success'=>"YES");
        echo json_encode($output); //output JSON data


    }
}

?>

