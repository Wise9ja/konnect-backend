<?php
include "includes/header.php";
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<br>
<section class="col-md-10 offset-md-1  form_box" id="referal_modal">
<section class="col-md-10 offset-md-1  form_box" id="referal_modal" style="margin-top: 40px;">
<h4 style="text-align: center;">Referral</h4>
<Br>
    <div class="text-center">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <i class="fa fa-users"></i>
                                <h6>0</h6>
                                <div>Referral Sign Up</div>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-users"></i>

                                <h6>0</h6>
                                <div>Successful Referrals</div>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-users"></i>
                                <h6>₦ 0</h6>
                                <div>Amount Earned</div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <p>₦500 is earned per successful referral <a href="#" data-toggle="modal" data-target="#how_ref" style="text-decoration: none;">HOW REFERRAL IS EARNED</a> <br>
                            <b>Share my referral link with friends</b></p>
                        <div class="referall_link" id="ref" style="font-weight: 500; font-size: 16px; color: blue;">
                        

                        </div>
                        <br>
                        <div class="referall_button">
                            <input style="opacity: 0;height: 0px!important;padding: 0!important;" id="url_link" value="">
                            <button onclick="copy()" class="btn btn-danger btn-lg btn-block" >Copy Link</a>
                        </div>

                    </div>

</section>

<script>
    /* Get the text field */
    function copy() {
        var copyText = document.getElementById("url_link");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");

    /* Alert the copied text */
    //alert("Referral link copied: " + copyText.value);
    alert ("Message Copied!");
    }

</script>

<div class="modal fade" id="how_ref" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="how_ref">HOW REFERRAL IS EARNED</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    <li>A successful referral is a referral that has completed a sum order above ₦50,000</li>
               <li>Amount Earned is ₦500 per your successful referral and it is credited into YOUR WALLET</li>
               <li>Note, you will earn cashback from purchases made by your referral </li>
                </ul>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function() {

var user = localStorage.getItem("konnect_user");
var dataString='user='+user;
$.ajax({
type:"GET",
url:"https://konnect.link/core/get_ref.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){
var count = data.count;
var ref = data.ref;



$('#ref').append(ref);
$('#count').append(count);

document.getElementById("url_link").value = ref; 

var user = localStorage.getItem("konnect_user");
var dataString='user='+user;
$.ajax({
type:"GET",
url:"https://www.konnect.link/core/cart_count.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){
var cart = data.cart;

$('#cartx').append(cart);
},

error: function(jqXHR, textStatus, errorThrown)
{
alert (errorThrown);
}


});



},
beforeSend:function()
{
$('.loader').show();
},
error: function(jqXHR, textStatus, errorThrown)
{
    alert (errorThrown);
    //$('#in').fadeOut(200).hide();

    }

});
//});
});

</script>

<?php
include 'includes/footer.php'
?>
