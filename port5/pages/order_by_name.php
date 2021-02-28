  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="row">
      <div class="col-md-6">
      <h2 style="margin-top: 0px;">
      <?php
      $date_t = $_GET['date_t'];
      $date_tx = date('d-M-Y',strtotime('+0 days',strtotime(str_replace('/', '-', $date_t))));
      ?>
       Orders By Name  - <?php echo $date_tx; ?>
      </h2>
      <p><a href="#"><i class="fa fa-dashboard"></i> Home</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a href="?p=orders">Orders</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a href="?p=orders_by_month">Orders By Month</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a class="active">Orders By Date</a></p>
    </div>
    <!-- <div class="col-md-4" style="text-align: left; margin-top: 10px;">  <a href="?p=new_category"> <button class="btn btn-primary" style="font-size: 16px; font-weight: 600;">Add New Category</button></a>  </div>-->
     

    </section>
     <!-- Main content -->
    <section class="content" style="margin-top: 0px; padding-top: 0px; ">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-9 col-xs-12" style="background-color: #fff; margin-left: 10px; border:solid; border-width: thin; border-color: #ddd;">

          <!-- small box -->
          <!-- <a href="add_product.php"><button style="background-color: #0060cc; height: 40px; width: 250px; border:none; border-radius: 5px; color: white; font-size: 16px;">ADD PRODUCT</button></a> -->
      
         <h4 style="color: green; font-weight: bold;"> <?php echo $up_error; ?></h4>
          <div style="dborder: solid; border-width: thin; border-color: #ccc; margin-top: 0px; padding: 1.5em; dheight: 500px; ">
       
<?php
require 'config/config.php';
$refid=$_GET['refid'];

if($refid=="")
{
$refid=0;
}
else
{
  $refid = $refid;
}
$refp=$refid+50;

?>         

<table class="table dtable-striped dtable-hover dno-head-border" border="1">
 <th style="border:solid; border-width: thin;">S/N</th>
 <th style="border:solid; border-width: thin;">NAME</th>
 <th style="border:solid; border-width: thin;">STATUS</th>
 <th style="border:solid; border-width: thin;">ITEM</th>
 <th style="border:solid; border-width: thin;">ORDER AMT</th>
 <th style="border:solid; border-width: thin;">SELLER FEE</th>
 <th style="border:solid; border-width: thin;">DEL FEE</th>
 <th style="border:solid; border-width: thin;">PAID</th>
 <th style="border:solid; border-width: thin;">VIEW</th>
 



<?php
require 'config/config.php';
$date_t = $_GET['date_t'];
   
$sql=$con->query("SELECT * FROM sales  WHERE  date_t = '$date_t' AND payment_status = 'Successful'   ORDER BY id DESC") or die("Error : ". mysqli_error($con));

$count = mysqli_num_rows($sql);

  $sql3 = $con->query("SELECT SUM(total) as sumTotal FROM sales WHERE date_t = '$date_t'  AND payment_status = 'Successful' ") or die("Error2 : ". mysqli_error($con));
$query3 = mysqli_fetch_assoc($sql3);
$sumTotal = $query3 ['sumTotal'];

    if ($sql)

{
    $i=$refid;
  while($rows=mysqli_fetch_array($sql))

{   
    $id=$rows['id'];
    $inv_num = $rows['inv_num'];
    $paid = $rows['paid'];
    $email = $rows['user'];
    $fname = $rows['fname'];
    $lname = $rows['lname'];
    
    $total = $rows['total'];
    $seller_fee = $rows['seller_fee'];
    $status = $rows['order_status'];
    $delivery = $rows['delivery'];
    //$date_t = $rows['date_t'];
    $today = date("Y-m-d");
    
 $sqlx=$con->query("SELECT * FROM cart WHERE  inv_num = '$inv_num' AND user = 'email'  ORDER BY id DESC") or die("Error2 : ". mysqli_error($con));
$countx = mysqli_num_rows($sqlx);


$date_tx = date('d-M-Y',strtotime('+0 days',strtotime(str_replace('/', '-', $date_t))));


$i++;
?>
<tr><td style="border:solid; border-width: thin;"><?php echo $i; ?><td style="border:solid; border-width: thin;"><?php echo $fname; ?> <?php echo $lname; ?><td style="border:solid; border-width: thin;"><?php echo $status; ?><td style="border:solid; border-width: thin;"><?php echo number_format($countx); ?><td style="border:solid; border-width: thin;">&#x20A6; <?php echo number_format($total); ?><td style="border:solid; border-width: thin;">&#x20A6; <?php echo number_format($seller_fee); ?><td style="border:solid; border-width: thin;">&#x20A6; <?php echo number_format($delivery); ?><td style="border:solid; border-width: thin;">&#x20A6; <?php echo number_format($paid); ?><td style="border:solid; border-width: thin;"><a href="?p=view_order&inv=<?php echo $inv_num; ?>&date_t=<?php echo $date_t; ?>"> View more</a></td></td></td></td></td></td></td></td></td></td></td></tr>

<?php
}
}
?>
 <tr><td style="border:solid; border-width: thin;"><td style="border:solid; border-width: thin;">Total<td style="border:solid; border-width: thin;"><td style="border:solid; border-width: thin;"><td style="border:solid; border-width: thin;">&#x20A6; <?php echo number_format($sumTotal); ?><td style="border:solid; border-width: thin;"><td style="border:solid; border-width: thin;"><td style="border:solid; border-width: thin;"><td style="border:solid; border-width: thin;"><a href="?p=view_order&inv=<?php echo $inv_num; ?>&date_t=<?php echo $date_t; ?>"> View more</a></td></td></td></td></td></td></td></td></td></td></td></tr>

</table>


        </div>
        </div>
        <!-- ./col -->
     
     
  <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div>
        </div>
        </div>
     
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
     </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

   
<?php include('includes/js.php')?>
</body>
</html>


