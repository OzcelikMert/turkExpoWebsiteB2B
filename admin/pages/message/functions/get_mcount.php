<?php
include_once("./config/config.php");
// Page Count
session_start();
$email = $_SESSION['email'];
$id = GetID($conn, $email); 
$sql = "select count(*) as Count_ from messages where cid_".$get_set." = '$id'";
$query = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_array($query)) {
	$count = $row["Count_"];
}

$show_count = $count / 20;
$show_count = ceil($show_count);
$mp_number = htmlspecialchars(trim(strip_tags($_GET['mp'])));
$mp_number = filter_var($mp_number, FILTER_VALIDATE_INT);
if($mp_number <= 0){
	$mp_number = 1;
}

if($mp_number > $show_count){
	$mp_number = 4;
}

$minusPage = "?mp=".($mp_number - 1)."";
$plusPage = "?mp=".($mp_number + 1)."";
if ($show_count < ($mp_number + 1)) {
	$plusPage = "javascript:void(0);";
}

if (($mp_number - 1) < 1){
	$minusPage = "javascript:void(0);";
}
?>