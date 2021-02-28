<?php
include "includes/header.php";
$con =$connn;
if(isset($user))
{
    $email =  $user['email'];

  //  print_r($user);
}else
{
die();
}

$whatsapp = $user['whatsapp'];

$today = date("Y-m-d");
$month = date("m-Y");
$year = date("Y");




$p_len = strlen($whatsapp);
if($p_len == 11)
{
    $phone2 = substr($whatsapp, -10);
    $phone2 = "234".$phone2;
}
elseif($p_len == 10)
{
    $phone2 = "234".$whatsapp;
}
elseif($p_len == 14 )
{
    $phone2 = $whatsapp;
}


if (isset($_GET['txref'])) {
    $ref = $_GET['txref'];
    $page = $_GET['p'];

    $sql = $con->query("SELECT * FROM sales  WHERE  inv_num = '$ref'")  or die ("error: ".mysqli_error($con));
    $rows = mysqli_fetch_array($sql);

//print_r($rows);
   // die();

    $id=$rows['id'];
    $inv_num = $rows['inv_num'];
    $total = $rows['final_total'];
    $delivery = $rows['delivery'];
    $totali = $total-$delivery;
    $used = $rows['used'];
    $paid =  $rows['paid'];
   // print_r($rows);
    $amount = $rows['delivery'];
    $pur_cashback = $rows['purchase_cashback'];
    $payment_stat = $rows['payment_status'];
    $email = $rows ['user'];
    $fname = $rows ['fname'];
    $lname = $rows ['lname'];
    //   $bonus = $rows['coupon'];


    $_SESSION['inv_num'] = $inv_num;
     $amt_pay = $total - $used;

    $amount = 0.95*$total;



    $fname = $rows['fname'];
    $lname = $rows['lname'];

    $inv_num = $rows['inv_num'];


    $paid = $rows ['paid'];
    $payment_stat = $rows['payment_status'];


    $sqlcc = $con->query("SELECT SUM(units) as sumUnits FROM trans_items WHERE inv_num = '$inv_num'") or die("Error2 : ". mysqli_error($con));
    $querycc = mysqli_fetch_assoc($sqlcc);
    $sumUnits = $querycc ['sumUnits'];



    $items = "";
    $n= 0;
    $sqlxx = $con->query("SELECT * FROM trans_items  WHERE  inv_num = '$ref'")  or die ("error: ".mysqli_error($con));
    while($rowsxx = mysqli_fetch_array($sqlxx))
    {
        $n++;
        $del_date = $rowsxx['delivery_date'];

        $addr = $rowsxx ['addr'];
        $lga = $rowsxx ['lga'];
        $state = $rowsxx ['state'];
        $product = $rowsxx ['product'];
        $items .= '<p>'.$n.' '.$product.'</p>';
    }

    $del_addr  = $addr." ".$lga." ".$state;


    $currency = "NGN";

    $query = array(
        "SECKEY" => "FLWSECK_TEST-e2671ed4bb668640432e7c365fd4cfc3-X",
//        "SECKEY" => "FLWSECK-68d33ca3f1b0104f9b395fc00fa01ec6-X",
        "txref" => $ref
    );
//print_r($query);
    $data_string = json_encode($query);

  //  $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
    $ch = curl_init('https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/v2/verify');
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

    $paymentStatus = $resp['data']['status'];
    $chargeResponsecode = $resp['data']['chargecode'];
    $chargeAmount = $resp['data']['amount'];
    $chargeCurrency = $resp['data']['currency'];

    ?>
    <div class="row">
    <div class="col-sm-8 offset-sm-2 text-center">

    <?php
 //   print_r(array($chargeResponsecode , $chargeAmount, $amount,$chargeCurrency,$currency));
 //   die();
    if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {

        if($payment_stat == "Pending")
        {
            $paid = $chargeAmount + $paid + $used;
            $bal = $new_total - $paid;


            $sqls=$con->query("SELECT * FROM checkout_trans WHERE user = '$email' AND inv_num = '$inv_num' AND source = 'Wallet'") or die("Error2 : ". mysqli_error($con));
            $count1 = mysqli_num_rows($sqls);
            if($count1 >= 1)
            {
                $rows=mysqli_fetch_array($sqls);

                $id=$rows['id'];
                $amount = $rows['amount'];
                $source = $rows['source'];
                // $inv_num = $rows['inv_num'];

                $rows=mysqli_fetch_array($sqls);

                $id=$rows['id'];
                $wallet = $rows['cash'];
                $voucher = $rows['voucher'];

                if($voucher > 0)
                {
                    $vouc = 0.1 * $voucher;
                    if($vouc >= 2000)
                    {
                        $vouc = 2000;
                    }
                }

                $new_wallet = $wallet-$amount+$vouc;

                $sqle=$con->query("UPDATE wallet SET cash  = '$new_wallet', voucher = '0' WHERE user = '$email'") or die("Error2 : ". mysqli_error($con));



                $year = date("Y");

                $sql3=$con->query("INSERT INTO wallet_trans (user, trans_ref, amount, type, method, status, balance,  month, year, date_t) VALUES ('$email',  '$ref', '$amount', 'WPayout', 'Purchase', 'Successful', '$new_wallet', '$month', '$year', '$today')") or die("Error3: ".mysqli_error($con));
            }


            $sqls=$con->query("SELECT * FROM checkout_trans WHERE user = '$email' AND inv_num = '$inv_num' AND source = 'Kredit'") or die("Error2 : ". mysqli_error($con));
            $count1 = mysqli_num_rows($sqls);
            if($count1 >= 1)
            {
                $rows=mysqli_fetch_array($sqls);

                $id=$rows['id'];
                $amount = $rows['amount'];
                $source = $rows['source'];
                // $inv_num = $rows['inv_num'];


                $kredit_used = $amount;

                $rate = .150/30; // Monthly interest rate
                $term = 1; // Term in months

                $mon_sum = $amount * $rate * (pow(1 + $rate, $term) / (pow(1 + $rate, $term) - 1));
                $int = ($mon_sum * 1) - $amount;

                $totals = $amount + $int; // Total loan plus interest


                function check_number(){
global $con;
                    $unique_number = rand(100000, 999999);

                    $sql = $con->query("SELECT * FROM konnect_loans WHERE loan_number = '$unique_number'")  or die ("error: ".mysqli_error($con));
                    $exists = mysqli_num_rows($sql);

                    if ($exists >0){
                        $results = check_number();
                    }
                    else{
                        $results = $unique_number;
                        return $results;
                    }
                }
                $loan_amount = 0;
                $loan_num =  check_number();
                $date_t = date("d-M-Y");
                $next_date = date('d-m-Y',strtotime('+30 days',strtotime(str_replace('/', '-', $date_t))));


                $insert = $con->query("INSERT INTO konnect_loans (user, agree_number, loan_number, loan_amount, interest, paid, bal, plan, loan_type, repayment, repayment_date, month, date_t )
   VALUES ('$email', '$agree_num', '$inv_num', '$totals', '$int', '0', '$totals', '$period', 'Purchase', '$mon_sum', '$next_date', '$month', '$date_t' )") or die("Error4: ".mysqli_error($con));

                $insert2 = $con->query("INSERT INTO kredit_trans (user, loan_type, loan_num,  amount, month, date_t )
  VALUES ('$email', 'Purchase', '$inv_num', '$totals',  '$month', '$date_t' )") or die("Error5: ".mysqli_error($con));


                $payday1 = date('d-M-Y',strtotime('+21 days',strtotime(str_replace('/', '-', $date_t))));
                $payday2 = date('d-M-Y',strtotime('+30 days',strtotime(str_replace('/', '-', $date_t))));
                $totalpay = $loan_amount + $int;



                $detail1 = '<!DOCTYPE HTML>     
			    <html>
					<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
					</head>
					<body>
								<div style="background-color:white; width: 80%; margin:auto; dborder:solid; dborder-width:thin; bdorder-color:#EEE; position: relative; font-size:17px; padding-top:2em; padding:1em; font-family:arial">
		

<p><b>Hi '.$fname.',</b></p>
<p></p>You have used a purchase credit of &#x20a6;'.number_format($totals).' amount for invoice #'.$inv_num.' </p>
<p><b>Pay &#x20a6;'.number_format($loan_amount).' by '.$payday1.' to enjoy ZERO percent interest. </b></p>
<p>Otherwise, pay in 30 days  '.$payday2.' a sum of  &#x20a6;'.number_format($totalpay).' </p>

<p><b>REPLY IF YOU HAVE ANY CONCERN</b></p>
<p><b>Konnect.one Team - Agile P3 </b></p>


						</div>
					</body>
				</html>';


                require 'mail/class.phpmailer.php';

                $mail2 = new PHPMailer();

                $mail2->IsSMTP();        // set mailer to use SMTP
                $mail2->Host = "smtp.1and1.com";  // specify main and backup server
                $mail2->SMTPAuth = true;     // turn on SMTP authentication
                $mail2->Port = 587;     // Set the SMTP port number
                $mail2->Username = "mails@konnect.one";  // SMTP username
                $mail2->Password = "!@AKonnect.One001"; // SMTP password

                $mail2->From = "konnect@agilep3.com";
                $mail2->FromName = "Konnect.one";
                $mail2->AddAddress($email, $fname);
                $mail2->AddBcc("Konnect@agilep3.com");
                $mail2->AddReplyTo("Konnect@agilep3.com", "Konnect.one");


                $mail2->WordWrap = 50;                                 // set word wrap to 50 characters

//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name

                $mail2->IsHTML(true);                                // set email format to HTML
                $mail2->Subject = "THANK YOU FOR USING YOUR PURCHASE CREDIT TO SHOP";

                $mail2->Body    = $detail1;

                if($mail2->Send())
                {

                }



                $query = array(
                    "phone" => $phone2,
                    "body" => "From Konnect.one
Hello ".$fname.", you have used a purchase credit of N'.$totals.' amount for invoice #'.$inv_num.'

*Pay ₦".number_format($totals)." by ".$payday1." to enjoy ZERO percent interest.*

Otherwise, pay in 30 days ".$payday2." a sum of ₦".number_format($totalpay)."


Yours Truly,
*Konnect.one Team*
*Agile P3 Limited* " );



                $data_string = json_encode($query);

                $ch = curl_init('https://api.mercury.chat/sdk/whatsapp/sendMessage?api_token=5df29ce699c89e00198b8c17lY7ANXzl9&instance=L1583328789738U');
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


            }

            $sqlc1=$con->query("UPDATE sales  SET  payment_status = 'Successful', payment_type = 'Pay Now', paid = '$paid',  balance = '$bal', order_status = 'Order in Process'  WHERE  inv_num = '$ref' AND user = '$email' ") or die("Error3: ".mysqli_error($con));
            $sqlc1x=$con->query("UPDATE trans_items  SET  payment_status = 'Successful', delivery_status = 'Order in Process'   WHERE  inv_num = '$ref'") or die("Error3: ".mysqli_error($con));

            $sqldc = $con->query("DELETE  FROM cart  WHERE user = '$email'") or die("Error2 : ". mysqli_error($con));





            $sqle=$con->query("UPDATE cashback_trans SET status = 'Settled' WHERE trans_ref = '$inv_num'") or die("Error2 : ". mysqli_error($con));

            $sql1=$con->query("SELECT * FROM cashback_trans  WHERE  trans_ref = '$inv_num'") or die("Error2 : ". mysqli_error($con));

            if ($sql1)

            {

                while($rows=mysqli_fetch_array($sql1))

                {
                    $user=$rows['user'];
                    $amount = $rows['cash'];


                    $sqlc=$con->query("SELECT * FROM wallet WHERE  user = '$user'") or die("Error2 : ". mysqli_error($con));
                    $countc = mysqli_num_rows ($sqlc);

                    if($countc == 0)
                    {
                        $sqlc2=$con->query("INSERT INTO wallet (user, cash,   date_t)  
      VALUES ('$user', '$amount', '$date_t')") or die("Error7: ".mysqli_error($con));

                    }
                    else
                    {
                        $rowc = mysqli_fetch_array($sqlc);
                        $cashback = $rowc ['cash'];
                        $cashback = $cahsback + $amount;


                        $sqle=$con->query("UPDATE wallet SET cash  = '$cashback' WHERE user = '$user'") or die("Error2 : ". mysqli_error($con));


                    }


                }
            }












            if($sqlc1 && $sqlc1x)
            {
                $date_t= date('d/m/Y');


                $rem_date = date('d-M-Y',strtotime('-2 days',strtotime(str_replace('/', '-', $del_date))));

                $details = '<!DOCTYPE HTML>     
			    <html>
					<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
					</head>
					<body>
								<div style="background-color:white; width: 80%; margin:auto; dborder:solid; dborder-width:thin; bdorder-color:#EEE; position: relative; font-size:17px; padding-top:2em; padding:1em; font-family:arial">
		

<p><b>Hi '.$fname.',</b></p>
<p>Thank you for shopping at konnect.one, your checkout is successful. </p>
<p><b>Your payment option is Pay Now</b></p>
<p>Your invoice amount is &#x20a6;'.number_format($total).'  </p>
<p><b>AMOUNT PAID IS  &#x20a6;'.number_format($totali).'</b></p>
<p>You have paid your delivery cost of &#x20a6;'.number_format($delivery).' </p>
<p> Purchase credit used: &#x20a6;'.number_format($kredit_used).' </p>
<p>Voucher used: &#x20a6;'.number_format($voucher).'</p>
<p><b>Your delivery date is '.$del_date.'</b></p>
<p>Your delivery location is '.$del_addr.' </p>
<p<b>WE WILL REMIND YOU TO CONFIRM YOUR DELIVERY BY '.$rem_date.' </b></p>
<p><b>CLICK TO VIEW YOUR ORDER https://www.konnect.one/user/orders </b></p>

<p><b>REPLY IF YOU HAVE ANY CONCERN</b></p>
<p><b>Konnect.one Team - Agile P3 </b></p>


						</div>
					</body>
				</html>';

                require("mail/class.phpmailer.php");
$mail4 = new PHPMailer();
$mail4->IsSMTP();        // set mailer to use SMTP
$mail4->Host = "smtp.1and1.com";  // specify main and backup server
$mail4->SMTPAuth = true;     // turn on SMTP authentication
$mail4->Port = 587;     // Set the SMTP port number
$mail4->Username = "mails@konnect.one";  // SMTP username
$mail4->Password = "!@AKonnect.One001"; // SMTP password

$mail4->From = "Konnect@agilep3.com";
$mail4->FromName = "Konnect.one";
$mail4->AddAddress($email, $fname);
$mail4->AddBcc("konnect@agilep3.com");
$mail4->AddReplyTo("Konnect@agilep3.com", "Konnect.one");

$mail4->WordWrap = 50;                                 // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail4->IsHTML(true);                                  // set email format to HTML

                $mail4->Subject = $fname.", Thank You for Your Order #".$inv_num;

                $mail4->Body    = $details;

                if($mail4->Send())
                {

                }



                $query = array(
                    "phone" => $phone2,
                    "body" => "From Konnect.one
*Hello ".$fname.",* 

Thank you for shopping at konnect.one, your checkout is successful.

*Your payment option is Paying Now*

Your invoice amount is ₦".number_format($total)." 

*AMOUNT PAID IS ₦".number_format($totali)."*

You have paid your delivery cost of ₦".number_format($delivery)."

Purchase credit used: ₦".number_format($kredit_used)."
Voucher used:  ₦".number_format($voucher)."

*Your delivery date is ".$del_date."*

Your delivery location is ".$del_addr."

*WE WILL REMIND YOU TO CONFIRM YOUR DELIVERY BY ".$rem_date."*

*CLICK TO VIEW YOUR ORDER https://www.konnect.one/user/orders*

*REPLY IF YOU HAVE ANY CONCERN*
*Konnect.one Team - Agile P3* "
                );



                $data_string = json_encode($query);

                $ch = curl_init('https://api.mercury.chat/sdk/whatsapp/sendMessage?api_token=5df29ce699c89e00198b8c17lY7ANXzl9&instance=L1583328789738U');
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





                $del_date = date('l M d, Y',strtotime('+0 days',strtotime(str_replace('/', '-', $del_date))));

                $month = date("m-Y");

                $sql3x=$con->query("SELECT * FROM kredit_application WHERE email = '$email'") or die("Error3 : ". mysqli_error($con));

                $rows=mysqli_fetch_array($sql3x);
                {
                    $id=$rows['id'];
                    $kredit_limit = $rows['kredit_limit'];
                    $income = $rows['income'];
                    $status = $rows['status'];

                    if($income < 200000)
                    {
                        $mon_pur_limit = 10000;
                    }
                    elseif ($income < 500000 && $income >= 200000)
                    {
                        $mon_pur_limit = 15000;
                    }
                    elseif($income >= 500000)
                    {
                        $mon_pur_limit = 20000;
                    }
                }



                $sql8 = $con->query("SELECT SUM(bal) as purBal FROM  konnect_loans  WHERE user = '$email'   ORDER BY id DESC") or die("Error3 : ". mysqli_error($con));
                $query8 = mysqli_fetch_assoc($sql8);
                $purBal = $query8 ['purBal'];

                $purBal = $mon_pur_limit - $purBal;



                $sqld=$con->query("SELECT * FROM shipping WHERE user = '$email'") or die("Error3 : ". mysqli_error($con));

                $rows=mysqli_fetch_array($sqld);
                {
                    $id=$rows['id'];
                    $addr = $rows['addr'];
                    $state = $rows['state'];
                    $lga = $rows['lga'];
                }

                ?>

                <h4><b> Your Delivery Address </b></h4>
                <p><?php echo $addr; ?>, <?php echo $lga; ?>, <?php echo $state; ?> </p>


                <h4 style="color:green; font-weight:bold;">  <?php echo $fname; ?>, thank you for completing your order. </h4>
                <h4 style="text-transform:uppercase; margin-top:10px;">Your order information </h4>
                <ul style="font-size : 16px; line-height:35px; list-style-type: circle;">
                    <li><b> <?php echo number_format($sumUnits); ?> Items </b> ordered with order amount of <b> &#x20A6;<?php echo number_format($total); ?> </b> </li>
                    <li><b>You have paid in full the sum of &#x20A6; <?php echo number_format($paid); ?></b></li>

                    <li> Your preferred delivery date is - <b><?php  echo $del_date; ?> </b>  </li>
                </ul>
                <p style="font-size : 16px;">You will reconfirm your delivery date 2 days before we deliver. </p>


                <h4><a href="track.php?i=<?php echo $inv_num; ?>" style="font-size : 18px; color:red;">Click to TRACK Your delivery  </a></h4>


                <br><h4 style="mmargin-top:40px;">KINDLY NOTE THE FOLLOWING</h4>
                <h4 style="font-size : 16px;"> <b> &#x20A6;<?php echo number_format($purBbal); ?> purchase credit is available for subsequent purchases You still have <b>   </h4>
                <h4 style="font-size : 16px;"> <b> &#x20A6;<?php echo number_format($pur_cashback); ?> cashback amount will be paid into your wallet upon delivery. </b> </h4>




                <?php
            }

        }
        else
        {
            $del_date = date('l M d, Y',strtotime('+0 days',strtotime(str_replace('/', '-', $del_date))));

            $month = date("m-Y");
            $sql3x=$con->query("SELECT * FROM kredit_application WHERE email = '$email'") or die("Error3 : ". mysqli_error($con));

            $rows=mysqli_fetch_array($sql3x);
            {
                $id=$rows['id'];
                $kredit_limit = $rows['kredit_limit'];
                $income = $rows['income'];
                $status = $rows['status'];

                if($income < 200000)
                {
                    $mon_pur_limit = 10000;
                }
                elseif ($income < 500000 && $income >= 200000)
                {
                    $mon_pur_limit = 15000;
                }
                elseif($income >= 500000)
                {
                    $mon_pur_limit = 20000;
                }
            }



            $sql8 = $con->query("SELECT SUM(bal) as purBal FROM  konnect_loans  WHERE user = '$email'   ORDER BY id DESC") or die("Error3 : ". mysqli_error($con));
            $query8 = mysqli_fetch_assoc($sql8);
            $purBal = $query8 ['purBal'];

            $purBal = $mon_pur_limit - $purBal;



            $sqld=$con->query("SELECT * FROM shipping WHERE user = '$email'") or die("Error3 : ". mysqli_error($con));

            $rows=mysqli_fetch_array($sqld);
            {
                $id=$rows['id'];
                $addr = $rows['addr'];
                $state = $rows['state'];
                $lga = $rows['lga'];
            }

            ?>

            <h4><b> Your Delivery Address </b></h4>
            <p><?php echo $addr; ?>, <?php echo $lga; ?>, <?php echo $state; ?> </p>


            <h4 style="color:green; font-weight:bold;">  <?php echo $fname; ?>, thank you for completing your order. </h4>
            <h4 style="text-transform:uppercase; margin-top:10px;">Your order information </h4>
            <ul style="font-size : 16px; line-height:35px; list-style-type: circle;">
                <li><b> <?php echo number_format($sumUnits); ?> Items </b> ordered with order amount of <b> &#x20A6;<?php echo number_format($total); ?> </b> </li>
                <li><b>You have paid in full the sum of &#x20A6; <?php echo number_format($paid); ?></b></li>
                <li> Your preferred delivery date is - <b><?php  echo $del_date; ?> </b>  </li>
            </ul>
            <p style="font-size : 16px;">You will reconfirm your delivery date 2 days before we deliver. </p>


            <h4><a href="track.php?i=<?php echo $inv_num; ?>" style="font-size : 18px; color:red;">Click to TRACK Your delivery  </a></h4>


            <br><h4 style="mmargin-top:40px;">KINDLY NOTE THE FOLLOWING</h4>
            <h4 style="font-size : 16px;"> <b> &#x20A6;<?php echo number_format($purBbal); ?> purchase credit is available for subsequent purchases You still have <b>   </h4>
            <h4 style="font-size : 16px;"> <b> &#x20A6;<?php echo number_format($pur_cashback); ?> cashback amount will be paid into your wallet upon delivery. </b> </h4>

            <?php

        }

        $sqlc2=$con->query("DELETE  FROM cart WHERE user= '$email'") or die("Error7: ".mysqli_error($con));

    }
    else {
        ?>
        <h3 style="color:red">Your Payment Was Not Successful </h3>
        <?php
        //Dont Give Value and return to Failure page
    }
    ?>
    </div>
    </div>

    <?php

}



?>
