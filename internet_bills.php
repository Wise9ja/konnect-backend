<?php
include "includes/header.php";
?>


<div>
    <img src="images/pay_bill.png" class="img-fluid" />
</div>

<?php include 'includes/buttons.php';
?>
<section class="col-md-6 offset-md-3 text-center form_box">
<h4>Internet Services</h4>
<div>
    <select class="form-control">
        <option selected>Service Provider Company </option>
        <option>Smile</option>
        <option>Swift</option>
        <option>Spectranet</option>
    </select>
</div><br>
    <div>
        <select class="form-control">
            <option selected>Plan   </option>
            <option>12gb - 1month - N20,000 </option>
            <option>10gb - 1month - N18,000 </option>
        </select>
    </div><br>
<div><input class="form-control" placeholder="Account Id" type="text"></div><br>
<div><input class="form-control" placeholder="Customer Email" type="email"></div><br>
<div><input class="form-control" placeholder="Amount " type="number"></div><bR>
<div><button class="btn btn-danger btn-block">CONTINUE</button></div>

</section>

<?php
include 'includes/footer.php'
?>
