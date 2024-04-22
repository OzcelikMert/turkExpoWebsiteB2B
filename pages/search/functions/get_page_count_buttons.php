<?php
include_once("./admin/config/config.php");
include_once("./sameparts/lang_cookie.php");
$GLOBALS["langdata"] =  lang_check($lang);

// Get Values
if(empty($country) && empty($main_category) && empty($sub_category)){

    $Count = Getbusiness_Count_Empty($conn, $country, $main_category, $sub_category);

}else if (!empty($country) || !empty($main_category) || !empty($sub_category)) {

    $Count = Getbusiness_Count_Fill($conn, $country, $main_category, $sub_category);

}
// Searchbox Value
if(!empty($searchingText)){
    $Count = Getbusiness_Count_WantedText($conn, $searchingText);
}
// end Searchbox Value

$Count = $Count / 10;
$Count = ceil($Count);
if($Page_number < 1){
    $Page_number = 1;
}
if($Page_number > $Count){
    $Page_number = $Count;
}
$PageCount_Buttons = Setbusiness_Count_Buttons($Count, $Page_number, $GetEmpty, $country_url, $main_category_url, $sub_category_url, $searchingText_url);
// end Get Values

/*
    Function
*/

// Get Business Count Fill
function Getbusiness_Count_Fill($connect, $GET_Country, $GET_MainCategory, $GET_SubCategory){
    $values = 0;
    // Where Values
    $where_country = "";
    $where_main_category = "";
    $where_sub_category = "";
    // end Where Values
     $langdata = $GLOBALS["langdata"];
    // Where Values Empty Check
    if (!empty($GET_Country)) {
        $where_country = "countrys.seourl$langdata = '".$GET_Country."'";
    }
    //
    if (!empty($GET_MainCategory)) {
        if (!empty($GET_Country)) {
            $where_main_category .= "and ";
        }
        $where_main_category .= "main_categorys.seourl$langdata = '".$GET_MainCategory."'";
    }
    //
    if (!empty($GET_SubCategory)) {
        $where_sub_category = "and sub_categorys.seourl$langdata = '".$GET_SubCategory."'";
    }
    // end Where Values Empty Check
    $sql = '
    SELECT count(*) as DataCount
    FROM `company_info` 
    INNER JOIN countrys ON countrys.id = company_info.country 
    INNER JOIN main_categorys ON main_categorys.id = company_info.main_category
    INNER JOIN sub_categorys ON sub_categorys.row = company_info.sub_category
    where 
    '.$where_country.' 
    '.$where_main_category.' 
    '.$where_sub_category.'
    ';
    $query = mysqli_query($connect, $sql);
    if ($row = mysqli_fetch_array($query)) {
       $values = $row["DataCount"];
    }

    return $values;
}
// end Get Business Count Fill

// Get Business Count Empty
function Getbusiness_Count_Empty($connect, $GET_Country, $GET_MainCategory, $GET_SubCategory){
    $values = 0;
    $sql = '
    SELECT count(*) as DataCount
    FROM `company_info` 
    INNER JOIN countrys ON countrys.id = company_info.country 
    INNER JOIN main_categorys ON main_categorys.id = company_info.main_category
    INNER JOIN sub_categorys ON sub_categorys.row = company_info.sub_category
    ';
    $query = mysqli_query($connect, $sql);
    if ($row = mysqli_fetch_array($query)) {
        $values = $row["DataCount"];
    }

    return $values;
}
// end Get Business Count Empty

