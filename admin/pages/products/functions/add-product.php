<?php
require_once("./config/config.php");
session_start();
$cid = GetID($conn,$_SESSION["email"]);

/* Get values */
if(isset($_POST["title"])){
  $langdata = lang_check(safe($_POST["product_update_lang"]));
  $title =  safe($_POST['title']);
  $type =   safe($_POST['type']);
  $desc =   safe($_POST['message']);
  $plogo =  safe($_POST['crop-image']);

  $errorMessage = "";
  $errorMessage = controlValues($title, $type, $desc, $plogo);
  if (empty($errorMessage)) {
    if (upload_images(1)) {
      // Files control and add message content
      $img = $plogo;
      $img = str_replace('data:image/webp;base64,', '', $img);
      $img = str_replace(' ', '-', $img);
      $data = base64_decode($img);
      $rand = rand(1000, 9999);
      $img_file = date("YmdHis").$rand.'.webp';
      $file = "../images/products_images/".$img_file; 
      file_put_contents($file, $data);
      $date = date("Y-m-d H-i-s");
      $slider = upload_images(0);
      $slider_images = "";

      if(count($slider) > 0){
        for($i = 0; $i < count($slider); $i++){
          $slider_images .= $slider[$i].",";
        }
      }
      if (count($slider) < 10) {
        $minusCount = 10 - count($slider);
        for ($i=0; $i < $minusCount; $i++) { 
          $slider_images .= ",";
        }
      }
      saveProduct($conn, $cid, $type, $title, $img_file, $slider_images, $desc, $date,$langdata);
    }else{
      $errorMessage .= "<li>"._alert_img_not_allowed."</li>";
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
}

// Set Product
function saveProduct($connect, $cid_, $type_, $title_, $plogo_, $images_, $desc_, $date_,$langdata){
  $ssql = "insert into products(cid,type$langdata,plogo,images,title$langdata,description$langdata,date) values('".$cid_."','".$type_."','".$plogo_."','".$images_."','".$title_."','".$desc_."','".$date_."')";
  if(mysqli_query($connect, $ssql)){
    echo "<script>document.location.href= 'product-view.php'</script>";
  }else {
    echo "<script>document.location.href= 'product-view.php'</script>";

  }
}

/* Get files function (again change file name) */
function upload_images($control){
  $files = $_FILES['files'];
  if(!empty($files["name"][0]))
  {
      $file_desc = reArrayFiles($files);
      if($control == 1){
          // Make a control files
          foreach($file_desc as $val)
          {
              $path_info = strtolower(pathinfo($val['name'], PATHINFO_EXTENSION));
              if($path_info != "png" && $path_info != "jpg" && $path_info != "jpeg"){
                  return false;
              }else{
                  return true;
              }
          }
      }else if($control == 0){
        // Make a upload files
          $array_number = 0;
          $array_url = array();
          foreach($file_desc as $val)
          {
            if ($array_number < 10) {
              $path_info = strtolower(pathinfo($val['name'], PATHINFO_EXTENSION));
              $newname = date("YmdHis").mt_rand().".".$path_info;
              move_uploaded_file($val['tmp_name'], '../images/products_images/'.$newname);
              $array_url[$array_number] = $newname;
              $array_number++;
            }
          }
          return $array_url;
      }
  }else{
      return true;
  }
}

// Multiple file function
function reArrayFiles(&$fileName){
    $file_ary = array();
    $file_count = count($fileName['name']);
    $file_key = array_keys($fileName);
   
    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $fileName[$val][$i];
        }
    }
    return $file_ary;
}


$GLOBALS["alert_fill_title"]=_alert_fill_title;
$GLOBALS["alert_fill_type"] = _alert_fill_type;
$GLOBALS["alert_fill_title"] = _alert_fill_title;
$GLOBALS["alert_fill_desc"] =  _alert_fill_desc;
$GLOBALS["alert_fill_logo"] = _alert_fill_logo;
$GLOBALS["alert_verylong_title"] = _alert_verylong_title;
$GLOBALS["alert_verylong_type"] = _alert_verylong_type;
$GLOBALS["alert_verylong_desc"] = _alert_verylong_desc;

function controlValues($title_, $type_, $desc_, $plogo_){
  $empty_logo = "data:image/webp;base64,UklGRrAAAABXRUJQVlA4WAoAAAAQAAAAxwAAxwAAQUxQSBQAAAABBxAREVCQtgFT//a7E9H/5P57CFZQOCB2AAAAUAwAnQEqyADIAD5tNplJpCMioSBIAIANiWlu4XaxG0AT2vRVwgyCGqpNdtouEGQQ1VJrttFwgyCGqpNdtouEGQQ1VJrttFwgyCGqpNdtouEGQQ1VJrttFwgyCGqpNdtouEGQQ1VJrttFnAAA/v/WAAAAAAAAAA==";
  // Error Message
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

  // Type Control
  if ($plogo_ == $empty_logo) {
    $errorMessage .= "<li>".$GLOBALS["alert_fill_logo"]."</li>";
  }
  
  // Return Error Message
  return $errorMessage;
}

?>