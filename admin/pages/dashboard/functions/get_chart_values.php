<?php 
include_once("../../../config/config.php");
// Array
$dateArray_values = [];
// end Array
// Session info
session_start();
$email = $_SESSION["email"];
$id = GetID($conn, $email);
// end Session Info
/*************************/
// Message Chart Values
/*************************/
/*
	Week
*/
// Week info
$now_date = date("Y-m-d");
$old_day = date('Y-m-d', strtotime("-6 day"));
// end Week info


// SQL Week count
$sql_week = "SELECT count(*) as MessageCount, Date(date) as MessageDate FROM `messages` WHERE (`cid_get` = '$id' or `cid_get` = '-$id') and date BETWEEN '$old_day' and '$now_date' GROUP BY MessageDate ORDER BY MessageDate asc";
if ($query = mysqli_query($conn, $sql_week)) {
	$number = 0;
	while ($row = mysqli_fetch_array($query)) {
		$dateArray_values["message"]["week"][0][$number] = $row["MessageCount"]; 
		$dateArray_values["message"]["week"][1][$number] = substr($row["MessageDate"], 0, 10);
		$number++;
	}
}else{
	echo mysqli_error($conn);
}

// Month info
$old_date = "";
$old_month = date("Y-m-d", strtotime("-1 month"));
$now_date = date('Y-m-d');
// end Month info


// SQL Month count
$sql_month = "SELECT count(*) as MessageCount, Date(date) as MessageDate FROM `messages` WHERE (`cid_get` = '$id' or `cid_get` = '-$id') and date BETWEEN '$old_month' and '$now_date' GROUP BY MessageDate ORDER BY MessageDate asc";
if ($query = mysqli_query($conn, $sql_month)) {
	$number = 0;
	while ($row = mysqli_fetch_array($query)) {
		$dateArray_values["message"]["month"][0][$number] = $row["MessageCount"]; 
		$dateArray_values["message"]["month"][1][$number] = substr($row["MessageDate"], 0, 10);
		$number++;
	}
}else{
	echo mysqli_error($conn);
}
// end SQL
// Year info
$old_date = "";
$new_year = date('Y', strtotime("+1 year"));
$now_date = date("Y");
// end Year info


// SQL Year count
$sql_year = "SELECT count(*) as MessageCount, DATE(date) as MessageDate FROM `messages` WHERE (`cid_get` = '$id' or `cid_get` = '-$id') and date BETWEEN '$now_date' and '$new_year' GROUP BY DATE_FORMAT(MessageDate, '%y-%m') ORDER BY MessageDate asc";
if ($query = mysqli_query($conn, $sql_year)) {
	$number = 0;
	while ($row = mysqli_fetch_array($query)) {
			$dateArray_values["message"]["year"][0][$number] = $row["MessageCount"]; 
			$dateArray_values["message"]["year"][1][$number] = substr($row["MessageDate"], 0, 7);
			$number++;
	}
}else{
	echo mysqli_error($conn);
}
// end SQL


/*
	end Year
*/


// Check Empty Message
if (count($dateArray_values["message"]["week"][0][0]) < 1) {
	$dateArray_values["message"]["week"][1][0] = date("Y-m-d");
	$dateArray_values["message"]["week"][0][0] = "0";
}if (count($dateArray_values["message"]["month"][0][0]) < 1) {
	$dateArray_values["message"]["month"][1][0] = date("Y-m-d");
	$dateArray_values["message"]["month"][0][0] = "0";
}if (count($dateArray_values["message"]["year"][0][0]) < 1) {
	$dateArray_values["message"]["year"][1][0] = date("Y-m");
	$dateArray_values["message"]["year"][0][0] = "0";
}
// end Check Empty Message

/*************************/
// end Message Chart Values
/*************************/
/* <------------------------------------------------- New Chart Values -------------------------------------------------> */
/*************************/
// View List Chart Values
/*************************/
/*
	Week
*/
// Week info
$now_date = date("Y-m-d");
$old_day = date('Y-m-d', strtotime("-6 day"));
// end Week info
// SQL Week count
$sql_week = "SELECT count(*) as ViewCount, Date(date) as ViewDate FROM `view_list` WHERE cid = $id and date BETWEEN '$old_day' and '$now_date' GROUP BY ViewDate ORDER BY ViewDate asc";
if ($query = mysqli_query($conn, $sql_week)) {
	$number = 0;
	while ($row = mysqli_fetch_array($query)) {
		$dateArray_values["view_list"]["week"][0][$number] = $row["ViewCount"]; 
		$dateArray_values["view_list"]["week"][1][$number] = substr($row["ViewDate"], 0, 10);
		$number++;
	}
}else{
	echo mysqli_error($conn);
}
// end SQL
/*
	end Week
*/
/*
	Month
*/
// Month info
$old_date = "";
$old_month = date("Y-m-d", strtotime("-1 month"));
$now_date = date('Y-m-d');
// end Month info
// SQL Month count
$sql_month = "SELECT count(*) as ViewCount, Date(date) as ViewDate FROM `view_list` WHERE cid = $id and date BETWEEN '$old_month' and '$now_date' GROUP BY ViewDate ORDER BY ViewDate asc";
if ($query = mysqli_query($conn, $sql_month)) {
	$number = 0;
	while ($row = mysqli_fetch_array($query)) {
		$dateArray_values["view_list"]["month"][0][$number] = $row["ViewCount"]; 
		$dateArray_values["view_list"]["month"][1][$number] = substr($row["ViewDate"], 0, 10);
		$number++;
	}
}else{
	echo mysqli_error($conn);
}
// end SQL
/*
	end Month
*/
/*
	Year
*/
// Year info
$old_date = "";
$new_year = date('Y', strtotime("+1 year"));
$now_date = date("Y");
// end Year info
// SQL Year count
$sql_year = "SELECT count(*) as ViewCount, Date(date) as ViewDate FROM `view_list` WHERE cid = $id and date BETWEEN '$now_date' and '$new_year' GROUP BY DATE_FORMAT(ViewDate, '%y-%m') ORDER BY ViewDate asc";
if ($query = mysqli_query($conn, $sql_year)) {
	$number = 0;
	while ($row = mysqli_fetch_array($query)) {
			$dateArray_values["view_list"]["year"][0][$number] = $row["ViewCount"]; 
			$dateArray_values["view_list"]["year"][1][$number] = substr($row["ViewDate"], 0, 7);
			$number++;
	}
}else{
	echo mysqli_error($conn);
}
// end SQL
/*
	end Year
*/
// Check Empty View List
if (count($dateArray_values["view_list"]["week"][0][0]) < 1) {
	$dateArray_values["view_list"]["week"][1][0] = date("Y-m-d");
	$dateArray_values["view_list"]["week"][0][0] = "0";
}if (count($dateArray_values["view_list"]["month"][0][0]) < 1) {
	$dateArray_values["view_list"]["month"][1][0] = date("Y-m-d");
	$dateArray_values["view_list"]["month"][0][0] = "0";
}if (count($dateArray_values["view_list"]["year"][0][0]) < 1) {
	$dateArray_values["view_list"]["year"][1][0] = date("Y-m");
	$dateArray_values["view_list"]["year"][0][0] = "0";
}
// end Check Empty View List
/*************************/
// end View List Chart Values
/*************************/
echo json_encode($dateArray_values);
?>