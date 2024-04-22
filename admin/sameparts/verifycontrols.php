<?php

require_once("./config/config.php");
session_start();

$email = $_SESSION['email'];
$id = GetID($conn, $email);
$url = $_SERVER['PHP_SELF'];
$path = pathinfo(parse_url($url, PHP_URL_PATH));
$path_info =  $path['filename'];




// Control Verifys
$sql= "SELECT * FROM company_info where id = $id";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        if($row = mysqli_fetch_array($result)) {
           // $license = getlicense($row["license_end"]); // true or false  (False End Licence)
             if ($row["type"] == 1){
                 if($path_info != "dashboard"){
                    if($row["verify_status"] == 0){
                        // Verify dont Confirm
                        header("Location: dashboard.php");
                    }else if($row["verify_status"] >= 1 && $row["type"] == 1 ){
                        
                        // Verify Confirmed
                        if(empty($row["main_category"]) || empty($row["activity"]) || empty($row["sub_category"])){
                            // Space Main Category
                            header("Location: dashboard.php");
                        }
                    } 
                 }else if($path_info == "dashboard"){
                   /* if($license== false){             
                        header("Location: license.php");
                    }*/
                }
            }else if ($row["type"] == 2){
                if ($path_info == "profile" || $path_info == "newmessage" || $path_info == "inbox" || $path_info == "security") {
                }else{
                    header("Location: dashboard.php");
                }
            }
        }
    }
}

/*
if($path_info == "dashboard" && $license== false){
    if($license== false){             
        header("Location: license.php");
    }
}
*/


//Licence Control (R:True/False)
// day-mount-year (Ex : 01-01-2020)
/*function getlicense($end){ 
    if(isset($end)){
        $nowday = strtotime(date("d-m-Y"));
        $userdate = strtotime($end);  
        if($userdate > $nowday ){
            return true;
        }else{
            return false;
        }
    }
    return true;
}*/

?>