// Wanted Text - Get Business
function Getbusiness_Count_WantedText($connect, $text){
     /* Language */
     $langdata = $GLOBALS["langdata"];

        $sql_whereAfterActivity = "";
        $sql_whereAfterCountry = "";
        $sql_whereAfterMain = "";
        $sql_whereAfterSub = "";
        $count = 0;
        $sql = "select company_info.*, countrys.*, sub_categorys.*, main_categorys.* 
        from company_info
        INNER JOIN countrys ON countrys.id = company_info.country 
        INNER JOIN main_categorys ON main_categorys.id = company_info.main_category 
        INNER JOIN sub_categorys ON sub_categorys.row = company_info.sub_category
        ";
        $query = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_field($query)) {
            if ($row->table != $oldTable) {
                $count = 0;
            }
            if ((substr($row->name, 0, 4) == "name") || (substr($row->name, 0, 8) == "activity")) {
                switch($row->table){
                    // Table 1
                    case "company_info":
                        if ($count > 0) {
                            $sql_whereAfterActivity .= " or company_info.".$row->name." like '%".$text."%'";
                        }else{
                            $sql_whereAfterActivity .= "company_info.".$row->name." like '%".$text."%'";
                        }
                    break;
                    // Table 2
                    case "countrys":
                        if ($count > 0) {
                            $sql_whereAfterCountry .= " or countrys.".$row->name." like '".$text."%'";
                        }else{
                            $sql_whereAfterCountry .= "countrys.".$row->name." like '".$text."%'";
                        }
                    break;
                    // Table 3
                    case "main_categorys":
                        if ($count > 0) {
                            $sql_whereAfterMain .= " or main_categorys.".$row->name." like '%".$text."%'";
                        }else{
                            $sql_whereAfterMain .= "main_categorys.".$row->name." like '%".$text."%'";
                        }
                    break;
                    // Table 4
                    case "sub_categorys":
                        if ($count > 0) {
                            $sql_whereAfterSub .= " or sub_categorys.".$row->name." like '%".$text."%'";
                        }else{
                            $sql_whereAfterSub .= "sub_categorys.".$row->name." like '%".$text."%'";
                        }
                    break;
                }
                $count++;
            }

            $oldTable = $row->table;
        }
    /* end Language */

    $values = "";
    $sql = "SELECT count(*) as DataCount
    FROM `company_info` 
    INNER JOIN countrys ON countrys.id = company_info.country 
    INNER JOIN main_categorys ON main_categorys.id = company_info.main_category 
    INNER JOIN sub_categorys ON sub_categorys.row = company_info.sub_category
    where 
    (company_info.company_name like '%".$text."%') or 
    (".$sql_whereAfterActivity.") or 
    (".$sql_whereAfterMain.") or 
    (".$sql_whereAfterSub.") or
    (".$sql_whereAfterCountry.") 
    GROUP BY company_info.seo_company_name 
    ";
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $values = $row["DataCount"];
    }
    return $values;
}
// end Wanted Text - Get Business

// Set Buttons
function Setbusiness_Count_Buttons($Count_, $Get_Count_, $GetEmpty_, $Country_URL, $Main_Category_URL, $Sub_Category_URL, $WantedText_URL){
    $values = "";
    // Check Get Count

    $minusPage = "search.php?".$Country_URL.$Main_Category_URL.$Sub_Category_URL.$WantedText_URL."&page=".($Get_Count_ - 1)."";
    $plusPage = "search.php?".$Country_URL.$Main_Category_URL.$Sub_Category_URL.$WantedText_URL."&page=".($Get_Count_ + 1)."";

    if (($Get_Count_ + 1) > $Count_) {
    	$plusPage = "javascript:void(0);";
    }
    if (($Get_Count_ - 1) < 1){
    	$minusPage = "javascript:void(0);";
    }
    // end Check Get Count

    $values .= '<a href="search.php?'.$Country_URL.$Main_Category_URL.$Sub_Category_URL.$WantedText_URL.'&page=1"><span><<</span></a>';
    $values .= '<a href="'.$minusPage.'"><span><</span></a>';

    // Number Buttons
    for ($i=0; $i < $Count_; $i++) {
        $button_range = ($i+1) - $Get_Count_;
        if(($button_range >= -3 ) && ($button_range <= 3 )){
            if (($i + 1) == $Get_Count_) {
                $values .= '
                <a class="IsDisabled" href="javascript:void(0);"><span>'.($i+1).'</span></a>
                ';
            }else {
                $values .= '
                <a href="search.php?'.$Country_URL.$Main_Category_URL.$Sub_Category_URL.$WantedText_URL.'&page='.($i + 1).'"><span>'.($i+1).'</span></a>
                ';
            }
        }
    }
    // end Number Buttons

    $values .= '<a href="'.$plusPage.'"><span>></span></a>';
    $values .= '<a href="search.php?'.$Country_URL.$Main_Category_URL.$Sub_Category_URL.$WantedText_URL.'&page='.$Count_.'"><span>>></span></a>';

    return $values;
}
// end Set Buttons

?>