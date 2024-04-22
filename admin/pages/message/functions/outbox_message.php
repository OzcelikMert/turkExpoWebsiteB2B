<?php
require_once("./config/config.php");
require_once("./pages/message/show_messages.php");
session_start();
$email = $_SESSION['email'];
$id = GetID($conn, $email);
// Show message count and show messages 
if (!empty($_GET["mp"])) {
	$min = 20 * ($mp_number - 1);
	$max = 20;
	$sql = "select count(*) as Count_ from messages where cid_set = '$id' limit $min, $max";
	$query = mysqli_query($conn, $sql);

	if ($row = mysqli_fetch_array($query)) {
		$count = $row["Count_"];
	}
	if($count > 0){
		showMessages($conn, "set", $id, $min, $max);
	}else{
		showMessages($conn, "set", $id, 0, 20);
	}
	
}else{
	$max = 20;
	$min = 0;
	showMessages($conn, "set", $id, $min, $max);
}
?>