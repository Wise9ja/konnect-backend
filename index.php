<?php
include "includes/header.php";
?>


<div>


    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/banner1.png" class="d-block w-100" width="100%" />
            </div>
            <div class="carousel-item">
                <img src="images/banner2.jpg" class="d-block w-100" width="100%"  />
            </div>
            <div class="carousel-item">
                <img src="images/banner3.jpg" class="d-block w-100" width="100%"  />
            </div>
        </div>


        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
</div>

<div class="hot_headers">
  <?php
     $product_cat= $_GET['category_id'];
     $product_search= $_GET['product_search'];
  if($product_cat){
      echo strtoupper($product_cat);
      }
  elseif($product_search)
  {
      echo strtoupper('Search Result: '.$product_search);

  }
      else
      {
          echo 'HOT OFFERS';

      }
  ?>
</div>

<section class="row product_list">
  <?php  global $connn ;
  $con = $connn;
  $product_cat= $_GET['category_id'];
  if($product_cat)
  {
    $query=  "SELECT * FROM product WHERE product_type = 'Tangible' AND product_category = '$product_cat' AND status != 'Hidden' ORDER BY id DESC LIMIT 0,8";
  }
  elseif($product_search)
  {
       $query=  "SELECT * FROM product WHERE product_type = 'Tangible' AND product LIKE '%$product_search%' AND status != 'Hidden' ORDER BY id DESC LIMIT 0,16";

  }
  else
  {
       $query=  "SELECT * FROM product WHERE product_type = 'Tangible' AND status != 'Hidden' ORDER BY id DESC LIMIT 0,8";

  }
  $query = mysqli_query($con,$query);
    while($fetch = mysqli_fetch_assoc($query)){?>
    <div class="col-md-3 ">
       <a href="product?id=<?php echo $fetch['id'];?>">

       <div class="product_box">
       <div class="product_img">
           <img src="port5/products/<?php echo $fetch["photo"]; ?>" class="img-fluid" />
           <span class="fab_"><i class="fa fa-shopping-cart"></i> </span>
           <?php
           $product = $fetch["product"];
           $price = $fetch["price"];
        $price = ($price * 105)/70;
        $market_price = $fetch["market_price"];
        
      if($market_price == 0)
      {
          $price = number_format($price);
      }
      else
      {
        $price = number_format($market_price);
      }
           $length = strlen($product);
           ?>   </div>
           <div class="product_content">
               <h6><?php echo $fetch['product'] ?></h6>
               <h6 class="text-danger">&#x20a6;<?php echo $price; ?></h6>
               <div><small>(Your cashback &#x20a6;<?php echo number_format($fetch["purchase_cashback"]);?>)</small></div>
           </div>
        </div>
       </a>

   </div>
    <?php } ?>

</section>
<div class="middle_ad">
    <img src="images/middle_ad.png" class="img-fluid" />
</div>

<section class="row product_list">
    <?php  global $connn ;
    $con = $connn;
    $product_cat= $_GET['category_id'];
    if($product_cat)
    {
        $query=  "SELECT * FROM product WHERE product_type = 'Tangible' AND product_category = '$product_cat' AND status != 'Hidden' ORDER BY id DESC LIMIT 8,16";
    }else
    {
        $query=  "SELECT * FROM product WHERE product_type = 'Tangible' AND status != 'Hidden' ORDER BY id DESC LIMIT 8,16";

    }
    $query = mysqli_query($con,$query);
    while($fetch = mysqli_fetch_assoc($query)){?>
        <div class="col-md-3 col-xs-6">
            <a href="product?id=<?php  echo $fetch['id'];?>">

                <div class="product_box">
                    <div class="product_img">
                        <img src="port5/products/<?php echo $fetch["photo"]; ?>" class="img-fluid" />
                        <span class="fab_"><i class="fa fa-shopping-cart"></i> </span>
                        <?php
                        $product = $fetch["product"];
                        $length = strlen($product);
                        ?>   </div>
                    <div class="product_content">
                        <h6><?php echo $fetch['product'] ?></h6>

                        <h6 class="text-danger">&#x20a6;<?php echo number_format($fetch["price"]); ?></h6>
                        <div><small>(Your cashback &#x20a6;<?php echo number_format($fetch["purchase_cashback"]);?>)</small></div>
                    </div>
                </div>
            </a>

        </div>
    <?php } ?>

</section>

<?php
include 'includes/footer.php'
?>
