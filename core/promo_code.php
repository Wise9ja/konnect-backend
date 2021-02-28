<?php
if(isset($_GET['user']))
{
include 'includes/con.php';

$user = $_GET['user'];

$inv_num = $_GET['inv_num'];
$coupon = $_GET['coupon'];

$sql = $con->query("SELECT * FROM coupon  WHERE coupon ='$coupon'");

$countx = mysqli_num_rows($sql);


if($countx == 1)
{
   $row = mysqli_fetch_array($sql);
        
        $coupon_value = $row['c_value'];

$sql2 = $con->query("SELECT * FROM sales  WHERE inv_num ='$inv_num'");

        $row2 = mysqli_fetch_array($sql2);
        
        $total = $row2['final_total'];
       

$sqln = $con->query("UPDATE sales set coupon = '$coupon', coupon_value = '$coupon_value' WHERE inv_num = '$inv_num' AND user='$user'") or die("Error2 : " . mysqli_error($con));

if($sqln)
{
$suc = "Yes";   
}

}
else
{
 $suc = "No";   
}
if(isset($_GET['callback']))
{
header("Content-Type:application/json");
}

$output = array('success' => $suc);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data
}
?>
