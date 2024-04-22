<?php
if(file_exists("./config/config.php")){
    include_once("./config/config.php");
}
session_start();
$email = $_SESSION["email"];
$self_id = GetID($conn, $email);
if(!empty($self_id)){
    $sql = "select * from company_info where id = $self_id";
    if($query = mysqli_query($conn, $sql)){
        // Sent Company info
        if($row = mysqli_fetch_array($query)){
            $c_logo = $row["c_logo"];
            $c_name = $row["company_name"];
            $c_country = $row["country"];
            $c_type = $row["type"];
            $c_username = $row["user_name"];
            $c_subc= $row["sub_category"];
            $c_mainc= $row["main_category"];
            $c_seourl = $row["seo_company_name"];
            $c_tel = $row["tel_1"];

            $c_license_start =  $row["license_start"];
            $c_license_end =  $row["license_end"];

        }
    }
}

?>