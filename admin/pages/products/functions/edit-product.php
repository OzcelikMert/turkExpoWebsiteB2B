  <?php
include_once("./config/config.php");

session_start();
$cid = GetID($conn,$_SESSION["email"]);

if (empty($_POST["lang"])) {
 // $langdata = lang_check(safe($_POST["product_update_lang"]));
$row = safe($_POST['row']);

if (!empty($_POST["update_lang_product"])) {
  $langdata = lang_check(safe($_POST["update_lang_product"]));
}else{
  $langdata =  empty($_POST["lang_edit"]) ? $langdata = lang_check($lang) : $langdata = lang_check(safe($_POST["lang_edit"]));
}


  $sql = "select * from products where row = ".(int)$row." and cid = '".(int)$cid."'";
  $query = mysqli_query($conn, $sql);
  if (mysqli_num_rows($query) > 0) {
    if ($data = mysqli_fetch_array($query)) {
      $title = $data["title$langdata"];
      $type = $data["type$langdata"];
      $desc = $data["description$langdata"];
      $plogo = $data["plogo"];
      $Slider_images = explode(",", $data["images"]);
    }
  }else{
    echo "<script>document.location.href = 'product-view.php'</script>";
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
  // Update Product Values
  $title_db = isset($_POST['title']) ? safe($_POST['title']) : "";
  $type_db = isset($_POST['type']) ? safe($_POST['type']) : "";
  $desc_db = isset($_POST['desc']) ? safe($_POST['desc']) : "";
  $plogo_db =   isset($_POST['crop-image']) ? safe($_POST['crop-image']) : "";
  $empty_logo = "data:image/webp;base64,UklGRrAAAABXRUJQVlA4WAoAAAAQAAAAxwAAxwAAQUxQSBQAAAABBxAREVCQtgFT//a7E9H/5P57CFZQOCB2AAAAUAwAnQEqyADIAD5tNplJpCMioSBIAIANiWlu4XaxG0AT2vRVwgyCGqpNdtouEGQQ1VJrttFwgyCGqpNdtouEGQQ1VJrttFwgyCGqpNdtouEGQQ1VJrttFwgyCGqpNdtouEGQQ1VJrttFnAAA/v/WAAAAAAAAAA==";

  if (!empty($title_db) && !empty($type_db) && !empty($desc_db)) {
    $errorMessage = "";
    $errorMessage = controlValues($title_db, $type_db, $desc_db);
    if (empty($errorMessage)) {
      if (upload_images(1, $_FILES['simg_1']) && upload_images(1, $_FILES['simg_2']) && upload_images(1, $_FILES['simg_3']) && upload_images(1, $_FILES['simg_4']) && upload_images(1, $_FILES['simg_5']) && upload_images(1, $_FILES['simg_6']) && upload_images(1, $_FILES['simg_7']) && upload_images(1, $_FILES['simg_8']) && upload_images(1, $_FILES['simg_9']) && upload_images(1, $_FILES['simg_10'])) {
        // Files control and add message content
        $img_file = $plogo;
        // Logo change
        if($plogo_db != $empty_logo){
          $img = $plogo_db;
          $img = str_replace('data:image/webp;base64,', '', $img);
          $img = str_replace(' ', '-', $img);
          $data = base64_decode($img);
          $rand = rand(1000, 9999);
          $img_file = date("YmdHis").$rand.'.webp';
          $file = "../images/products_images/".$img_file;
          file_put_contents($file, $data);
          unlink("../images/products_images/".$plogo."");  
        }
        // Slider Change
        $new_slider_images = [];
        for ($i=0; $i < 10; $i++) { 
          $new_slider_images[$i] = strtolower($_FILES['simg_'.($i+1).'']["name"]);
          //echo  "<script>alert('".$new_slider_images[$i]."');</script>";
        }
        for ($i=0; $i < count($new_slider_images); $i++) { 
          if(!empty($new_slider_images[$i])){
            $new_sliderName = upload_images(0, $_FILES['simg_'.($i+1).'']);
            $old_slider = $Slider_images[$i];
            $Slider_images[$i] = $new_sliderName;
            if (!empty($old_slider)) {
              unlink("../images/products_images/".$old_slider."");
            }
          }
        }
          $slider_images = "";
          for($i = 0; $i < count($Slider_images) - 1; $i++){
            $slider_images .= $Slider_images[$i].",";
          }
          if (count($Slider_images) < 10) {
            $minusCount = 10 - count($Slider_images);
            for ($i=0; $i < $minusCount; $i++) { 
              $slider_images .= ",";
            }
          }
          updateProduct($conn, $cid, $row, $type_db , $title_db, $img_file, $slider_images, $desc_db,$langdata);
        }else{
        $errorMessage .= "<li>Sorry, just only JPG, JPEG & PNG  files are allowed.</li>";
        }
      }
    }
  if(!empty($errorMessage)) {
    $ErrorMessage_show = '
    <div class="alert alert-danger col-md-12" role="alert" id="notes">
        <ul style="margin-bottom:0px;">
            '.$errorMessage.'
        </ul>
    </div>
    ';
  }
  if(!empty($title_db)){
    $title = $title_db;
  }
  if(!empty($type_db)){
    $type = $type_db;
  }
  if(!empty($desc_db)){
    $desc = $desc_db;
  }
}else{
  echo "<script>document.location.href = 'product-view.php'</script>";
}

// Update Values
function updateProduct($connect, $self_id, $pid, $type_, $title_, $plogo_, $images_, $desc_,$langdata){
  $ssql = "update products set type$langdata = '$type_', title$langdata = '$title_', plogo = '$plogo_', images = '$images_', description$langdata = '$desc_' where row = ".(int)$pid." and cid = '".(int)$self_id."'";
  if(mysqli_query($connect, $ssql)){
    echo "<script>document.location.href= 'product-view.php'</script>";
  }else {
    echo '<script>alert("'._error.'");</script>';
    echo "<script>document.location.href= 'product-view.php'</script>";
  }
}

/* Get files function (again change file name) */
function upload_images($control, $files){
  //$files = $_FILES['files'];
  if(!empty($files["name"][0]))
  {
      if($control == 1){
          // Make a control files
          foreach($files as $val)
          {
              $path_info = strtolower(pathinfo($val, PATHINFO_EXTENSION));
              if($path_info != "png" && $path_info != "jpg" && $path_info != "jpeg"){
                  return false;
              }else{
                  return true;
              }
          }
      }else if($control == 0){
        // Make a upload files
          $path_info = strtolower(pathinfo($files["name"], PATHINFO_EXTENSION));
          $newname = date("YmdHis").mt_rand().".".$path_info;
          move_uploaded_file($files['tmp_name'], '../images/products_images/'.$newname);
          return $newname;
      }
  }else{
      return true;
  }
}

$GLOBALS["alert_fill_title"]=_alert_fill_title;
$GLOBALS["alert_fill_type"] = _alert_fill_type;
$GLOBALS["alert_fill_title"] = _alert_fill_title;
$GLOBALS["alert_fill_desc"] =  _alert_fill_desc;
$GLOBALS["alert_fill_logo"] = _alert_fill_logo;
$GLOBALS["alert_verylong_title"] = _alert_verylong_title;
$GLOBALS["alert_verylong_type"] = _alert_verylong_type;
$GLOBALS["alert_verylong_desc"] = _alert_verylong_desc;

function controlValues($title_, $type_, $desc_){
  $errorMessage = "";

  // Title Control
  if (empty($title_)) { 
    $errorMessage .= "<li>".$GLOBALS["alert_fill_title"]."</li>";
  }else if (strlen($title_) > 150) {
    $errorMessage .= "<li>".$GLOBALS["alert_verylong_title"]."</li>";
  }

  // Type Control
  if (empty($type_)) {
    $errorMessage .= "<li>".$GLOBALS["alert_fill_title"]."</li>";
  }else if (strlen($type_) > 150) {
    $errorMessage .= "<li>".$GLOBALS["alert_verylong_type"]."</li>";
  }

  // Description Control
  if (empty($desc_)) {
    $errorMessage .= "<li>".$GLOBALS["alert_fill_desc"]."</li>";
  }else if (strlen($desc_) > 1000) {
    $errorMessage .= "<li>".$GLOBALS["alert_verylong_desc"]."</li>";
  }

  // Return Error Message
  return $errorMessage;
}

?>

