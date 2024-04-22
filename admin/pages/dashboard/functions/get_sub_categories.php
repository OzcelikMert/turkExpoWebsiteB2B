<?php
// Includes
if(file_exists("../../../config/config.php")){
    include_once("../../../config/config.php");
}
if(file_exists("../../../../sameparts/lang_cookie.php")){
    $language_page_index = 3;
    include_once("../../../../sameparts/lang_cookie.php");
}
// end Includes

if ($_POST) {

    $main_category = safe($_POST["main_category"]);

    $Category_Values = Get_SubCategories($conn, $main_category);

    echo $Category_Values;

}


/* Functions */

// Get Sub Categories
function Get_SubCategories($connect, $main_category){
    $values = "";
    $sql = "select * from sub_categorys where mcid='$main_category'";
    $query = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($query)){
        $values .= "<option value='".$row["row"]."'>".$row["name".$GLOBALS["langdata"]]."</option>";
    }

    return $values;
}
// end Get Sub Categories

/* end Functions */

?>