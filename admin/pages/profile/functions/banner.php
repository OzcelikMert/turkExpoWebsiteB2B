<?php 
if(!empty($_FILES["banner-image"])){
    $info = pathinfo($_FILES['banner-image']['name']);
    $ext = $info['extension']; 
    if ($ext=="png" || $ext=="jpg" || $ext =="jpeg") {
        list($width, $height) = getimagesize($_FILES['banner-image']['tmp_name']);
        if ($width<=800 && $height<=200) {
            $newname = date("YmdHis").mt_rand().".".$ext; 
            $target = "../images/banner_images/".$newname;
            move_uploaded_file($_FILES['banner-image']['tmp_name'], $target);
            del_and_update_banner($conn,$newname);
        }else{
            echo "<script>alert('"._error." : "._banner_size."  800px * 200px');</script>";
        }
    }
}
function del_and_update_banner($con, $img_loc){
    $email = $_SESSION['email'];
    $id = GetID($con, $email);
    $ssql = "select banner_image from company_info where id = $id";
    $select=mysqli_query($con,$ssql); //Before Delete image
    if($data=mysqli_fetch_row($select)) {        
        if($data[0]!="message_default_logo.jpeg" || !empty($data[0])){
            if(file_exists("../images/banner_images/".$data[0]."")){
                unlink('../images/banner_images/'.$data[0]);
            }
        }
    }

    $sql = "update company_info set banner_image ='".$img_loc."' where id = $id";
    if($result = mysqli_query($con, $sql)){
// echo '<script>window.location.href = "profile.php";</script>';
    }else { 
    //   echo '<script>alert("Not Upload"); window.location.href = "profile.php";</script>';
    }
    
}
?> 
        

