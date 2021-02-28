<?php
include "includes/header.php";

$email = $user['email'];

$sqlw = $connn->query("SELECT * FROM wishlist WHERE user = '$email' ") or die("Error2 : " . mysqli_error($connn));
$countw = mysqli_num_rows($sqlw);

?>

<section class=" row">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php include "side_profile_menu.php" ?>
    <div class="col-md-8">
        <h5>Saved Items</h5>

         <div class="card bg-grey2 cyan-top">

            <div class="card-body" id="saved">

            
               
        </div>
    </div>
</section>
<script type="text/javascript">

$(document).ready(function() {
var konnect_user = localStorage.getItem("konnect_user");
var dataString='user='+konnect_user;
$.ajax({
type:"GET",
url:"https://www.konnect.link/core/saved.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){
var saved = data.saved;
$('#saved').append(saved); 

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
//alert (textStatus);
    }


});
//});
});

</script>

<script type="text/javascript">
    function remove_saved(id){

        //alert(id);
        var dataString='id='+id;
        $.ajax({
            type:"GET",
            url:"https://konnect.link/core/remove_saved.php",
            data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,

            success: function(data){
                //alert(id);
                window.location="saved.html";
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert ("Could not connect to server");
                $('#in').fadeOut(200).hide();
            }
        });
    }
</script>

  <script>
        function add_basket(product_code, id){
            //alert("gdgdg");
            user = localStorage.getItem("konnect_user");

            var dataString='product_code='+product_code+'&user='+user+'&id='+id;

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
                        window.location="cart.html";

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

    </div>
</section>

<?php
include 'includes/footer.php'
?>
