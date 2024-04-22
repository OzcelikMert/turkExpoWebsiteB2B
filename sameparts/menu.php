<!-- Menu -->
<div class="mobile_menu"  style="display:none;">
<div class="menu-btn"><span>Menu</span> <i class="fa fa-bars" aria-hidden="true"></i></div>

	
	
		<a href="https://turkexpo.org"><i class="fa fa-home"></i> <?php echo _home;?></a>
		<a href="/category/"><i class="fa fa-th"></i> <?php echo _catagories; ?></a>
		<a href="/blog.php"><i class="fa fa-sticky-note"> </i> <?php echo blog; ?></a>
		<?php 
		//Show_company_info.php
		if ($session_control) {
			echo '
				<a href="/admin/dashboard.php"><i class="fa fa-tachometer"></i> '._dashboard.'</a>';
				if($c_type==1){echo '<a href="profile/'.$c_seourl.'"><i class="fa fa-user"></i> '._profile.' '.$c_type.'</a>';}
			echo '
				<a href="/admin/inbox.php"><i class="fa fa-envelope"></i> '._messages.'</a>
				<a href="javascript:SignOut();"><i class="fa fa-sign-out"></i> '._sign_out.' </a>
			';
		}else {

			echo '
			<a href="/admin/"><i class="fa fa-user"></i>'._login.'</a>
			<a href="/admin/register.php"><i class="fa fa-user-plus"></i>'._register.'</a>
			';
		}
		
		?>

	

		<ul>
			<form action="" method="post">
				<li class="nav-item dropdown language-dropdown" style="line-height: 26px;">
					<a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
					<div class="d-inline-flex mr-0 mr-md-3" style="padding-left: 10px;">
						<div class="flag-icon-holder">
						<i class="flag-icon flag-icon-<?php echo $lang; ?>"></i> <?php echo $lang_long?>
						</div>
					</div>
					<span class="profile-text font-weight-medium d-none d-md-block"></span>
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

</div>