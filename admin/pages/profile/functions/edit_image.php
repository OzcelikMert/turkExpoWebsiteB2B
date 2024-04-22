<?php
include_once("./config/config.php");
session_start();
//Empty İmage
if(!empty($_POST['crop-image'])){
    $empty = "UklGRrAAAABXRUJQVlA4WAoAAAAQAAAAxwAAxwAAQUxQSBQAAAABBxAREVCQtgFT//a7E9H/5P57CFZQOCB2AAAAUAwAnQEqyADIAD5tNplJpCMioSBIAIANiWlu4XaxG0AT2vRVwgyCGqpNdtouEGQQ1VJrttFwgyCGqpNdtouEGQQ1VJrttFwgyCGqpNdtouEGQQ1VJrttFwgyCGqpNdtouEGQQ1VJrttFnAAA/v/WAAAAAAAAAA==";
    $img = $_POST['crop-image'];
	$img = str_replace('data:image/webp;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    if(!($empty==$img)){ //img not empty
    $img_file = date("YmdHis").mt_rand().'.webp';
    $file = "../images/company_logo/". $img_file; 
    $success = file_put_contents($file, $data);
    print $success ? $file : 'Unable to save the file.';
    del_and_update_image($conn, $img_file);
    }else{echo '<script>alert("Select The Image File"); window.location.href = "profile.php";</script>';}
}

function del_and_update_image($con, $img_loc){
    $email = $_SESSION['email'];
    $id = GetID($con, $email);
    $ssql = "select c_logo from company_info where id = $id";

    $select=mysqli_query($con,$ssql); //Before Delete image
    if($data=mysqli_fetch_row($select)) {        
        if($data[0]!="message_default_logo.png"){unlink('../images/company_logo/'.$data[0]);}
    }
   
    $sql = "update company_info set c_logo ='".$img_loc."' where id = $id";
    if($result = mysqli_query($con, $sql)){
    echo '<script>window.location.href = "profile.php";</script>';
    }else { echo '<script>alert("Not Upload"); window.location.href = "profile.php";</script>';}
}
?>