<?php

$GLOBALS["URL"] = "https://turkexpo.org/";
$GLOBALS["URL_404"] = "https://turkexpo.org/404.php";



$db_host="localhost";
$db_name="matrixte_turkexpo";
$db_user="matrixte_turkexpo";
$db_password="TurkishExpo.md5(11122334455*#).+TurkishExpo";

/*---------------------------------------*/

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name)or die('<div class="error"><h1>Veri Tabanı Bağlantısı Kurulamadı!</h1></div>');
$conn->query("SET NAMES 'utf8'"); 
$conn->query("SET CHARACTER SET utf8");  
$conn->query("SET SESSION collation_connection = 'utf8_unicode_ci'"); 


function GetID($connect, $email){
    $sql = "select * from company_info where email = '$email'";
    $show_id = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_assoc($show_id)){
        return $row["id"];
    }else{
        return "";
    }
}


function safe($str){
      $name = htmlspecialchars(trim(strip_tags($str)));
      $name = str_replace("'", '', $name);
      return $name;
}

function lang_value_control($str,$str2){
     if (!empty($str)) {
         return $str;
     }else{
         return $str2;
     }
}




define("_not_data_entered","No data entered in this language");



?>