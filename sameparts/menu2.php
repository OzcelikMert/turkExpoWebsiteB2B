<?php 

session_start();
if ($_GET['exit'] == "true") {
	unset($_SESSION['email']);
	echo '<script>window.location.assign("https://turkexpo.org");</script>';
}

?>

<header id="p-b-100">
<nav class="menu">
	<div class="menu-cont">
	
		<div class="logo">
			<a href=""> <img src="./images/TurkExpo.png" alt="logo" ></a>
		</div> 
		<div class="links bg-gradient-1 ">
			<div class="links-left">
                <a href="index.php"><?php echo _home;?></a>
                <a href="category/"><?php echo _catagories; ?></a>
                <a href="#"><?php echo _blog;?></a>
                
                    <div class="lang" id="lang-menu" >
                    <a class="lang-select" href="javascript:void(0);"><i class="flag-icon flag-icon-<?php echo $lang; ?>"></i> <?php echo $lang_long?></a>
                        <div class="ld">
                            <form action="" method="post">
                            <?php echo $lang_menu;?>
                            </form>
                        </div>
                    </div>

			</div>
			<div class="links-right">
				<a href="#"><a href="/admin/"> <i class="fa fa-user"></i>    <?php echo _login; ?> </a></a>
				<a href="#"><?php echo _sign_up; ?></a>
			</div>
		</div>
		
	</div>
</nav>
</header>


