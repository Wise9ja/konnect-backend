<?php
include "includes/header.php";
?>


<div>
    <img src="images/pay_bill.png" class="img-fluid" />
</div>

<?php include 'includes/buttons.php';
?>
<section class="col-md-6 offset-md-3 text-center form_box">
<h4>Electricity Bill</h4>
<div>
    <select class="form-control">
        <option selected>Distribution Company </option>
        <option>Ikeja</option>
        <option>Surulere</option>
        <option>Yaba</option>
    </select>
</div><br>
    <div>
        <select class="form-control">
            <option selected>Meter Type  </option>
            <option>Post Paid</option>
            <option>Pre paid</option>
        </select>
    </div><br>
<div><input class="form-control" placeholder="Customer Name" type="text"></div><br>
<div><input class="form-control" placeholder="Customer Email" type="email"></div><br>
<div><input class="form-control" placeholder="Amount " type="number"></div><bR>
<div><button class="btn btn-danger btn-block">CONTINUE</button></div>

</section>

<?php
include 'includes/footer.php'
?>
