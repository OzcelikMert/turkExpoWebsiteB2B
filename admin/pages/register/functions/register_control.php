<?php

require_once("./config/config.php");
require_once("./inc/send_smtp_mail.php");

//Langue Globals START
    $GLOBALS["alert_pls_fill_cname"]= _alert_pls_fill_cname;
    $GLOBALS["alert_cname_verylong"] = _alert_cname_verylong;
    $GLOBALS["alert_pls_fill_adress"] = _alert_pls_fill_adress;
    $GLOBALS["alert_adress_verylong"] = _alert_adress_verylong;
    $GLOBALS["alert_pls_fill_postcode"] = _alert_pls_fill_postcode;
    $GLOBALS["alert_postcode_verylong"] = _alert_postcode_verylong;
    $GLOBALS["alert_website_verylong"]= _alert_website_verylong;
    $GLOBALS["alert_enter_valid_url"]= _alert_enter_valid_url;
    $GLOBALS["alert_tel1_veryshort"] = _alert_tel1_veryshort;
    $GLOBALS["alert_pls_fill_tel1"] = _alert_pls_fill_tel1;
    $GLOBALS["alert_tel1_verylong"] = _alert_tel1_verylong;
    $GLOBALS["alert_pls_fill_tel2"] = _alert_pls_fill_tel2;
    $GLOBALS["alert_pls_enter_vaalid_tel1"] = _alert_pls_enter_vaalid_tel1;
    $GLOBALS["alert_pls_enter_vaalid_tel2"] = _alert_pls_enter_vaalid_tel2;
    $GLOBALS["alert_tel2_verylong"] = _alert_tel2_verylong;
    $GLOBALS["alert_fill_country"] = _alert_fill_country;
    $GLOBALS["alert_pls_eneter_valid_country"] = _alert_pls_eneter_valid_country;
    $GLOBALS["alert_pls_fill_city"] = _alert_pls_fill_city;
    $GLOBALS["alert_city_very_long"] = _alert_city_very_long;
    $GLOBALS["alert_pls_fill_password"] = _alert_pls_fill_password;
    $GLOBALS["alert_password_verylong"] = _alert_password_verylong;
    $GLOBALS["alert_pls_fill_repassword"] = _alert_pls_fill_repassword;
    $GLOBALS["alert_password_not_same"] = _alert_password_not_same;
    $GLOBALS["alert_pls_fill_email"] = _alert_pls_fill_email; 
    $GLOBALS["alert_email_verylong"] = _alert_email_verylong; 
    $GLOBALS["alert_enter_valid_email"] = _alert_enter_valid_email; 
    $GLOBALS["select_account_type"] = _select_account_type;

    $GLOBALS["alert_email_already_registered"] = _alert_email_already_registered;
    $GLOBALS["alert_username_very_long"] = _alert_username_very_long;

    
//Langue Globals END

