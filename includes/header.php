<?php
include 'functions.php';
include 'connection.php';

$categories = select_nofetch('*','product_category','category','asc','','sector','Food Basket');
$products = select_nofetch('*','product','date_t','asc','20','trending','YES');
$user =  $_SESSION['user'];
 //print_r($user);
$carts_count = 0;
if($user) {
    $carts = select_nofetch('*', 'cart', '', '', '', 'user', $user['email']);
    $carts_count = $carts->num_rows;

    $carts_trans = select_nofetch('*', 'trans_items', '', '', '', 'user', $user['email']);
    $row_c = mysqli_fetch_assoc($carts_trans);
    //print_r($row_c);
    if($row_c) {
        $inv_num = $row_c['inv_num'];
        $_SESSION['inv_num'] = $inv_num;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Quattrocento+Sans:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet">
<!--    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500;900&display=swap" rel="stylesheet">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
<link rel="icon" href="images/konnect.png">
    <title>Konnect</title>
</head>
<body>
<div class="container-fluid">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index"><img class="logo" src="images/konnect.png"/> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav nav justify-content-center">
            <li class="nav-item ">
                <a class="nav-link" href="index">Shop</a>
            </li>
            <li class="nav-item">
                <?php if($user){?>

                <a class="nav-link" href="referral" >Referral</a>
                <?php }else {?>
                    <a class="nav-link" href="login" >Referral</a>

                <?php } ?>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://pos.credpal.com/Agile/login" target="_blank">Get Loan</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="pay_bills">Pay Bills</a>
            </li>


        </ul>
        <ul class="navbar-nav nav justify-content-end">
            <li class="nav-item">
                <?php if($user){?>
                    <div class="dropdown top_right" >
                        <button  class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hi, <?php echo $user['fname']; ?>
                        </button>
                        <div class=" top_drop dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="profile"><i class="fa fa-user"></i>  My Account</a>
                            <a class="dropdown-item" href="order?type=Pending"><i class="fa fa-shopping-cart"></i>  My Orders</a>
                            <a class="dropdown-item" href="wallet"><i class="fa fa-money"></i>  My Wallet</a>
                            <a class="dropdown-item" href="saved"><i class="fa fa-heart"></i>  My Saved items</a>
                            <a class="dropdown-item" href="cart"><i class="fa  fa-shopping-bag"></i>  My Shopping Cart</a>
                            <a class="dropdown-item  btn btn-success bg-cyan" href="login?logout=true">Logout</a>
                        </div>
                    </div>
                <?php }else { ?>
                    <div class="dropdown top_right" >
                        <button  class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i>  LOGIN <span style="margin-left: 10px;margin-right: 10px">/</span> SIGN UP
                        </button>
                        <div class=" top_drop dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item  btn btn-success bg-cyan" href="login">Login </a>
                            <a class="dropdown-item  btn btn-success bg-red" style="color: #fff!important;" href="login">Sign Up</a>
                            <hr>
                            <a class="dropdown-item" href="login"><i class="fa fa-shopping-cart"></i>  My Orders</a>
                            <a class="dropdown-item" href="login"><i class="fa fa-heart"></i>  My Saved items</a>
                            <a class="dropdown-item" href="login"><i class="fa  fa-shopping-bag"></i>  My Shopping Cart</a>

                        </div>
                    </div>
                <?php } ?>
            </li>

        </ul>
    </div>
</nav>

    <section class="padding-top-header" >
        <div class="row">
            <div class="col-md-6">

                <div class="dropdown">
                    <button class="btn btn- dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        SEARCH BY CATEGORY
                    </button>

                    <div class="dropdown-menu search_dropdown" aria-labelledby="dropdownMenuButton">
                       <?php  while($category = mysqli_fetch_assoc($categories)){?>
                        <a class="dropdown-item" href="index?category_id=<?php echo  $category['category']; ?>"><?php echo $category['category']; ?></a>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <form action="index">

                <div class="form-group line">
<a href="cart" style="position: relative;color: black"   >
                    <i class="fa fa-shopping-bag"style="margin-right:20px; margin-top: 15px"></i>
    <span style="position: absolute;right: 10px;top:-15px;font-size: 12px;background: red;width: 20px;height: 20px;border-radius: 30px;text-align: center;color: white"><?php echo ($carts_count);?></span>
</a>
                    <input class="form-control float-right search_input"  placeholder="Search" name="product_search" required="" >
                </div>
                </form>
            </div>
        </div>
        <br>
