<?php
if(isset($_POST['submit']))
{
include 'config/config.php';

$state = $_POST['state'];
$lga = $_POST['lga'];


$date_t=date("d-M-Y");


$sql=$con->query("SELECT * FROM lga WHERE state = '$state' AND lga = '$lga'") or die("Error2 : ". mysqli_error($con));
if($sql)
{
$count = mysqli_num_rows($sql);

if($count >= 1)
{
$up_error = "L.G.A Already Exist!";
}
else
{
$sql2=$con->query("INSERT INTO lga (state, lga, collection,  date_t) VALUES('$state', '$lga', 'Yes',  '$date_t')") or die("error: ".mysqli_error($con));
}
}

if($sql2)
{
?>
<script type="text/javascript">
window.location = "?p=lga";
</script>
<?php
}
}
?>

<?php
//require 'process/get_product_categories.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <div class="row">
      <div class="col-md-6">
      <h2 style="margin-top: 0px;">
       Add a New L.G.A
      </h2>
      <p><a href="?p=dashbaord"><i class="fa fa-dashboard"></i> Home</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a href="?p=lga">LGA</a> &nbsp;&nbsp;  > &nbsp;&nbsp; <a class="active">Add a New L.G.A</a></p>
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
      
          <div style="dborder: solid; border-width: thin; border-color: #ccc; margin-top: 0px; padding: 1.5em; dheight: 500px; ">
       
<form action="#" method="post" enctype="multipart/form-data">
 <table class="table dtable-striped dtable-hover no-head-border">
                    
<tr><td><td style="color: green; font-size: 15px;"><?php echo $up_error; ?></td></tr>
    <tr><td style="width: 30%; font-size: 16px;">State<td>
      <select name="state" required="required" style="width: 100%; height: 40px;">
    <?php
    include 'config/config.php';
$sql=$con->query("SELECT * FROM states ORDER BY state ASC") or die("Error2 : ". mysqli_error($con));

if($sql)
{
 $i=1;
   
  while ($rows=mysqli_fetch_array($sql))
   {
    $id=$rows['id'];
    $state = $rows['state'];
    echo '<option>'.$state.'</option>';
    }  
  }
?>  
      </select>
    </td></td></tr>
 

<tr><td><td style="color: green; font-size: 15px;"><?php echo $up_error; ?></td></tr>
    <tr><td style="width: 30%; font-size: 16px;">L.G.A<td><input  type="text" name="lga" required="required" style="width: 100%; height: 40px;"></td></td></tr>

 
 </table>

<table class="table dtable-striped dtable-hover no-head-border">
  <tr><td style="width: 30%;"><td><input type="submit" name="submit" class="btn btn-primary" value="ADD L.G.A" style="height: 40px; width: 200px; dbackground-color: blue; color: white; border:none;"></td></td></tr> 
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



