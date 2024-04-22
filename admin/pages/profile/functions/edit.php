<?php
include_once("./config/config.php");
session_start();
$email = $_SESSION["email"];
$id = GetID($conn, $email);

$GLOBALS["alert_pls_fill_slogan"] = _alert_tel1_verylong;
$GLOBALS["alert_slogan_verylong"] = _alert_slogan_verylong;
$GLOBALS["alert_cname_verylong"] = _alert_cname_verylong;
$GLOBALS["alert_about_verylong"] = _alert_about_verylong;
$GLOBALS["alert_cname_verylong"] = _alert_cname_verylong;
$GLOBALS["alert_about_verylong"] = _alert_about_verylong;
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
$GLOBALS["alert_pls_fill_tel2"] = _alert_pls_fill_tel2;
$GLOBALS["alert_pls_enter_vaalid_tel1"] = _alert_pls_enter_vaalid_tel1;
$GLOBALS["alert_pls_enter_vaalid_tel2"] = _alert_pls_enter_vaalid_tel2;
$GLOBALS["alert_tel2_verylong"] = _alert_tel2_verylong;
 
$GLOBALS["alert_pls_eneter_valid_country"] = _alert_pls_eneter_valid_country;
$GLOBALS["alert_city_very_long"] = _alert_city_very_long;
$GLOBALS["alert_tel2_verylong"] = _alert_tel2_verylong;
$GLOBALS["alert_tel2_verylong"] = _alert_tel2_verylong;

$GLOBALS["alert_fill_subcategory"] = _alert_fill_subcategory;
$GLOBALS["alert_activity_verylong"] = _alert_activity_verylong;
$GLOBALS["alert_employess_count_verylong"] = _alert_employess_count_verylong;
$GLOBALS["alert_business_count_verylong"] = _alert_business_count_verylong;
$GLOBALS["alert_pls_enter_vaild_employess_count"] = _alert_pls_enter_vaild_employess_count;
$GLOBALS["alert_pls_enter_vaild_bussines_count"] = _alert_pls_enter_vaild_bussines_count;

/* Get values */
if($_POST["form_value"] == "profile"){
    $name = safe($_POST['c_name']);
    $website = safe($_POST['website']);
    $address = safe($_POST['address']);
   // $country = safe($_POST['country']);
    $country = "222";
    $postcode = safe($_POST['postcode']);
    $activity = safe($_POST['activity']);
    $city = safe($_POST['city']);
    $about = safe($_POST['about']);
    $tel_1 = filter_var(safe($_POST['tel']), FILTER_SANITIZE_NUMBER_INT);
    $tel_1_country =  filter_var(safe($_POST['tel_1_country']), FILTER_SANITIZE_NUMBER_INT);
    $tel_2 = filter_var(safe($_POST['tel2']), FILTER_SANITIZE_NUMBER_INT);
    $tel_2_country = filter_var(safe($_POST['tel_2_country']), FILTER_SANITIZE_NUMBER_INT);
    $subcategoryID = filter_var(safe($_POST['sub_category']), FILTER_SANITIZE_NUMBER_INT);
    $employees = filter_var(safe($_POST['ecount']), FILTER_SANITIZE_NUMBER_INT);
   // $business = filter_var(safe($_POST['bcount']), FILTER_SANITIZE_NUMBER_INT);
   // $slogan = safe($_POST['slogan']);

    // Get error message && Value control
    $errorMessage = "";
    $errorMessage .= valueControl($conn, $name, $about, $website, $address, $country, $city, $postcode,$tel_1, $tel_1_country, $tel_2, $tel_2_country, $subcategoryID, $activity, $employees);
    // end Get error message

    // Saving DB in Business
    if(empty($errorMessage)){
        update_profile($conn, $id, $name, $about, $website, $address, $country, $city, $postcode, $tel_1, $tel_1_country, $tel_2, $tel_2_country, $subcategoryID, $activity, $employees,$editlang);
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
function update_profile($connect, $id_, $company_name_, $about_, $website_, $address_, $country_, $city_, $postcode_, $tel_1_, $tel_1_country_, $tel_2_, $tel_2_country_,$subcategoryID_, $activity_, $employees_,$editlang){
    $langdata =  lang_check(safe($_POST["profile_update_lang"]));
      $sql = "select * from company_info where id= $id_";
      $query = mysqli_query($connect, $sql);
      if ($row = mysqli_fetch_array($query)) {
          $old_company_name = $row["company_name"];
          $seo_name = $row["seo_company_name"];
      }
      // And make names comparison
      if ($company_name_ != $old_company_name) {
          $seo_name = convertUrl($connect, $company_name_);
      }

    // Update Profile Command
    $sql = "update company_info set 
    company_name = '$company_name_',
    seo_company_name = '$seo_name',
    about$langdata = '$about_',
    website_url = '$website_',
    address = '$address_',
    country = '$country_',
    city = '$city_',
    post_code = '$postcode_',
    tel_1 = '$tel_1_',
    tel_1_country = '$tel_1_country_',
    tel_2 = '$tel_2_',
    tel_2_country = '$tel_2_country_',
    sub_category = '$subcategoryID_',
    activity$langdata = '$activity_',
    employees_count = '$employees_' 
    where id = $id_";
    // Update Profile Query
    if(mysqli_query($connect, $sql)){
        echo "<script>document.location.href = 'profile.php';</script>";
    }else{echo "<script>alert('Hata')</script>";}
}



// Convert Seo Url
function convertUrl($connect, $url) {
  // Convert Seo Url
  $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',','!');
  $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','');
  $url = str_replace($tr, $eng, $url);
  $url = strtolower($url);
  $url = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $url);
  $url = preg_replace('/\s+/', '-', $url);
  $url = preg_replace('|-+|', '-', $url);
  $url = preg_replace('/#/', '', $url);
  $url = str_replace('.', '', $url);
  $url = str_replace("'", '', $url);
  $url = trim($url, '-');
  // end Convert Seo Url
  
  // Seo Url Control
  $new_url = $url;
  $number = 2;
  while(controlSeoName($connect, $new_url)){
      $new_url = $url . $number; 
      $number++;
  }
  // end Seo Url Control

  return $new_url;
}
// end Convert Seo Url

