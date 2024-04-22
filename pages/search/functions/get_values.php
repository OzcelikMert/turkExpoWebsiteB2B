<?php
include_once("./admin/config/config.php");
include_once("./sameparts/lang_cookie.php");
$GLOBALS["langdata"] =  lang_check($lang);
//Translate 
$GLOBALS["_category"] = _category;
$GLOBALS["_sub_category"] = _sub_category;
$GLOBALS["not_result"] = _not_result;
$GLOBALS["pls_select_category"] = _pls_select_category; 
/* Values */
$min = (($Page_number - 1) >= 0) ? 10 * ($Page_number - 1) : 0;
$max = 10;
$Country_Values = Getcountry_Values($conn, $country, $main_category_url, $sub_category_url);
$MainCategory_Values = Getmain_categoryValues($conn, $country_url, $main_category, $sub_category_url);
$SubCategory_Values = Getsub_categoryValues($conn, $country_url, $main_category_url, $main_category, $sub_category);
if(empty($country) && empty($main_category) && empty($sub_category)){
    $Business_Values = Getbusiness_Values_Empty($conn, $country, $main_category, $sub_category, $min, $max);
}else if (!empty($country) || !empty($main_category) || !empty($sub_category)) {
    $Business_Values = Getbusiness_Values_Fill($conn, $country, $main_category, $sub_category, $country_url, $min, $max);
}
// Searchbox Value
if(!empty($searchingText)){
    $Business_Values = Getbusiness_Values_WantedText($conn, $searchingText, $min, $max);
    $searchValues = '
    <h3 style="display:inline-block">'._search.'</h3>
    <h4 style="display:inline-block">'.$searchingText.'</h4>
    ';
}
// end Searchbox Value
/* end Values */
/* Functions */
// Get Countries
function Getcountry_Values($connect, $GET_Country, $GET_MainCategory_url, $GET_SubCategory_url){
    $values = "";
    $langdata = $GLOBALS["langdata"];
    $sql = "select name$langdata as name, seourl$langdata as seo_name from countrys";
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {
        if ($row["seo_name"] == $GET_Country) {
            $values .= '
            <p><a href="search.php?'.$GET_MainCategory_url.$GET_SubCategory_url.'" style="margin-left:5px;color:blue;">'.$row["name"].'</a></p>
            ';
        }else {
            $values .= '
            <p><a href="search.php?country='.$row["seo_name"].$GET_MainCategory_url.$GET_SubCategory_url.'">'.$row["name"].'</a></p>
            ';
        }
    }
    return $values;
}
// end Get Countries 
// Get Main Categories
function Getmain_categoryValues($connect, $GET_Country_url, $GET_MainCategory, $GET_SubCategory_url){
    $values = "";
    $langdata = $GLOBALS["langdata"];
    $sql = "select name$langdata as name, seourl$langdata as seo_name from main_categorys";
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {
        if ($row["seo_name"] == $GET_MainCategory) {
            $values .= '
            <p><a href="search.php?'.$GET_Country_url.'" style="margin-left:5px;color:blue;">'.$row["name"].'</a></p>
            ';
        }else {
            $values .= '
            <p><a href="search.php?'.$GET_Country_url.'&main_category='.$row["seo_name"].'">'.$row["name"].'</a></p>
            ';
        }
    }
    return $values;
}
// end Get Main Categories
// Get Sub Categories
function Getsub_categoryValues($connect, $GET_Country_url, $GET_MainCategory_url, $GET_MainCategory, $GET_SubCategory){
    $values = "";
    $langdata = $GLOBALS["langdata"];
    $sql = "select sub_categorys.name$langdata as name, sub_categorys.seourl$langdata as seo_name from sub_categorys INNER JOIN main_categorys ON main_categorys.id = sub_categorys.mcid where main_categorys.seourl$langdata = '".$GET_MainCategory."'";
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) { 
        if ($row["seo_name"] == $GET_SubCategory) { 
            $values .= '
            <p><a href="search.php?'.$GET_Country_url.$GET_MainCategory_url.'" style="margin-left:5px;color:blue;">'.$row["name"].'</a></p>
            ';
        }else {
            $values .= '
            <p><a href="search.php?'.$GET_Country_url.$GET_MainCategory_url.'&sub_category='.$row["seo_name"].'">'.$row["name"].'</a></p>
            ';
        }
    }
    if (empty($values)) {
        $values = "<p>".$GLOBALS["pls_select_category"]."</p>";
    }
    return $values;
}
// end Sub Main Categories
// Get Business Fill GETS
function Getbusiness_Values_Fill($connect, $GET_Country, $GET_MainCategory, $GET_SubCategory, $GET_Country_url, $min_, $max_ ){
    $values = "";
    $langdata = $GLOBALS["langdata"];
    // Where Values
    $where_country = "";
    $where_main_category = "";
    $where_sub_category = "";
    // end Where Values
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
    SELECT company_info.*, main_categorys.name'.$langdata.' as MC_name, main_categorys.seourl'.$langdata.' as MC_seo_name, sub_categorys.name'.$langdata.' as SC_name, sub_categorys.seourl'.$langdata.' as SC_seo_name
    FROM `company_info` 
    INNER JOIN countrys ON countrys.id = company_info.country 
    INNER JOIN main_categorys ON main_categorys.id = company_info.main_category 
    INNER JOIN sub_categorys ON sub_categorys.row = company_info.sub_category
    where 
    '.$where_country.' 
    '.$where_main_category.' 
    '.$where_sub_category.' 
    order by company_info.company_name asc
    limit '.(int)$min_.', '.(int)$max_.'
    ';
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $values .= '
        <div class="searchp">
            <div class="search-box">
                <a href="profile/'.$row["seo_company_name"].'">
                <h3>'.$row["company_name"].'</h3>
                <div class="fl"><img src="./images/company_logo/'.$row["c_logo"].'" alt="'.$row["company_name"].'"> </div>
                </a>
                <div class="fl search-box-p">
                    <p class="h110px">'.substr($row["about"], 0, 450).'</p>
                    <p class="h30px">'.$GLOBALS["_category"].': <a href="search.php?'.$GET_Country_url."&main_category=".$row["MC_seo_name"].'">'.$row["MC_name"].'</a> | '.$GLOBALS["_sub_category"].': <a href="search.php?'.$GET_Country_url."&main_category=".$row["MC_seo_name"]."&sub_category=".$row["SC_seo_name"].'">'.$row["SC_name"].'</a></p>
                </div>
        </div>
        <!--Search-Box End-->
        </div>
        <!--Searchp End-->
        ';
    }
    if (empty($values)) {
        $values = "<h4 style='text-align: center;'>".$GLOBALS["not_result"]."</h4>";
    }
    return $values;
}
// end Get Business
// Get Business Empty GETS
function Getbusiness_Values_Empty($connect, $GET_Country, $GET_MainCategory, $GET_SubCategory, $min_, $max_){
    $langdata = $GLOBALS["langdata"];
    $values = "";
    $sql = '
    SELECT company_info.*, main_categorys.name'.$langdata.' as MC_name, main_categorys.seourl'.$langdata.' as MC_seo_name, sub_categorys.name'.$langdata.' as SC_name, sub_categorys.seourl'.$langdata.' as SC_seo_name
    FROM `company_info` 
    INNER JOIN countrys ON countrys.id = company_info.country 
    INNER JOIN main_categorys ON main_categorys.id = company_info.main_category 
    INNER JOIN sub_categorys ON sub_categorys.row = company_info.sub_category
    order by company_info.company_name asc 
    limit '.(int)$min_.', '.(int)$max_.'
    ';
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $values .= '
        <div class="searchp">
            <div class="search-box">
                <a href="profile/'.$row["seo_company_name"].'">
                <h3>'.$row["company_name"].'</h3>
                <div class="fl"><img src="./images/company_logo/'.$row["c_logo"].'" alt="'.$row["company_name"].'"> </div>
                </a>
                <div class="fl search-box-p">
                    <p class="h110px">'.substr($row["about"], 0, 450).'</p>
                    <p class="h30px">'.$GLOBALS["_category"].': <a href="search.php?&main_category='.$row["MC_seo_name"].'">'.$row["MC_name"].'</a> | '.$GLOBALS["_sub_category"].': <a href="search.php?main_category='.$row["MC_seo_name"].'&sub_category='.$row["SC_seo_name"].'">'.$row["SC_name"].'</a></p>
                </div>
        </div>
        <!--Search-Box End-->
        </div>
        <!--Searchp End-->
        ';
    }
    if (empty($values)) {
        $values = "<h4 style='text-align: center;'>".$GLOBALS["not_result"]."</h4>";
    }
    return $values;
}
// end Get Business Empty GETS
// Wanted Text - Get Business
function Getbusiness_Values_WantedText($connect, $text, $min_, $max_){
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
    $sql = "SELECT company_info.*,  count(view_list.cid) as Count_, main_categorys.name$langdata as MC_name, main_categorys.seourl$langdata as MC_seo_name, sub_categorys.name$langdata as SC_name, sub_categorys.seourl$langdata as SC_seo_name
    FROM `company_info` 
    INNER JOIN countrys ON countrys.id = company_info.country 
    INNER JOIN main_categorys ON main_categorys.id = company_info.main_category 
    INNER JOIN sub_categorys ON sub_categorys.row = company_info.sub_category
    INNER JOIN view_list ON company_info.id = view_list.cid 
    where 
    (company_info.company_name like '%".$text."%') or 
    (".$sql_whereAfterActivity.") or 
    (".$sql_whereAfterMain.") or 
    (".$sql_whereAfterSub.") or
    (".$sql_whereAfterCountry.") 
    GROUP BY company_info.seo_company_name 
    ORDER BY Count_ DESC 
    limit ".(int)$min_.", ".(int)$max_."
    ";
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $values .= '
        <div class="searchp">
            <div class="search-box">
                <a href="profile/'.$row["seo_company_name"].'">
                <h3>'.$row["company_name"].'</h3>
                <div class="fl"><img src="./images/company_logo/'.$row["c_logo"].'" alt="'.$row["company_name"].'"> </div>
                </a>
                <div class="fl search-box-p">
                    <p class="h110px">'.substr($row["about"], 0, 450).'</p>
                    <p class="h30px">'.$GLOBALS["_category"].': <a href="search.php?"&main_category="'.$row["MC_seo_name"].'">'.$row["MC_name"].'</a> | '.$GLOBALS["_sub_category"].': <a href="search.php?"&main_category="'.$row["MC_seo_name"].'&sub_category='.$row["SC_seo_name"].'">'.$row["SC_name"].'</a></p>
                </div>
        </div>
        <!--Search-Box End-->
        </div>
        <!--Searchp End-->
        ';
    }
    if (empty($values)) {
        $values = "<h4 style='text-align: center;'>".$GLOBALS["not_result"]."</h4>";
    }
    return $values;
}
// end Wanted Text - Get Business
/* end Functions */
?>