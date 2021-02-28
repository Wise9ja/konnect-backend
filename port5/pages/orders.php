  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="row">
      <div class="col-md-6">
      <h2 style="margin-top: 0px;">
       ORDERS
      </h2>
      <p><a href="#"><i class="fa fa-dashboard"></i> Home</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a class="active">Orders</a></p>
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
      
        <div style="margin: 20px; margin-top: 20px;">
        <form method="get" action="#">
          <input type="hidden" name="p" value="sort_status">
        <input type="text" name="q" value="<?php echo $_GET['q']; ?>" placeholder="Search By Buyer Name " style="height: 30px; font-size: 15px; padding: 15px; width: 30%; border:solid; border-color: #cccccc;"> 

        <input type="date" name="del_date" value="" placeholder="Search By Buyer Name " style="height: 30px; font-size: 15px; padding: 15px; width: 30%; border:solid; border-color: #cccccc;"> 

        <select name="status" style="height: 35px; border: solid; border-color: #cccccc; width: 30%;"> 
        <option value="">Select Status</option>
        <option>Order in Cart</option>
        <option>Order in Process</option>
        <option>Order in Transit</option>
        <option>Order in Delivery</option>
        <option>Order Delivered</option>
        </select>

        <button class="btn btn-primary" style="font-size: 14px;">Submit</button>

       </form>
     </div>

 <div style="dborder: solid; border-width: thin; border-color: #ccc; margin-top: -20px; padding: 1.5em; dheight: 500px; ">
       
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
<!-- <th style="border:solid; border-width: thin;">S/N</th>-->
 <th style="border:solid; border-width: thin;">YEAR</th>
 <th style="border:solid; border-width: thin;">ORDERS</th>
 <th style="border:solid; border-width: thin;">ORDER AMT</th>
 <th style="border:solid; border-width: thin;">SELLER FEE</th>
 <th style="border:solid; border-width: thin;">DEL FEE</th>
 <th style="border:solid; border-width: thin;">PAID</th>
 <th style="border:solid; border-width: thin;">VIEW</th>
 

<?php
$sqlx=$con->query("SELECT * FROM sales  WHERE  payment_status = 'Successful' GROUP BY year") or die("Error2 : ". mysqli_error($con));
if($sqlx)
{
 $i=0;
  

  while ($rows=mysqli_fetch_array($sqlx))
   {
    $id=$rows['id'];
    $year = $rows['year'];  
    $i++;
    
$sql=$con->query("SELECT * FROM sales WHERE  payment_status = 'Successful' AND year = '$year'  ORDER BY id DESC") or die("Error2 : ". mysqli_error($con));
$count = mysqli_num_rows($sql);


$sql3 = $con->query("SELECT SUM(total) as sumTotal FROM sales WHERE  year= '$year' AND payment_status = 'Successful' ") or die("Error2 : ". mysqli_error($con));
$query3 = mysqli_fetch_assoc($sql3);
$sumTotal = $query3 ['sumTotal'];

$sql4 = $con->query("SELECT SUM(paid) as sumPaid FROM sales WHERE  year= '$year' AND payment_status = 'Successful' ") or die("Error2 : ". mysqli_error($con));
$query4 = mysqli_fetch_assoc($sql4);
$sumPaid = $query4 ['sumPaid'];


$sql5 = $con->query("SELECT SUM(delivery) as sumDelivery FROM sales WHERE  year= '$year' AND payment_status = 'Successful'") or die("Error2 : ". mysqli_error($con));
$query5 = mysqli_fetch_assoc($sql5);
$sumDelivery = $query5 ['sumDelivery'];


$sql6 = $con->query("SELECT SUM(seller_fee) as sumSeller FROM sales WHERE  year= '$year' AND payment_status = 'Successful'") or die("Error2 : ". mysqli_error($con));
$query6 = mysqli_fetch_assoc($sql6);
$sumSeller = $query6 ['sumSeller'];


?>

<tr><td style="border:solid; border-width: thin;"><?php echo $year; ?><td style="border:solid; border-width: thin;"><?php echo number_format($count); ?><td style="border:solid; border-width: thin;">&#x20A6;
<?php echo number_format($sumTotal); ?><td style="border:solid; border-width: thin;"> &#x20A6;
<?php echo number_format($sumSeller); ?><td style="border:solid; border-width: thin;">&#x20A6;
 <?php echo number_format($sumDelivery); ?><td style="border:solid; border-width: thin;">&#x20A6;
 <?php echo number_format($sumPaid); ?><td style="border:solid; border-width: thin;"><a href="?p=orders_by_month&year=<?php echo $year; ?>">View more</a></td></td></td></td></td></td></td></tr>

<?php
}
}

?>
 
</table>

<script type="text/javascript">
function delete_cat(id)
{

var r = confirm ("Do you want to Delete this item?");

if (r == true) {
var dataString='id='+id;
$.ajax({
type:"GET",
url:"process/delete_cat.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){
var success = data.success;
if(success == "Yes")
{
//alert("Category Deleted Successfully!");
window.location = "?p=product_categories";
}
else if (success = "No")
{
 alert("An error Occured!");
}
},
beforeSend:function()
{
$('#loader').fadeOut(200).show();
},
error: function(jqXHR, textStatus, errorThrown)
{
    alert ("Could not connect to server");
    //$('#in').fadeOut(200).hide();

    }


});} else {
}


 
}
</script>

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