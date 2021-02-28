<?php
session_start();
include 'includes/functions.php';
include 'includes/connection.php';
  ?>

  <?php  global $connn ;
   $con = $connn;
  $query=  "SELECT * FROM product  GROUP BY product_category  ORDER BY product_category ASC";
  $query = mysqli_query($con,$query);

    while($fetch = mysqli_fetch_assoc($query))
    {
        $categoryx = $fetch["product_category"];
        if($categoryx !== " ")
        {
        $category .= '<option>'.$categoryx.'</option>';
        }
        
    }


$offer = '<select class="form-control" id="category" onchange="get_products()">
<option>HOT OFFERS</option>
'.$category.'
</select>';

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
    while($fetch = mysqli_fetch_assoc($query)){
        $photo = $fetch["photo"];
        $id = $fetch["id"];
        $product = $fetch["product"];
        $length = strlen($product);

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

        //$price = number_format($fetch["price"]);
        //$market_price = number_format($fetch["price"]);
        
        $cashback = number_format($fetch["purchase_cashback"]);
           

$output1 .=    '<div class="col-md-3 ">
        <a onclick="view_product(\''.$id.'\')" style="cursor:pointer">
               
       <div class="product_box">
       <div class="product_img">
           <img src="https://konnect.link/port5/products/'.$photo.'" class="img-fluid" />
           <span class="fab_"><i class="fa fa-shopping-cart"></i> </span>
            </div>
           <div class="product_content">
               <h6>'.$product.'</h6>
               <h6 class="text-danger">&#x20a6;'.$price.'</h6>
               <div><small>(Your cashback &#x20a6;'.$cashback.')</small></div>
           </div>
        </div>
       </a>

   </div>';
    }



global $connn ;
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
    while($fetch = mysqli_fetch_assoc($query)){
      
        $photo = $fetch["photo"];
        $id = $fetch["id"];
        
        $product = $fetch["product"];
        $length = strlen($product);
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
        $cashback = number_format($fetch["purchase_cashback"]);
           

    $output2 .= '<div class="col-md-3 col-xs-6">
                 <a onclick="view_product(\''.$id.'\')" style="cursor:pointer">
                <div class="product_box">
                    <div class="product_img">
                        <img src="https://konnect.link/port5/products/'.$photo.'" class="img-fluid" />
                        <span class="fab_"><i class="fa fa-shopping-cart"></i> </span>
                           </div>
                    <div class="product_content">
                        <h6>'.$product.'</h6>

                        <h6 class="text-danger">&#x20a6;'.$price.'</h6>
                        <div><small>(Your cashback &#x20a6;'.$cashback.')</small></div>
                    </div>
                </div>
            </a>

        </div>';
    } 




$output = array('offer'=>$offer, 'output1'=>$output1, 'output2' => $output2);

echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

?>