<?php 

require_once("./config/config.php");

session_start();

    //LANGUAGE SETTINGS
   $langdata = lang_check($editlang);
    $profile = $_SESSION["email"];
    $id = GetID($conn, $profile);
    $sql="SELECT * FROM company_info WHERE id = ".(int)$id."";
    $go=mysqli_query($conn,$sql);
if( $data=mysqli_fetch_assoc($go) ){
    $c_logo=  $data["c_logo"];
    $c_email = $data["email"];
    $c_name = $data["company_name"];   
    $c_slogan = $data["slogan".$langdata];
    $c_about = $data["about".$langdata];
    $c_tel =  $data["tel_1"];
    $c_tel2 =  $data["tel_2"]; 
    $c_tel_c =  $data["tel_1_country"];
    $c_tel2_c =  $data["tel_2_country"]; 
    $c_web = $data["website_url"];
    $c_tags =  $data["activity".$langdata]; 
    $c_postcode = $data["post_code"];
    // Main Category

    $sql2 = "select * from main_categorys where id = ".(int)$data["main_category"]."";
    $query = mysqli_query($conn, $sql2);
    if($row = mysqli_fetch_array($query)){
        $c_category = $row["name".$langdata]; 
    }

    // end Main Category
    $c_adress =  $data["address"];       
    $c_ecount =  $data["employees_count"];   
    $c_bcount =  $data["business_count"];   
    $c_country =  $data["country"];
    $c_city =  $data["city"];

    // Sub category
    $sub_category = $data["sub_category"];
    $sub_categorys = ""; //<option value="0"></option>
    $sql2 = "select * from sub_categorys where mcid = '".(int)$data["main_category"]."'";
    $query = mysqli_query($conn, $sql2);
    while ($row = mysqli_fetch_array($query)){
        $selected = "";
        if($sub_category == $row["row"]){
            $selected = "selected";
        }
        $sub_categorys .= '<option value="'.$row["row"].'" '.$selected.'>'.$row["name".$langdata].'</option>';
    }

    // end Sub category
}










?>