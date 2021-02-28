<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="apple-touch-icon" href="" />
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <link rel="stylesheet" href="index.css">
    <title>Konnect</title>
</head>

<body>
    <header>
        <div class="container text-center mt-3">
            <img src="images/logo.jpeg" alt="logo" class="img-fluid logo">
        </div>
    </header>
    <section class="cover mt-4">
        <div class="container">
            <div class="container-text pt-5">
                <div class="row">
                    <div class="col-lg-6 col-md-6 first">
                        <h1>Meet KONNECT</h1>
                        <p class="mt-3">
                            Konnect is a consumer and consumption behaviour analytic application. <span>It is an online
                                shopping platform
                                that is family friendly</span>. The platform connects consumers with wholesales
                        </p>
                        <!--<form action="">-->
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="your email address" name="email" id="email"
                                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <input type="hidden"  id = "i" value = "<?php echo $_GET['i']; ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" onclick = "submit()" type="submit">Submit</button>
                                </div>
                            </div>
                        <!--</form>-->
<script type="text/javascript">
    function submit() {
var i = document.getElementById("i").value;
var email = document.getElementById("email").value;

        var dataString='email='+email+'&i='+i;  

            $.ajax({
               type:"GET",
url:"https://konnect.link/core/add_ref.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
                success: function(data){
                    var suc = data.success;
                    if(suc == "YES")
                    {
                   window.location = "direct.html";
                    }
                                   },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert (errorThrown);
                    //$('#in').fadeOut(200).hide();

                }


            });
  
    
}
</script>

                        <img src="images/google.png" alt="get it on google" class="img-fluid">
                        <img src="images/app.jpg" alt="get it on app store" class="img-fluid">
                    </div>
                    <div class="col-lg-6 col-md-6 second">
                        <div class="card pt-5 pl-4 pr-2 pb-5">
                            <div class="media pt-3 mb-5">
                                <img class="mr-5" src="images/funnel.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="">BUY AT CHEAPEST PRICE</h5>
                                    <p>Wholesale prices for retail delivery</p>
                                </div>
                            </div>
                            <div class="media mb-5">
                                <img class="mr-5" src="images/retail.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="">PROACTIVE RETAILING </h5>
                                    <p>Tailor ordering and delivery behaviours</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aside mb-3 mt-4">
                <div class="container text-center">
                    <strong><span>LIVE FROM FEBRUARY 2021</span></strong>
                </div>
            </div>
        </div>
    </section>
    <section class="last block py-5 px-0 my-0 mx-0">
        <div class="container mt-5 pt-5 mb-5 pb-5">
            <div class="row">
                <div class="py-1 px-0 my-0 mx-0 col-md-7 col-12 my-md-0 my-2 undefined col">
                    <strong>UPTO 50% PURCHASE CREDIT</strong>
                    <div class="mt-5 pt-5">
                        <div class="row">
                            <div class="py-1 px-0 my-0 mx-0 col-md col-6 my-md-0 my-2 undefined col">
                                <img src="images/cashback.png" alt="cashback" class="img-fluid">
                                <div class="py-3 px-3 my-1 mx-0">
                                    <strong style="font-size: 24px">CASHBACKS</strong>
                                </div>
                            </div>
                            <div class="py-1 px-0 my-0 mx-0 col-md col-6 my-md-0 my-2 undefined col">
                                <img src="images/referral.png" alt="referral" class="img-fluid">
                                <div class="py-3 px-3 my-1 mx-0">
                                    <strong style="font-size: 24px">REFERRAL</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-1 px-0 my-0 mx-0 col-md col-12 my-md-0 my-2 undefined col">
                    <div>
                        <img src="images/mockup.png" alt="mockup" class="img-fluid mockup">
                    </div>

                </div>
            </div>
            <div>
                <p class="rights">&copy; 2020. All rights reserved</p>
            </div>
        </div>
    </section>
</body>

</html>