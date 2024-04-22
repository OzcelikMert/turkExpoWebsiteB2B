<?php
include_once("../../../config/config.php");
session_start();
$email = $_SESSION["email"];
$id = GetID($conn, $email);
function Delete_images($connect, $row_, $pid_, $self_id){
    $sql = "select * from products where row = ".(int)$pid_." and cid = '".(int)$self_id."'";
    $query = mysqli_query($connect, $sql);
    if (mysqli_num_rows($query) > 0) {
      if ($data = mysqli_fetch_array($query)) {
        $Slider_images = explode(",", $data["images"]);
      }
    }else {
      return "true";
    }

    $sliderImages = "";
    $EmptysliderImages = "";
    $delete_images = $Slider_images[$row_];
    $Slider_images[$row_] = "";
    for ($i=0; $i < count($Slider_images) - 1; $i++) {
        if(!empty($Slider_images[$i])){
            $sliderImages .= $Slider_images[$i].",";
        }else {
            $EmptysliderImages .= ",";
        }
    }
    $sliderImages .= $EmptysliderImages;
    $sql = "update products set images = '$sliderImages' where row = ".(int)$pid_." and cid = '".(int)$self_id."'";
    if(mysqli_query($connect, $sql)){
        unlink("../../../../images/products_images/".$delete_images."");
    }
}

// Get id
if ($_POST) {
    $pid = htmlspecialchars(trim(strip_tags($_POST["product_id"])));
    $pid = str_replace("'", '', $pid);
    $Srow = htmlspecialchars(trim(strip_tags($_POST["slider_row"])));
    $Srow = str_replace("'", '', $Srow);
    if (!empty($pid) && isset($pid) && (int)$Srow >= 0 && (int)$Srow < 10) {
        $echo_value = Delete_images($conn, $Srow, $pid, $id);
        $echo_value = Get_images($conn, $pid, $id);
        $echo_value = trim($echo_value);
        echo $echo_value;
    }
}

// Get Product Images(Slider)
function Get_images($connect, $pid_, $self_id){
  // Get Product Values
  $sql = "select * from products where row = ".(int)$pid_." and cid = '".(int)$self_id."'";
  $query = mysqli_query($connect, $sql);
  if (mysqli_num_rows($query) > 0) {
    if ($data = mysqli_fetch_array($query)) {
      $title = $data["title"];
      $type = $data["type"];
      $desc = $data["description"];
      $plogo = $data["plogo"];
      $Slider_images = explode(",", $data["images"]);
    }
  }else{
    return "true";
  }
  $Sliders = "";
  for ($i=0; $i < 10; $i++) { 
    if(!empty($Slider_images[$i])){
      $Sliders .= '
      <div class="product-slider-image">
        <div class="product-add-image" id="slider_'.($i + 1).'" data-src="/images/products_images/'.$Slider_images[$i].'"  style="background-image: url(../images/products_images/'.$Slider_images[$i].');"></div>
        <input type="file" accept="image/x-png, image/jpeg" id="simg_'.($i + 1).'" name="simg_'.($i + 1).'" class="file-upload-default"> 
        <div>
          <a class="btn btn-warning float-left" href="javascript:void(0);" onclick="edit_image(\'simg_'.($i + 1).'\', \'slider_'.($i + 1).'\');">Update</a>
          <a id="img-dlt-btn-'.($i + 1).'" onclick="Product_imageDelete('.($i).')" class="btn btn-danger float-right" href="javascript:void(0);">Delete</a>
        </div>
      </div>
      ';
    }else {
      $Sliders .= '
      <div class="product-slider-image">
        <div class="product-add-image" id="slider_'.($i + 1).'" data-src="none"  style="background-color: #cee1ff;");"></div>
        <input type="file" accept="image/x-png, image/jpeg" id="simg_'.($i + 1).'" name="simg_'.($i + 1).'" class="file-upload-default"> 
        <div>
          <a class="btn btn-warning float-left" href="javascript:void(0);" onclick="edit_image(\'simg_'.($i + 1).'\', \'slider_'.($i + 1).'\');">Update</a>
          <a id="img-dlt-btn-'.($i + 1).'" onclick="Product_imageDelete('.($i).')" class="btn btn-danger float-right" href="javascript:void(0);">Delete</a>
        </div>
      </div>
      ';
    }
  }
  return $Sliders;
}
?>