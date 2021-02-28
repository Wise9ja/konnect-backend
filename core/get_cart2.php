<?php
include "includes/con.php";

$user = $_GET['user'];
$inv_num = $_GET['inv_num'];

$sql1 = $con->query("SELECT * FROM cart WHERE  user = '$user' AND status = 'Cart' ORDER BY id DESC") or die("Error2 : ". mysqli_error($con));
$nums_row = mysqli_num_rows($sql1);
if($sql1) {
    $sum1 = 0;
    while ($rows1 = mysqli_fetch_array($sql1)) {
        $id = $rows1['id'];
        $cart_id = $rows1['cart_id'];
        $code = $rows1['product_code'];
        $num_goods = $rows1['num_of_goods'];
        $product = $rows1['product'];
        $price = $rows1['actual_price'];
        $product_sector = $rows1['product_sector'];
        $discount = $rows1['discount'];
        $total = $rows1['final_total'];
        $num_of_goods = $rows1['num_of_goods'];
        $discounted_price = $price - $discount;
        $sum1 = $sum1 + $total;

        $sqlx = $con->query("SELECT * FROM product WHERE product_code = '$code'") or die("Error2 : " . mysqli_error($con));
        if ($sqlx) {

            $rowsx = mysqli_fetch_array($sqlx);
// $id=$rowsx['id'];
            $photo = $rowsx['photo'];

            $qid = "q" . $id;
            $mid = "m" . $id;
            $pid = "p" . $id;


            $qid2 = "#q" . $id;
            $mid2 = "#m" . $id;

            $tid = "t" . $id;

        }
        
            $cart .= '<div class="cart_card row" style="background-color:white; padding-bottom: 0.8em; border-bottom:solid; border-bottom-color: #cccccc; border-bottom-width:thin;">
            <div class="col-sm-3">
           <!-- <span><i class="fa fa-trash" style="color:red; cursor:pointer" onclick="update_cart(\''.$num_goods.'\', \''.$id.'\', \'delete\' )"></i></span>-->
                <img src="https://konnect.link/port5/products/'.$photo.'" class="img-fluid" width="120" /></div>
            <div class="col-sm-9"><br>
                <h5>'.$product.'</h5>
               <!-- <div class="row control_box">-->
                    <div class="col-sm-6" style="cursor: pointer">
                    <span style="font-size:18px; font-weight:bold;">'.$num_goods.' x &nbsp;&nbsp; &#8358;'.number_format($total).'</span>

                            
                       <!-- <div class="control_box_control">
                            <span class="control"><i class="fa fa-minus" onclick="update_cart(\''.$num_goods.'\', \''.$id.'\', \'reduce\' )"></i></span>
                            <span>'.$num_goods.'</span>
                            <span class="control"><i class="fa fa-plus" onclick="update_cart(\''.$num_goods.'\', \''.$id.'\',  \'add\' )"></i></span>
                        </div>-->
                   <!-- </div>-->
                   <!-- <div class="col-sm-6 text-right" style="margin-top: -25px;">
                        <h4 style="font-weight:bold; font-size:18px;">&#8358;'.number_format($total).'</h4>
                    </div>-->
                </div>
            </div>
        </div>';

        }

    }



