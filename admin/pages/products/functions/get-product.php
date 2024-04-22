<?php 
require_once("./config/config.php");
include("./sameparts/lang_edit.php");
session_start();
$cid = GetID($conn,$_SESSION["email"]);
//$langdata = lang_check($editlang);
//$deflang = GetlangueCompanyLangId($conn,$c_country);
$sql="SELECT * FROM products WHERE cid= '".$cid."' order by date desc";
$go=mysqli_query($conn,$sql);
$number = 0;
while($data=mysqli_fetch_assoc($go)){
    $number++;
    $row = $data["row"];
    $title = (empty($data["title".$langdata])) ? $data["title".$GLOBALS["langdata"]] : $data["title".$langdata.""];
    $plogo =  $data["plogo"];
    $date = $data["date"];
    $delmessage = "'"._alert_delete_time."'";
    echo '
    <div class="product" id="product-'.$row.'">
        <div class="product-alt">
        <img src="../images/products_images/'.$plogo.'" alt="">
        <span>'.$title.'</span>
        <span id="min-date">'.$date.'</span>
        </div>
            <div class="center" style="text-align:center;padding-top:10px;text-decoration: none;">
                <form action="product-edit.php" method="post" style="display: inline-block;">
                <input type="hidden" name="row" value="'.$row.'" class="btn-edit">
                <input type="submit" class="btn-edit" value="'._edit.'">
                </form>
            <a href="javascript:void(0);" id="ProductDelete_'.$number.'" onclick="ProductDelete('.$row.', '.$number.' , '.$delmessage.')" data="'.$date.'"  class="btn-delete">'._del.'</a>
            </div>
    </div>
    ';
}
?>





