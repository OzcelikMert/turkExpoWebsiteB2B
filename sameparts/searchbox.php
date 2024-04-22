<?php
include_once("../admin/config/config.php");
$language_page_index = 1;
include_once("../sameparts/lang_cookie.php");
$langdata = lang_check($lang);
// POST Values
$Searching_Text = isset($_POST['searchingText']) ? htmlspecialchars(trim(strip_tags($_POST['searchingText']))) : "";
$Searching_Text = str_replace("'", '', $Searching_Text);
// end POST Values
// Get Function Values
if(!empty($Searching_Text)){
//$before = microtime(true);
$Wanted_MainCategory = Search_Main_Category($conn, $Searching_Text, _main_category ,$langdata);
$Wanted_SubCategory = Search_Sub_Category($conn, $Searching_Text, _sub_category,$langdata);
$Wanted_Company = Search_Company($conn, $Searching_Text, _business);
/*$after = microtime(true);
$Searching_Time = $after - $before;
$Searching_Time = substr($Searching_Time, 0, 5);
echo "<div class='text-center'><p>Searching Time: ".$Searching_Time." Second</p></div>";*/
echo $Wanted_MainCategory.$Wanted_SubCategory.$Wanted_Company;
}
// end Get Function Values
// Main Category Search
function Search_Main_Category($connect, $text, $lang_header, $langdata){
    /* Language */
        $sql_whereAfterMain = "";
        $count = 0;
        $sql = "select main_categorys.* from main_categorys";
        $query = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_field($query)) {
            if ($row->table != $oldTable) {
                $count = 0;
            }
            if ((substr($row->name, 0, 4) == "name")) {
                switch($row->table){
                    // Table 1                    
                    case "main_categorys":
                        if ($count > 0) {
                            $sql_whereAfterMain .= " or main_categorys.".$row->name." like '%".$text."%'";
                        }else{
                            $sql_whereAfterMain .= "main_categorys.".$row->name." like '%".$text."%'";
                        }
                    break;
                }
                $count++;
            }
            $oldTable = $row->table;
        }
    /* end Language */
    $value = "<b>".$lang_header."</b>";
    $sql = "select * from main_categorys where ".$sql_whereAfterMain." order by name asc limit 0, 5";
    $query = mysqli_query($connect, $sql);
    $count = 0;
    while ($row = mysqli_fetch_array($query)) {
        $value .= '
        <a href="search.php?main_category='.$row["seourl".$langdata].'"><li>'.$row["name".$langdata].'</li></a>
        ';
        $count++;
    }
    if ($count < 1) {
        $value = '';
    }
    return $value;
}
// end Main Category Search
// Sub Category Search
function Search_Sub_Category($connect, $text,$lang_header,$langdata){
    /* Language */
        $sql_whereAfterMain = "";
        $sql_whereAfterSub = "";
        $count = 0;
        $sql = "select sub_categorys.*, main_categorys.* 
        from sub_categorys
        INNER JOIN main_categorys ON main_categorys.id = sub_categorys.mcid";
        $query = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_field($query)) {
            if ($row->table != $oldTable) {
                $count = 0;
            }
            if ((substr($row->name, 0, 4) == "name")) {
                switch($row->table){
                    // Table 1                    
                    case "main_categorys":
                        if ($count > 0) {
                            $sql_whereAfterMain .= " or main_categorys.".$row->name." like '%".$text."%'";
                        }else{
                            $sql_whereAfterMain .= "main_categorys.".$row->name." like '%".$text."%'";
                        }
                    break;
                    // Table 2
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
    $value = "<b>".$lang_header."</b>";
    $sql = "select sub_categorys.*, main_categorys.seourl$langdata as MC_seourl from sub_categorys 
    inner join main_categorys on main_categorys.id = sub_categorys.mcid 
    where 
    (".$sql_whereAfterSub.") or 
    (".$sql_whereAfterMain.") 
    order by sub_categorys.name asc
    limit 0, 5";
    $query = mysqli_query($connect, $sql);
    $count = 0;
    while ($row = mysqli_fetch_array($query)) {
        $value .= '
        <a href="search.php?main_category='.$row["MC_seourl"].'&sub_category='.$row["seourl".$langdata].'"><li>'.$row["name".$langdata].'</li></a>
        ';
        $count++;
    }
    if ($count < 1) {
        $value = '';
    }
    return $value;
}
// end Sub Category Search
// Company Search
function Search_Company($connect, $text,$lang_header){
    /* Language */
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
    
    $value = '<b>'. $lang_header .'</b>';
    $sql = "select company_info.*, count(view_list.cid) as Count_ from company_info 
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
    limit 0, 5";
    $query = mysqli_query($connect, $sql);
    $count = 0;
    while ($row = mysqli_fetch_array($query)) {
        $value .= '
        <a href="profile/'.$row["seo_company_name"].'"><li>'.$row["company_name"].'</li></a>
        ';
        $count++;
    }
    if ($count < 1) {
        $value = '';
    }
    return $value;
}
// end Company Search
?>