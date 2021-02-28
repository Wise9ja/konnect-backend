<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <p><a href="#"><i class="fa fa-dashboard"></i> Home</a> &nbsp;&nbsp; > &nbsp;&nbsp; <a class="active">Dashboard</a>
        
     <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>-->

<!--      <p style="font-size: 16px; font-weight: bold;"> <a href="dashboard.php?tl=1" style="color: red;">TILL DATE</a> &nbsp; &nbsp; <a href="dashboard.php?tl=2"> THIS YEAR</a>&nbsp; &nbsp; <a href="dashboard.php?tl=3"> LAST QUATER</a>&nbsp; &nbsp; <a href="dashboard.php?tl=4"> THIS MONTH</a>&nbsp; &nbsp; <a href="dashboard.php?tl=5"> THIS WEEK</a>&nbsp; &nbsp; <a href="dashboard.php?tl=6"> TODAY</a></p>-->
    </section>
    
    <!-- Main content -->

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <a href="?p=orders"><div class="col-lg-4 col-xs-6">
          <!-- small box -->
         <div class="small-box bg-green">
            <div class="inner">
              <?php
      include 'config/config.php';

      $sql1=$con->query("SELECT * FROM  sales WHERE payment_status = 'Successful'") or die("Error2 : ". mysqli_error($con));
      $count1 = mysqli_num_rows($sql1);

      if($count1 >= 1000)
      {
        $count1 = $count1/1000;
        $count1 = ceil($count1);
 
      $count1 = $count1."K";
    }
    elseif ($count1 >= 1000000)
    {
      $count1 = $count1 / 1000000;
      $count1 = ceil($count1);
      $count1 = $count1."M";
    }


      ?>
              <h3 style="font-style: italic; font-size: 50px;""><?php echo $count1; ?> <sup style="font-size: 22px"></sup></h3>

             <!-- <p style="font-size: 20px; font-weight: bold; dfont-style: italic;">G / M</p>-->
             <h3 style="font-size: 20px; font-style: italic; padding-top: 30px; ">TOTAL ORDERS</h3>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
          </div>
        </div>
</a>
  <!-- ./col -->
      


      

     <a href="?p=orders">
  <div class="col-lg-4 col-xs-6">
          <!-- small box -->
         <div class="small-box bg-blue">
            <div class="inner">
                
   
<?php
$sql3 = $con->query("SELECT SUM(total) as sumTotal FROM sales WHERE payment_status = 'Successful'") or die("Error2 : ". mysqli_error($con));
$query3 = mysqli_fetch_assoc($sql3);
$sumTotal = $query3 ['sumTotal'];

    if($sumTotal >= 1000)
      {
        $sumTotal = $sumTotal/1000;
        $sumTotal = ceil($sumTotal);
      $sumTotal = $sumTotal."K";
    }
    elseif ($sumTotal >= 1000000)
    {
      $sumTotal = $sumTotal / 1000000;
      $sumTotal = ceil($sumTotal);
      $sumTotal = $sumTotal."M";
    }

?>

             <h3 style="font-style: italic; font-size: 50px;">&#x20a6;<?php echo $sumTotal; ?></h3>

             <!-- <p style="font-size: 20px; font-weight: bold; dfont-style: italic;">G / M</p>-->
             <h3 style="font-size: 20px; font-style: italic; padding-top: 30px; ">TOTAL SALES</h3>
            </div>
            <div class="icon">
              <i class="far fa-credit-card"></i>
            </div>
          </div>
        </div>
</a>
  <!-- ./col -->
      



     
 

     <a href="?p=customers">
 <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
  
          <?php
    
      $sql2=$con->query("SELECT * FROM  customers") or die("Error2 : ". mysqli_error($con));
      $count2 = mysqli_num_rows($sql2);

 if($count2 >= 1000)
      {
        $count2 = $count2/1000;
        $count2 = ceil($count2);
        $count2 = $count2."K";
    }
    elseif ($count2 >= 1000000)
    {
      $count2 = $count2 / 1000000;
      $count2 = ceil($count2);
      $count2 = $count2."M";
    }



      ?>
    
                <h3 style="font-style: italic; font-size: 50px;"><?php echo $count2; ?></h3>

             <!-- <p style="font-size: 20px; font-weight: bold; dfont-style: italic;">G / M</p>-->
             <h3 style="font-size: 20px; font-style: italic; padding-top: 30px; ">TOTAL CUSTOMERS</h3>
            </div>
            <div class="icon" style="padding-top: 10px;">
              <i class="glyphicon glyphicon-user"></i>
            </div>
          </div>
        </div>
