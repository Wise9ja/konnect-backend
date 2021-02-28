<?php
include "includes/header.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-fluid">


<style>
    .group_input input
    {
        width: 60%;

    }
    .group_input button
    {
        width: 40%;
    }
</style>
<div class="container" style="margin-top: 20px;">
<div class="row">
      <div class="col-md-8" id="cart">
      
        <h5>CHECKOUT</h5>
     
       
        <div style="text-align: dcenter;" class="loader" style="display:none;">
                            <span class="spinner-grow spinner-grow-sm" style="height: 10px; width: 10px;"></span>
                            <span class="spinner-grow spinner-grow-sm" style="height: 10px; width: 10px;"></span>
                            <span class="spinner-grow spinner-grow-sm" style="height: 10px; width: 10px;"></span>
                          
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


<script type="text/javascript">
$(document).ready(function() {

var user = localStorage.getItem("konnect_user");
var inv_num = localStorage.getItem("inv_num");


var dataString='user='+user+'&inv_num='+inv_num;
$.ajax({
type:"GET",
url:"https://konnect.link/core/get_cart2.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){
var cart = data.cart;
var cartx = data.cartx;
var total = data.total;
var del_addr  = data.del_addr;
var del_date  = data.del_date;

var new_total = data.new_total;
var final_total = data.final_total;
var final_totalx = data.final_totalx;
var wallet = data.wallet;
var walletx = data.walletx;
var credit = data.credit;
var credit_bal = data.credit_bal;
var creditx = data.creditx;
var kredit_stat   = data.kredit_stat;
var discount = data.discount;
var coupon = data.coupon;

var states = data.states;



var discountx = data.discountx;
var couponx = data.couponx;

var paid = data.paid;
var delivery = data.delivery;
var wallet_bal = data.wallet_bal;
var wallet_bal2 = data.wallet_bal2;

var fname = data.fname;
var lname = data.lname;
var phone  = data.phone;
var email  = data.email;


var fname = data.fname;
var lname = data.lname;
var phone  = data.phone;
var email  = data.email;

var paynow_discount = data.paynow_discount;

var lga = data.lga;
var landmark = data.landmark;
var addr  = data.addr;
var state  = data.state;



document.getElementById('phone').value = phone;
document.getElementById('fname').value = fname;
document.getElementById('lname').value = lname;
document.getElementById('email').value = email;
            

document.getElementById('landmark').value = landmark;
document.getElementById('street').value = addr;

 $('#lga').append(lga);   
// $('#state').append(state);   

//if(state == null)
//{
 $('#state').append(states);   
//}

document.getElementById('pay_total').value = final_totalx;
            




$('.loader').hide();

if(credit == 0 && kredit_stat == "Active")
{
$('#kredit').show();
$('#kredit_amt').append(credit_bal);
}


if(del_date == "")
{
$('#add_date').show();
}
else
{
$('#change_date').show();
}



if(wallet == 0 && wallet_bal > 0)
{
$('#wallet').show();
$('#wallet_amt').append(wallet_bal2);

}


$('#new_total').append(final_total);
$('#final_total').append(final_total);
$('#cart').append(cart);
$('#cartx').append(cartx);

 
if(discount > 0)
{
$('#discountx').show();
$('#discountn').append(discountx);
}

if(wallet > 0)
{
$('#walletx').show();
$('#walletn').append(walletx);
}

if(coupon > 0)
{
$('#couponx').show();
$('#couponn').append(couponx);
}


if(credit > 0)
{
$('#creditx').show();
$('#creditn').append(creditx);
}

$('#paynow_discount').append(paynow_discount);
$('#total').append(total);
$('#del_date').append(del_date);
$('#address').append(del_addr);
$('#delivery').append(delivery);


document.getElementById('cart_id').value = cart_id;


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


    <div class="col-md-4">
     <h5>DELIVERY / PAYMENT INFO</h5>
        <br>

        <div class="cart_card pad">
         <div id="address">

        </div>
        
                <a href="#" data-toggle="modal" data-target="#delivery_date_">Add / Change delivery address</a>

              
            <div style="margin-top: 10px">
                <span id="del_date">Delivery Date: </span><br>

            </div> 
            <a href="#" data-toggle="modal" id="add_date" style="display: none;" data-target="#delivery_date2">Select a Delivery Date</a>
             <a href="#" data-toggle="modal" id="change_date" style="display: none;" data-target="#delivery_date2">Change Delivery Date</a>

             <div style="text-align: dcenter;" class="loader" style="display:none;">
                            <span class="spinner-grow spinner-grow-sm" style="height: 10px; width: 10px;"></span>
                            <span class="spinner-grow spinner-grow-sm" style="height: 10px; width: 10px;"></span>
                            <span class="spinner-grow spinner-grow-sm" style="height: 10px; width: 10px;"></span>
                          
                          </div>

        </div>




        <div class="cart_card pad">
        <input type="hidden" id="cart_id">
       <b>PRICE SUMMARY</b>
            <div>
                <span>Order:</span> <span style="float: right;font-weight: bold" id="total"></span><br>
                <span id="deliveryx">Delivery Cost: <span style="float: right;font-weight: bold" id="delivery"></span></span><br>
                <span id="discountx" style="display: none;">Less Discount: <span style="float: right;font-weight: bold" id="discountn"></span><br></span>
                <span id="couponx" style="display: none;">Less Coupon: <span style="float: right;font-weight: bold" id="couponn"></span><br></span>
                <span id="creditx" style="display: none;">Less Credit: <span style="float: right;font-weight: bold" id="creditn"></span><br></span>
                <span id="walletx" style="display: none;">Less Wallet: <span style="float: right;font-weight: bold" id="walletn"></span></span>
                
                
             <hr>
                Total:
                <span style="float: right;font-weight: bold" id="new_total"></span>
            </div>
        </div>


        <div class="cart_card pad">
        <div class="group_input">
         <input placeholder="Enter Promo Code" id="promo_code"><span><button class="btn btn-success  bg-cyan" onclick="promo_code()"><i class="fa fa-arrow-right"></i></button></span>
        </div>
      
               <div style="margin-top: 20px; display: none;" id="wallet"> <b> USE  WALLET <span id="wallet_amt"></span>
                <span style="float: right;font-weight: bold;"></span>
                </b>
         <div class="group_input" >
            <button class="btn btn-success  bg-cyan" style="width: 100%" onclick="use_wallet()">Click to deduct</button>
            </div>
        </div>

        <div style="margin-top: 20px; display: none;" id="kredit"> <b> Available Credit <span id="kredit_amt"> </span>
                <span style="float: right;font-weight: bold;"></span>
                </b>
         <div class="group_input" >
            <button class="btn btn-success  bg-cyan" style="width: 100%" onclick="use_kredit()">CLICK TO USE CREDIT</button>
            </div>

        </div>


    </div>


        <div class="cart_card pad">
            <div style="font-weight: bold;">
                New Total:     <span style="float: right;font-weight: bold" id="final_total"></span>
            </div>
             <div style="text-align: center;" class="loader" style="display:none;">
                       <span class="spinner-grow spinner-grow-sm" style="height: 10px; width: 10px;"></span>
                            <span class="spinner-grow spinner-grow-sm" style="height: 10px; width: 10px;"></span>
                            <span class="spinner-grow spinner-grow-sm" style="height: 10px; width: 10px;"></span>
                               </div>

              <br>
              <input type="hidden" name="pay_total" id="pay_total">
              <button class="btn btn-block bg-cyan" onclick="payWithRave()"> PAY NOW</button>
          
        </div>

      <!--  <div class="cart_card pad">
           <!-- <b>PAYMENT METHOD</b>-->
          <!--  <div><br>
               
            <button class="btn btn-block bg-cyan" onclick="payWithRave()"> PAY NOW</button>
               <!-- <p><small>5% DISCOUNT APPLIES FOR PAY NOW</small></p>
                <button class="btn btn-block " onclick="payWithRave()" style="border: solid 1px #23d9d9;color: #23d9d9;background-color: white">PAY ON DELIVERY</button>
<p><small>DELIVERY FEE ONLY APPLIES</small></p>-->

                <!--            <button class="btn btn-block  "  style="border: solid 1px cyan;color: cyan;background-color: white">CredPay</button>-->
            <!--</div>
<br>
            <!--<img src="images/pay_img.png" width="100%" />-->
        </div>

    </div>

    <div class="modal fade " id="delivery_date_" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" >
        <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content" style=" color:#000;padding: 20px">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle" style="color:#000">Your Delivery Address </h3>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
      
                </div>
                 <!-- Modal Header -->
                <div class="modal-body" style="color:#000">
                      
                        <div class="form-group">
                            <label style="color:#000">First Name</label>
                            <input class="form-control" type="text" value="" id="fname">
                        </div>
                        <div class="form-group">
                            <label style="color:#000">Last Name</label>
                            <input class="form-control" value="" type="text" id="lname">
                        </div>

                        <div class="form-group">
                            <label style="color:#000">Email</label>
                            <input class="form-control" type="text" value="" id="email">
                        </div>


                        <div class="form-group">
                            <label style="color:#000">Phone Number</label>
                            <input class="form-control" value="" type="text" id="phone">
                        </div>

                        <div class="form-group">
                            <label style="color:#000">Street Number</label>
                            <input class="form-control" value="" type="text" id="street">
                        </div>

                        <div class="form-group">
                            <label style="color:#000">Notable Landmark/Bustop</label>
                            <input class="form-control" value="" type="text" id="landmark">
                        </div>

                          <div class="form-group">
                            <label style="color:#000">State</label>
                            <select class="form-control" type="text" id="state">
                            </select>
                        </div>

                            <div class="form-group">
                            <label style="color:#000">Local Govt Area</label>
                          <select class="form-control" type="text" id="lga">
                            </select>
                        </div>

                      
                        <div class="form-group">
                            <center><input type="submit" onclick="add_address()" class="btn btn-primary" style="padding:10px; font-size:16px"></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade " id="delivery_date2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" >
        <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content" style=" color:#000;padding: 20px">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle" style="color:#000">DELIVERY DATE</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
      
                </div>
                <div class="modal-body" style="color:#000">
                    
                        <div class="form-group">
                            <label style="color:#000; font-size: 16px; font-weight: bold;">"PAY NOW" attracts  <span id="paynow_discount"></span> discount
</label>
                            <select name="pay_option" id="pay_option" class="form-control" onchange="get_dates();">
                            <option value="">Select Payment Option</option>
                            <option value="Now">Pay Now</option>
                            <option value="Delivery">Pay on Delivery</option>
                            </select>
                           </div>

                        <!--  <div class="form-group">
                             <label style="color:#000">City</label>
                             <input class="form-control" type="text" name="city" />
                         </div>-->


                        <div class="form-group">
                            <label style="color:#000">Select Delivery Date </label>
                            <select  id="delivery_date" class="form-control">
                            </select>
                        </div>
                        <!--<div class="form-group">
                            <label style="color:#000">Delivery Time</label>
                            <input class="form-control" type="time" name="delivery_time" />

                        </div>-->
                        <div class="form-group">
                            <center><input type="submit" class="btn btn-primary" onclick="confirm_date()" style="padding:10px; font-size:16px"></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   

    <script type="text/javascript">
        function use_wallet()
        {

            var dataString='jj=jjj';

            $.ajax({
                type:"GET",
                url:"https://konnect.one/user/functions/use_wallet",
                data:dataString,
                jsonp:"callback",
                jsonpCallback:"Sverify",
                dataType:"jsonp",
                crossDomain:true,

                success: function(data){


                    window.location="checkout.php";

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert ("Could not connect to server");
                    $('#in').fadeOut(200).hide();

                }
            });
        }
    </script>


        <script type="text/javascript">
        function add_address()
        {
           


            var user = localStorage.getItem("konnect_user");
            
            var inv_num = localStorage.getItem("inv_num");
            var fname = document.getElementById('fname').value;
            var lname = document.getElementById('lname').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;

            var street = document.getElementById('street').value;
            var landmark = document.getElementById('landmark').value;
            var state = document.getElementById('state').value;
            var lga = document.getElementById('lga').value;
            

            var dataString='fname='+fname+'&lname='+lname+'&email='+email+'&phone='+phone+'&street='+street+'&landmark='+landmark+'&state='+state+'&user='+user+'&inv_num='+inv_num+'&lga='+lga;
            $.ajax({
                type:"GET",
                url:"https://konnect.link/core/add_address.php",
                data:dataString,
                jsonp:"callback",
                jsonpCallback:"Sverify",
                dataType:"jsonp",
                crossDomain:true,
               success: function(data){
              
                window.location = "checkout.php";
                    
                    
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert ();
                    // $('#in').fadeOut(200).hide();

                }
            })
        }
    </script>


     <script type="text/javascript">
        function  use_kredit()
        {
            var user = localStorage.getItem("konnect_user");
            var inv_num = localStorage.getItem("inv_num");

            

            var dataString='inv_num='+inv_num+'&user='+user;
            $.ajax({
                type:"GET",
                url:"https://konnect.link/core/use_kredit.php",
                data:dataString,
                jsonp:"callback",
                jsonpCallback:"Sverify",
                dataType:"jsonp",
                crossDomain:true,

                success: function(data){

                 window.open('checkout.php', '_self', 'location=yes');
    

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert (errorThrown);
                    // $('#in').fadeOut(200).hide();

                }
            })
        }
    </script>


     <script type="text/javascript">
        function  promo_code()
        {
                var coupon = document.getElementById('promo_code').value;
              var user = localStorage.getItem("konnect_user");
            var inv_num = localStorage.getItem("inv_num");

            

            var dataString='inv_num='+inv_num+'&coupon='+coupon+'&user='+user;
            $.ajax({
                type:"GET",
                url:"https://konnect.link/core/promo_code.php",
                data:dataString,
                jsonp:"callback",
                jsonpCallback:"Sverify",
                dataType:"jsonp",
                crossDomain:true,

                success: function(data){

                 success = data.success;
                // alert (success);

                 window.open('checkout.php', '_self', 'location=yes');
    

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert (errorThrown);
                    // $('#in').fadeOut(200).hide();

                }
            })
        }
    </script>




    <script type="text/javascript">
        function get_dates()
        {
            pay_option = document.getElementById('pay_option').value;

            var dataString='pay_option='+pay_option;
            $.ajax({
                type:"GET",
                url:"https://konnect.link/core/get_dates.php",
                data:dataString,
                jsonp:"callback",
                jsonpCallback:"Sverify",
                dataType:"jsonp",
                crossDomain:true,

                success: function(data){

                    del_dates = data.del_dates;
                  
                    $('#delivery_date').empty();
                    $('#delivery_date').append(del_dates);

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert ();
                    // $('#in').fadeOut(200).hide();

                }
            })
        }
    </script>





    <script type="text/javascript">
        function confirm_date()
        {
            var pay_option = document.getElementById('pay_option').value;
            var del_date = document.getElementById('delivery_date').value;
            var user = localStorage.getItem("konnect_user");
            var inv_num = localStorage.getItem("inv_num");

            

            var dataString='pay_option='+pay_option+'&del_date='+del_date+'&inv_num='+inv_num+'&user='+user;
            $.ajax({
                type:"GET",
                url:"https://konnect.link/core/confirm_date.php",
                data:dataString,
                jsonp:"callback",
                jsonpCallback:"Sverify",
                dataType:"jsonp",
                crossDomain:true,

                success: function(data){

                 window.open('checkout.php', '_self', 'location=yes');
    

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert ();
                    // $('#in').fadeOut(200).hide();

                }
            })
        }
    </script>

<!--    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>-->
    <script src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>

    <script>
        const API_publicKey = "FLWPUBK_TEST-12e1a64143e1707e8213498f475327b4-X";
        //const API_publicKey = "FLWPUBK_TEST-1b936a791b2c93ac1d1507c685d986ff-X";
            var user = localStorage.getItem("konnect_user");
            var inv_num = localStorage.getItem("inv_num");

        function payWithRave(amount) {
            var x = getpaidSetup({
                PBFPubKey: API_publicKey,
                customer_email: localStorage.getItem("konnect_user"),
                amount: document.getElementById('pay_total').value,
                customer_phone: localStorage.getItem("konnect_phone"),
                currency: "NGN",
                txref: localStorage.getItem("inv_num"),
                meta: [{
                    metaname: "flightID",
                    metavalue: "AP1234"
                }],
                onclose: function() {},
                callback: function(response) {
                    var txref = response.tx.txRef; // collect txRef returned and pass to a 					server page to complete status check.
                    console.log("This is the response returned after a charge", response);
                    if (
                        response.tx.chargeResponseCode == "00" ||
                        response.tx.chargeResponseCode == "0"
                    ) {
                        // redirect to a success page
                        window.location='pay_success?txref='+txref;

                    } else {
                        // redirect to a failure page.
                    }

                    x.close(); // use this to close the modal immediately after payment.
                }
            });
        }



    </script>





</div>
</div>





<?php
include "includes/footer.php";
?>