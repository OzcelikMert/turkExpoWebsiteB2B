<?php
include_once("./config/config.php");
session_start();
$email = $_SESSION["email"];
$id = GetID($conn, $email);

$GLOBALS["alert_pls_fill_slogan"] = _alert_tel1_verylong;
$GLOBALS["alert_pls_fill_adress"] = _alert_pls_fill_adress;
$GLOBALS["alert_fill_country"] = _alert_fill_country;
$GLOBALS["alert_pls_fill_city"] = _alert_pls_fill_city;
$GLOBALS["alert_pls_fill_postcode"] = _alert_pls_fill_postcode;
$GLOBALS["alert_postcode_verylong"] = _alert_postcode_verylong;

$GLOBALS["alert_website_verylong"]= _alert_website_verylong;
$GLOBALS["alert_pls_fill_cname"]= _alert_pls_fill_cname;
$GLOBALS["alert_enter_valid_url"]= _alert_enter_valid_url;
$GLOBALS["alert_adress_verylong"] = _alert_adress_verylong;

$GLOBALS["alert_tel1_veryshort"] = _alert_tel1_veryshort;
$GLOBALS["alert_pls_fill_tel1"] = _alert_pls_fill_tel1;
$GLOBALS["alert_tel1_verylong"] = _alert_tel1_verylong;
$GLOBALS["alert_pls_enter_vaalid_tel1"] = _alert_pls_enter_vaalid_tel1;
$GLOBALS["alert_pls_enter_vaalid_tel2"] = _alert_pls_enter_vaalid_tel2;

$GLOBALS["alert_pls_eneter_valid_country"] = _alert_pls_eneter_valid_country;
$GLOBALS["alert_city_very_long"] = _alert_city_very_long;
$GLOBALS["error"] = _error;
$GLOBALS["alert_pls_fill_user_name"] = _alert_pls_fill_user_name;
$GLOBALS["alert_username_verylong"] = _alert_username_verylong;


/* Get values */
if($_POST["form_value"] == "profile"){
    $name = safe($_POST['user_name']);
    $website = safe($_POST['website']);
    $address = safe($_POST['address']);
    $country = safe($_POST['country']);
    $postcode = safe($_POST['postcode']);
    $city = safe($_POST['city']);
    $tel_1 = filter_var(safe($_POST['tel']), FILTER_SANITIZE_NUMBER_INT);
    $tel_1_country =  filter_var(safe($_POST['tel_1_country']), FILTER_SANITIZE_NUMBER_INT);

    // Get error message && Value control
    $errorMessage = "";
    $errorMessage .= valueControl($conn, $name, $website, $address, $country, $city, $postcode,$tel_1, $tel_1_country);
    // end Get error message

    // Saving DB in Business
    if(empty($errorMessage)){
        update_profile($conn, $id, $name, $website, $address, $country, $city, $postcode, $tel_1, $tel_1_country);
    }else{
        $ErrorMessage_show = '
        <div class="alert alert-danger col-md-12" role="alert" id="notes">
            <ul style="margin-bottom:0px;">
                '.$errorMessage.'
            </ul>
        </div>
        ';
    }
}


/* Update function */
function update_profile($connect, $id_, $username, $website_, $address_, $country_, $city_, $postcode_, $tel_1_, $tel_1_country_){
    // Update Profile Command
    $sql = "update company_info set 
    user_name = '$username',
    website_url = '$website_',
    address = '$address_',
    country = '$country_',
    city = '$city_',
    post_code = '$postcode_',
    tel_1 = '$tel_1_',
    tel_1_country = '$tel_1_country_'
    where id = $id_";
    // Update Profile Query
    if(mysqli_query($connect, $sql)){
        echo "<script>document.location.href = 'profile.php';</script>";
    }else{echo "<script>alert('".$GLOBALS["error"]."')</script>";}
}


 

// Values Control
function valueControl($connect, $username_, $website_, $address_, $country_, $city_, $postcode_, $tel_1_, $tel_1_country_){
    /* Message*/  $errorMessage = "";
    // Company Control
    if (empty($username_)){
        $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_user_name"]."</li>";
    }else if(strlen($username_) > 50){
        $errorMessage .= "<li>".$GLOBALS["alert_username_verylong"]."</li>";
    }


    // Website Control
    if (!empty($website_)) {
        if(strlen($website_) > 75){
            $errorMessage .= "<li>".$GLOBALS["alert_website_verylong"]."</li>";
        }else if (!filter_var($website_, FILTER_VALIDATE_URL)) {
            $errorMessage .= "<li>".$GLOBALS["alert_enter_valid_url"]."</li>";
        }
    }

    // Address Control
    if (empty($address_)) {
        $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_adress"]."</li>";
    }else if(strlen($address_) > 150){
        $errorMessage .= "<li>".$GLOBALS["alert_adress_verylong"]."</li>";
    }

    // Country Control
    if (empty($country_)) {
        $errorMessage .= "<li>".$GLOBALS["alert_fill_country"]."</li>";
    }else if(!countryControl($connect, $country_)){
        $errorMessage .= "<li>".$GLOBALS["alert_pls_eneter_valid_country"]."</li>";
    }

    // City Control
    if (empty($city_)) {
        $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_city"]."</li>";
    }else if(strlen($city_) > 30){
        $errorMessage .= "<li>".$GLOBALS["alert_city_very_long"]."</li>";
    }

    // Postcode Control
    if (empty($postcode_)) {
        $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_postcode"]."</li>";
    }else if(strlen($postcode_) > 15){
        $errorMessage .= "<li>".$GLOBALS["alert_postcode_verylong"]."</li>";
    }

    // Tel 1 Control
    if (empty($tel_1_)){
        $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_tel1"]."</li>";
    }else if(strlen($tel_1_) > 10){
        $errorMessage .= "<li>".$GLOBALS["alert_tel1_verylong"]."</li>";
    }else if(strlen($tel_1_) < 10){
        $errorMessage .= "<li>".$GLOBALS["alert_tel1_veryshort"]."</li>";
    }else if(!filter_var($tel_1_, FILTER_SANITIZE_NUMBER_INT)){
        $errorMessage .= "<li>".$GLOBALS["alert_pls_enter_vaalid_tel1"]."</li>";
    }
    
    // Return Message
    return $errorMessage;
}
// end Values Control

// Country Control
function countryControl($connect, $country_){
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

?>