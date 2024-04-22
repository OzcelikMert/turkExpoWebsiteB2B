<?php
include_once("./admin/config/config.php");
session_start();
$session_control=false;
$email = $_SESSION["email"];
$self_id = GetID($conn, $email);
if(!empty($self_id)){
    $sql = "select * from company_info where id = $self_id";
    if($query = mysqli_query($conn, $sql)){
        // Sent Company info
        if($row = mysqli_fetch_array($query)){
            $c_logo = $row["c_logo"];
            $c_name = $row["company_name"];
            $c_seourl = $row["seo_company_name"];
            $session_control = true;
        }
    }
}

?>