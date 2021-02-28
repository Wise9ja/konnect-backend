<?php
include "includes/con.php";

$user = $_GET['user'];

 $sql =$con->query("SELECT * FROM kredit WHERE email='$user'");
 $count = mysqli_num_rows($sql);

    if($count == 0)
    {
    $status = "Exist";
    }
  else

{
        $row = mysqli_fetch_array($sql);
        
        $activate = $row['activate'];
        $activate_date = $row['activate_date'];
        $status = $row['status'];
        $total = $row['total'];
        $balance = $row['balance'];
        $interest = $row['interest'];
        $used = $row['used'];
        $day = 2;

        $interest = ($used * 0.1 * $day)/30;

        $pay = ($used + $interest) - $cashback; 

        
        $total =    "&#8358;".number_format($total);
        $balance =  "&#8358;".number_format($balance);
        $used = "&#8358;".number_format($used);
        $pay =    "&#8358;".number_format($pay);
        $interest =    "&#8358;".number_format($interest);
        

        
        
}  
      

$output = array('activate' => $activate, 'activate_date' => $activate_date, 'status' => $status, 'used' => $used, 'total' => $total, 'balance' => $balance, 'interest' => $interest);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data
