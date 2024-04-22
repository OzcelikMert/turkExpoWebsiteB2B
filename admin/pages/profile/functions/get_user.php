<?php 
require_once("./config/config.php");
session_start();

    //LANGUAGE SETTINGS
    $profile = $_SESSION["email"];
    $id = GetID($conn, $profile);
    $sql="SELECT * FROM company_info WHERE id = ".(int)$id."";
    $go=mysqli_query($conn,$sql);
if( $data=mysqli_fetch_assoc($go) ){
    $c_logo=  $data["c_logo"];
    $c_email = $data["email"];
    $c_username = $data["user_name"];   
    $c_tel =  $data["tel_1"];
    $c_tel_c =  $data["tel_1_country"];
    $c_web = $data["website_url"];
    $c_postcode = $data["post_code"];
    $c_adress =  $data["address"];       
    $c_city =  $data["city"];
    // Main Category
    // end Sub category
}










?>