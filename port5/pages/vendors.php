  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="row">
      <div class="col-md-6">
      <h2 style="margin-top: 0px;">
       Product Vendors
      </h2>
      <p><a href="#"><i class="fa fa-dashboard"></i> Home</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a class="active">Product Vendor</a></p>
    </div>
     <div class="col-md-4" style="text-align: left; margin-top: 10px;">  <a href="p=new_vendor"> <button class="btn btn-primary" style="font-size: 16px; font-weight: 600;">Add New Vendor</button></a>  </div>
     

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
       
<table class="table dtable-striped table-hover no-head-border" border="1">
 <th style="border:solid; border-width: thin; border-color: #eee;">NO</th>
 <th style="border:solid; border-width: thin; border-color: #eee;">Vendor</th>
 <th style="border:solid; border-width: thin; border-color: #eee;">Type</th>
 <th style="border:solid; border-width: thin; border-color: #eee;">Address</th>
 <th style="border:solid; border-width: thin; border-color: #eee;">Phone</th>
 <th style="border:solid; border-width: thin; border-color: #eee;">Email</th>
 <th style="border:solid; border-width: thin; border-color: #eee;">Date Added</th>
 <th style="border:solid; border-width: thin; border-color: #eee;">Edit</th>
 <th style="border:solid; border-width: thin; border-color: #eee;">Delete</th>
<?php
require 'config/config.php';



$sql=$con->query("SELECT * FROM vendors ORDER BY id DESC") or die("Error2 : ". mysqli_error($con));

if($sql)
{
 $i=1;
   
  while ($rows=mysqli_fetch_array($sql))
   {
    $id=$rows['id'];
    $vendor=$rows['vendor'];
    $type=$rows['type'];
    $address=$rows['address'];
    $email=$rows['email'];
    $phone=$rows['phone'];
    
    
    
    $date_t =$rows['date_t'];
    
 
?>
<tr><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $i; ?><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $vendor; ?><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $type; ?><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $address; ?><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $phone; ?><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $email; ?><td style="border:solid; border-width: thin; border-color: #eee;"><?php echo $date_t; ?> <td style="border:solid; border-width: thin; border-color: #eee;"><a href="edit_vendor.php?id=<?php echo $id; ?>"><button class="btn btn-warning"><icon class="fas fa-pencil-alt"></button><td style="border:solid; border-width: thin; border-color: #eee;"><button onclick="delete_vendor('<?php echo $id; ?>');" class="btn btn-danger">Delete</button> </td></td></td></td></tr>

<?php
$i++;
}
}
?>

 
 
</table>


<script type="text/javascript">
function delete_vendor(id)
{

var r = confirm ("Do you want to Delete this item?");

if (r == true) {
var dataString='id='+id;
$.ajax({
type:"GET",
url:"process/del_vendor.php",
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
window.location = "?p=vendors";
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