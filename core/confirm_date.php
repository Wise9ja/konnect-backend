<?php
include 'includes/con.php';
if(isset($_GET['user']))
{
$user = $_GET['user'];

$inv_num = $_GET['inv_num'];
$del_date = $_GET['del_date'];
$pay_option = $_GET['pay_option'];


$sql2 = $con->query("SELECT * FROM sales  WHERE inv_num ='$inv_num'");

        $row2 = mysqli_fetch_array($sql2);
        
        $total = $row2['total'];


if($pay_option == "Now")
{
    $sqld = $con->query("SELECT * FROM discount");
        $rowd = mysqli_fetch_array($sqld);
        $paynow_discount = $rowd['pay_now'];
        $discount = ($paynow_discount/100) * $total;
      
}
else
{
    $discount = 0;
}

$sqln = $con->query("UPDATE sales set payment_type = '$pay_option',  delivery_date = '$del_date', discount = '$discount' WHERE inv_num = '$inv_num' AND user='$user'") or die("Error2 : " . mysqli_error($con));

if($sqln)
{
$suc = "Yes";   
}

if(isset($_GET['callback']))
{
header("Content-Type:application/json");
}

$output = array('success' => "Yes");
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

}
?>
