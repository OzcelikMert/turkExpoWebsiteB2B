<?php

include_once("./config/config.php");
session_start();
$email = $_SESSION["email"];
$id = GetID($conn, $email);
//Translate
$GLOBALS["alert_wrong_self_password"] = _alert_wrong_self_password;
$GLOBALS["alert_fill_retry_password"] = _alert_fill_retry_password;
$GLOBALS["alert_long_password"] = _alert_long_password;
$GLOBALS["alert_not_same"] = _alert_not_same;
$GLOBALS["alert_fill_password"] = _alert_fill_password;
$GLOBALS["error"] = _error;
$GLOBALS["success"] = _success;



function changePass($connect, $id_, $pass_){
    // Change Password code...
    $sql = "update company_info set pass = '$pass_' where id = $id_";
    if (mysqli_query($connect, $sql)) { echo "<script>alert('".$GLOBALS["success"]."');</script>";
        session_destroy();
        
    }
    else{ echo "<script>alert('".$GLOBALS["error"]."');</script>"; }
}



if (isset($_POST["oldpass"]) && isset($_POST["newpass"]) && isset($_POST["newpassre"])) {
    // Get Values
    $oldpass = isset($_POST['oldpass']) ? safe($_POST['oldpass']) : "";
    $newpass = isset($_POST['newpass']) ? safe($_POST['newpass']) : "";
    $newpassre = isset($_POST['newpassre']) ? safe($_POST['newpassre']) : "";
    $errorMessage = "";
    $errorMessage .= valueControl($newpass, $newpassre);
    $newpassre = md5($newpassre);
    $newpass = md5($newpass);
    $oldpass = md5($oldpass);
    if (empty($errorMessage)) {
        if (!PassControl($conn, $email, $oldpass)) {
            $errorMessage .= "<li>".$GLOBALS["alert_wrong_self_password"]."</li>";
        }
    }



    if (empty($errorMessage)) {
        changePass($conn, $id, $newpass);
    }else {
        $ErrorMessage_show = '
        <div class="alert alert-danger col-md-12" role="alert" id="notes">
            <ul style="margin-bottom:0px;">
                '.$errorMessage.'
            </ul>
        </div>
        ';
    }
}

// Password Control
function PassControl($connect, $email_, $pass_){
    $sql = "select * from company_info where email = '$email_' and pass = '$pass_'";
    $query = mysqli_query($connect, $sql);
    if (mysqli_num_rows($query) > 0) {
        return true;
    }else {
        return false;
    }
}

// end Password Control

// Values Control
function valueControl($pass_, $pass_re){
    // Message
    $errorMessage = "";
    // pass Control
    if (empty($pass_)){
        $errorMessage .= "<li>".$GLOBALS["alert_fill_password"]."</li>";
    }else if(strlen($company_name_) > 35){
        $errorMessage .= "<li>".$GLOBALS["alert_long_password"]."</li>";
    }

    // pass Control
    if (empty($pass_re)) {
        $errorMessage .= "<li>".$GLOBALS["alert_fill_retry_password"]."</li>";
    }else {
        if($pass_re != $pass_){
            $errorMessage .= "<li>".$GLOBALS["alert_not_same"]."</li>";
        }
    }

    // Return Message
    return $errorMessage;
}

// end Values Control
?>