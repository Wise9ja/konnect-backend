<?php
include "includes/header.php";
$con = $connn ;

if(isset($_GET['logout']))
{
    unset($_SESSION['user']);
    header('location:index.php');
}
?>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
/*if (isset($_POST['email']) && isset($_POST['register']))
{

//print_r($_POST);
    $id = $_POST['id'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];

    $email2=$_POST['email2'];


    $phone=$_POST['phone'];
    $whatsapp=$_POST['whatsapp'];

    $academics=$_POST['academics'];
    $age=$_POST['age'];

    $sex=$_POST['sex'];
    $ref_code = $_POST['ref_code'];


//$interest=$_POST['prof'];
//$bday_month=$_POST['bmonth'];

    $country=$_POST['country'];

    $pass=$_POST['password'];
    $pass2=$_POST['confirm_password'];


    $sql1=$connn->query("SELECT * FROM customers WHERE email='$email'");
    $count1=mysqli_num_rows($sql1);

    if($count1 ==1){
        $info = "Email already registered, please try with another email.";

    }else {


        if ($pass == $pass2) {
            $pass2 = sha1($pass2);
            $code = rand(00000, 99999);

            function check_number()
            {
                global $connn;


                $unique_number = rand(100000, 999999);

                $sql = $connn->query("SELECT * FROM customers WHERE ref_code = '$unique_number'") or die ("error: " . mysqli_error($connn));
                $exists = mysqli_num_rows($sql);


                if ($exists > 0) {
                    $results = check_number();
                } else {
                    $results = $unique_number;
                    return $results;
                }


            }

            $code = check_number();
            $date_t = date("Y-m-d");
            $endDate = date("Y-m-d", strtotime("+30 days", strtotime($date_t)));

            $year = date("Y");
            $month1 = date("m-Y");
            $month2 = date("M-Y");
            $month = date("M");

            $verify_date = date("Y-m-d");


            $sqlb = $connn->query("INSERT INTO customers (fname, lname,  email,  phone, whatsapp, age, sex,  verify, verify_date,  password, ref_code, month, mon_year1, mon_year2, year,  date_t, startDate, endDate)  
      VALUES ('$fname', '$lname', '$email', '$phone', '$whatsapp', '$age', '$sex',  'YES', '$verify_date', '$pass2',  '$code', '$month', '$month1', '$month2', '$year', '$date_t','$date_t','$endDate')") or die("Error4: " . mysqli_error($con));


            if ($ref_code !== "") {
                $sql1 = $connn->query("SELECT * FROM customers WHERE ref_code='$ref_code'");
                $count1 = mysqli_num_rows($sql1);
                if ($count1 >= 1) {
                    $row = mysqli_fetch_array($sql1);
                    $ref_email = $row['email'];
                }


                $sqlb = $connn->query("INSERT INTO referral (referral_email, referral_code,  referred_email,  month, year, date_t)  
      VALUES ('$ref_email', '$ref_code', '$email',  '$mon_year1',  '$year', '$date_t')") or die("Error4: " . mysqli_error($con));

            }


            $_SESSION['konnect_cus'] = $email;
            $_SESSION['konnect_whatsapp'] = $whatsapp;


            if (isset($_SESSION['cart_id'])) {
                $cart_id = $_SESSION['cart_id'];
                $sqlx = $connn->query("UPDATE cart SET user = '$email'  WHERE user  = '$cart_id'") or die("Error2 : " . mysqli_error($con));
            }


            $p_len = strlen($whatsapp);
            if ($p_len == 11) {
                $phone2 = substr($whatsapp, -10);
                $phone2 = "+234" . $phone2;

            } elseif ($p_len == 10) {
                $phone2 = "+234" . $whatsapp;
            } elseif ($p_len == 14) {
                $phone2 = $whatsapp;
            }


             $body = "---";
            $query = array(
                "phone" => $phone2,
                "body" => $body
            );


            $data_string = json_encode($query);

            $ch = curl_init('https://api.mercury.chat/sdk/whatsapp/sendMessage?api_token=5df29ce699c89e00198b8c17lY7ANXzl9&instance=L1583328789738U');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $response = curl_exec($ch);

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);

            curl_close($ch);


            require("mail/class.phpmailer.php");
            require 'inc/verify.php';
            $_SESSION['val'] = "First";

            $info2 = "Registration was successful";
            //  header("location:login.php");
            //  exit;

        } else {
            $info = "Your Passwords do not match";
        }
    }
}



if (isset($_POST['user'])) {

    $user = $_POST['user'];
    $pass = $_POST['password'];

    $pass = sha1($pass);
       $sql ="SELECT * FROM customers WHERE email='$user' AND password = '$pass'";
    $sql1 = $connn->query($sql);
    $count1 = mysqli_num_rows($sql1);

    if ($count1 == 1) {
        $row = mysqli_fetch_array($sql1);
        $email = $row['email'];
        $_SESSION['user'] =  $row;
        header("location:index.php");
        exit;
    } else {
        $info = "Incorrect Password.";
    }

}


*/
?>

 
<section>
    <?php if(isset($info)){?>

        <div class="alert alert-danger"><?php echo $info ?></div>
    <?php }?>
    <?php if(isset($info2)){?>

        <div class="alert alert-success"><?php echo $info2 ?></div>
    <?php }?>
    <div class="row">
        <div class="col-md-6 " >
            <div class="card " style="width:100%">
                <div class="card-body" style="padding: 50px">
                   <!-- <form action="" method="post">-->

                        <h3 class="card-title"><b>Login</b></h3>
                        <div>
                            <input  required class="form-control border_bottom" type="text" name="user" id = "user" placeholder="Email Address or Phone Number">
                        </div>
                        <br>
                        <div>
                            <input required class="form-control border_bottom" name="pass" id="pass" type="password" placeholder="Password ">
                        </div>
                        <br>
                        <p><a href=""><small class="text-danger">Forgotten your password ?</small></a></p>
                        <div>
                            <button class="btn btn-block btn-lg btn-warning bg-cyan" onclick = "login()">Login</button>
                        </div>
                  <!--  </form>-->
                </div>
            </div>
        </div>
        <div class="col-md-6 " >
            <div class="card " style="width:100%">
                <div class="card-body" style="padding: 50px">
                   <!-- <form method="post">-->

                        <h3 class="card-title"><b>Create your account</b></h3>
                        <div class="row form_input">
                            <div class="col-md-6">
                                <input class="form-control border_bottom" name="fname" required placeholder="First Name ">
                            </div>

                            <div class="col-md-6">
                                <input class="form-control border_bottom" name="lname" required placeholder="Last Name ">
                            </div>

                            <div class="col-md-6">
                                <input class="form-control border_bottom" name="email" id = "email" required placeholder="Email Address  ">
                            </div>
                            <div class="col-md-6">
                                <input type="tel" class="form-control border_bottom" id = "email2" required name="email" placeholder="Confirm Email">
                            </div>
                            <div class="col-md-6">
                                <input type="phone" name="phone" required = "required" id = "phone"  class="form-control border_bottom" placeholder="Phone">
                            </div>
                                 <div class="col-md-6">
                                <input type="phone" name="phone" required = "required" id = "phone2"  class="form-control border_bottom" placeholder="Confirm Phone">
                            </div>


                            <div class="col-md-6">
                                <input class="form-control border_bottom" type="password" name="password" id="password" required placeholder="Password">
                            </div>

                            <div class="col-md-6">
                                <input class="form-control border_bottom"  type="password" id="password2" required name="confirm_password" placeholder="Confirm Password">
                            </div>
                        </div>
                        <input type="hidden" name="register">
                        <div>
                            <button class="btn btn-block btn-lg btn-danger" onclick = "register()">Sign Up</button>
                        </div>
                   <!-- </form>-->

                </div>
            </div>
        </div>

    </div>
