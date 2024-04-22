<?php
/* GET Values */
$country = isset($_GET['country']) ? htmlspecialchars(trim(strip_tags($_GET['country']))) : "";
$country = str_replace("'", '', $country);
$main_category = isset($_GET['main_category']) ? htmlspecialchars(trim(strip_tags($_GET['main_category']))) : "";
$main_category = str_replace("'", '', $main_category);
$sub_category = isset($_GET['sub_category']) ? htmlspecialchars(trim(strip_tags($_GET['sub_category']))) : "";
$sub_category = str_replace("'", '', $sub_category);
$searchingText = isset($_GET['searchingText']) ? htmlspecialchars(trim(strip_tags($_GET['searchingText']))) : "";
$searchingText = str_replace("'", '', $searchingText);
//$searchingText = convertUrl($searchingText);
$Page_number = htmlspecialchars(trim(strip_tags($_GET['page'])));
$Page_number = filter_var($Page_number, FILTER_VALIDATE_INT);
/* end GET Values */
/* Get Values Control */
$country_url = "";
$main_category_url = "";
$sub_category_url = "";
//
if (!empty($country)) {
    $country_url = "&country=".$country;
}
//
if (!empty($main_category)) {
    $main_category_url = "&main_category=".$main_category;
}
//
if (!empty($sub_category)) {
    $sub_category_url = "&sub_category=".$sub_category;
}
if (!empty($searchingText)) {
    $searchingText_url = "&searchingText=".$searchingText;
}
/* end Get Values Control */
// Convert Seo Url
function convertUrl($url) {
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
    return $url;
}
// end Convert Seo Url
?>