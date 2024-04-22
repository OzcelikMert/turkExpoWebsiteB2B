<?php
// Includes
include_once("./admin/config/config.php");
// end Includes
/* Values */
$min = (($Page_number - 1) >= 0) ? 10 * ($Page_number - 1) : 0;
$max = 10;
$EventCategory_Values = Getevent_categoryValues($conn, $event_category);
if(empty($event_category)){
    // Empty
    $Events_Values = Getevent_Values_Empty($conn, $min, $max);
}else if (!empty($event_category)) {
    // Fill
    $Events_Values = Getevent_Values_Fill($conn, $event_category, $min, $max);
}
/* end Values */
/* Functions */
// Get Event Categories
function Getevent_categoryValues($connect, $GET_EventCategory){
    $values = "";
    $sql = "select * from event_categorys";
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {
        if ($row["seourl"] == $GET_EventCategory) {
            $values .= '
            <p><a href="events.php" style="margin-left:5px;color:blue;">'.$row["name"].'</a></p>
            ';
        }else {
            $values .= '
            <p><a href="events.php?event_category='.$row["seourl"].'">'.$row["name"].'</a></p>
            ';
        }
    }
    return $values;
}
// end Get Event Categories
// Get Business Fill GETS
function Getevent_Values_Fill($connect, $GET_event_category, $min_, $max_){
    $values = "";
    // end Where Values Empty Check
    $sql = '
    SELECT  events.message as Message, company_info.company_name as Cname, company_info.seo_company_name as Cseourl, 
    company_info.c_logo as c_logo_, event_categorys.name as EC_name, event_categorys.bg_color as EC_bgColor, event_categorys.seourl as seoURL
    from events
    INNER JOIN event_categorys ON event_categorys.id = events.category 
    INNER JOIN company_info ON company_info.id = events.cid 
    where 
    event_categorys.seourl = "'.$GET_event_category.'"
    order by events.date desc 
    limit '.(int)$min_.', '.(int)$max_.'
    ';
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {
        //echo "$sql";
        $values .= '
        <div class="searchp">
            <div class="search-box">
                <a href="profile/'.$row["Cseourl"].'">
                <h3>'.$row["Cname"].'</h3>
                <div class="fl"><img src="./images/company_logo/'.$row["c_logo_"].'" alt="'.$row["Cname"].'"> </div>
                </a>
                <div class="fl search-box-p">
                    <p class="h110px">'.substr($row["Message"], 0, 250).'</p>
                    <p class="h30px badge badge-'.$row["EC_bgColor"].'">Category: <a href="events.php?event_category='.$row["seoURL"].'">'.$row["EC_name"].'</a></p>
                </div>
        </div>
        <!--Search-Box End-->
        </div>
        <!--Searchp End-->
        ';
    }
    //echo mysqli_error($connect);
    if (empty($values)) {
        $values = "<p style='text-align: center;'>OH! sorry, no results were found.</p>";
    }
    return $values;
}
// end Get Business
// Get Business Empty GETS
function Getevent_Values_Empty($connect, $min_, $max_){
    $values = "";
    $sql = '
    SELECT  events.message as Message, company_info.company_name as Cname, company_info.seo_company_name as Cseourl, 
    company_info.c_logo as c_logo_, event_categorys.name as EC_name, event_categorys.bg_color as EC_bgColor, event_categorys.seourl as seoURL
    from events
    INNER JOIN event_categorys ON event_categorys.id = events.category 
    INNER JOIN company_info ON company_info.id = events.cid 
    order by events.date desc 
    limit '.(int)$min_.', '.(int)$max_.'
    ';
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $values .= '
        <div class="searchp">
            <div class="search-box">
                <a href="profile/'.$row["Cseourl"].'">
                <h3>'.$row["Cname"].'</h3>
                <div class="fl"><img src="./images/company_logo/'.$row["c_logo_"].'" alt="'.$row["Cname"].'"> </div>
                </a>
                <div class="fl search-box-p">
                    <p class="h110px">'.substr($row["Message"], 0, 250).'</p>
                    <p class="h30px badge badge-'.$row["EC_bgColor"].'">Category: <a href="events.php?event_category='.$row["seoURL"].'">'.$row["EC_name"].'</a></p>
                </div>
        </div>
        <!--Search-Box End-->
        </div>
        <!--Searchp End-->
        ';
    }
    if (empty($values)) {
        $values = "<p style='text-align: center;'>OH! sorry, no results were found.</p>";
    }
    return $values;
}
// end Get Business Empty GETS
/* end Functions */
?>