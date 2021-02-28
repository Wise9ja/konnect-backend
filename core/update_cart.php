<?php
include 'includes/con.php';
$id=$_GET['id'];
$quan = $_GET['quan'];
$type = $_GET['type'];


$sql1=$con->query("SELECT * FROM cart WHERE id = '$id'") or die("Error1b : ". mysqli_error($con));

if($sql1)
{

    $rows1=mysqli_fetch_array($sql1);

    $id=$rows1['id'];
    $price = $rows1['actual_price'];
    $discount = $rows1['discount'];

    
if($type == "add")
{
 //$quan ++;
 $final_total = $price * $quan;

$sqln = $con->query("UPDATE cart set num_of_goods = '$quan', final_total = '$final_total'  WHERE id = '$id'") or die("Error2 : " . mysqli_error($con));
 }

else if($type == "delete")
{
$sqln = $con->query("DELETE FROM  cart  WHERE id = '$id'") or die("Error2 : " . mysqli_error($con));
}

}

if(isset($_GET['callback']))
{
header("Content-Type:application/json");
}


$output = array('success' => "Yes");
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data


?>
