<?php 

include_once("./config/config.php");
session_start();
$GLOBALS["langdata"] = $langdata;
$email = $_SESSION["email"];
$id = GetID($conn, $email);
$Exports = getExports($conn);
$Events = getEvents($conn);
$Registereds = getRegistereds($conn);
$TotalView = getTotal_view($conn, $id);
$TotalMessage = getTotal_message($conn, $id);
/*	Functions */



// GET EXPORTS

function getExports($connect){
	$exports = "";
	$sql = "SELECT exports.*, countrys.name".$GLOBALS["langdata"]." as CountryName FROM `exports` INNER JOIN countrys ON countrys.id = exports.country order by exports.date desc";
	$query = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($query)){
		$exports .= '
		<tr>
    	    <td>'.$row["CountryName"].'</td>
    	    <td>'.number_format($row["price"], 2, ',', '.')." ".$row["price_type"].'</td>
    	    <td>'.$row["date"].'</td>
    	</tr>';
	}
	return $exports;

}

// end GET EXPORTS



// GET EVENTS
/*
function getEvents($connect){
	$events = "";
	$sql = "select events.*, event_categorys.name".$GLOBALS['langdata']." as EC_name, event_categorys.bg_color as EC_bgColor from events 
	INNER JOIN event_categorys ON event_categorys.id = events.category 
	order by date desc limit 0, 7";
	$query = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($query)){
		$categoryColor = "".$row["EC_bgColor"]."";
		$events .= '
		<div class="d-flex py-2 border-bottom">
	    	<div class="wrapper">
	    	  <small class="text-muted">'.$row["date"].'</small>
	    	  <p class="font-weight-semibold text-gray mb-0">'.$row["title"].'</p>
	    	</div>
	    	<small class="ml-auto badge badge-'.$categoryColor.'" style="height: 20px;">'.$row["EC_name"].'</small>
		</div>
		';
	}
	return $events;
}*/
function getEvents($connect){
	$events = "";
	$sql = 'select seourl,title'.$GLOBALS['langdata'].' as title, date from events order by date desc';
	$query = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($query)){
		$events .= '
		<div class="d-flex py-2 border-bottom">
	    	<div class="wrapper">
	    	  <small class="text-muted">'.$row["date"].'</small>
			  <a href="http://turkexpo.org/profile/'.$row["seourl"].'">
			   <p class="font-weight-semibold text-gray mb-0">'.$row["title"].'</p>
			  </a>
	    	</div>
		</div>
		';
	}
	return $events;
}

// end GET EVENTS


// GET REGISTEREDS
function getRegistereds($connect){
	$registereds = "";
	$sql = "
	select 
	company_info.company_name as CompanyName,
	company_info.seo_company_name as CompanySeoName,
	main_categorys.name".$GLOBALS["langdata"]." as CategoryName
	from company_info
	INNER JOIN main_categorys ON main_categorys.id = company_info.main_category
	order by company_info.register_date desc limit 0, 7
	";

	$query = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($query)){
		$registereds .= '
		<li class="timeline-item">
    		<p class="timeline-content"><a href="../profile.php?company_name='.$row["CompanySeoName"].'" target="_blank">'.$row["CompanyName"].'</a> '._joined_us.'!</p>
        	<p class="event-time">'.$row["CategoryName"].'</p>
    	</li>
		';
	}
	return $registereds;
}
// end GET REGISTEREDS


// Get Total View
function getTotal_view($connect, $id_){
	$count = 0;
	$sql = "select count(*) as Count_ from view_list where cid = '$id_'";
	$query = mysqli_query($connect, $sql);
	if($row = mysqli_fetch_array($query)){
		$count = $row["Count_"];
	}
	return $count;
}
// end Get Total View



// Get Total View
function getTotal_message($connect, $id_){
	$count = 0;
	$sql = "select count(*) as Count_ from messages where cid_get = '$id_'";
	$query = mysqli_query($connect, $sql);
	if($row = mysqli_fetch_array($query)){
		$count = $row["Count_"];
	}
	return $count;
}
// end Get Total View
/* end Functions */
?>