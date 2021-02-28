  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 1000px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="row">
      <div class="col-md-6">
      <h2 style="margin-top: 0px;">
       Order Details
      </h2>
      <p><a href="#"><i class="fa fa-dashboard"></i> Home</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a href="?p=orders">Orders</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a href="?p=orders_by_month">Orders By Month</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a class="active">Orders By Date</a></p>
    </div>
  </div>

    <!-- <div class="col-md-4" style="text-align: left; margin-top: 10px;">  <a href="?p=new_category"> <button class="btn btn-primary" style="font-size: 16px; font-weight: 600;">Add New Category</button></a>  </div>-->
     

    </section>
     <!-- Main content -->
    <section class="content" style="margin-top: 0px; margin-bottom: 50px; padding-top: 0px; ">
      <!-- Small boxes (Stat box) -->
        <div class="col-md-10 col-xs-12" style="background-color: #fff; margin-left: 10px; border:solid; border-width: thin; border-color: #ddd;">
      <div class="row">

     <div class="col-md-6" style="dbackground-color: #f0f0f0;">
 
       

<?php
require 'config/config.php';

$inv_num=$_GET['inv'];
$date_t=$_GET['date_t'];


$sql=$con->query("SELECT * FROM sales WHERE inv_num = '$inv_num' ORDER BY id ASC") or die("Error2 : ". mysqli_error($con));

if($sql)
{
 $i=1;
   
  while ($rows=mysqli_fetch_array($sql))
   {
    $id=$rows['id'];
    $product_code=$rows['product_code'];
    $units=$rows['units'];
    $price=$rows['actual_price'];
    
    $fname=$rows['fname'];
    $lname=$rows['lname'];
    $phone=$rows['phone'];
    $delivery_date=$rows['delivery_date'];
    $addr=$rows['delivery_addr'];
    $payment_status = $rows['payment_status'];
    $delivery_status = $rows['delivery_status'];
    
    

if($payment_status == "Successful")
{
  $payment_status = '<span style="color:#00aa00;">Paid</span>';
}
else
{
  $payment_status = '<span style="color:#aa0000;">No Paid</span>';
}


  $date_t=$rows['date_t'];

$sql2=$con->query("SELECT * FROM product WHERE product_code= '$product_code'") or die("Error2 : ". mysqli_error($con));

 $rows=mysqli_fetch_array($sql2);
    $id=$rows['id'];
    $product=$rows['product'];
    $pic=$rows['photo'];
  
    $delivery_date = date('d-M-Y',strtotime('+0 days',strtotime(str_replace('/', '-', $delivery_date))));
    $order_date = date('d-M-Y',strtotime('+0 days',strtotime(str_replace('/', '-', $date_t))));
    
  
    ?>
 <div class="row" style="dbackground-color: #eee; margin-top: 15px;"> 
<div class="col-md-12" style="dbackground-color: #f9f9f9; dheight: 100px;">

<table class="table dtable-striped dtable-hover dno-head-border" border="1">
 <th style="border:solid; border-width: thin;">ITEM NAMES</th>
 <th style="border:solid; border-width: thin;">ITEM QTY</th>
 <th style="border:solid; border-width: thin;">ORDER AMT</th>
 <th style="border:solid; border-width: thin;">SELLER FEE</th>

<?php
$sql=$con->query("SELECT * FROM cart WHERE inv_num = '$inv_num' ORDER BY id ASC") or die("Error2 : ". mysqli_error($con));

if($sql)
{
 $i=1;
   
  while ($rows=mysqli_fetch_array($sql))
   {
    $id=$rows['id'];
    $product=$rows['product'];
    $units=$rows['num_of_goods'];
    $price=$rows['actual_price'];
    $seller_price=$rows['seller_price'];
    
    ?>


  <tr><td style="border:solid; border-width: thin;"><?php echo $i; ?><td style="border:solid; border-width: thin;"><?php echo $product; ?><td style="border:solid; border-width: thin;">&#x20A6; <?php echo number_format($units); ?>&#x20A6; <td style="border:solid; border-width: thin;"><?php echo number_format($price); ?><td style="border:solid; border-width: thin;">&#x20A6; <?php echo number_format($seller_price); ?><td style="border:solid; border-width: thin;">&#x20A6; <?php echo number_format($seller_fee); ?><td style="border:solid; border-width: thin;"><a href="?p=view_order&inv=<?php echo $inv_num; ?>&date_t=<?php echo $date_t; ?>"> View more</a></td></td></td></td></td></td></td></td></td></td></td></tr>

<?php
}
}
?>

<!--<div class="col-md-4" style="background-color: white; border:solid; border-width: thin; border-color: #eee;">
  <img src="products/<?php //echo $pic; ?>"  height="100px" style="border-radius: 10px;" >
</div>
<div class="col-md-8" style="background-color: #f9f9f9; height: 100px;">
<!--<h3 style="font-size: 16px; font-weight: bold; font-family: verdana;">
<?php //echo $product; ?> <br>&#x20A6;<?php //echo number_format($price); ?> (<?php //echo $units; ?>)
</h3>-->
</table>
</div>
</div>

    <?php

}
}
?>

</div>
<div class="col-md-1"></div>
  <div class="col-md-5" style=" dbackground-color: #f0f0f0;">
   <div style="margin-top: 15px; padding: 20px; padding-top: 0px; border:solid; border-width: thin; border-color: #ccc;     background-color: #f5f5f5;"> 
    <h2 style="font-size: 18px; padding-top: 5px; font-weight: bold; font-family: calibri;">DELIVERY DETAILS </h2> 
    <!--<p style="color: #0060ff; font-size: 14px; font-weight: bold;"> Name : <span style="color: black; color: #606060;"> <?php echo $fname; ?> <?php echo $lname; ?> </span></p>
    <p style="color: #0060ff; font-size: 14px; font-weight: bold;"> Phone : <span style="color: black; color: #606060;"> <?php echo $phone; ?> </span></p>-->
    <p style="color: #0060ff; font-size: 14px; font-weight: bold;">  <span style="color: black; color: #606060;"><?php echo $addr; ?> </span></p>
    <p style="color: #0060ff; font-size: 14px; font-weight: bold;"> Order  Date: <span style="color: black; color: #606060;"><?php echo $order_date; ?></span> 
    <p style="color: #0060ff; font-size: 14px; font-weight: bold;"> Delivery  Date: <span style="color: black; color: #606060;"><?php echo $delivery_date; ?></span> </p>
    
   </div>
   <div style="margin-top: 15px; padding: 20px; padding-top: 0px; border:solid; border-width: thin; border-color: #ccc;     background-color: #f5f5f5;"> 
    <h2 style="font-size: 18px; padding-top: 5px; font-weight: bold; font-family: calibri;">PAYMENT STATUS : <?php echo $payment_status; ?> </h2> 
   </div>
<div style="margin-top: 15px; padding: 20px; padding-top: 0px; border:solid; border-width: thin; border-color: #ccc;     background-color: #f5f5f5;"> 
    <h2 style="font-size: 18px; padding-top: 5px; font-weight: bold; font-family: calibri;">DELIVERY STATUS : <span style="color: orange;"><?php echo $delivery_status; ?> </span></h2> 
   </div>
   
 </div>

        
        </div>
      </div>
     
 
      </section>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<!-- ./wrapper -->

   
</body>
</html>






