<?php
include 'includes/functions.php';
include 'includes/connection.php';
$id=$_GET['id'];
$quan = $_GET['quan'];


$sql1=$connn->query("SELECT * FROM cart WHERE id = '$id'") or die("Error1b : ". mysqli_error($connn));

if($sql1)
{

    $rows1=mysqli_fetch_array($sql1);

    $id=$rows1['id'];
if($quan>0) {
    $price = $rows1['actual_price'];
    $discount = $rows1['discount'];

    $price = $price - $discount;
    $final_total = $price * $quan;

    $sqln = $connn->query("UPDATE cart set num_of_goods = '$quan', final_total = '$final_total'  WHERE id = '$id'") or die("Error2 : " . mysqli_error($connn));
}else
{
    $sqln = $connn->query("DELETE FROM  cart   WHERE id = '$id'") or die("Error2 : " . mysqli_error($connn));

}
}

header('location:cart.php');

?>
