<?php
include_once("./config/config.php");
$langdata = lang_check($lang);
$EventCategories_Value = GetEvent_Categories($conn,$langdata);

// Get Event Categorys

function GetEvent_Categories($connect,$langdata){
    $values = "";
    $sql = "select * from event_categorys order by name asc";
    $query = mysqli_query($connect, $sql);
    while ($row =  mysqli_fetch_array($query)) {
        $values .= "
        <option value='".$row["id"]."'>".$row["name".$langdata]."</option>
        ";
    }
    return $values;
}

// end Get Event Categorys



?>