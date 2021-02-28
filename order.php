<?php
include "includes/header.php";

$email = $_SESSION['user'];

$type = $_GET['type'];
if($type == "Pending")
{
$sqlw = $connn->query("SELECT * FROM sales WHERE user = '$user' AND  order_status !='Delivered' AND payment_status = 'Successful'") or die("Error2 : " . mysqli_error($connn));
}
else if ($type == "Successful")
{
$sqlw = $connn->query("SELECT * FROM sales WHERE user = '$user' AND  order_status ='Delivered' AND payment_status = 'Delivered'") or die("Error2 : " . mysqli_error($connn));
}
$countw = mysqli_num_rows($sqlw);


?>

<section class=" row">
    <?php include "side_profile_menu.php" ?>
    <div class="col-md-8">
        <h5>My Orders -  <?php echo $type ;?></h5>

        <div class="card bg-grey2 cyan-top">

            <div class="card-body ">

                <?php while($order = mysqli_fetch_array($sqlw))
                { ?>

                    <div class="cart_card row">
                        <div class="col-sm-3">
                            <img src="images/cart_icon.png" class="img-fluid"></div>
                        <div class="col-sm-9"><br>
                            <h5>Invoice <?php echo $order['inv_num'];?> <span class="float-right">₦ <?php echo number_format($order['total'],2) ?></span></h5>
                            <div><small>Tracking No:  <b>KD<?php echo $order['id'] ?></b></small></div>

                            <div class="row" style="margin-top:30px">
                                <div class="col-sm-8">
                                    <h5 style="" class="text-<?php if($type=='Successful'){ echo 'success';} if($type=='Pending'){ echo 'warning';} if($type=='Cancelled'){ echo 'danger';}?> "> <?php if($type=='Successful'){ echo 'Delivered'; } else { echo $type; }?></h5>
                                </div>
                                <div class="col-sm-4">
                                    <a href='order-details' class="btn-block btn bg-cyan">Details</a>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>
<?php if($countw==0)
{?>
                <div>You have no <?php echo $type ?> order!</div>
                <?php }?>
            </div>
    </div>
</section>

<?php
include 'includes/footer.php'
?>
