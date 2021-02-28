<?php
if(isset($_GET['user']))
{
include "includes/con.php";

$user= $_GET['user'];



$sql1 = $con->query("SELECT * FROM cart WHERE  user = '$user' AND  status = 'Cart' ORDER BY id DESC") or die("Error2 : ". mysqli_error($con));
$nums_row = mysqli_num_rows($sql1);
if($sql1) {
    $sum1 = 0;
    while ($rows1 = mysqli_fetch_array($sql1)) {
        $id = $rows1['id'];
        $code = $rows1['product_code'];
        $num_of_goods = $rows1['num_of_goods'];

        

    
        $sqlx = $con->query("SELECT * FROM product WHERE product_code = '$code'") or die("Error2 : " . mysqli_error($con));
        if ($sqlx) {

            $rowsx = mysqli_fetch_array($sqlx);
            $price = $rowsx["price"];
        $price = ($price * 105)/70;
        $market_price = $rowsx["market_price"];
        
      if($market_price == 0)
      {
          $price = $price;
      }
      else
      {
        $price = $market_price;
      }
    $total = $price * $num_of_goods;

       $sqlu = $con->query("UPDATE cart SET  actual_price = '$price', final_total = '$total' WHERE  id = '$id'");

        }
    }
}

$sql3 = $con->query("SELECT SUM(final_total) as sumTotal FROM cart WHERE  user = '$user' AND status = 'Cart'") or die("Error2 : ". mysqli_error($con));

$query3 = mysqli_fetch_assoc($sql3);
$sumTotal = $query3 ['sumTotal'];


function check_number(){
require 'includes/con.php';

    $unique_number = rand(00000000, 999999999);

    $sql = $con->query("SELECT * FROM sales WHERE  inv_num = '$unique_number'")  or die ("error: ".mysqli_error($con));
    $exists = mysqli_num_rows($sql);

    if ($exists >0){
        $results = check_number();
    }
     else{
       $results = $unique_number;
        return $results;
     }
}

$inv_num = check_number(); 

  $sqlx =$con->query("SELECT * FROM shipping WHERE user ='$user' AND status = 'Default'");
  $countx = mysqli_num_rows($sqlx);
if($countx == 1)
{
        $row = mysqli_fetch_array($sqlx);
        
        $fname = $row['fname'];
        $lname = $row['lname'];
        $phone = $row['phone'];
        $email = $row['email'];
        
        $fulname = $fname." ".$lname;
        $addr = $row['addr'];
        $landmark = $row['landmark'];
        $lga = $row['lga'];
        $state = $row['state'];

         $del_addr = '<h5><b>'.$fulname.'</b></h5>

                '.$email.'<br>
                '.$phone.'<br>
                 '.$addr.'<bR>
                 '.$state.'<br>';
}

$today = date("d-m-Y");
$month = date("M-Y");
$year = date("Y");

       $sqld = $con->query("SELECT * FROM delivery_rate  WHERE from_cost < '$sumTotal' AND to_cost > '$sumTotal'");

        $rowd = mysqli_fetch_array($sqld);
        $del_rate = $rowd['cost'];

        



$insert=$con->query("INSERT INTO sales (user,  inv_num, total, delivery, delivery_addr, order_status, month, year, date_t) 
      VALUES ('$user',  '$inv_num', '$sumTotal', '$del_rate', '$del_addr', 'Pending', '$month', '$year', '$today')") or die("Error: ".mysqli_error($con));
 
 $sqlu = $con->query("UPDATE cart SET  inv_num = '$inv_num' WHERE  status = 'Cart' AND  user ='$user'");


if($insert)
{
$suc = "Yes";    
}

$output = array('success' => $suc, 'inv_num' => $inv_num);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data
}

?>