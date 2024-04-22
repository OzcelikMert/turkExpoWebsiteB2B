<?php
include_once("./admin/config/config.php");
// Get Values
$main_category = isset($_GET['category']) ? htmlspecialchars(trim(strip_tags($_GET['category']))) : "";
$main_category = str_replace("'", '', $main_category);
// end Get Values
// Values
$Sub_Categories = Getsub_Categories($conn, $main_category,$lang);
// end Values
/*
    Functions
*/
// Get Sub Categories
function Getsub_Categories($connect, $main_category_,$lang){
    $values = "";
    $mc_name = "";
    $mc_image = "";
    $langdata = lang_check($lang);
    $sql = "SELECT sub_categorys.name$langdata as SC_name, sub_categorys.seourl$langdata as SC_seourl, main_categorys.name$langdata as MC_name, main_categorys.img as MC_img from sub_categorys 
    INNER JOIN main_categorys ON main_categorys.id = sub_categorys.mcid where main_categorys.seourl$langdata = '$main_category_' ORDER BY sub_categorys.name$langdata";
    
    // Get Main Category info
    $first_query = mysqli_query($connect, $sql);
    if ($row = mysqli_fetch_array($first_query)) {
        $mc_name = $row["MC_name"];
        $mc_image = $row["MC_img"];
    }
    // end Get Main Category info
    // Get Sub Categories info
    $query = mysqli_query($connect, $sql);
    $count = 0;
    while ($row = mysqli_fetch_array($query)) {
        $count++;
        $values .= '
        <div style="margin-bottom: 10px;"; class="col-md-12 sub-c-box b-sc1 categorty-type-s noscroll">
            <a style="border-radius: 5px;" href="search/'.$main_category_.'/'.$row["SC_seourl"].'"><span>'.$count.'-) '.$row["SC_name"].'</span><i class="fa fa-arrow-right"></i></a>
        </div>
    ';
    }
    // end Get Sub Categories info
    $main_value = '
    <div class="categories">
        <img id="top-img-categorty" src="./images/category_images/'.$mc_image.'" alt="'.$mc_name.'">
        <div class="container bg-white">
            <div class="row">
                <div class="scategorty-title col-md-12">
                    <span>'.$mc_name.'</span>
                </div>
                '.$values.'
            </div>
        </div>
    </div>
    ';
    
    return $main_value;
}
// end Get Sub Categories
// Get Show Categories Values
function Getcategory_Values($connect, $main_category_){
}
/*
    end Functions
*/
?>