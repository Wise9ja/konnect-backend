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
       Search Results
      </h2>
      <p><a href="#"><i class="fa fa-dashboard"></i> Home</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a href="?p=orders">Orders</a> &nbsp;&nbsp; > &nbsp;&nbsp; Search Results</p>
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
$refp=$refid+100;

?>         

<table class="table dtable-striped dtable-hover dno-head-border" border="1">
 <th style="border:solid; border-width: thin;">S/N</th>
 <th style="border:solid; border-width: thin;">NAME</th>
 <th style="border:solid; border-width: thin;">STATUS</th>
 <th style="border:solid; border-width: thin;">ITEM</th>
 <th style="border:solid; border-width: thin;">AMOUNT</th>
 <th style="border:solid; border-width: thin;">PAID</th>
 <!--<th style="border:solid; border-width: thin;">VENDOR FEE</th>-->
 <th style="border:solid; border-width: thin;">DELIVERY DATE</th>
 <th style="border:solid; border-width: thin;">ACTION</th>
 



<?php
require 'config/config.php';

$del_date = $_GET['del_date'];
$q = $_GET['q'];
$status = $_GET['status'];



if (!empty($q))
{
    $sql1=$con->query("SELECT * FROM sales  WHERE  fname LIKE '%$q%' AND payment_status = 'Successful' OR lname LIKE '%$q%' AND payment_status = 'Successful'  GROUP BY inv_num LIMIT $refid, 100") or die("Error2 : ". mysqli_error($con));
}


if (!empty($del_date))
{
    $sql1=$con->query("SELECT * FROM sales  WHERE  delivery_date = '$del_date' AND payment_status = 'Successful'  GROUP BY inv_num LIMIT $refid, 100") or die("Error2 : ". mysqli_error($con));
}

if(!empty($status))
{
      $sql1=$con->query("SELECT * FROM sales  WHERE   order_status = '$status' AND payment_status = 'Successful'  GROUP BY inv_num LIMIT $refid, 100") or die("Error2 : ". mysqli_error($con));
}
   
  
    if ($sql1)

{
    $i=$refid;
  while($rows=mysqli_fetch_array($sql1))

{   
    $id=$rows['id'];
    $inv_num = $rows['inv_num'];
    $fname = $rows['fname'];
    $lname = $rows['lname'];
    $paid = $rows['paid'];
    $email = $rows['user'];
    $total = $rows['final_total'];
    $bal = $rows['balance'];
    $status = $rows['order_status'];
    $delivery = $rows['delivery'];
    $del_date = $rows['delivery_date'];
    
    
    //$date_t = $rows['date_t'];
    $today = date("Y-m-d");
    
    
    

  



$sql7 = $con->query("SELECT * FROM trans_items WHERE  inv_num = '$inv_num'") or die("Error2 : ". mysqli_error($con));
$count = mysqli_num_rows($sql7);

$rows=mysqli_fetch_array($sql7);

$del_date = $rows['delivery_date'];
$date_t = $rows['date_t'];
    
  if(!empty($del_date))
  {
$del_date2 = date('d-M-Y',strtotime('+0 days',strtotime(str_replace('/', '-', $del_date))));
}
else
{
$del_date2 = "";
}

$i++;
?>
<tr><td style="border:solid; border-width: thin;"><?php echo $i; ?><td style="border:solid; border-width: thin;"><?php echo $fname; ?> <?php echo $lname; ?><td style="border:solid; border-width: thin;"><?php echo $status; ?><td style="border:solid; border-width: thin;"><?php echo number_format($count); ?><td style="border:solid; border-width: thin;">&#x20A6; <?php echo number_format($total); ?><td style="border:solid; border-width: thin;">&#x20A6; <?php echo number_format($paid); ?><td style="border:solid; border-width: thin;"><?php echo $del_date2; ?><td style="border:solid; border-width: thin;"><a href="?p=view_order&inv=<?php echo $inv_num; ?>&date_t=<?php echo $date_t; ?>"> View more</a></td></td></td></td></td></td></td></td></td></td></td></tr>

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


