<aside class="main-sidebar" style="min-height: 400px;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="min-height: 400px;">
      <!-- Sidebar user panel -->
      <!-- search form -->
     <!--- <form action="sales.php" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" value="<?php //echo $_GET['q']; ?>" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
     <ul class="sidebar-menu" dstyle="line-height: 10px; ">
      

         <!-- <li class="treeview">
          <a href="#">
           <i class="fa fa-folder"></i>  <span style="font-family: verdana; font-size: 13px; font-weight: normal;">BUSINESS UNIT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

           <li style="font-family: verdana; font-size: 12px; font-weight: normal;"><a href="add_biz_unit.php" style="font-size: 12px;"><i class="fa fa-circle-o"></i>ADD BUSINESS UNIT</a></li>
           <li style="font-family: verdana; font-size: 12px; font-weight: normal;"><a href="add_product_class.php" style="font-size: 12px;"><i class="fa fa-circle-o"></i>ADD PRODUCT CLASS</a></li>
            
          </ul>
          </li> -->
  <li class="treeview" style="margin-top: 50px;">
          <a href="?p=dashboard">
           <i class="far fa-clock"></i>  <span style="font-family: verdana; font-size: 13px; font-weight: normal;"> &nbsp; DASHBOARD</span>
          <!--  <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>-->
          </a>
          </li> 






          <li class="treeview">
          <a href="#">
           <i class="fa fa-folder"></i>  <span style="font-family: verdana; font-size: 13px; font-weight: normal;">CATLOG</span>
           <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">


      <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=product_categories" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Categories</a></li>
        <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=products" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Products</a></li>
        <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=vendors" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Vendors</a></li>
        <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="#" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Reviews</a></li>

            
                 
         </ul>
          </li> 




  <li class="treeview">
          <a href="#">
           <i class="fas fa-chart-line"></i>  <span style="font-family: verdana; font-size: 13px; font-weight: normal;"> &nbsp; SALES</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
         <ul class="treeview-menu">


  <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=orders" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Orders</a></li>
        <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="#" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Delivery</a></li>
        <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="#" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Payment to Vendors</a></li>


            
         </ul>
          </li> 



<li class="treeview">
          <a href="#">
           <i class="fa fa-user-friends"></i>  <span style="font-family: verdana; font-size: 13px; font-weight: normal;">CUSTOMERS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
         <ul class="treeview-menu">


  <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=customers" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Customers</a></li>
  <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=referrals" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Referral</a></li>
  <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=wallet" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Wallet</a></li>
 
       </li>


            
         </ul>
          </li> 





<li class="treeview">
          <a href="#">
           <i class="fa fa-share-alt"></i>  <span style="font-family: verdana; font-size: 13px; font-weight: normal;">TSR</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
         <ul class="treeview-menu">


  <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="#" style="font-size: 13px;"><i class="fa fa-circle-o"></i>TSR Houses</a></li>
        <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="#" style="font-size: 13px;"><i class="fa fa-circle-o"></i>TSR Inflow</a></li>
        <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="#" style="font-size: 13px;"><i class="fa fa-circle-o"></i>TSR Outflow</a></li>
       </li>     
        </ul>
          </li> 






<!--<li class="treeview">
          <a href="#">
           <i class="fa fa-envelope"></i>  <span style="font-family: verdana; font-size: 13px; font-weight: normal;">MAIL</span>
            <span class="pull-right-container">
             <!-- <i class="fa fa-angle-right pull-right"></i>-->
            </span>
          </a>
         <!--<ul class="treeview-menu">


  <!--<li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="#" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Marketing</a></li>
        <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="#" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Coupns</a></li>
       </li>   -->  
      <!--  </ul>
          </li>  -->






<li class="treeview">
          <a href="#">
           <i class="fa fa-laptop"></i>  <span style="font-family: verdana; font-size: 13px; font-weight: normal;">SETTINGS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
          </a>
         <ul class="treeview-menu">


  <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=admin_users" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Admin Users</a></li>
  <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=discount" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Discount</a></li>
  <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=delivery_rate" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Delivery Rate</a></li>
  <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=del_dates" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Delivery Dates</a></li>
  <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=states" style="font-size: 13px;"><i class="fa fa-circle-o"></i>States</a></li>
  <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=lga" style="font-size: 13px;"><i class="fa fa-circle-o"></i>L.G.A's</a></li>
  <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="?p=coupons" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Coupons</a></li>
       </li>     
        </ul>
          </li> 



<!--<li class="treeview">
          <a href="#">
           <i class="fa fa-bar-chart"></i>  <span style="font-family: verdana; font-size: 13px; font-weight: normal;">REPORT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
         <ul class="treeview-menu">


  <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="#" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Marketing</a></li>
        <li style="font-family: verdana; font-size: 14px; font-weight: normal;"><a href="#" style="font-size: 13px;"><i class="fa fa-circle-o"></i>Coupns</a></li>
       </li>     
        </ul>
          </li> -->









    </section>
    <!-- /.sidebar -->
  </aside>