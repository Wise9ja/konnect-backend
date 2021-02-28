<?php
session_start();
include "includes/con.php";

if(isset($_GET['logout']))
{
    unset($_SESSION['user']);
    header('location:index.php');
}
if (isset($_GET['email']) && isset($_GET['register']))
{

//print_r($_GET);
    $id = $_GET['id'];
    $fname=$_GET['fname'];
    $lname=$_GET['lname'];
    $email=$_GET['email'];

    $phone=$_GET['phone'];
   
    $password = $_GET['password'];


//$interest=$_GET['prof'];
//$bday_month=$_GET['bmonth'];


    $sql1=$con->query("SELECT * FROM customers WHERE email='$email'");
    $count1=mysqli_num_rows($sql1);

    if($count1 ==1){
        $suc = "Email";

    }else {


            $pass = sha1($password);
            $code = rand(00000, 99999);

            function check_number()
            {
                global $con;


                $unique_number = rand(100000, 999999);

                $sql = $con->query("SELECT * FROM customers WHERE ref_code = '$unique_number'") or die ("error: " . mysqli_error($con));
                $exists = mysqli_num_rows($sql);


                if ($exists > 0) {
                    $results = check_number();
                } else {
                    $results = $unique_number;
                    return $results;
                }


            }

            $ref_code = check_number();
            $date_t = date("Y-m-d");
            $endDate = date("Y-m-d", strtotime("+30 days", strtotime($date_t)));

            $year = date("Y");
            $month1 = date("m-Y");
            $month2 = date("M-Y");
            $month = date("M");

            $verify_date = date("Y-m-d");


            $sqlb = $con->query("INSERT INTO customers (fname, lname,  email,  phone,   password, ref_code, month,  year,  date_t, startDate, endDate)  
      VALUES ('$fname', '$lname', '$email', '$phone', '$pass',  '$ref_code', '$month',  '$year', '$date_t','$date_t','$endDate')") or die("Error4: " . mysqli_error($con));


           

            /*    $sqlb = $con->query("INSERT INTO referral (referral_email, referral_code,  referred_email,  month, year, date_t)  
                 VALUES ('$ref_email', '$ref_code', '$email',  '$mon_year1',  '$year', '$date_t')") or die("Error4: " . mysqli_error($con));
                  } 


            $_SESSION['konnect_cus'] = $email;
            $_SESSION['konnect_whatsapp'] = $whatsapp;


            

            $p_len = strlen($whatsapp);
            if ($p_len == 11) {
                $phone2 = substr($whatsapp, -10);
                $phone2 = "+234" . $phone2;

            } elseif ($p_len == 10) {
                $phone2 = "+234" . $whatsapp;
            } elseif ($p_len == 14) {
                $phone2 = $whatsapp;
            }


             $body = "---";
            $query = array(
                "phone" => $phone2,
                "body" => $body
            );


            $data_string = json_encode($query);

/*            $ch = curl_init('https://api.mercury.chat/sdk/whatsapp/sendMessage?api_token=5df29ce699c89e00198b8c17lY7ANXzl9&instance=L1583328789738U');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_GETFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $response = curl_exec($ch);

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);

            curl_close($ch); */


            //require("mail/class.phpmailer.php");
            //require 'inc/verify.php';
            $_SESSION['val'] = "First";
            $_SESSION['user'] = $email;
 

            $suc = "Yes";
         
           }

          
$output = array('success'=>$suc, 'name' => $fname, 'phone' => $phone, 'email' => $email, 'ref_code' => $ref_code);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

} 



if (isset($_GET['user'])) {

    $user = $_GET['user'];
    $pass = $_GET['password'];

    $pass = sha1($pass);
    $sql1 =$con->query("SELECT * FROM customers WHERE email='$user' AND password = '$pass'");
    $count1 = mysqli_num_rows($sql1);
    
    
    if ($count1 == 1) {
        $row = mysqli_fetch_array($sql1);
        $email = $row['email'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $phone = $row['phone'];
        
        $ref_code = $row['ref_code'];
        

        $name = $fname." ".$lname;
        
        
      //  $_SESSION['user'] =  $row;
        $suc = "Yes";
     
    } else {
    $sql2 =$con->query("SELECT * FROM customers WHERE email='$user' AND verify != 'YES'");
    $count2 = mysqli_num_rows($sql2);
    if($count2 == 1)
    {
       $suc = "Exist"; 
    }
    else
    {
  
        $suc = "Password";
       // $info = "Incorrect Password.";
    } 
    }

 $_SESSION['user'] = $email;
 
$output = array('success'=>$suc, 'name' => $fname, 'phone' => $phone, 'email' => $email, 'ref_code' => $ref_code);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

}




?>