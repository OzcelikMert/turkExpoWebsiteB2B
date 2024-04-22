<?php 
if (!empty($_GET["exit"]) && $_GET["exit"]=="true") {
	session_start();
	session_destroy();
	echo '<script type="text/javascript">window.location = "'."http://" . $_SERVER['SERVER_NAME'].'";</script>';
}

include_once("./admin/sameparts/show_company_info.php");

?>
<!-- Header -->
<header class="header trans_400">
	<div class="header_content d-flex flex-row align-items-center justify-content-start trans_400">
		<div class="logo"><a href="#"><img style="width: 160px;" src="./images/logoo.png" alt=""></div>
		<!--span>Turk</span>Expo</a-->
		<nav class="main_nav">
			<ul class="d-flex flex-row align-items-center justify-content-start">
				<li class="active"><a href="index.php"><?php echo _home;?></a></li>
				<li><a href="category/"><?php echo _catagories; ?></a></li>
				<li><a href="#"><?php echo _blog;?></a></li>

			<form action="" method="post">
				<li class="nav-item dropdown language-dropdown" style="line-height: 26px;">
					<a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
					<div class="d-inline-flex mr-0 mr-md-3">
						<div class="flag-icon-holder">
						<i class="flag-icon flag-icon-<?php echo $lang; ?>"></i>
						</div>
					</div>
					<span class="profile-text font-weight-medium d-none d-md-block"><?php echo $lang_long?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
					<?php  
					echo $lang_menu;
					?>
			</div>
			</li>
			</ul>
		</nav>
		</form>

		<div class="header_right d-flex flex-row align-items-center justify-content-start">
		<?php 
		//Show_company_info.php
		if ($session_control) {
			echo '
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
				<li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
				<a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
					<img class="img-xs rounded-circle" src="./images/company_logo/'.$c_logo.'" alt="'._profile_image.'">
				</a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
					<div class="dropdown-header text-center">
					<img class="img-md rounded-circle" src="./images/company_logo/'.$c_logo.'" alt="'._profile_image.'">
					<p class="mb-1 mt-3 font-weight-semibold">'.$c_name.'</p>
					<p class="font-weight-light text-muted mb-0">'.$email.'</p>
					</div>
					<a class="dropdown-item" href="/admin/dashboard.php"><i class="fa fa-tachometer"></i> '._dashboard.'</a>';
				if($c_type==1){ echo '<a class="dropdown-item" href="profile/'.$c_seourl.'"><i class="fa fa-user"></i> '._profile.'</a>';}
				echo '
					<a class="dropdown-item" href="/admin/inbox.php"><i class="fa fa-envelope"></i> '._messages.'</a>
					<a class="dropdown-item" href="javascript:SignOut();"><i class="fa fa-sign-out"></i> '._sign_out.' </a>
				</div>
				</li>
			</ul>
			';
		}else {
			echo '<!-- Header Links -->
			<div class="header_links">
				<ul class="d-flex flex-row align-items-center">
					<li><a href="/admin/"> <i class="fa fa-user"></i> '._login.'</a></li>
					<li id="reg"><a href="/admin/register.php"><i class="fa fa-user-plus"></i> '._register.' </a></li>
				</ul>
			</div>';
		}
		
		?>


			<div class="menu-btn"><i class="fa fa-bars" aria-hidden="true"></i></div>
		</div>	
	</div>
</header>