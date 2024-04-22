<?php 
include_once("./admin/config/config.php");
session_start();

// Get Values
$GLOBALS["not_fill_about"] = _not_fill_about;
// Get $_GETS
$company_name =  htmlspecialchars(trim($_GET['company_name']));
$product_id = htmlspecialchars(strip_tags($_GET['product_id']));
$Company_Values = GetCompany_values($conn, $company_name,$langdata);
SetView_list($conn, $Company_Values["id"]);


// Get Company Values

function GetCompany_values($connect, $company_seo_name, $lang){
    $values = array();
    // Company Info
    $sql= "SELECT company_info.*, countrys.name as CountryName FROM `company_info` INNER JOIN countrys ON countrys.id = company_info.country WHERE company_info.seo_company_name = '$company_seo_name'";
    $query = mysqli_query($connect, $sql);
    if ($row = mysqli_fetch_array($query)) {
        $values["id"] = $row["id"];
        $values["name"] = $row["company_name"];
        $values["logo"] = $row["c_logo"];
        $values["about"] = $row["about".$lang];
        $values["activity"] = $row["activity".$lang];
        $values["country"] = $row["CountryName"];
        $values["address"] = $row["address"];
        $values["city"] = $row["city"];
        $values["post_code"] = $row["post_code"];
        $values["tel1"] = "+".$row["tel_1_country"]." ".$row["tel_1"];
        $values["tel2"] = "+".$row["tel_2_country"]." ".$row["tel_2"];
        $values["website"] = $row["website_url"];
        $values["email"] = $row["email"];
        $values["employees_count"] = $row["employees_count"];
        $values["banner"] =  $row["banner_image"];
        $contryValues =  GetlangueCompany($connect,$row["CountryName"]);
        $values["deflang"] = $contryValues["ShortCode"];
        // Page Lang Get Country Name
        $values["ProfileCountry"] = $contryValues["CountryName"];
      //  echo '<script>alert("'.$values["deflang"].' / '. $values["ProfileCountry"].'");</script>';
    }else {
       header("Location: ".$GLOBALS["URL_404"]."");
    }

    // Company View Info
    $count = 0;
	$sql = "select 
    count(view_list.cid) as Count_
    from view_list 
    INNER JOIN company_info ON view_list.cid = company_info.id 
    where company_info.seo_company_name = '$company_seo_name'";
	$query = mysqli_query($connect, $sql);
	if($row = mysqli_fetch_array($query)){
		$count = $row["Count_"];
    }
    $values["view"] = $count;
    return $values;
}
// end Get Company Values

// Get Exports
function GetExport_values($connect, $cid){
    $values = "";
    $sql = "SELECT exports.*, countrys.name as CountryName FROM `exports` INNER JOIN countrys ON countrys.id = exports.country where cid = '$cid' order by exports.date desc";
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
      $values .= '
      <tr>
      <td>'.$row["CountryName"].'</td>
      <td>'.$row["price"].' '.$row["price_type"].'</td>
      <td>'.$row["date"].'</td>
      </tr>
      ';

    }

    return $values;

}
// end Get Exports

