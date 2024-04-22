<?php
    include_once("../admin/config/config.php");
    session_start();

$values = array();
if($_SESSION){
    // Session Info
    $email = (empty($_SESSION["email"])) ? "" : $_SESSION["email"];
    $id = GetID($conn, $email);
    // end Session Info

    // Get Value
    $ip_address = GetIP();
    $checked_ip_address = Check_IpAddress($conn, $id, $ip_address); 
    // end Get Value

    // Checked Control
    if($checked_ip_address){
        $values["title"] = "no-change-ip-address";
        $values["comment"] = "null";
        $values["type"] = "null";
        $values["button_text"] = "null";
    }else{
        $values["title"] = "Your Session Ended";
        $values["comment"] = "Your account has been logged in from another ip.";
        $values["type"] = "error";
        $values["button_text"] = "Okay";
        session_destroy();
    }
    // end Checked Control
}else{
    $values["title"] = "no-session";
    $values["comment"] = "null";
    $values["type"] = "null";
    $values["button_text"] = "null";
}

echo json_encode($values);


/* Functions */

// Check Ip Address
function Check_IpAddress($connect, $id, $ip_address){
    $value = "";
    $sql = "select * from company_info where id = ".(int)$id." and last_ip = '$ip_address'";
    $query = mysqli_query($connect, $sql);
    if(mysqli_num_rows($query) > 0){
        // Get Info
        return true;
    }

    return false;
}
// end Check Ip Address 

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
// end GET ip

/* end Functions */
?>