// POST Control
if($_POST){
    // Values
    $company_name = isset($_POST['company_name']) ? safe($_POST['company_name']) : "";
    $email = isset($_POST['email']) ? safe($_POST['email']) : "";
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    $tel_1 = isset($_POST['tel_1']) ? safe($_POST['tel_1']) : "";
    $tel_1 = filter_var($tel_1, FILTER_SANITIZE_NUMBER_INT);
    $tel_1_country = isset($_POST['tel_1_country']) ? safe($_POST['tel_1_country']) : "";

    $tel_2 = isset($_POST['tel_2']) ? safe($_POST['tel_2']) : "";
    $tel_2 = filter_var($tel_2, FILTER_SANITIZE_NUMBER_INT);
    $tel_2_country = isset($_POST['tel_2_country']) ? safe($_POST['tel_2_country']) : "";

    $website = isset($_POST['website']) ? safe("https://".$_POST['website']) : "";
    $website = filter_var($website, FILTER_SANITIZE_URL);

    $pass = isset($_POST['pass']) ? safe($_POST['pass']) : "";
    $pass_re = isset($_POST['pass_re']) ? safe($_POST['pass_re']) : "";

    $address = isset($_POST['address']) ? safe($_POST['address']) : "";
    $country = isset($_POST['country']) ? safe($_POST['country']) : "";
    $city = isset($_POST['city']) ? safe($_POST['city']) : "";
    $postcode = isset($_POST['postcode']) ? safe($_POST['postcode']) : "";
    $username = isset($_POST['user_name']) ? safe($_POST["user_name"]): "";
    $select_type = isset($_POST['account_type']) ? safe($_POST["account_type"]) :"" ;
    // end Values


    // Get error message
    $errorMessage = "";
    /* Value control */
    $errorMessage .= valueControl($conn, $company_name, $email, $tel_1, $tel_1_country, $tel_2, $tel_2_country, $pass, $pass_re, $address, $country, $city, $postcode, $website,$username,$select_type);
    /* Email control */
    if(empty($errorMessage)){
        $errorMessage .= emailControl($conn, $email);
    }
    // end Get error message

    // Saving DB in Business
    if(empty($errorMessage)){
        $account_confirm_code = rand(100000, 999999);
        if ($select_type==1) {
            $tel_1_country = "90";
            $tel_2_country = "90";
        }
        register_company($conn, $company_name, $email, $tel_1, $tel_1_country, $tel_2, $tel_2_country, $pass, $address, $country, $city, $postcode, $website, $account_confirm_code,$username,$select_type);
    }else{
        $ErrorMessage_show = '
        <div class="alert alert-danger col-md-12" role="alert" id="notes">
            <ul style="margin-bottom:0px;">
                '.$errorMessage.'
            </ul>
        </div>
        ';
    }

    // end Saving DB in Business
}

// end POST Control

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

// Control Seo Url
function controlSeoName($connect, $seoName){
    $sql = "select * from company_info where seo_company_name = '$seoName'";
    $query = mysqli_query($connect, $sql);
    if(mysqli_num_rows($query) > 0){
        return true;
    }else {
        return false;
    }
}

//  end Control Seo Url

// GET ip
function GetIP(){
    if(getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } else if(getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode (',', $ip);
            $ip = trim($tmp[0]);
        }
    } else {
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}

