<?php  
  $page = safe($_GET['page']);

  // Functions in get_values.php
  switch($page){
    case "products": 
      //-1 All Products
     $Product_Values = GetProduct_Values($conn, $company_name, $Company_Values["id"],$langdata,-1,$Company_Values["deflang"]);
     $define["login_view"]= _pls_login_view;
      $define["name"]=       _full_name;
      $define["address"]=     _address;
      $define["city"]=       _city;
      $define["country"]=    _country;      
      $define["post"]=       _post_code;
      $define["web_site"]=   _web_site;      
      $define["email"]=      _email_address;
      $define["phone"]=      _phone_number;
      $define["send_msg"]=      _send_message;
      $Contact_Values = GetContact_Values($Company_Values["id"],$Company_Values["name"],$Company_Values["email"],$Company_Values["tel1"],$Company_Values["tel2"],$Company_Values["address"], $Company_Values["city"],$Company_Values["country"],$Company_Values["post_code"],$Company_Values["website"],$define);
      include("pages/profile/profile-products.php"); 
     break;

    case "contact": 
      $define["login_view"]= _pls_login_view;
      $define["name"]=       _full_name;
      $define["address"]=     _address;
      $define["city"]=       _city;
      $define["country"]=    _country;      
      $define["post"]=       _post_code;
      $define["web_site"]=   _web_site;      
      $define["email"]=      _email_address;
      $define["phone"]=      _phone_number;
      $define["send_msg"]=      _send_message;
      $Contact_Values = GetContact_Values($Company_Values["id"],$Company_Values["name"],$Company_Values["email"],$Company_Values["tel1"],$Company_Values["tel2"],$Company_Values["address"], $Company_Values["city"],$Company_Values["country"],$Company_Values["post_code"],$Company_Values["website"],$define);
      include("pages/profile/profile-contact.php");   
     break;



    case "view": 
      //$Product_Values = GetProduct_Values($conn, $company_name, $Company_Values["id"],$langdata,50);
     // echo $Product_Values."</div>";  
     //  $Product_Values = GetProduct_Values($conn, $company_name, $Company_Values["id"],$langdata,1);
     $Product_View_Values = GetProduct_viewValues($conn, $product_id, $Company_Values["id"],$langdata, $Company_Values["deflang"]);
      $define["login_view"]=_pls_login_view;
      $define["name"]=_full_name;
      $define["address"]=  _address;
      $define["city"]=  _city;
      $define["country"]=  _country;
      $define["post"]=_post_code;
      $define["web_site"]=_web_site;
      $define["email"]= _email_address;
      $define["phone"]= _phone_number;
      $define["send_msg"]= _send_message;
      $Contact_Values = GetContact_Values($Company_Values["id"],$Company_Values["name"],$Company_Values["email"],$Company_Values["tel1"],$Company_Values["tel2"],$Company_Values["address"], $Company_Values["city"],$Company_Values["country"],$Company_Values["post_code"],$Company_Values["website"],$define);
      echo $Product_View_Values."</div>";   
     break;



     default : 
     $Product_Values = GetProduct_Values($conn, $company_name, $Company_Values["id"],$langdata,1, $Company_Values["deflang"]);
     $Event_Values = GetEvent_Values($conn, $company_name, $Company_Values["id"],$langdata,1, $Company_Values["deflang"]);
     $Export_Values = GetExport_values($conn, $Company_Values["id"]);
     $define["login_view"]= _pls_login_view;
     $define["name"]= _full_name;
     $define["address"]=  _address;
     $define["city"]=  _city;
     $define["country"]=  _country;
     $define["post"]=_post_code;
     $define["web_site"]=_web_site; 
     $define["email"]= _email_address;
     $define["phone"]= _phone_number;
     $define["send_msg"]= _send_message;
     $Contact_Values = GetContact_Values($Company_Values["id"],$Company_Values["name"],$Company_Values["email"],$Company_Values["tel1"],$Company_Values["tel2"],$Company_Values["address"], $Company_Values["city"],$Company_Values["country"],$Company_Values["post_code"],$Company_Values["website"],$define);
     include("pages/profile/profile-details.php");

    }

?>

