<?php
/* GET Values */
$event_category = isset($_GET['event_category']) ? htmlspecialchars(trim(strip_tags($_GET['event_category']))) : "";
$event_category = str_replace("'", '', $event_category);
$Page_number = htmlspecialchars(trim(strip_tags($_GET['page'])));
$Page_number = filter_var($Page_number, FILTER_VALIDATE_INT);
/* end GET Values */
/* Get Values Control */
$event_category_url = "";
//
if (!empty($event_category)) {
    $event_category_url = "&event_category=".$event_category;
}
/* end Get Values Control */
?>