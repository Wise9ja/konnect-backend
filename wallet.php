<?php
include "includes/header.php";

$email = $user['email'];
?>

<section class=" row">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php include "side_profile_menu.php" ?>
    <div class="col-md-8">
        <h5>My Wallet</h5>

        
            <div class="card-body ">
                <div class="row">
                    <div class="col-sm-6">
                        <small>Balance</small>
                        <h2><b><span id="bal"></span> <small style="font-size: 14px"></small></b></h2>
                    </div>
                    <div class="col-sm-6">
                        <br>
                       <!-- <button class="btn btn- btn-secondary">06/06/2020 - 08/06/2020
                            <i class="fa fa-calendar"></i></button> <span class="text-danger">Filter</span> -->
                    </div>
                </div>
                <div style="margin-top:10px"><h6><b>TRANSACTIONS</b></h6></div></div>
            <div class="col-12" style="overflow: scroll;">
                <table class="table table-striped table-hover" id="trans">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>In</th>
                        <th>Out</th>
                        <th>Balance</th>
                        </tr>
                    </thead>

                    
                     <tbody id="trans">
                  </tbody>
                </table>
                <div id="notrans"></div>
            </div>
            <div>

            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

$(document).ready(function() {
var konnect_user = localStorage.getItem("konnect_user");
var dataString='user='+konnect_user;
$.ajax({
type:"GET",
url:"https://www.konnect.link/core/get_trans.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){

var bal = data.bal;
var trans = data.trans;
var notrans = data.notrans;

 $('#bal').append(bal);
 $('#notrans').append(notrans);

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
},
error: function(jqXHR, textStatus, errorThrown)
{
//alert (errorThrown);
    }


});
//});
});

</script>



    </div>
</section>

<?php
include 'includes/footer.php'
?>
