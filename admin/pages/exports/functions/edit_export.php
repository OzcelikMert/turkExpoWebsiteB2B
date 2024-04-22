<?php
include_once("./config/config.php");
session_start();
/* Add function Export*/
$self_id = GetID($conn,$_SESSION['email']);
$GLOBALS["langdata"] = $langdata;
$GLOBALS["pls_fill_all_colums"] = _pls_fill_all_colums;

function add_export($connect,$id,$country,$price,$price_type_,$date){
$ssql = "insert into exports(cid, country, price, price_type, date) values('".$id."','".$country."','".$price."','".$price_type_."','".$date."')";
  if(mysqli_query($connect, $ssql)){
   // echo '<script>document.location.href = "profile.php";</script>';
  }else{echo '<script>alert(hata)</script>';}
}

/* Get values */
if($_POST["form_value"] == "export"){
  $coe_country = safe($_POST['coe_country']);
  $coe_price = safe($_POST['coe_price']); 
  $coe_price = filter_var($coe_price, FILTER_SANITIZE_NUMBER_INT);
  $coe_date = strval(safe($_POST['coe_date']));
  $price_type =   safe($_POST['money_type']);
  $errorMessage = "";
  $errorMessage .= valueControl_export($conn ,$coe_country,$coe_price, $coe_date, $price_type);

  if(empty($errorMessage)){
    add_export($conn, $self_id, $coe_country,$coe_price, $price_type, $coe_date);
  }else{
    $ErrorMessage_show_2 = '
    <div class="alert alert-danger col-md-12" role="alert" id="notes">
        <ul style="margin-bottom:0px;">
            '.$errorMessage.'
        </ul>
    </div>
    ';
  }
}

// Values Control
function valueControl_export($connect ,$coe_country_,$coe_price_, $coe_date_, $price_type_){

  if (empty($coe_country_)) {
    $errorMessage = "<li>".$GLOBALS["pls_fill_all_colums"]."!</li>";
  }else if(!countryControl_export($connect, $coe_country_)){
    $errorMessage = "<li>".$GLOBALS["pls_fill_all_colums"]."!</li>";
  }else if (empty($coe_price_)) {
    $errorMessage = "<li>".$GLOBALS["pls_fill_all_colums"]."!</li>";
  }else if(strlen($coe_price_)> 18){
    $errorMessage = "<li>".$GLOBALS["pls_fill_all_colums"]."!</li>";
  }else if (empty($coe_price_)) {
    $errorMessage = "<li>".$GLOBALS["pls_fill_all_colums"]."!</li>";
  }else if(strlen($coe_price_)> 9){
    $errorMessage = "<li>".$GLOBALS["pls_fill_all_colums"]."!</li>";
  }else  if (empty($coe_date_)) {
    $errorMessage = "<li>".$GLOBALS["pls_fill_all_colums"]."!</li>";
  }else if($coe_date_ > date("Y") || (int)$coe_date_ < 1980){
    $errorMessage = "<li>".$GLOBALS["pls_fill_all_colums"]."!</li>";
  }
  // Return Message
  return $errorMessage;
}
// end Values Control

// Country Control
function countryControl_export($connect, $country_){
  // Control Country
  $sql = "select * from countrys where id = $country_";
  $query = mysqli_query($connect, $sql);
  if(mysqli_num_rows($query) > 0){
      return true;
  }else {
      return false;
  }
}
// end Country Control
$Countrys = getCountry($conn, $id);
// Get Country

function getCountry($connect, $id_){
    $sql = "select * from company_info where id = ".(int)$id_."";
    $query = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($query)){
        $selectedCountry = $row["country"];
    }

    $countrys = "";
    $sql = "select * from countrys order by name asc";
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $selected = "";
        if ($selectedCountry == $row["id"]) {
            $selected = "selected";
        }
        $countrys .= "<option value='".$row["id"]."' $selected>".$row["name".$GLOBALS["langdata"]]."</option>";
    }
    return $countrys;
}


?>