// end GET ip
// Save Company Function
function register_company($connect, $company_name_, $email_, $tel_1_, $tel_1_country_, $tel_2_, $tel_2_country_, $pass_, $address_, $country_, $city_, $postcode_, $website_, $random_code, $username_,$select_type_){
    // Mail Owner Info
    $owner_email = "info@ozceliksoftware.com";
    $owner_name = "Özçelik Software";
    // Get ip, date, convert seo url and md5 pass

    $self_ip = GetIP();
    $date = date("Y-m-d H:i:s");
    $seoURL = ($select_type_ == 1) ? convertUrl($connect, $company_name_): null;
    $company_name_ = ($select_type_ == 1) ? $company_name_ : null;
    $pass_ = md5($pass_);
    // end Get ip, date, convert seo url and md5 pass

    // Database query
    $sql = "insert into company_info(company_name, seo_company_name, email, pass, tel_1, tel_1_country, tel_2, tel_2_country, address, country, post_code, city, website_url, self_ip, register_date, verify_code,user_name,type)
    values('$company_name_', '$seoURL', '$email_', '$pass_', '$tel_1_', '$tel_1_country_', '$tel_2_', '$tel_2_country_', '$address_', '$country_', '$postcode_', '$city_', '$website_', '$self_ip', '$date', '$random_code','$username_',$select_type_)";
    if(mysqli_query($connect, $sql)){
        // True all items. Sent values to db
        // Set Message Company
        $message = "<h2 style='color: green;'>Thank you for registering on our site !</h2><br />";
        $message .= "<hr>";
        $message .= "Your Verification Code: <b style='color: darkred;'>".$random_code."</b>";
        if(sendMail_smtp($email_, $message, $company_name_, "Verification Code")){ /* Ok */ }
        // end Set Message Company

        // Set Message Owner
        $message = "<h2 style='color: green;'>1 new company registering!</h2><br />";
        $message .= "<hr>";
        $message .= "<h4>
        Company name: ".$company_name_."<br>
        Company email: ".$email_."<br>
        Company tel: (".$tel_1_country_.")".$tel_1_."<br>
        Company website: ".$website_."</h4>";

        if(sendMail_smtp($owner_email, $message, $owner_name, "New Registered")){ /* Ok */ }  // end Set Message Owner
        // Going to dashboard
        session_start();
        $_SESSION['email'] = $email_;
        session_regenerate_id();
        $_SESSION['password'] = $pass_;
        session_regenerate_id();
        header("Location: dashboard.php");
        // end Going to dashboard

    }else{
        // Error Message
        $message = "<h2>Mysql error!</h2><br>";
        $message .= "<h4>Date: $date</h2><br>";
        $message .= "<h4>Ip Address: $self_ip</h2><br>";
        $message .= "<h4>Error Comment: ".mysqli_error($connect)."</h2><br>";
        $message .= "<h4>Company Name: ".$company_name_."</h2><br>";
        $message .= "<h4>Company Email: ".$email_."</h2><br>";
        $message .= "<h4>Company Tel: ".$tel_1_."</h2><br>";
        if(sendMail_smtp("info@ozceliksoftware.com", $message, "Özçelik Software", "Add New Company Error")){ /* Ok */ }
        // end Error Message
    }
    // end Database query
}
// end Save Company Function


