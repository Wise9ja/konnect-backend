  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="row">
      <div class="col-md-6">
      <h2 style="margin-top: 0px;">
  
  <?php
require 'config/config.php';
$user = $_GET['e'];
$sqlr =$con->query("SELECT * FROM customers WHERE email = '$user'") or die("Error2 : ". mysqli_error($con));
 $rowsr=mysqli_fetch_array($sqlr);
 $fname = $rowsr['fname'];
 $lname = $rowsr['lname'];

 ?>
 

       Wallet Statement  - <?php echo $fname; ?>  <?php echo $lname; ?>
      </h2>
      <p><a href="#"><i class="fa fa-dashboard"></i> Home</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a class="active">Referrals</a></p>
    </div>
     <!--<div class="col-md-4" style="text-align: left; margin-top: 10px;">  <a href="?p=new_category"> <button class="btn btn-primary" style="font-size: 16px; font-weight: 600;">Add New Category</button></a>  </div>-->
     

    </section>
     <!-- Main content -->
    <section class="content" style="margin-top: 0px; padding-top: 0px; ">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-10 col-xs-12" style="background-color: #fff; margin-left: 10px; border:solid; border-width: thin; border-color: #ddd;">

          <!-- small box -->
          <!-- <a href="add_product.php"><button style="background-color: #0060cc; height: 40px; width: 250px; border:none; border-radius: 5px; color: white; font-size: 16px;">ADD PRODUCT</button></a> -->
      
         <h4 style="color: green; font-weight: bold;"> <?php echo $up_error; ?></h4>
          <div style="dborder: solid; border-width: thin; border-color: #ccc; margin-top: 0px; padding: 1.5em; dheight: 500px; ">
       

<table class="table dtable-striped table-hover no-head-border" border="1" style="border:solid; border-color: black; border-width: thin;">
 <th style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">No</th>
 <th style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">Reference</th>
 <th style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">Amount</th>
 <th style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">Trans Type</th>
 <th style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">Description</th>
 <th style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">Balance</th>
 <th style="border:solid; border-width: thin; border-color: #eee; color: white; background-color: #0060a0;">Date</th>
<!-- <th>Edit</th>-->
<!-- <th style="border:solid; border-width: thin; border-color: #eee;">Delete</th>-->
<?php

$user = $_GET['e'];
$sql=$con->query("SELECT * FROM wallet_trans WHERE user = '$user'") or die("Error2 : ". mysqli_error($con));

 $i=1;
   
  while ($rows=mysqli_fetch_array($sql))
   {
    $id=$rows['id'];
    $trans_ref = $rows['trans_ref'];
    
    $amount = $rows['amount'];
    $type = $rows['type'];
    $method = $rows['method'];
    $balance = $rows['balance'];
    
    
  
    $date_t =$rows['date_t'];

    $date_t = date('d-M-Y',strtotime('+0 days',strtotime(str_replace('/', '-', $date_t))));
    

?>
<tr><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $i; ?><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $trans_ref; ?><td style="border:solid; border-width: thin; border-color: #eee;">&#8358;<?php echo number_format($amount); ?><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $type; ?><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $method; ?><td style="border:solid; border-width: thin; border-color: #eee;">&#8358;<?php echo number_format($balance); ?><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $date_t; ?> </a></td></td></td></tr>

<?php
$i++;
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



