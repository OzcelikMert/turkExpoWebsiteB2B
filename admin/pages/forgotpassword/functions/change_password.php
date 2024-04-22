<?php 
require_once("./config/config.php");
session_start();
if(!empty($_SESSION["email_verify"])){
// User control
$email = $_SESSION["email_verify"];
if($_POST){
    // Values
    $newpass = isset($_POST['newpass']) ? htmlspecialchars(trim(strip_tags($_POST['newpass']))) : "";
    $newpass = str_replace("'", '', $newpass);
    
    $newpassre = isset($_POST['newpassre']) ? htmlspecialchars(trim(strip_tags($_POST['newpassre']))) : "";
    $newpassre = str_replace("'", '', $newpassre);
    
    $verifyCode = isset($_POST['verifycode']) ? htmlspecialchars(trim(strip_tags($_POST['verifycode']))) : "";
    
    $Session_verifyCode = $_SESSION['verfiyCode'];
    // Value Controls
    $errorMessage = valueControl($verifyCode, $Session_verifyCode, $newpass, $newpassre);
    $newpass = md5($newpass);
    $newpassre = md5($newpassre);
    if(empty($errorMessage)){ $errorMessage .= updatePassword($conn, $newpass, $email);}
    // Login
    if(empty($errorMessage)){
        // end Set Message Company
        session_destroy();
        header("Location: index.php");
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
}else {
    header("Location: forgotpassword.php");
}

// Title, Comment and Category control
function valueControl($verify_, $verify_confirm_, $pass_, $pass_re_){
    // Message
    $errorMessage = "";

    // Verify
    if (empty($verify_)){
        $errorMessage .= "<li>Please fill in the verify!</li>";
    }else {
        if($verify_ != $verify_confirm_){
            $errorMessage .= "<li>Wrong verify!</li>";
        }
    }

    // pass Control
    if (empty($pass_)){
        $errorMessage .= "<li>Please fill in the password!</li>";
    }else if(strlen($pass_) > 35){
        $errorMessage .= "<li>Password is very long!</li>";
    }

    // pass Control
    if (empty($pass_re_)) {
        $errorMessage .= "<li>Please fill in the retry password!</li>";
    }else {
        if($pass_re_ != $pass_){
            $errorMessage .= "<li>Passwords are not the same!</li>";
        }
    }
    
    // Return Message
    return $errorMessage;
}
// Account Control

function updatePassword($connect, $pass_, $email_){
    $error_message = "";
    $sql="update company_info set pass= '$pass_' where email = '$email_'";
        if($result = mysqli_query($connect, $sql)){
            $error_message .= "";
        }else{
            $error_message .= '<li>Error</li>';
        }
    return $error_message;
}


?>