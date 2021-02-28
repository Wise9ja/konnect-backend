<?php
include "includes/header.php";
?>
<section id="about" class="features-area pt-135 pb-110 hero-area hero-hight hero-bg pos-rel" style="Overflow:hidden">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section-title pos-rel text-center mb-70">
                    <h1 class="uppercase bb">Contact Us</h1>
                </div>
            </div>
        </div>
        <div class="features-list">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="agillogo.png" style="width:300px" alt="">
                            <br>
                            <h6>Telephone:</h6> 0818 049 4018
                            <br>
                            <br>
                            <h6>For general enquiries:</h6> konnect@agilep3.com
                            <br>
                            <br>
                            <h6>Working Hours:</h6>
                            Mondays - Fridays: 8AM - 5PM (GMT +1)
                            <br>
                            <br>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.6111160928635!2d3.350025214449669!
                                        3d6.570666524436938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b92091830d3a1%3A0xbdbaf7acac598
                                        dd6!2s59+Oduduwa+Way%2C+Ikeja+GRA%2C+Ikeja!5e0!3m2!1sen!2sng!4v1551017481828" width="100%" height="275" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                        </div>
                        <div class="col-md-6">
<!--                            <h2 class="mb-30">Reach out to us</h2>-->
                            <form method="POST" action="contact" role="form">

                                <?php

                                if(isset($_POST["submit"])){

                                    $firstName = mysqli_real_escape_string($con,$_POST["firstName"]);
                                    $lastName = mysqli_real_escape_string($con,$_POST["lastName"]);
                                    $email = mysqli_real_escape_string($con,$_POST["email"]);
                                    $subject = mysqli_real_escape_string($con,$_POST["subject"]);
                                    $messageBody = mysqli_real_escape_string($con,$_POST["messageBody"]);


                                    $mail4 = new PHPMailer();

                                    $mail4->IsSMTP();        // set mailer to use SMTP
                                    $mail4->Host = "smtp.1and1.com";  // specify main and backup server
                                    $mail4->SMTPAuth = true;     // turn on SMTP authentication
                                    $mail4->Port = 587;     // Set the SMTP port number
                                    $mail4->Username = "mails@konnect.one";  // SMTP username
                                    $mail4->Password = "!@AKonnect.One001"; // SMTP password

                                    $mail4->FromName = $firstName .' '.$lastName .'<'.$email.'>';
                                    $mail4->AddAddress("konnect@agilep3.com");

                                    $mail4->WordWrap = 50;                                 // set word wrap to 50 characters
                                    //$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
                                    //$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
                                    $mail4->IsHTML(true);                                  // set email format to HTML

                                    $mail4->FromName = $firstName .' '.$lastName;
                                    $mail4->Subject = $subject;
                                    $mail4->Body    = '<!DOCTYPE HTML>     
                                                <html>
                                                    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
                                                    </head>
                                                    <body>
                                                        <div style="background-color:white; width: 80%; margin:auto; dborder:solid; dborder-width:thin; bdorder-color:#EEE; position: relative; font-size:15px; padding-top:2em; padding:1em; font-family:Verdana, Geneva, sans-serif">
                                                            <p style="font-size:15px; dtext-align:center;">
                                                                '.$messageBody.',
                                                            </p>
                                                        </div>
                                                    </body>
                                                </html>';

                                    if($mail4->Send()){
                                        ?>
                                        <script>
                                            alert("Mail successfully sent.");
                                            location.href = "contact.php";
                                        </script>
                                        <?php

                                    }else{
                                        echo "Mail Not sent";
                                    }

                                }else{
                                ?>
                                <div class="form-group">
                                    <label>Your name</label>
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="firstName" placeholder="First name" required="">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="lastName" placeholder="Last name" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Email1">Email address</label>
                                    <input type="email" class="form-control" name="email" aria-describedby="email" placeholder="Enter email address" required="">
                                </div>
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" class="form-control" name="subject" aria-describedby="subject" placeholder="Subject" required="">
                                </div>
                                <div class="form-group">
                                    <label for="messageBody">Message:</label>
                                    <textarea class="form-control" name="messageBody" rows="7" required=""></textarea>
                                </div>

                                <div class="text-center">
                                    <button name="submit" class="btn bg-cyan btn-dark btn-block rounded-0 py-2">Submit</button>
                                </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><?php
include 'includes/footer.php'
?>
