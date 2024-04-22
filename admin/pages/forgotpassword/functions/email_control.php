<?php 

require_once("./config/config.php");

require_once("./inc/send_smtp_mail.php");

session_start();

// User control

if($_POST){

    $email = htmlspecialchars(trim(strip_tags($_POST['email'])));

    // Value Controls

    $errorMessage = valueControl($email);

    // Account Controls

    if(empty($errorMessage)){

        $errorMessage .= accountControl($conn, $email);

    }

    // Login

    if(empty($errorMessage)){

        $_SESSION['email_verify'] = $email;

        $random_code = "VC".date("Ym");

        $random_code .= rand(1000000, 9999999);

        $random_code .= date("d");

        // Set Message Company

        $message = "<h2 style='color: green;'>Change Password Verify Code!</h2><br />";

        $message .= "<hr>";

        $message .= "Your Verification Code: <b style='color: darkred;'>".$random_code."</b>";

        if(sendMail_smtp($email, $message, "","Password Verification Code")){ $_SESSION['verfiyCode'] = $random_code; }

        session_regenerate_id();



        header("Location: changepassword.php");

    }else{

        $ErrorMessage_show = '

        <div class="alert alert-danger col-md-12" role="alert" id="notes">

            <ul style="margin-bottom:0px;">

                '.$errorMessage.'

            </ul>

        </div>

        ';

    }

}



// Title, Comment and Category control

function valueControl($email_){

    $errorMessagge = "";

    // Email Control

    if (empty($email_)){

        $errorMessagge .= "<li>Please fill in the email!</li>";

    }else if(strlen($email_) > 100){

        $errorMessagge .= "<li>Email is very long!</li>";

    }else if(!filter_var($email_, FILTER_VALIDATE_EMAIL)){

        $errorMessagge .= "<li>Please enter a valid email! (Examples:abc@xyz.com)</li>";

    }



    return $errorMessagge;

}

// Account Control

function accountControl($connect, $email_){

    $sql="SELECT * FROM company_info where email = '$email_'";

        if($result = mysqli_query($connect, $sql)){

            if(mysqli_num_rows($result) > 0){

                $error_message = "";

            }else{

                $error_message = '<li>Your username is incorrect</li>';

            }

        }

    return $error_message;

}





?>