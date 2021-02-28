<?php
include "includes/header.php";
?>


<div>
    <img src="images/pay_bill.png" class="img-fluid" />
</div>

<?php include 'includes/buttons.php';
?>
<section class="col-md-6 offset-md-3 text-center form_box">
<h4>Airtime Top Up</h4>
<div>
    <select class="form-control">
        <option selected>Network Provider </option>
        <option>MTN</option>
        <option>AIRTEL</option>
        <option>GLO</option>
    </select>
</div><br>
<div><input class="form-control" placeholder="Amount" type="number"></div><br>
<div><input class="form-control" placeholder="Phone Number" type="tel"></div><bR>
<div><button class="btn btn-danger btn-block">CONTINUE</button></div>

</section>

<?php
include 'includes/footer.php'
?>
