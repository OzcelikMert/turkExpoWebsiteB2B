<?php 
require_once("./config/config.php");
require_once("./inc/send_smtp_mail.php");
session_start();

$GLOBALS["succes"] = _success;
$GLOBALS["alert_invalid_verift_code"] = _alert_invalid_verift_code;
$GLOBALS["resend_verification_code"] = _resend_verification_code;
$GLOBALS["langdata"] = $langdata;

$email = $_SESSION['email'];
$id = GetID($conn, $email);

// Verify code control
if(!empty($_POST["verify_code"])){
    $errorMessage = "";
    $verify_code = safe($_POST['verify_code']);
    $verify_code = str_replace("'", '', $verify_code);
    $sql= "SELECT * FROM company_info where id = $id and verify_code = '$verify_code'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            $sql= "UPDATE company_info SET verify_status ='1' WHERE id = $id";
            if(mysqli_query($conn, $sql)){
                echo "<script>alert('".$GLOBALS["succes"]."');</script>";
                echo "<script>location.href = 'dashboard.php';</script>";
            }
        }else{
            $errorMessage .= '<li>'.$GLOBALS["alert_invalid_verift_code"].'</li>';
        }
    }

    $ErrorMessage_show = '
    <div class="alert alert-danger col-md-12" role="alert" id="notes">
        <ul style="margin-bottom:0px;">
            '.$errorMessage.'
        </ul>
    </div>
    ';

}else if($_POST["resend"] == "resend"){
    $sql= "SELECT * FROM company_info where id = $id";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = $result->fetch_assoc()) {
                $message = "<h2 style='color: green;'>Resend the verification email!</h2><br />";
                $message .= "<hr>";
                $message .= "Your Verification Code: <b style='color: darkred;'>".$row['verify_code']."</b>";
                sendMail_smtp($email, $message, $row['company_name'], "aktivasyon");
            }
        }
    }

}else if(!empty($_POST["main_category"]) && !empty($_POST["activity"])){
    $sql2 = "select * from main_categorys";
    $query = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($query) > 0) {
            $main_category = safe($_POST['main_category']);
            $sub_category = safe($_POST['sub_category']);
        }else{
            $main_category = "";
        }     

    $activity = safe($_POST['activity']);
    $activity = substr($activity, 0, 200); 

    $sql= "UPDATE company_info SET main_category = '$main_category', sub_category = ".$sub_category.", activity".$GLOBALS["langdata"]." = '$activity' WHERE id = $id";
    if($result = mysqli_query($conn, $sql)){
                echo "<script>location.href = 'dashboard.php';</script>";
    }
}


// Verify control
$sql= "SELECT * FROM company_info where id = $id";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        if($row = mysqli_fetch_array($result)) {
                if($row["verify_status"] == 0 || $row["verify_status"] != 1){
                    // Verify dont Confirm
                    include("./pages/dashboard/verification_form.php");
                }else if($row["verify_status"] == 1 && $row["type"] == 1){
                    // Verify Confirmed
                    if(empty($row["main_category"]) || empty($row["activity".$GLOBALS["langdata"]]) || empty($row["sub_category"])){
                        // Space Main Category
                        $get_activity = $row["activity".$GLOBALS["langdata"]];
                        $get_category = "";
                        $sql2 = "select * from main_categorys";
                        $query = mysqli_query($conn, $sql2);
                            while($row2 = mysqli_fetch_array($query)){
                                $get_category .= '<option value="'.$row2["id"].'">'.$row2["name".$GLOBALS["langdata"]].'</option>';
                            }
                        include("./pages/dashboard/activity_form.php");

                }else{
                    /*  Not Space Main Category*/ 
                   include("./pages/dashboard/dashboard_items.php"); 
                  
                }
            }else{
                include("./pages/dashboard/dashboard_items.php");
            }
        }
    }
}




?>