</a>
        
        <!-- ./col -->

 <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">

    <?php
    
      $sqlt=$con->query("SELECT * FROM  customers WHERE last_seen >= NOW() - INTERVAL 10 MINUTE") or die("Error2 : ". mysqli_error($con));
      $count = mysqli_num_rows($sqlt);

 if($count >= 1000)
      {
        $count = $count2/1000;
        $count = ceil($count);
        $count = $count2."K";
    }
    elseif ($count >= 1000000)
    {
      $count = $count / 1000000;
      $count = ceil($count);
      $count = $count."M";
    }



      ?>
    
                <h3 style="font-style: italic; font-size: 50px;"><?php echo $count; ?><sup style="font-size: 22px"></sup></h3>

             <!-- <p style="font-size: 20px; font-weight: bold; dfont-style: italic;">G / M</p>-->
             <h3 style="font-size: 20px; font-style: italic; padding-top: 30px;">PEOPLE ONLINE</h3>
            </div>
            <div class="icon" style="padding-top: 10px;">
              <i class="fas fa-user-friends "></i>
            </div>
          </div>
        </div>





 <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
  

                <h3 style="font-style: italic; font-size: 50px;"">0<sup style="font-size: 22px"></sup></h3>

             <!-- <p style="font-size: 20px; font-weight: bold; dfont-style: italic;">G / M</p>-->
             <h3 style="font-size: 20px; font-style: italic; padding-top: 30px; ">REFERRAL</h3>
            </div>
            <div class="icon" style="padding-top: 10px;">
             <i class="fas fa-user-plus"></i>
             </div>
          </div>
        </div>

        
        <!-- ./col -->

 <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">

                <h3 style="font-style: italic; font-size: 50px;"">0<sup style="font-size: 22px"></sup></h3>

             <!-- <p style="font-size: 20px; font-weight: bold; dfont-style: italic;">G / M</p>-->
             <h3 style="font-size: 20px; font-style: italic; padding-top: 30px;">PAYMENT TO VENDOR</h3>
            </div>
            <div class="icon" style="padding-top: 10px;">
              <i class="fas fa-user-friends "></i>
            </div>
          </div>
        </div>









<!--=====================TSR  TSR TSR ===========================================-->

 <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
  
          <?php
    
     /* $sql2=$con->query("SELECT * FROM  customers") or die("Error2 : ". mysqli_error($con));
      $count2 = mysqli_num_rows($sql2);

 if($count2 >= 1000)
      {
        $count2 = $count2/1000;
        $count2 = ceil($count2);
        $count2 = $count2."K";
    }
    elseif ($count2 >= 1000000)
    {
      $count2 = $count2 / 1000000;
      $count2 = ceil($count2);
      $count2 = $count2."M";
    }*/



      ?>
    
                <h3 style="font-style: italic; font-size: 50px;">0</h3>

             <!-- <p style="font-size: 20px; font-weight: bold; dfont-style: italic;">G / M</p>-->
             <h3 style="font-size: 20px; font-style: italic; padding-top: 30px; ">TSR INFLOW</h3>
            </div>
            <div class="icon" style="padding-top: 10px;">
              <i class="glyphicon glyphicon-user"></i>
            </div>
          </div>
        </div>

        
        <!-- ./col -->

 <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">

                <h3 style="font-style: italic; font-size: 50px;"">0<sup style="font-size: 22px"></sup></h3>

             <!-- <p style="font-size: 20px; font-weight: bold; dfont-style: italic;">G / M</p>-->
             <h3 style="font-size: 20px; font-style: italic; padding-top: 30px;">TSR OUTFLOW</h3>
            </div>
            <div class="icon" style="padding-top: 10px;">
              <i class="fas fa-user-friends "></i>
            </div>
          </div>
        </div>





 <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
  

                <h3 style="font-style: italic; font-size: 50px;"">0<sup style="font-size: 22px"></sup></h3>

             <!-- <p style="font-size: 20px; font-weight: bold; dfont-style: italic;">G / M</p>-->
             <h3 style="font-size: 20px; font-style: italic; padding-top: 30px; ">TSR HOUSES</h3>
            </div>
            <div class="icon" style="padding-top: 10px;">
             <i class="fas fa-user-plus"></i>
             </div>
          </div>
        </div>

        
        <!-- ./col -->

