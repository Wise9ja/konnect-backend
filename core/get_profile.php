<?php
include "includes/con.php";

$user = $_GET['user'];

/*if(isset($_POST['form1'])){

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
}*/

 $sql ="SELECT * FROM customers WHERE email='$user'";
        $sql1 = $con->query($sql);
        $row = mysqli_fetch_array($sql1);
        $user = $row;
        $id = $user['id'];
        $fname = $user['fname'];
        $lname = $user['lname'];
        $email = $user['email'];
        $phone = $user['phone'];
        $whatsapp = $user['whatsapp'];
        $age = $user['age'];
        $sex = $user['sex'];

    
  
       $profile = '<p>Full name :'.$fname.' '.$lname.'</p>
       <p>Email: '.$email.' </p>
       <p>Phone: '.$phone.'</p>
       <p>WhatsApp Number: '.$whatsapp.'</p>
       <p>Age range: '.$age.'</p>
       <p>Gender: '.$sex.'</p>';
       
$sqld=$con->query("SELECT * FROM trans_items WHERE email = '$email' order by id desc ") or die("Error2 : ". mysqli_error($connn));
$rowd=mysqli_fetch_array($sqld);
//print_r($rowd);
 $delivery_address= $rowd ['addr'];


$output = array('profile' => $profile, 'id' => $id, 'fname' => $fname, 'lname' => $lname, 'email' => $email, 'phone' => $phone, 'del_addr' => $delivery_address, 'whatsapp' => $whatsapp, 'age' => $age, 'sex' => $sex);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data
