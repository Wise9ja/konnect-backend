<?php
include "includes/header.php";


$id = $_GET['id'];
$sql1 = $connn->query("SELECT * FROM product WHERE id = '$id' ") or die("Error2 : " . mysqli_error($connn));


if ($sql1) {

    $rows = mysqli_fetch_array($sql1);

    $id = $rows['id'];
if(!$id)
{
    header('location:index.php');
}
    $photo = $rows['photo'];
    $product = $rows['product'];
    $product_code = $rows['product_code'];
    $price = $rows['price'];
    $cashback = $rows['purchase_cashback'];
    $product_sector = $rows['product_sector'];
    $product_category = $rows["product_category"];
    $product_id = $rows['product_id'];
    $brand = $rows['brand'];
    $desc = $rows['description'];
    $overview = $rows['overview'];
    $warranty = $rows['warranty'];
    $shipping = $rows['shipping'];
    $code = $rows['product_code'];

  $price = ($price * 105)/70;
        $pricex = $price;
    
        $market_price = $rows["market_price"];
        
      if($market_price == 0)
      {
          $price = $price;
      }
      else
      {
        $price = $market_price;
      }

//$discounted_price = $price - $rows['premium_discount'];
//$price = "&#8358;".number_format($discounted_price);
$cashback = "&#8358;".$cashback;

}


?>

<div class="row">
<div class="col-md-4">
    <img src="https://konnect.link/port5/products/<?php echo $photo; ?>" class="img-thumbnail" style="padding: 0;width: 100%" />
</div>
    <div class="col-md-8">
<h4><?php echo $product;?></h4>
<h4> &#x20a6; <?php echo number_format($price);?> <small class="text-danger" style="font-size: 15px">Cashback &#x20a6;<?php echo number_format($cashback);?></small></h4>
        <p style="margin-top: 50px">
            <h5 class="text-grey">Product Description</h5>
            <?php echo $desc; ?> </p>
        <form action="">
            <input type="hidden" name="product" id="product" value="<?php echo $product; ?>">
            <input type="hidden" name="price" id="price" value="<?php echo $price; ?>">
            <input type="hidden" name="discount" id="discount" value="<?php echo $discount; ?>">
            <input type="hidden" name="total" id="total" value="<?php echo $discounted_price; ?>">
            <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_code; ?>">
            <input type="hidden" name="user" id="user" value="<?php echo $user['email']; ?>">
            <input type="hidden" name="code" id="code" value="<?php echo $code; ?>">
            <p>
   <select style="display: none" name="quantity" required  id="num_of_goods">
        <option selected="selected">1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
    </select>
</p>
            <Br>
        <div class="row">
        <div class="col-md-6">
            <button type="button" onclick="add_basket()" class="btn btn-lg   btn-outline-dark btn-block" style="background-color: cyan;font-size: 14px;font-weight: 700"><i class="fa fa-shopping-cart"></i> ADD TO BAG</button>
        </div>
            <div class="col-md-6">
                <?php if($user)
                    {?>

                <button onclick="add_wish()" type="button" class="btn btn-lg btn-outline-primary btn-block" style="border: solid 1px cyan!important;color: black;font-size: 14px;font-weight: 700;background-color: white"><i style="color: red!important;" class="fa fa-heart"></i> SAVE ITEM</button>
         <?php }else{ ?>
                    <a href="#" onclick = "add_wish()" class="btn btn-lg btn-outline-primary btn-block" style="border: solid 1px cyan!important;color: black;font-size: 14px;font-weight: 700;background-color: white"><i style="color: red!important;" class="fa fa-heart"></i> SAVE ITEM</a>

                <?php } ?>
            </div>
        </div>
        </form>

    </div>
</div>
<br>
<br>
<br>
<section>
    <h4 class="text-danger">Product Review</h4>
</section>
<div class="row">
    <div class="col-md-12">
<div class="card" style="box-shadow: 1px 1px rgba(128,128,128,0.42)">
<div class="card-body">

    <div id="disqus_thread"></div>
    <script>

        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /**/
        var disqus_config = function () {
        this.page.url ='https://konnect.one/beta/product.php?id=<?php echo $id;?>';
 // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = 'https://konnect.one/beta/product.php?id=<?php echo $id;?>' // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };

        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://http-konnect-one.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

</div>
            <div class="col-md-6">
        <!--        <div class="card" style="box-shadow: 1px 1px rgba(128,128,128,0.42)">-->
        <!--            <div class="card-body">-->
        <!--<b>Stephen James</b>-->
        <!--<p>-->
        <!--    Lorem Ipsum is simply dummy text of the printing and typesetting industry.-->
        <!--</p>-->
        <!---->
        <!--            </div>-->
        <!--        </div>-->


            </div>
        </div>
<script type="text/javascript">

var q = document.getElementById("q");
q.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
        validate(e);
    }
});

function validate(e) {
var q = document.getElementById("q").value; 
localStorage.setItem("q", q);
window.open('search_product.html', '_self', 'location=yes');
}

</script>




        <script>
        function add_basket(){
            //alert("gdgdg");
            num_of_goods =  document.getElementById('num_of_goods').value;
            product = document.getElementById('product').value;
            product_id = document.getElementById('product_id').value;
            price = document.getElementById('price').value;
            discount = document.getElementById('discount').value;
            total = document.getElementById('total').value;
            train = null;
            code  = document.getElementById('code').value;
            user = localStorage.getItem("konnect_user");

            
            var dataString='product='+product+'&product_id='+product_id+'&price='+price+'&discount='+discount+'&total='+total+'&num_of_goods='+num_of_goods+'&user='+user+'&product_code='+code;


            $.ajax({
               type:"GET",
url:"https://konnect.link/core/add_cart.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
                success: function(data){
                    var suc = data.success;
                    if(suc == "YES")
                    {
                        window.location="cart.php";

                    }
                    else
                    {
                        alert ("Error while adding to basket. Please try again.");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert (textStatus);
                    $('#in').fadeOut(200).hide();

                }


            });
        }
</script>

        <script type="text/javascript">
            function add_wish()
            {
            product = document.getElementById('product').value;
            price = document.getElementById('price').value;
            code  = document.getElementById('code').value;
            user = localStorage.getItem("konnect_user");

            
            var dataString='product='+product+'&price='+price+'&discount='+discount+'&user='+user+'&code='+code;

                
            $.ajax({
               type:"GET",
url:"https://konnect.link/core/add_wish.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
    success: function(data){
                        var success = data.success;
                        if(success == "YES")
                        {
//window.open('carts.html', '_self', 'location=yes');
                            alert ("Item successfully added to your saved items");
                        }
                        else if (success == "Exist")
                        {
                            alert ("Item already in your saved items");

                        }


                    },
                    beforeSend:function()
                    {
                        $('#loader').fadeOut(200).show();
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        alert (errorThrown);
                        //$('#in').fadeOut(200).hide();

                    }


                });
            }
        </script>

<?php
include 'includes/footer.php'
?>