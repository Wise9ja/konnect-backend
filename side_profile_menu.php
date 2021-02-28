<?php
$url =  $_SERVER['REQUEST_URI'];
?>
<div class="col-md-4 card bg-grey2 " style="padding: 0;border-radius: 12px">
    <div class="card-body profile_list">
        <ul>
            <li ><a href="profile" class="<?php if(strpos($url,'profile') !== false) { echo 'active'; }?>"><i class="fa fa-user"></i> My Account </a></li>
            <li>
                <a
                    class="<?php if(strpos($url,'order') !== false) { echo 'active'; }?>" href="#" onclick="$('.dropdown_list').toggleClass('d-none')" > <i class="fa fa-shopping-cart"></i> My Orders <i style="margin-left:10px" class="fa fa-caret-right"></i> </a>

                <ul class="dropdown_list d-none">
                    <li><a href="order?type=Successful" > Delivered</a></li>
                    <li><a href="order?type=Pending" > To be delivered</a></li>
                    <li><a href="order?type=Canceled" > Cancelled</a></li>
                </ul>

            </li>

            <li><a class="<?php if(strpos($url,'wallet') !== false) { echo 'active'; }?>" href="wallet" ><i class="fa fa-money"></i>  My Wallet </a></li>
            <li><a class="<?php if(strpos($url,'saved') !== false) { echo 'active'; }?>" href="saved" ><i class="fa fa-heart"></i> Save items </a></li>
        </ul>
    </div>
</div>
