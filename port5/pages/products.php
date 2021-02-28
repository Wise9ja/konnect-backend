  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="row">
      <div class="col-md-6">
      <h2 style="margin-top: 0px;">
       Product List
      </h2>
      <p><a href="#"><i class="fa fa-dashboard"></i> Home</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a href="?p=products" class="active">Product</a></p>
    </div>
     <div class="col-md-4" style="text-align: left; margin-top: 10px;">  <a href="?p=new_product"> <button class="btn btn-primary" style="font-size: 16px; font-weight: 600;">Add New Product</button></a>  </div>
     

    </section>
     <!-- Main content -->
    <section class="content" style="margin-top: 0px; padding-top: 0px; ">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-10 col-xs-12" style="background-color: #fff; margin-left: 10px; border:solid; border-width: thin; border-color: #ddd;">

          <!-- small box -->
        
         <h4 style="color: green; font-weight: bold;"> <?php echo $up_error; ?></h4>
          <div style="dborder: solid; border-width: thin; border-color: #ccc; margin-top: 0px; padding: 1.5em; dheight: 500px; ">
       <div style="margin: 20px; margin-top: 0px;">
        <form method="get" action="#">
          <input type="hidden" name="p" value="products">
        <input type="text" name="q" value="<?php echo $_GET['q']; ?>" placeholder="Search By Products or Sellers or Category" style="height: 30px; font-size: 15px; padding: 15px; width: 80%; border:solid; border-color: #cccccc;"> 
       </form>
     </div>
 <table class="table dtable-striped table-hover no-head-border" border="1">
 <!--<th style="border: solid; border-width: thin; border-color: #eee; dcolor:blue;">No</th>-->
  <th style="border-top: solid; border-width: thin; border-color: #eee;">Image</th>
 <th style="border-top: solid; border-width: thin; border-color: #eee;">Product Name</th>
 <th style="border-top: solid; border-width: thin; border-color: #eee;">Category</th>
 <th style="border-top: solid; border-width: thin; border-color: #eee;">Seller Price</th>
 <th style="border-top: solid; border-width: thin; border-color: #eee;">Order Price</th>
 <th style="border-top: solid; border-width: thin; border-color: #eee;">Market Price</th>
  <th style="border-top: solid; border-width: thin; border-color: #eee;">Save</th>
  <th style="border-top: solid; border-width: thin; border-color: #eee;">Status</th>
 <th style="border: solid; border-width: thin; border-color: #eee;">Action</th>


<?php
require 'config/config.php';
$sql=$con->query("SELECT * FROM product ORDER BY id DESC LIMIT 0, 200") or die("Error2 : ". mysqli_error($con));

if(isset($_GET['q']))
{
$q = $_GET['q'];
$sql=$con->query("SELECT * FROM product WHERE product LIKE '%$q%' OR product_category LIKE '%$q%'  ORDER BY id DESC LIMIT 0, 200") or die("Error2 : ". mysqli_error($con));
}

 $i=1;
   
  while ($rows=mysqli_fetch_array($sql))
   {
    $id=$rows['id'];
    $sector=$rows['sector'];
    $category=$rows['product_category'];
    $type=$rows['product_type'];
    $sector=$rows['product_sector'];
    $product=$rows['product'];
    $product_code=$rows['product_code'];
    $price = $rows['price'];
    $market_price = $rows['market_price'];
    $order_price = ($price * (105/70));
    $quantity = $rows['quantity'];
    $pic = $rows['photo'];
    $status = $rows['status'];
     
      $date_t =$rows['date_t'];
     
    $pid = "p".$id;
    $vid = "v".$id;
    $mid = "m".$id;
   
    if($status == "Hidden")
    {
        $stat = "Unavailable";
        $but = "btn-danger";
  
    }
    else
    {
        $stat = "Available";
        $but = "btn-warning";
    }
   
   
 
?>
<tr><!--<td style="border: solid; border-width: thin; border-color: #eee;"><?php //echo $i; ?>--><td style="border: solid; border-width: thin; border-color: #eee;" width="10%"><img src="products/<?php echo $pic; ?>" width="50" height="50"><td style="border: solid; border-width: thin; border-color: #eee;" width="20%"><?php echo $product; ?><td style="border: solid; border-width: thin; border-color: #eee;" width="10%"><?php echo $category; ?><td style="border: solid; border-width: thin; border-color: #eee;" width="10%"><input type="number" id="<?php echo $pid; ?>" value = "<?php echo $price; ?>" style="width: 50px"><td style="border: solid; border-width: thin; border-color: #eee;" width="10%"><?php echo $order_price; ?><td style="border: solid; border-width: thin; border-color: #eee;" width="10%"><input type="number" id="<?php echo $mid; ?>" value = "<?php echo $market_price; ?>" style="width: 50px" ><td style="border: solid; border-width: thin; border-color: #eee;" width="10%"><button class="btn btn-success" onclick = "save_item('<?php echo $id; ?>', '<?php echo $product_code; ?>')">Save</button><td style="border: solid; border-width: thin; border-color: #eee;" width="10%"><button  class="btn <?php echo $but; ?>" onclick = "set_available('<?php echo $id; ?>', '<?php echo $product_code; ?>', '<?php echo $stat; ?>')"><?php echo $stat; ?></button></a><td style="border: solid; border-width: thin; border-color: #eee;" width="10%"><a href="?p=edit_product&id=<?php echo $id; ?>" donclick="return confirm('Do you want to Delete this item?');"><button dclass="bg-blue"><icon class="fas fa-pencil-alt">  </button></a> </td></td></td></td></tr>

<?php
$i++;
}
?>

 
 <script type="text/javascript">
function save_item(id, p_code)
{
var price = document.getElementById("p"+id).value;
var market_price = document.getElementById("m"+id).value;
//var v_cost = document.getElementById("v"+id).value;

//alert (price);
//alert (v_cost);

var dataString='id='+id+'&price='+price+'&p_code='+p_code+'&market_price='+market_price;
$.ajax({
type:"GET",
url:"process/update_product.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){
var success = data.success;
if(success == "Yes")
{
alert("Product Updated Successfully!");
window.location = "?p=products";
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


}); 
}
</script>





<script type="text/javascript">
function set_available(id, p_code, stat)
{
var price = document.getElementById("p"+id).value;
//var v_cost = document.getElementById("v"+id).value;

//alert (price);
//alert (v_cost);

var dataString='id='+id+'&p_code='+p_code+'&set='+stat;
$.ajax({
type:"GET",
url:"process/update_product.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){
var success = data.success;
if(success == "Yes")
{
//alert("Product Updated Successfully!");
window.location = "?p=products";
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


}); 
}
</script>

 
</table>
<p><a href="&q=50"> More </a> </p>
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