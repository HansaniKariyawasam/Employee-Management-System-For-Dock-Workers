<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once "assets/libs/phpmailer/vendor/autoload.php";
include "Connection/connection.php";
$success=0;
$error_message = "";
$email="";


if(!empty($_POST["submit_email"])) {

    if(!empty($_POST['email']) AND !empty($_POST['username'])) {
        $result_username = mysqli_query($connection,"SELECT * FROM User WHERE Username='" . $_POST["username"] . "'");
        $count  = mysqli_num_rows($result_username);
        if($count>0){
            $_SESSION['Username']=$_POST["username"];
            // generate OTP
            $otp = rand(100000,999999);
            // Send OTP

            $body = '<html>
              <body>

                <p>Hi,</p>
                <p>To chnage the passwaord</p>
                <p>Input the following number</p>
                <p>Your One-Time-Password is '.$otp.' </p>
              </body>
            </html>';
            $result = mysqli_query($connection,"INSERT INTO otp_expiry(otp,is_expired,create_at) VALUES ('" . $otp . "', 0, '" . date("Y-m-d H:i:s"). "')");
            $current_id = mysqli_insert_id($connection);
            if(!empty($current_id)) {
                $success=1;
                //This will display if the mail client cannot display HTML.
                $altBody = "Copy and paste the following One-Time-Password: ".$otp."";

                //sending mail:
                sendConfirmationMail($_POST["email"], $body, $altBody);
            }else{
                echo mysqli_error($connection);
            }
        }else{
            ?>
            <script>
                alert('Username is incorrect. Please check again!');
            </script>
            <?php
        }

    } else {
        ?>
        <script>
            alert('Email not exist');
        </script>
        <?php
        $error_message = "Email not exists!";
    }
}
if(!empty($_POST["submit_otp"])) {
    $result = mysqli_query($connection,"SELECT * FROM otp_expiry WHERE otp='" . $_POST["otp"] . "' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 24 HOUR)");
    $count  = mysqli_num_rows($result);
    if(!empty($count)) {
        $result = mysqli_query($connection,"UPDATE otp_expiry SET is_expired = 1 WHERE otp = '" . $_POST["otp"] . "'");
        $success = 2;
    } else {
        $success =1;
        $error_message = "Invalid OTP!";
    }
}
if(!empty($_POST["save_password"])) {
    $password=md5($_POST['new_password']);
    $resultPa = mysqli_query($connection,"UPDATE User SET password='".$password."' WHERE Username='".$_SESSION['Username']."'");
//    $count  = mysqli_num_rows($result);
    if($resultPa) {
        echo "<script>alert('Password has been successfully updated!')</script>";
        echo "<script>window.location.replace('index.php')</script>";

    } else {
        echo mysqli_error($connection);
        $success =1;
        $error_message = "Invalid OTP!";
    }
}
function sendConfirmationMail($toEmail, $emailBody, $emailAltBody){
    include_once "assets/libs/phpmailer/vendor/autoload.php";

    $fromEmailID = 'bpes.payroll@gmail.com'; //confirmation email will be sent from this email.
    $fromName = 'B P E S'; //name that will dispay as the sender of confirmation email.
    $subject = 'One-Time-Password'; //subject for the confrimation email.

//you can modify the body of the email address in the script 'signup.php'.

//LOGIN DETAILS FOR FROM Email ID: Settings to be taken from Email Provider.
    $mailHost = 'smtp.gmail.com'; //specify main and backup SMTP mail servers.
    $mailUsername = 'bpes.payroll@gmail.com'; //usually the email address, but check with Email provider.
    $mailPassword = 'bpes1234'; //password used to login to email ID.
    $mailEncryptionType = 'tls'; //enter ssl or tsl.
    $mailPortNumber = 587; //usually 587 for TSL. But find the recommended settings from your email provider.

//optional settings. Leave blank if not required.
    $replyToEmailID = ''; //if user replies to confirmation email, email id to recieve that message.





    $mail = new PHPMailer();    $BCCEmailID = ''; //BCC of confirmation email to be sent to this email address.

    $mail->isSMTP();
    $mail->Host = $mailHost;
//     $mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
//    $mail->SMTPKeepAlive = true;
// $mail->Mailer = "smtp"; // don't change the quotes!

// $mail->SMTPOptions = array(
//         'ssl' => array(
//             'verify_peer' => false,
//             'verify_peer_name' => false,
//             'allow_self_signed' => true
//         )
//     );


    $mail->SMTPAuth = true;
    $mail->Username = $mailUsername;
    $mail->Password = $mailPassword;
    $mail->SMTPSecure = $mailEncryptionType;
    $mail->Port = $mailPortNumber;

    $mail->setFrom($fromEmailID, $fromName);
    $mail->addAddress($toEmail);

    if($replyToEmailID)
        $mail->addReplyTo($replyToEmailID);

    if($BCCEmailID)
        $mail->addBCC($BCCEmailID);



    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body    = $emailBody;
    $mail->AltBody = $emailAltBody;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
//        echo 'Message has been sent. Please check your inbox and spam folder.';
    }
}
?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>B. P. E. S</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform1">
                    <div class="text-center p-t-20 p-b-20">
                        <span class="db"><img src="assets/images/logo.png" alt="logo" /></span>
                    </div>


                    <form method="post" action="" name="frmUser">
                        <?php
                        if(!empty($success == 1)) {
                            ?>
                            <p style="color: whitesmoke">Enter OTP here</p>
                            <div class="form-group">
                                <input class="form-control form-control-lg" type="text" name="otp" placeholder="One Time Password" autocomplete="off" required>
                            </div>
                            <div class="form-group pt-1">
                                <input class="btn btn-block btn-danger btn-xl" type="submit" value="Submit" name="submit_otp" required>
                            </div>
                        <?php
                        } else if ($success == 2) {
                        ?>
                            <!--                    <p style="color:#31ab00;">Welcome, You have successfully loggedin!</p>-->
                            <p style="color: whitesmoke">Enter Your New Password</p>
                            <div class="form-group">
                                <input class="form-control form-control-lg" type="password" name="new_password" placeholder="New Password" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-lg" onchange="validate()" id="confirm_password" type="password" name="cnew_password" placeholder="Confirm New Password" autocomplete="off" required>
                            </div>
                            <div class="form-group pt-1">
                                <input class="btn btn-block btn-danger btn-xl" type="submit" value="Submit" name="save_password" required>
                            </div>
                            <script>
                                function validate(){
                                    const password = document.querySelector('input[name=new_password]');
                                    const confirm = document.querySelector('input[name=cnew_password]');
                                    if (confirm.value === password.value) {
                                        confirm.setCustomValidity('');
                                    } else {
                                        document.getElementById('confirm_password').select();
                                        confirm.setCustomValidity('Passwords do not match');
                                    }
                                }


                                // alert('Welcome, You can the password!');
                            </script>
                        <?php
                        }
                        else {
                        ?>
                            <p style="color: whitesmoke">Don't worry, we'll send you an email to reset your password.<br><small style="color: whitesmoke">Please input your log in Username and active email address</small></p>

                            <div class="form-group">
                                <input class="form-control form-control-lg" type="text" name="username" required placeholder="Your Username" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-lg" type="email" name="email" required placeholder="Your Email" autocomplete="off">
                            </div>
                            <div class="form-group pt-1">
                                <input class="btn btn-block btn-danger btn-xl" type="submit" name="submit_email" value="Reset Password">
                            </div>
                            <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function(){

        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
    </script>

</body>

</html>