<?php 

require_once("./config/config.php");
session_start();

$GLOBALS["alert_user_pass_incorrect"] = _alert_user_pass_incorrect;
$GLOBALS["alert_pls_fill_password"] = _alert_pls_fill_password;
$GLOBALS["alert_password_verylong"] = _alert_password_verylong;
$GLOBALS["alert_pls_fill_email"] = _alert_pls_fill_email; 
$GLOBALS["alert_email_verylong"] = _alert_email_verylong; 
$GLOBALS["alert_enter_valid_email"] = _alert_enter_valid_email; 
// Session Control

if(!empty($_SESSION["email"])){
    header("Location: dashboard.php");
}else{
    session_destroy();
    session_start();
}

// User control
if($_POST){
    $keep = htmlspecialchars(trim(strip_tags($_POST['keep'])));
    $keep = str_replace("'", '', $keep);
    $email = htmlspecialchars(trim(strip_tags($_POST['email'])));
    $email = str_replace("'", '', $email);
    $pass = htmlspecialchars(trim(strip_tags($_POST['pass'])));
    $pass = str_replace("'", '', $pass);
    // Value Controls

    $errorMessage = valueControl($email, $pass);
    // Account Controls
    if(empty($errorMessage)){
        $errorMessage .= accountControl($conn, $email, $pass);
    }

    // Login
    if(empty($errorMessage)){
        if($keep == "Keep"){
            setcookie("email", $email, time() + 365 * 24 * 60 * 60);
        }else{
            setcookie("email", "", time() + -3600);
        }

        $_SESSION['email'] = $email;
        session_regenerate_id();
        $_SESSION['password'] = md5($pass);
        session_regenerate_id();

        // Update Last Ip Address
        $id = GetID($conn, $email);
        $ip_address = GetIP();
        if(updateLastIp_Address($conn, $id, $ip_address)){
            header("Location: dashboard.php");
        }
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

// Get Cookie Values

if(isset($_COOKIE["email"])){
    $cookie_email = $_COOKIE["email"];
}

/* Functions */


// Title, Comment and Category control
function valueControl($email_, $pass_){
    $errorMessagge = "";
    // Email Control
    if (empty($email_)){
        $errorMessagge .= "<li>".$GLOBALS["alert_pls_fill_email"]."!</li>";
    }else if(strlen($email_) > 100){
        $errorMessagge .= "<li>".$GLOBALS["alert_email_verylong"]."!</li>";
    }else if(!filter_var($email_, FILTER_VALIDATE_EMAIL)){
        $errorMessagge .= "<li>".$GLOBALS["alert_enter_valid_email"]."</li>";
    }

    // Password Control
    if (empty($pass_)) {
        $errorMessagge .= "<li>".$GLOBALS["alert_pls_fill_password"]."!</li>";
    }else if(strlen($pass_) > 50){
        $errorMessagge .= "<li>".$GLOBALS["alert_password_verylong"]."!</li>";
    }
    return $errorMessagge;

}

// Account Control
function accountControl($connect, $email_, $pass_){
    $pass_ = md5($pass_);
    $sql="SELECT * FROM company_info where email = '$email_' and pass = '$pass_'";
        if($result = mysqli_query($connect, $sql)){
            if(mysqli_num_rows($result) > 0){
                $error_message = "";
            }else{
                $error_message = '<li>'.$GLOBALS["alert_user_pass_incorrect"].'</li>';
            }
        }
    return $error_message;
}

// Update Last Ip Address
function updateLastIp_Address($connect, $id, $ip_address){
    $sql = "update company_info set last_ip = '$ip_address' where id = ".(int)$id."";
    if(mysqli_query($connect, $sql)){
        return true;
    }
    return false;
}

// GET ip
function GetIP(){
    if(getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } else if(getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode (',', $ip);
            $ip = trim($tmp[0]);
        }
    } else {
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}

/* end Functions */
?>