<?php
include "includes/con.php";


if(isset($_GET['pay_option'])){

$pay_option = $_GET['pay_option'];
$date_t = date("Y-m-d");

$sql ="SELECT * FROM delivery_dates WHERE pay_option ='$pay_option' AND delivery_date >= '$date_t'";
        $sql1 = $con->query($sql);
        while ($row = mysqli_fetch_array($sql1))
        {
        $del_date = $row['delivery_date'];
        $del_datex = date('D d-M-Y',strtotime('+0 days',strtotime(str_replace('/', '-', $del_date))));


        $del_dates .=   '<option value="'.$del_date.'">'.$del_datex.'</option>';

       
    
        }
    
  
      

$output = array('del_dates' => $del_dates);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

}

 