</section>



<script type="text/javascript">
function register()
{


alert ("djdj");

//var terms = document.getElementById("terms");
var fname = document.getElementById("fname").value;
var lname = document.getElementById("lname").value;
var email = document.getElementById("email").value;
var email2 = document.getElementById("email2").value;
var phone = document.getElementById("phone").value;
var phone2 = document.getElementById("phone2").value;

/*var age = document.getElementById("age").value;
var sex = document.getElementById("sex").value;
var ref_code = document.getElementById("ref_code").value; */

var password = document.getElementById("password").value;
var password2 = document.getElementById("password2").value;

alert ("djdj");

var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var filter2 = /^([a-zA-Z0-9_\.\-])+\@+([gmail.com])+$/;
var filter3 = /^([0-9]{10})+$/;
var filter4 = /^([0-9]{11})+$/;
var filter5 = /^([0-9]{4})+$/;


if(fname == ""  || lname == "" || email == "" || email2 == "" || phone == "" ||  phone2 == "" || password == "" || password2 == "")
{
$('#toast').empty();
$('#toast').show();
$('#toast').append("Please fill all fields");
return false;
}

if(!filter.test(email))
{
$('#toast').empty();
$('#toast').show();
$('#toast').append("Enter a Valid Email");
return false;
}

if(!filter4.test(phone) )
{
$('#toast').empty();
$('#toast').show();
$('#toast').append("Enter Correct Phone Number");
return false;
}


if(email !== email2)
{
$('#toast').empty();
$('#toast').show();
$('#toast').append("Emails Do Not Match");
return false;
}



if(phone !== phone2)
{
$('#toast').empty();
$('#toast').show();
$('#toast').append("Mobile Phones do Not Match");
return false;
}


if(password == "")
{
$('#toast').empty();
$('#toast').show();
$('#toast').append("Enter Your Password");
//alert ("Enter a  Pin");
return false;
}


if(password2 == "")
{
$('#toast').empty();
$('#toast').show();
$('#toast').append("Retype Your Password");
return false;
}


if(password !== password2)
{
$('#toast').empty();
$('#toast').show();
$('#toast').append("Passwords do not match");
return false;
}

   /* if (!terms.checked){
      alert("Please accept terms and conditions");
      return false;
    } */



var dataString='fname='+fname+'&lname='+lname+'&email='+email+'&phone='+phone+'&password='+password+'&register=register';
$.ajax({
type:"GET",
url:"https://konnect.link/core/login.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){
var success = data.success;
var ref_code = data.ref_code;
var name = fname;

if(success == "Email")
{

$('#toast').empty();
$('#toast').show();
$('#toast').append("Email already exist");
$('#but2').hide();
$('#but1').show();
return false;
}

else if (success == "Yes")
{
    localStorage.setItem("konnect_name", name);
    localStorage.setItem("konnect_user", email);
    localStorage.setItem("konnect_refcode", ref_code);

     window.open('index.html', '_self', 'location=yes');

}
},
beforeSend:function()
{
$('#toast').empty();
$('#but1').hide();
$('#but2').show();

},
error: function(jqXHR, textStatus, errorThrown)
{
$('#toast').empty();
$('#toast').show();
$('#toast').append(errorThrown);
$('#but2').hide();
$('#but1').show();

    }


});
}
</script>


