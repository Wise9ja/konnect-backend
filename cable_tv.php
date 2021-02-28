<?php
include "includes/header.php";
?>


<div>
    <img src="images/pay_bill.png" class="img-fluid" />
</div>

<?php include 'includes/buttons.php';
?>
<section class="col-md-6 offset-md-3 text-center form_box">
<h4>Cable Bill</h4>
<div>
    <select class="form-control">
        <option selected>Service Provider </option>
        <option>Dstv</option>
        <option>Star times</option>
    </select>
</div><br>
    <div>
        <select class="form-control">
            <option selected>Product Type   </option>
            <option>Compact - N10,000 </option>
            <option>Compact Plus - N15,000 </option>
        </select>
    </div><br>
<div><input class="form-control" placeholder="Smart Card Number " type="text"></div><br>
<div><input class="form-control" placeholder="Amount " type="number"></div><bR>
<div><button class="btn btn-danger btn-block">CONTINUE</button></div>

</section>

<?php
include 'includes/footer.php'
?>
