<?php
include "includes/header.php";
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-fluid">



<div class="container" style="margin-top: 80px;">
<div class="row">

    <div class="col-md-8" id="cart" style="font-size: 16px;">
      <div style="text-align: center;" class="loader" style="display:none">
        <span class="spinner-grow spinner-grow-sm"></span>
                              <span class="spinner-grow spinner-grow-sm"></span>
                              <span class="spinner-grow spinner-grow-sm"></span>
                          </div>
    
    </div>
             
    <div class="col-md-4">
        <!--<div class="group_input">
            <input placeholder="Enter Promo Code" id="promo_code"><span><button class="btn btn-success  bg-cyan" onclick="promo_code()"><i class="fa fa-arrow-right"></i></button></span>
        </div>-->
        <br>
        <br>

        <div style="text-align: center;" class="loader" style="display:none;">
       <!-- <span class="spinner-grow spinner-grow-sm"></span>
                              <span class="spinner-grow spinner-grow-sm"></span>
                              <span class="spinner-grow spinner-grow-sm"></span>-->
                          </div>

        <div id = "noitem" style="display: none; text-align: center; margin-top: -20px;">
        Your shoping cart is empty. 
        </div>

         <div id="viewx" style="display: none;"><span style="font-weight: bold; font-size: 25px;">Total Amount </span> <span id="total" class="red_header text-danger float-right" style="font-size: 1.2em; font-size: 25px; font-weight: bold;"></span></div>
       <bR> 
    
           

        <button id="viewxx" style="display: none;" onclick="checkout()" class="btn btn-lg btn-danger btn-block">CHECKOUT</button><BR>

            <a href="dashboard.html" class="btn btn-lg btn-primary bg-cyan btn-block" style="border: none;color: black">CONTINUE SHOPPING</a>
            <div style="text-align: center; font-size: 16px; margin-top: 10px; font-weight: bold;	">
           FREE DELIVERY APPLIES TO ORDER ABOVE <span id="delivery"></span>
          <!--<br>Valid Coupon: <<xxx>> Naira <<xxx>> discount-->

        </div>
        </div>
    </div>

 <input type="hidden" id="cart_id" value = "">


<script type="text/javascript">
$(document).ready(function() {

var user = localStorage.getItem("konnect_user");
var dataString='user='+user;
$.ajax({
type:"GET",
url:"https://konnect.link/core/get_cartx.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){
var cart = data.cart;
var cartx = data.cartx;
var cart_id = data.cart_id;
var total = data.total;
var delivery = data.delivery;


if(cartx >= 1)
{
 $('#viewx').show(); 
 $('#viewxx').show(); 
}    
else
{
 $('#noitem').show(); 
}

$('.loader').hide();

$('#cart').append(cart);
$('#cartx').append(cartx);
$('#total').append(total);

 document.getElementById('cart_id').value = cart_id;



$('#delivery').append(delivery);



},
beforeSend:function()
{
$('.loader').show();
},
error: function(jqXHR, textStatus, errorThrown)
{
   // alert (errorThrown);
    //$('#in').fadeOut(200).hide();

    }


});
//});
});

</script>


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
function update_cart(id, type)
{
quan = document.getElementById("s"+id).value;

var dataString='id='+id+'&quan='+quan+'&type='+type;
$.ajax({
type:"GET",
url:"https://konnect.link/core/update_cart.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){

 window.open('cart.php', '_self', 'location=yes');

},
beforeSend:function()
{
//$('#loader').fadeOut(200).show();
},
error: function(jqXHR, textStatus, errorThrown)
{
    alert (errorThrown);
    //$('#in').fadeOut(200).hide();

    }


});
}
</script>

    <script type="text/javascript">
        function checkout()
        {

           
            var user = localStorage.getItem("konnect_user");
            
           
            var dataString='user='+user;

            $.ajax({
                type:"GET",
                url:"https://konnect.link/core/checkout.php",
                data:dataString,
                jsonp:"callback",
                jsonpCallback:"Sverify",
                dataType:"jsonp",
                crossDomain:true,
             
                  success: function(data){
                    var suc = data.success;
                    var inv_num = data.inv_num;
                    

                    if(suc == "Yes")
                    {

                localStorage.setItem("inv_num", inv_num);
               
                window.open('checkout.php', '_self', 'location=yes');

                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert (errorThrown);
                    $('#in').fadeOut(200).hide();

                }
            });
        }
    </script>



<script>
function promo_code ()
{
var promo_code = document.getElementById('promo_code').value;
var user = localStorage.getItem("konnect_user");

var dataString='promo_code='+promo_code+'&user='+user;
$.ajax({
type:"GET",
url:"https://konnect.link/core/promo_code.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){

 window.location="cart.php";

},
beforeSend:function()
{
//$('#loader').fadeOut(200).show();
},
error: function(jqXHR, textStatus, errorThrown)
{
    alert (errorThrown);
    //$('#in').fadeOut(200).hide();

    }


});
}
</script>


</BR>
</div>
</bR>
</div>
</div>
</div>

    <?php
    include 'includes/footer.php'
    ?>
  