$sql2 = $con->query("SELECT * FROM sales  WHERE inv_num ='$inv_num'");

        $row2 = mysqli_fetch_array($sql2);
        
        $total = $row2['total'];
        $coupon = $row2['coupon_value'];
        $wallet = $row2['wallet'];
        $discount = $row2['discount'];
        $credit = $row2['credit'];
        $delivery = $row2['delivery'];
        $del_date = $row2['delivery_date'];
        $del_addr = $row2['delivery_addr'];
        $paid = $row2['paid'];

        $new_total = $total + $delivery;

        $final_total = ($new_total) - ($coupon + $wallet + $discount + $credit + $paid);
        
        if ($del_date !== "")
        {
      $del_date = date('D d-M-Y',strtotime('+0 days',strtotime(str_replace('/', '-', $del_date))));
        }

       $sqlw = $con->query("SELECT * FROM wallet  WHERE user ='$user'");

        $rowx = mysqli_fetch_array($sqlw);
        $wallet_bal = $rowx['balance'];

        
       $sqld = $con->query("SELECT * FROM discount");
        $rowd = mysqli_fetch_array($sqld);
        $paynow_discount = $rowd['pay_now'];
        $paynow_discount = ($paynow_discount/100) * $total;
        
        


       $sqlc = $con->query("SELECT * FROM kredit  WHERE user ='$user'");

        $rowc = mysqli_fetch_array($sqlc);
        $kredit_status = $rowc['status'];
        $kredit = $rowc['credit'];

         $credit_r = 0.1 * $total; 
         $credit_bal = 100000 - $kredit;

         if($credit_bal >= $credit_r)
         {
                $credit_bal = $credit_r;
         }
         else if ($credit_bal >= 0)
         {
                $credit_bal = $credit_bal;
         }
         else
         {
           $credit_bal = 0;
         }

        if($kredit_status == "Active" && $credit <= 0)
        {
            $kredit_stat = "Active";
            $credit_bal = $credit_bal;
        }
        else
        {
            $credit_bal = 0;
        }
        
    
        


$sum1 = '&#8358;'.number_format($sum1);
if(isset($_GET['callback']))
{
header("Content-Type:application/json");
}


$total =  "&#8358;".number_format($total,2);
$discountx =  "&#8358;".number_format($discount,2);
$walletx =  "&#8358;".number_format($wallet,2);
$couponx =  "&#8358;".number_format($coupon,2);
$paynow_discount =  "&#8358;".number_format($paynow_discount);

$creditx =  "&#8358;".number_format($credit,2);



$wallet_bal2 =  "&#8358;".number_format($wallet_bal,2);
$credit_bal =  "&#8358;".number_format($credit_bal,2);


$delivery =  "&#8358;".number_format($delivery,2);
$new_total =  "&#8358;".number_format($new_total,2);

$final_totalx =  $final_total;
$final_total =  "&#8358;".number_format($final_total,2);


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

        $state = '<option>'.$state.'</option>';
        $lga = '<option>'.$lga.'</option>';
   
}
else
{

  $sqlx =$con->query("SELECT * FROM customers WHERE user = '$user'");
        $row = mysqli_fetch_array($sqlx);
        
        $fname = $row['fname'];
        $lname = $row['lname'];
        $phone = $row['phone'];
        $email = $row['email'];
        
        $fulname = $fname." ".$lname;
        $addr = $row['address'];
    
}


if($lga !== "")
{
$sql=$con->query("SELECT * FROM lga WHERE state = '$state' ORDER BY state ASC") or die("Error2 : ". mysqli_error($con));

if($sql)
{
 $i=1;
   
  while ($rows=mysqli_fetch_array($sql))
   {
    $id=$rows['id'];
    $lga = $rows['lga'];
    $lga .= '<option>'.$lga.'</option>';
    }  
  }
  
}

$sql=$con->query("SELECT * FROM states ORDER BY state ASC") or die("Error2 : ". mysqli_error($con));

if($sql)
{
 $i=1;
   
  while ($rows=mysqli_fetch_array($sql))
   {
    $id=$rows['id'];
    $state = $rows['state'];
    $states .= '<option>'.$state.'</option>';
    }  
  }
  




$output = array('cart' => $cart, 'cartx' => $nums_row,   'total' => $total, 'new_total' => $new_total, 'del_date' => $del_date, 'final_total' => $final_total, 'final_totalx' => $final_totalx, 'wallet' => $wallet, 'walletx' => $walletx, 'wallet_bal2' => $wallet_bal2, 'wallet_bal' => $wallet_bal, 'credit' => $credit, 'creditx' => $creditx, 'credit_bal' => $credit_bal, 'kredit_stat' => $kredit_stat, 'coupon' => $coupon, 'couponx' => $couponx, 'discount' => $discount, 'discountx' => $discountx, 'paid' =>$paid, 'delivery' =>$delivery, 'del_addr' => $del_addr, 'fname' => $fname, 'lname' => $lname, 'email' => $email, 'phone' => $phone, 'lga' => $lga, 'landmark' => $landmark, 'addr' => $addr, 'state' => $state, 'states' => $states, 'paynow_discount' => $paynow_discount);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

//echo $cart;


   ?>