// Values Control
function valueControl($connect ,$company_name_, $email_, $tel_1_, $tel_1_country_, $tel_2_, $tel_2_country_, $pass_, $pass_re_, $address_, $country_, $city_, $postcode_, $website_,$username_,$select_type_){
    $errorMessage = "";

    if (empty($select_type_)) {
        $errorMessage .= "<li>".$GLOBALS["select_account_type"]."!</li>";
    }else{

        if ($select_type_== 1) {
            //Bussines Account
            // Company Control
            if (empty($company_name_)){
                $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_cname"]."!</li>";
            }else if(strlen($company_name_) > 75){
                $errorMessage .= "<li>".$GLOBALS["alert_cname_verylong"]."!</li>";
            }
            if(strlen($username_) >= 50){
                $errorMessage .= "<li>".$GLOBALS["alert_username_very_long"]."!</li>";
            }
        }else if($select_type_== 2){
            //User Account
            $company_name_ = null;
        }else{
            $errorMessage .= "<li>".$GLOBALS["select_account_type"]."!</li>";
        }
    }


    // Email Control
    if (empty($email_)) {
        $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_email"]."! (0x003)</li>";
    }else if(strlen($email_) > 100){
        $errorMessage .= "<li>".$GLOBALS["alert_email_verylong"]."! (0x004)</li>";
    }else if(!filter_var($email_, FILTER_VALIDATE_EMAIL)){
        $errorMessage .= "<li>".$GLOBALS["alert_enter_valid_email"]."! (0x005)</li>";

    }

    // Tel 1 Control
    if (empty($tel_1_)){
        $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_tel1"]."! (0x006)</li>";
    }else if(strlen($tel_1_) > 10){
        $errorMessage .= "<li>".$GLOBALS["alert_tel1_verylong"]."! (0x007)</li>";
    }else if(strlen($tel_1_) < 10){
        $errorMessage .= "<li>".$GLOBALS["alert_tel1_veryshort"]."! (0x008)</li>";
    }else if(!filter_var($tel_1_, FILTER_SANITIZE_NUMBER_INT)){
        $errorMessage .= "<li>".$GLOBALS["alert_pls_enter_vaalid_tel1"]."! (0x009)</li>";
    }


    // Tel 1 Country Control
    if (!countryTelControl($connect, $tel_1_country_)) {
        $errorMessage .= "<li>Please enter a valid tel-1 code!</li>";
    }

    // Tel 2 Control
    if (!empty($tel_2_)){
        if(strlen($tel_2_) > 10){
            $errorMessage .= "<li>".$GLOBALS["alert_tel2_verylong"]."! (0x0010)</li>";
        }else if(strlen($tel_2_) < 10){
            $errorMessage .= "<li>".$GLOBALS["alert_tel2_veryshort"]."</li>";
        }else if(!filter_var($tel_2_, FILTER_SANITIZE_NUMBER_INT)){
            $errorMessage .= "<li>".$GLOBALS["alert_pls_enter_vaalid_tel2"]."! (0x0011)</li>";
        }
    }

    // Tel 2 Country Control
    if (!countryTelControl($connect, $tel_2_country_)) {
        $errorMessage .= "<li>Please enter a valid tel-2 code!</li>";
    }

    // Password Control
    if (empty($pass_)) {
        $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_password"]."! (0x0012)</li>";
    }else if(strlen($pass_) > 30){
        $errorMessage .= "<li>".$GLOBALS["alert_password_verylong"]."! (0x0013)</li>";
    }

    // Confirm Password Control
    if (empty($pass_re_)) {
        $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_repassword"]."! (0x0014)</li>";
    }else if($pass_re_ != $pass_){
        $errorMessage .= "<li>".$GLOBALS["alert_password_not_same"]."! (0x0015)</li>";
    }

    // Address Control
    if (empty($address_)) {
        $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_adress"]."! (0x0016)</li>";
    }else if(strlen($address_) > 150){
        $errorMessage .= "<li>".$GLOBALS["alert_adress_verylong"]."! (0x0017)</li>";
    }

    // Country Control
    if ($select_type_ == 2) {
        if (empty($country_)) {
            $errorMessage .= "<li>".$GLOBALS["alert_fill_country"]."</li> (0x0018)";
        }else if(!countryControl($connect, $country_)){
            $errorMessage .= "<li>".$GLOBALS["alert_pls_eneter_valid_country"]."! (0x0019)</li>";
        }
    }


    // City Control
    if (empty($city_)) {
        $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_city"]."! (0x0020)</li>";
    }else if(strlen($city_) > 30){
        $errorMessage .= "<li>".$GLOBALS["alert_city_very_long"]."! (0x0021)</li>";
    }

    // Postcode Control
    if (empty($postcode_)) {
        $errorMessage .= "<li>".$GLOBALS["alert_pls_fill_postcode"]."! (0x0022)</li>";
    }else if(strlen($postcode_) > 15){
        $errorMessage .= "<li>".$GLOBALS["alert_postcode_verylong"]."! (0x0023)</li>";
    }

    // Website Control
    if (!empty($website_)) {
        if(strlen($website_) > 75){
            $errorMessage .= "<li>".$GLOBALS["alert_website_verylong"]."! (0x0024)</li>";
        }else if (!filter_var($website_, FILTER_VALIDATE_URL)) {
            $errorMessage .= "<li>".$GLOBALS["alert_enter_valid_url"]."! (0x0025)</li>";
        }
    }

    // Return Message
    return $errorMessage;
}

// end Values Control



// Email Control
function emailControl($connect, $email_){
    // Error message
    $errorMessage = "";
    // Control email
    $sql = "select * from company_info where email = '".$email_."'";
    $query = mysqli_query($connect, $sql);
    if(mysqli_num_rows($query) > 0){
        $errorMessage .= "<li>".$GLOBALS["alert_email_already_registered"]." (0x0020)</li>";
    }
    // Return error message
    return $errorMessage;
}

// end Email Control
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
        return true;
    }else {
        return false;
    }
}

// end Country Tel Control

?>