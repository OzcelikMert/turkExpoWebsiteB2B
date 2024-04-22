<?php
include_once("./admin/config/config.php");
//Langue 
// Get Values
$Main_Categorys = GetB2B_andCount($conn,$lang);
//$Recent_Events = GetRecent_events($conn);
$GetBlocks = Get_Blocks($conn);

// Get Business to Business Marketplace
function GetB2B_andCount($connect,$lang){
	//Langue Select
		$langdata = lang_check($lang);
	$get_values = "";
	// Get Desc Count Main Category
	$sql = "SELECT main_categorys.*, count(company_info.main_category) as c_main_category 
	FROM main_categorys INNER JOIN company_info ON company_info.main_category = main_categorys.id 
	GROUP BY company_info.main_category, main_categorys.id ORDER BY c_main_category DESC LIMIT 0, 9";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
		$get_values .= '
			<div class="col-md-4">
				<div class="property-wrap ">
					<a href="category/'.$row["seourl".$langdata].'" class="img-categorys" style="background-image: url(./images/category_images/'.$row["img"].');"></a>
					<div class="text">
						<ul class="property_list">
							<li>
								<img src="./images/company.png" class="category_icon" alt="'.$row["name".$langdata].'" title="'.$row["name".$langdata].'">'.$row["c_main_category"].' '._companies.'
							</li>
						</ul>
						<h3><a href="category/'.$row["seourl".$langdata].'">'.$row["name".$langdata].'</a></h3>
					</div>
					</a>
				</div>
			</div>
		';
	}
	// end Get Desc Count Main Category
	return $get_values;
}

// end Get Business to Business Marketplace
// Get Recent Events
function GetRecent_events($connect){
	$events = "";
	$sql = "SELECT events.*, company_info.company_name as CompanyName, company_info.seo_company_name as CompanyURL, event_categorys.name as EC_name, event_categorys.bg_color as EC_bgColor 
	FROM `events` 
	INNER JOIN company_info on company_info.id = events.cid 
	INNER JOIN event_categorys ON event_categorys.id = events.category 
	order by events.date desc limit 0, 5";
	$query = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($query)){
		$categoryColor = "".$row["EC_bgColor"]."";
		$events .= '
		<div class="d-flex py-2 border-bottom">
			<div class="wrapper">
			<small class="text-muted">'.$row["date"].'</small>
			<a class="recent-events-companyname" href="profile/'.$row["CompanyURL"].'" target="blank_">'.$row["CompanyName"].'</a> 
			<p class="font-weight-semibold text-gray mb-0">'.$row["title"].'</p>
			<p class="recent-events-comment" style="overflow: hidden;">'.$row["message"].'</p>
			</div>
			<small class="ml-auto badge badge-'.$categoryColor.'" style="height: 20px;"><font style="display: block;margin: 3px;">'.$row["EC_name"].'</font></small>
		</div>
		';
	}
	return $events;
}


// end Get Recent Events
// Get Recent Registereds
function GetRecent_registereds($connect){
	$registereds = "";
	$sql = "select * from company_info order by register_date desc limit 0, 7";
	$query = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($query)){
		$sql2 = "select * from main_categorys where id = ".(int)$row["main_category"]."";
		$query2 = mysqli_query($connect, $sql2);
		if($row2 = mysqli_fetch_array($query2)){
			$main_category = $row2["name"];
		}
		$registereds .= '
		<li class="timeline-item">
			<p class="timeline-content"><a href="../profile.php?company_name='.$row["seo_company_name"].'" target="_blank">'.$row["company_name"].'</a> joined us!</p>
			<p class="event-time">'.$main_category.'</p>
		</li>
		';
	}
	return $registereds;
}
// end Get Recent Registereds


function Get_Blocks($connect){
	$data = "";
	$sql = "select * from blog where type = 0 order by date desc limit 0, 10";
	$query = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($query)){

		$data .= '<a href="https://turkexpo.org/blog/'.$row["seourl".$GLOBALS["langdata"]].'">
		<div class="d-flex py-2 border-bottom">
			<div class="wrapper">
			<small class="text-muted">'.$row["date"].'</small>
			<p class="font-weight-semibold text-gray mb-0">'.$row["title".$GLOBALS["langdata"]].'</p>
			</div>
		</div><a/>
		';
	}
	return $data;
}
?>