// Control Seo Url in covertUrl()
function controlSeoName($connect, $seoName){
  $sql = "select * from company_info where seo_company_name = '$seoName'";
  $query = mysqli_query($connect, $sql);
  if(mysqli_num_rows($query) > 0){
      return true;
  }else {
      return false;
  }
}
//  end Control Seo Url in covertUrl()

// Subcategory Control
function categorysControl($connect, $subcategoryID_){
  session_start();
  $email_ = $_SESSION["email"];
  $id_ = GetID($connect, $email_);
  // find Subcategory in self subcategory control
  //echo "<script>alert('$email_, $id_');</script>";
  $sql="SELECT * FROM company_info WHERE id = $id_";
  $go=mysqli_query($connect, $sql);
  if( $data=mysqli_fetch_assoc($go) ){
    $main_categoryID = $data["main_category"];
  }

  $sql2 = "select * from sub_categorys where mcid = '".$main_categoryID."' and row = $subcategoryID_";
  $query = mysqli_query($connect, $sql2);
  if(mysqli_num_rows($query) > 0){
    return true;
  }else{
    return false;
  }
}
// end Subcategory Control
  

 

// Values Control
function valueControl($connect, $company_name_, $about_, $website_, $address_, $country_, $city_, $postcode_, $tel_1_, $tel_1_country_, $tel_2_, $tel_2_country_, $subcategoryID_, $activity_, $employees_){
    /* Message*/  $errorMessage = "";
    // Company Control
    if (empty($company_name_)){
        $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_cname"]."</li>";
    }else if(strlen($company_name_) > 200){
        $errorMessage .= "<li>".$GLOBALS["alert_cname_verylong"]."</li>";
    }

    // About Control
    if (!empty($about_)){
        if(strlen($about_) > 2000){
            $errorMessage .= "<li>".$GLOBALS["alert_about_verylong"]."</li>";
        }
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

    // Tel 2 Control
    if (!empty($tel_2_)){
        if(strlen($tel_2_) > 10){
            $errorMessage .= "<li>".$GLOBALS["alert_tel2_verylong"]."</li>";
        }else if(strlen($tel_2_) < 10){
            $errorMessage .= "<li>".$GLOBALS["alert_tel2_veryshort"]."</li>";
        }else if(!filter_var($tel_2_, FILTER_SANITIZE_NUMBER_INT)){
            $errorMessage .= "<li>".$GLOBALS["alert_pls_enter_vaalid_tel2"]."</li>";
        }
    }

/*
    // Tel 1 Country Control
    if (!countryTelControl($connect, $tel_1_country_)) {
        $errorMessage .= "<li>".$GLOBALS["alert_pls_enter_vaalid_tel1"]."</li>";
    }
    // Tel 2 Country Control
    if (!empty($tel_2_country_)) {
        if (!countryTelControl($connect, $tel_2_country_)) {
            $errorMessage .= "<li>".$GLOBALS["alert_pls_enter_vaalid_tel2"]."</li>";
        }
    }
*/
    // Sub Category Control
    if (!empty($subcategoryID_)){
        if(!categorysControl($connect, $subcategoryID_)){
            $errorMessage = "<li>".$GLOBALS["alert_fill_subcategory"]."</li>";
        }
    }


    // Activity Control
    if (!empty($activity_)){
        if(strlen($activity_) > 200){
            $errorMessage .= "<li>".$GLOBALS["alert_activity_verylong"]."</li>";
        }
    }

    // Employees Control
    if (!empty($employees_)){
        if(strlen($employees_) > 11){
            $errorMessage .= "<li>".$GLOBALS["alert_employess_count_verylong"]."</li>";
        }else if(!filter_var($employees_, FILTER_SANITIZE_NUMBER_INT)){
            $errorMessage .= "<li>".$GLOBALS["alert_pls_enter_vaild_employess_count"]."</li>";
        }
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

// Country Tel Control
function countryTelControl($connect, $country_tel_){
    // Control Tel Country
    $sql = "select * from countrys where tel_code = '$country_tel_'";
    $query = mysqli_query($connect, $sql);
    if(mysqli_num_rows($query) > 0){
        echo '<script>alert("TRUE");</script>';
        return true;
    }else {
        echo '<script>alert("FALSE");</script>';
        return false;
    }
}
// end Country Tel Control
?>