<script type="text/javascript">
function login()
{

var user = document.getElementById("user").value;
var password = document.getElementById("pass").value;

var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var filter3 = /^([0-9]{10})+$/;
var filter4 = /^([0-9]{11})+$/;
var filter5 = /^([0-9]{4})+$/;

if(!filter.test(user))
{
$('#toast').empty();
$('#toast').show();
$('#toast').append("Please enter your email");
return false;
}

if(password == "")
{
$('#toast').empty();
$('#toast').show();
$('#toast').append("Please enter your password");
return false;
}



var dataString='user='+user+'&password='+password;
$.ajax({
type:"GET",
url:"https://konnect.link/core/login.php",
data:dataString,
jsonp:"callback",
jsonpCallback:"Sverify",
dataType:"jsonp",
crossDomain:true,
success: function(data){
var success = data.success;
var ref_code = data.ref_code;
var name = data.name;
var email = data.email;
var phone = data.phone;


if (success == "Yes")
{
    localStorage.setItem("konnect_name", name);
    localStorage.setItem("konnect_user", email);
    localStorage.setItem("konnect_phone", phone);
    localStorage.setItem("konnect_refcode", ref_code);
    
    window.open('index.php', '_self', 'location=yes');

}
else if (success == "Password")
{
$('#toast').empty();
$('#toast').show();
$('#toast').append("Incorrect login details");
$('#but2').hide();
$('#but1').show();
return false;
}
else if (success == "Exist")
{
localStorage.setItem("konnect_userx", user);
window.open('update.html', '_self', 'location=yes');
}
},
beforeSend:function()
{
$('#but1').hide();
$('#but2').show();
},
error: function(jqXHR, textStatus, errorThrown)
{
$('#toast').empty();
$('#toast').show();
$('#toast').append(errorThrown);
$('#but2').hide();
$('#but1').show();
return false;

    }
});
}
</script>

<?php
include 'includes/footer.php'
?>
