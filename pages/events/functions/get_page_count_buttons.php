<?php
include_once("./admin/config/config.php");

// Get Values
if(empty($event_category)){

    $Count = Getevent_Count_Empty($conn);

}else if (!empty($event_category)) {

    $Count = Getevent_Count_Fill($conn, $event_category);

}

$Count = $Count / 10;
$Count = ceil($Count);
if($Page_number < 1){
    $Page_number = 1;
}
if($Page_number > $Count){
    $Page_number = $Count;
}

$PageCount_Buttons = Setevent_Count_Buttons($Count, $Page_number, $event_category_url);
// end Get Values

/*
    Function
*/

// Get Business Count Fill
function Getevent_Count_Fill($connect, $GET_event_category){
    $values = 0;
    // end Where Values Empty Check
    $sql = '
    SELECT count(*) as DataCount
    FROM `events` 
    INNER JOIN event_categorys ON event_categorys.id = events.category 
    INNER JOIN company_info ON company_info.id = events.cid 
    where 
    event_categorys.seourl = "'.$GET_event_category.'"
    ';
    $query = mysqli_query($connect, $sql);
    if ($row = mysqli_fetch_array($query)) {
       $values = $row["DataCount"];
    }

    return $values;
}
// end Get Business Count Fill

// Get Business Count Empty
function Getevent_Count_Empty($connect){
    $values = 0;
    $sql = '
    SELECT count(*) as DataCount FROM `events`
    ';
    $query = mysqli_query($connect, $sql);
    if ($row = mysqli_fetch_array($query)) {
        $values = $row["DataCount"];
    }

    return $values;
}
// end Get Business Count Empty

// Set Buttons
function Setevent_Count_Buttons($Count_, $Get_Count_, $Event_Category_URL){
    $page = "events.php";
    $values = "";
    // Check Get Count

    $minusPage = "$page?".$Event_Category_URL."&page=".($Get_Count_ - 1)."";
    $plusPage = "$page?".$Event_Category_URL."&page=".($Get_Count_ + 1)."";

    if (($Get_Count_ + 1) > $Count_) {
    	$plusPage = "javascript:void(0);";
    }
    if (($Get_Count_ - 1) < 1){
    	$minusPage = "javascript:void(0);";
    }
    // end Check Get Count

    $values .= '<a href="'.$page.'?'.$Event_Category_URL.'&page=1"><span><<</span></a>';
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
                <a href="'.$page.'?'.$Event_Category_URL.'&page='.($i + 1).'"><span>'.($i+1).'</span></a>
                ';
            }
        }
    }
    // end Number Buttons

    $values .= '<a href="'.$plusPage.'"><span>></span></a>';
    $values .= '<a href="'.$page.'?'.$Event_Category_URL.'&page='.$Count_.'"><span>>></span></a>';

    return $values;
}
// end Set Buttons

?>