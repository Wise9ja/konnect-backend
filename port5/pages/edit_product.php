<?php
if(isset($_POST['submit']))
{
include 'config/config.php';


$id = $_POST['id'];
$product=$_POST['product'];
$sector=$_POST['sector'];
$category=$_POST['category'];
$price=$_POST['price'];
$vendor=$_POST['vendor'];

$ref_cashback=$_POST['ref_cashback'];
$pur_cashback=$_POST['pur_cashback'];
//$shipping=$_POST['shipping'];


$description=$_POST['description'];
$warranty=$_POST['warranty'];

$return_policy = $_POST['return_policy'];

$date_t=date("d-M-Y");


$file_size1=$_FILES['pic']['size'];
 
  $file1=$_FILES['pic']['name'];
  $file_type1=$_FILES['pic']['type'];
  $kaboom = explode(".", $file1);
  $fileExt = end($kaboom);
  $file1 = rand(100000000000,999999999999).".".$fileExt;
  
  $allowed_files=array("image/jpeg","image/jpg", "image/png");
  $path1="products/".$file1;
  $date_t=date('d-M-Y');
if($file_size1 > 0 )
{
move_uploaded_file($_FILES['pic']['tmp_name'],$path1);
$sql=$con->query("UPDATE product SET product='$product',  product_sector = '$sector',   product_category='$category',   price = '$price', photo = '$file1', vendor = '$vendor',  ref_cashback = '$ref_cashback',  purchase_cashback = '$pur_cashback',  description = '$description', warranty= '$warranty', return_policy = '$return_policy'   WHERE id='$id'") or die("error: ".mysqli_error($con));
}

else
{
$sql=$con->query("UPDATE product SET product='$product',  product_sector = '$sector',   product_category='$category',   price = '$price', vendor = '$vendor',  ref_cashback = '$ref_cashback',  purchase_cashback = '$pur_cashback',  description = '$description', warranty= '$warranty', return_policy = '$return_policy'   WHERE id='$id'") or die("error: ".mysqli_error($con));
}

if($sql)
{
?>
<script type="text/javascript">
window.location = "?p=products";
</script>
<?php
}
}
?>
<?php
require 'process/get_product_categories.php';
require 'config/config.php';
$id = $_GET['id'];
$sql=$con->query("SELECT * FROM product WHERE id = '$id'") or die("Error2 : ". mysqli_error($con));

if($sql)
{
 $i=1;
   
  $rows=mysqli_fetch_array($sql);
   
    $id=$rows['id'];
    $vendor=$rows['vendor'];
    $category=$rows['product_category'];
    $type=$rows['product_type'];
    $sector=$rows['product_sector'];
    $product=$rows['product'];
    $product_code=$rows['product_code'];
    $price = $rows['price'];
    
    $pre_discount=$rows['premium_discount'];
    $max_plan = $rows['max_plan'];
    $ref_cashback=$rows['ref_cashback'];
    $pur_cashback=$rows['purchase_cashback'];
    $merchant = $rows['merchant'];
    $shipping = $rows['shipping'];
    $return_policy = $rows['return_policy'];
    $warranty = $rows['warranty'];
    $description = $rows['description'];
    
    
    $date_t =$rows['date_t'];
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="row">
      <div class="col-md-6">
      <h2 style="margin-top: 0px;">
       Update Product
      </h2>
      <p><a href="?p=dashbaord"><i class="fa fa-dashboard"></i> Home</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a href="?p=products">Products</a> &nbsp;&nbsp;  > &nbsp;&nbsp; <a class="active">Update Product</a></p>
    </div>
     <!--<div class="col-md-4" style="text-align: left; margin-top: 10px;">  <a href="p=new_product"> <button class="btn btn-primary" style="font-size: 16px; font-weight: 600;">Add New Category</button></a>  </div>-->
     

    </section>
     <!-- Main content -->
    <section class="content" style="margin-top: 0px; padding-top: 0px; ">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-9 col-xs-12" style="background-color: #fff; margin-left: 10px; border:solid; border-width: thin; border-color: #ddd;">

          <!-- small box -->
          <!-- <a href="add_product.php"><button style="background-color: #0060cc; height: 40px; width: 250px; border:none; border-radius: 5px; color: white; font-size: 16px;">ADD PRODUCT</button></a> -->
      
        <!-- <h4 style="color: green; text-align: center; font-weight: bold;"> <?php echo $up_error; ?></h4>-->
          <div style="dborder: solid; border-width: thin; border-color: #ccc; margin-top: 0px; padding: 1.5em; dheight: 500px; ">
       
<form action="#" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
 <table class="table dtable-striped dtable-hover no-head-border">
  

<tr><td><td style="color: green; font-size: 15px;"><?php echo $up_error; ?></td></tr>

<tr><td style="width: 30%;">Vendor 
  <td><select name="vendor" drequired="required" style="width: 100%; height: 40px;"><option><?php echo $vendor; ?></option>
    <option>......................</option>
    <?php echo get_vendor(); ?>
  </select> </td></td>

    <tr><td style="width: 30%;">Product<td><input type="text" name="product" value="<?php echo $product; ?>" required="required" style="width: 100%; height: 40px;"></td></td></tr>

<tr><td style="width: 30%;">Product Sector<td><select name="sector" value="<?php echo $sector; ?>"  drequired="required" style="width: 100%; height: 40px;">
<option><?php echo $sector; ?></option>
<option>----------</option>
<?php get_sector(); ?>
</select>
</td></td></tr>

<tr><td style="width: 30%;">Product Category<td><select name="category" value="<?php echo $category; ?>"  drequired="required" style="width: 100%; height: 40px;">
<option><?php echo $category; ?></option>
<option>----------</option>
<?php get_category(); ?>
</select>
</td></td></tr>

  <tr><td style="width: 30%; font-size: 16px;">Photo<td><input type="file" name="pic" drequired="required"  style="width: 100%; height: 40px; padding-left: 0.5em;"></td></td></tr>

  <tr><td style="width: 30%;">Price<td><input type="number" name="price" value="<?php echo $price; ?>"  required="required" style="width: 100%; height: 40px;"></td></td></tr>

<tr><td style="width: 30%;">Referral Cashback<td><input type="number" name="ref_cashback" value="<?php echo $ref_cashback; ?>" required="required" style="width: 100%; height: 40px;"></td></td></tr>
<tr><td style="width: 30%;">Purchase Cashback<td><input type="text" name="pur_cashback" value="<?php echo $pur_cashback; ?>" required="required" style="width: 100%; height: 40px;"></td></td></tr>
<tr><td style="width: 30%;">Description<td><textarea  name="description" required="required" style="width: 100%; height: 100px;"><?php echo $description; ?></textarea></td></td></tr>
<tr><td style="width: 30%;">Warranty<td><input type="text" name="warranty" value="<?php echo $warranty; ?>" required="required" style="width: 100%; height: 40px;"></td></td></tr>
<tr><td style="width: 30%;">Return Policy<td><textarea name="return_policy" required="required" style="width: 100%; height: 100px;"><?php echo $return_policy; ?></textarea></td></td></tr>



 
</table>

<table class="table dtable-striped dtable-hover no-head-border">
  <tr><td style="width: 30%;"><td><input class="btn btn-primary" type="submit" name="submit" value="UPDATE PRODUCT" style="height: 40px; width: 200px; dbackground-color: blue; color: white; border:none;"></td></td></tr> 
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