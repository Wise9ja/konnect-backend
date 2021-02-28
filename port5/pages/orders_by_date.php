  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="row">
      <div class="col-md-6">
      <h2 style="margin-top: 0px;">
      <?php
      $month = $_GET['month'];
      $monthx = "01-".$month;
      $monthx = date('M-Y',strtotime('+0 days',strtotime(str_replace('/', '-', $monthx))));
      ?>
       Orders By Date  - <?php echo $monthx; ?>
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
<th style="border:solid; border-width: thin;">ORDER DATE</th>
 <th style="border:solid; border-width: thin;">ORDERS</th>
 <th style="border:solid; border-width: thin;">ORDER AMT</th>
 <th style="border:solid; border-width: thin;">SELLER FEE</th>
 <th style="border:solid; border-width: thin;">PAID</th>
 <th style="border:solid; border-width: thin;">VIEW</th>

 



<?php
require 'config/config.php';
$month = $_GET['month'];


$sqlx=$con->query("SELECT * FROM sales  WHERE  month = '$month' AND payment_status = 'Successful'   GROUP BY date_t  ORDER BY id DESC") or die("Error : ". mysqli_error($con));
if($sqlx)
{
 $i=0;

  while ($rows=mysqli_fetch_array($sqlx))
   {
    $id=$rows['id'];
    $inv_num = $rows['inv_num'];
    $date_t = $rows['date_t'];
      
  $sql=$con->query("SELECT * FROM sales WHERE  payment_status = 'Successful' AND  month = '$month' AND date_t = '$date_t'  ORDER BY id DESC") or die("Error2 : ". mysqli_error($con));
$count = mysqli_num_rows($sql);



$sql3 = $con->query("SELECT SUM(total) as sumTotal FROM sales WHERE  month = '$month' AND date_t = '$date_t'  AND payment_status = 'Successful' ") or die("Error2 : ". mysqli_error($con));
$query3 = mysqli_fetch_assoc($sql3);
$sumTotal = $query3 ['sumTotal'];

$sql4 = $con->query("SELECT SUM(paid) as sumPaid FROM sales WHERE  month = '$month' AND date_t = '$date_t' AND  payment_status = 'Successful' ") or die("Error2 : ". mysqli_error($con));
$query4 = mysqli_fetch_assoc($sql4);
$sumPaid = $query4 ['sumPaid'];


$sql5 = $con->query("SELECT SUM(delivery) as sumDelivery FROM sales WHERE  month = '$month' AND date_t = '$date_t' AND payment_status = 'Successful'") or die("Error2 : ". mysqli_error($con));
$query5 = mysqli_fetch_assoc($sql5);
$sumDelivery = $query5 ['sumDelivery'];


$sql6 = $con->query("SELECT SUM(seller_fee) as sumSeller FROM sales WHERE  month = '$month' AND date_t = '$date_t' AND payment_status = 'Successful'") or die("Error2 : ". mysqli_error($con));
$query6 = mysqli_fetch_assoc($sql6);
$sumSeller = $query6 ['sumSeller'];

$date_tx = date('d-M-Y',strtotime('+0 days',strtotime(str_replace('/', '-', $date_t))));


$i++;
?>
<tr><td style="border:solid; border-width: thin;"><?php echo $i; ?><td style="border:solid; border-width: thin;"><?php echo $month; ?><td style="border:solid; border-width: thin;"><?php echo number_format($count); ?><td style="border:solid; border-width: thin;">&#x20A6;
<?php echo number_format($sumTotal); ?><td style="border:solid; border-width: thin;"> &#x20A6;
<?php echo number_format($sumSeller); ?><td style="border:solid; border-width: thin;">&#x20A6;
 <?php echo number_format($sumPaid); ?><td style="border:solid; border-width: thin;">
<a href="?p=order_by_name&date_t=<?php echo $date_t; ?>"> View more</a></td></td></td></td></td></td></td></td></td></td></td></tr>

<?php
}
}
?>
 
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



<?php
function product_list ()
{

}





?>