// Get Products
function GetProduct_Values($connect, $company_seo_name, $cid,$langdata,$limit,$deflang){
    $values = "";
    if ($limit==1) {
        $product_next ='<a class="profile-product-links"  " href="/profile/'.$company_seo_name.'/products" >Diğer Ürünlerine Göz At</a>';
        $lmt = "LIMIT 4";
    }else{$lmt=""; $product_next =""; }
    $sql = 'SELECT * FROM products WHERE cid= '.$cid.' order by date desc '.$lmt.'';
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
        $id = $row["row"];
        //Title Boşsa Firmanın Default dilinde yazacak
        $title = (empty($row["title".$langdata])) ? $row["title".lang_check($deflang)]:$row["title".$langdata];
        $plogo =  $row["plogo"];
        $date = $row["date"];
        $values .= '
        <div style="margin-right: 30px;display: block;float:left;">
          <a href="/profile/'.$company_seo_name.'/view/'.$id.'">
            <div class="product-box text-center">
                <img style="border-radius:0 !important; width:140px" src="./images/products_images/'.$plogo.'" alt="">
                <h4>'.$title.'</h4>
                <p style="padding: 0;font-size: 11px;">'.$date.'</p>
            </div>
          </a> 
        </div>
        ';
    }
    return $values.$product_next;
}
// Get Product in Values
function GetProduct_viewValues($connect, $pid, $cid,$langdata,$deflang){
    $values = "";
    $slider_values = "";
    $sql= "SELECT * FROM `products` where row = ".(int)$pid." and cid = '$cid'";
    $query = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($query)){
        $title =lang_value_control($row["title".$langdata],$row["title".lang_check($deflang)]);
        $type = lang_value_control($row["type".$langdata],$row["title".lang_check($deflang)]);
        $desc = lang_value_control($row["description".$langdata],$row["title".lang_check($deflang)]);
        $logo = $row["plogo"];
        $images = $row["images"];
        $date = $row["date"];
        $images = explode(",", $images);
        // Big Image (Top Image)

        $slider_values .= '
        <!-- Swiper -->
        <div class="swiper-container gallery-top">
            <div class="swiper-wrapper">
        ';

        if(strlen($images[0]) > 0){
            foreach ($images as $value) {
                if(strlen($value) > 5){
                    $slider_values .= '<div class="swiper-slide" style="background-image:url(./images/products_images/'.$value.')"></div>';
                }
            }
            $slider_enable = true;
        }else {
            $slider_values .= '<div class="swiper-slide" style="background-image:url(./images/noimage.png)"></div>';
            $slider_enable = false;
        }

        $slider_values_end .= '
            </div>
            <div class="swiper-button-next swiper-button-white"></div>
            <div class="swiper-button-prev swiper-button-white"></div>
        </div>
        ';

        // Small Images (Bottom Images)
        $slider_values .= '
        <!-- Add Arrows -->
        <div class="swiper-container gallery-thumbs">
            <div class="swiper-wrapper">
        ';

        if(strlen($images[1]) > 0){
            foreach ($images as $value) {
                if(strlen($value) > 5){
                    $slider_values .= '<div class="swiper-slide" style="background-image:url(./images/products_images/'.$value.')"></div>';
                }else{
                    $slider_values .= '<div class="swiper-slide"></div>';
                    
                }
            }
        }

        $slider_values .= '
            </div>
        </div>
        <!-- Initialize Swiper -->
        ';

        // Product Infos

        $values .= '
        <div class="view">
            <div class="view-sss">
                <div class="view-s">
                <img src="./images/products_images/'.$logo.'" alt="'.$title.'" title="'.$title.'">
                </div>
                <div class="view-ss">
                <h4>'.$title.'</h4>  <br>
                <h5><B>'._date.'</B> : '.$date.'</h5>
                </div>
            </div>';
            if ($slider_enable) {
                $values .= '
                <div class="view-slider"> 
                <h4 style="text-align: center;display: block;padding: 15px;">Product Images</h4>
                '.$slider_values.'
                </div></div></div>';
            }else{
                $values .= '<!---!></div></div><!---!>';
            }
            $values .= ' 
            <div class="view-last">
                <p><b style="font-size:22px;display: block;">'._description.'</b> <br>'.$desc.'</p>
            </div>
        </div>
        ';

    }
    return $values;
}
// end Get Product in Values
function GetEvent_Values($connect, $company_seo_name, $cid,$langdata,$limit,$deflang){
    $values = '<div class="profile-about-left"><h3>'._write_event.'</h3><!--h4></h4--></div>';
    $sql = 'SELECT * FROM events WHERE cid= '.$cid.' order by date desc LIMIT 5';
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
        if(!empty($row["title".$langdata])){
        $title = $row["title".$langdata];
        $date = $row["date"];
        $des = $row["message".$langdata];
        $values .= '
        <div class="col-md-12" style="display: block;float:left; word-break: break-all;">
            <div class="product-box text-center" style="border: 2px dashed #181d2e45;">
                <h4 style="width:100%; padding:0px 10px;background:transparant" >'.$title.'</h4>
                <p style="padding: 5px;font-size: 12px; ">'.$des.'</p>
                <p style="padding: 0px;font-size: 10px;">'.$date.'</p>
            </div>
        </a> 
        </div>
        ';
        }else{
            $value ="";
        }
    }


    return $values;
}

// Get Contact Values
function GetContact_Values($id, $name, $email, $tel, $tel2, $address, $city, $country, $postcode, $web,$define){
    $login_url = "admin/index.php?";
    $contact .= '<p style="font-size: 16px;"><b><i class="fa fa-map-marker"></i></b>  '.$address.' </p><p>'.$postcode.' '.$city.' '.$country.'</p>';
    // $contact .= '<p><b>'.$define["country"].'</b> : '.$country.'</p>';
    // $contact .= '<p><b>'.$define["city"].'</b> : '.$city.'</p>';
    // $contact .= '<p><b></b> : '.$postcode.'</p>';
    $contact .= '<p class="profile-contact-link"><i class="fa fa-link"></i> </b>  <a target="_blank" href="'.$web.'">'.$web.'</a></p>';
    //Session Control
    if(filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)){
    // $contact .='<p>'.$define["email"].' : <a target="_blank" href="mailto:'.$email.'">'.$email.'</a></p>';
        $contact .='<p class="btn btn-secondary profile-click-tel">'.$define["phone"].' : <a href="tel:'.$tel.'">'.$tel.'</a></p>';
        if (strlen($tel2) > 5) {
            $contact .='<p class="btn btn-secondary profile-click-tel">WhatsApp '.$define["phone"].' : <a  href="tel:'.$tel2.'">'.$tel2.'</a></p>'; 
        }
        $contact .= '<a class="btn btn-success profile-send-message" href="admin/newmessage.php?title=&email='.$email.'" id="msg-send">'.$define["send_msg"].'</a>';
    }else{
    // $contact .='<p>'.$define["email"].' : <a target="_blank" href="'.$login_url.'">'.$define["login_view"].'</a></p>';
        $contact .='<p class="btn btn-secondary profile-click-tel">'.$define["phone"].' : <a  href="'.$login_url.'">'.$define["login_view"].'</a></p>';
    }
    return $contact;
}
// end Get Contact Values
// Set View List (Viewed Count)
function SetView_list($connect, $cid){
    $ip = GetIP();
    $date = date("Y-m-d");
    $sql= "SELECT * FROM `view_list` WHERE cid = '$cid' and ip_address = '$ip' and date ='$date'";
    $go = mysqli_query($connect,$sql);
    if(mysqli_num_rows($go) < 1){
    $sql_in = "INSERT INTO `view_list`(cid, ip_address, date) VALUES ('$cid', '$ip', '$date')";
    mysqli_query($connect, $sql_in);
    }
}
// end Set View List (Viewed Count)
// GET ip
function GetIP(){
    if(getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
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
/*
    end Functions
*/
?>