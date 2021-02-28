<?php
include "includes/header.php";

$email = $user['email'];
if(isset($_POST['form1'])){

    $id = $_POST['id'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    //$email=$_POST['email'];
    $phone=$_POST['phone'];
    $sex=$_POST['sex'];
    $age=$_POST['age'];

        $sqlb=$connn->query("UPDATE customers SET fname = '$fname', lname = '$lname',  phone = '$phone', sex ='$sex', age='$age' WHERE id = '$id'")  or die("Error4: ".mysqli_error($connn));

    if($sqlb)
    {
        $sql ="SELECT * FROM customers WHERE id='$id'";
        $sql1 = $connn->query($sql);
        $row = mysqli_fetch_array($sql1);
        $_SESSION['user'] =  $row;
        $user = $row;
        $info = "Profile Updated Successfully!";
    }
}
?>

<section class=" row">
<?php include "side_profile_menu.php" ?>
    <div class="col-md-8">
<h5>Account</h5>
    <div class="card bg-grey2 cyan-top">
        <?php if(isset($info)){?>

            <div class="alert alert-info"><?php echo $info ?></div>
        <?php }?>
    <div class="card-body " id="noedit" >
        <h6>Basic Information <i  style="font-size: 1.5em" onclick="$('#edit').show();$('#noedit').hide(); " class="fa float-right fa-edit"></i></h6>
      <?php
      $email = $_SESSION['user'];
          $sql ="SELECT * FROM customers WHERE email='$email'";
        $sql1 = $connn->query($sql);
        $row = mysqli_fetch_array($sql1);
        
        ?>
      
        <hr>
       <p>Full name : <?php echo $row['fname'].' '.$row['lname']; ?></p>
       <p>Email: <?php echo $row['email']; ?></p>
       <p>Phone: <?php echo $row['phone']; ?></p>
       <p>WhatsApp Number: <?php echo $row['whatsapp']; ?></p>
      
    </div>
    <div class="card-body " style="display: none"  id="edit">
        <form method="post">
            <input type="hidden" name="form1" value="1">
            <input required type="hidden" name="id" value="<?php echo $user['id'];?>">
        <h6>Edit Basic Information </h6>
        <hr>
       <p>First name : <input value="<?php echo $row['fname']; ?>" name="fname"  required/></p>
       <p>Last name : <input value="<?php echo $row['lname']; ?>" name="lname" required /></p>
       <p>Email: <input disabled value="<?php echo $row['email']; ?>" name="email" required /></p>
       <p>Phone: <input  value="<?php echo $row['phone']; ?>" name="phone" required /></p>
       <p>Whatsapp: <input  value="<?php echo $row['whatsapp']; ?>" name="whatsapp" required /></p>
      <!-- <p>Gender:   <select name="sex" required="required">
               <option selected value="<?php echo $user['sex']; ?>"><?php echo $user['sex']; ?></option>
               <option value="Male">male</option>
               <option value="female">female</option>
           </select></p>
       <p>Age range:   <select name="age"   required name="age">
               <option selected value="<?php echo $user['age']; ?>"><?php echo $user['age']; ?></option>
               <option>15-25</option>
               <option>26-33</option>
               <option>34-40</option>
               <option>41-50</option>
               <option>15-25</option>
               <option>50-Above</option>
           </select>
         </p>-->
<p>
    <button class="btn btn-bl btn-success">Save</button>
</p>
        </form>

    </div>
    </div>
<br>
    <div class="card bg-grey2 cyan-top">
<?php    $sqld=$connn->query("SELECT * FROM shipping WHERE email = '$email' AND status = 'Default' order by id desc ") or die("Error2 : ". mysqli_error($connn));
$rowd=mysqli_fetch_array($sqld);
//print_r($rowd);
 $delivery_address= $rowd ['addr'];
?>
        <div class="card-body ">
            <h6>Delivery Address</h6>
            <hr>
           <p><?php echo $delivery_address; ?></p>
        </div>
    </div>
</div>
</section>

<?php
include 'includes/footer.php'
?>
