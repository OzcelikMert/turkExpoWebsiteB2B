

<!-- Navbar -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
    <a class="navbar-brand brand-logo" href="index.php" target="_blank">
    <!--img src="./assets/images/logo.png" alt="logo" /--> 
      <H4 style="PADDING: 20PX;FONT-SIZE: 22PX;">
      <?php if($c_type==1){echo _bussines_panel;}else{echo _user_panel;}?>
      </H4>
    </a>
    <a class="navbar-brand brand-logo-mini" href="index.php" target="_blank">
      <!--img src="./assets/images/mini-logo.png" alt="logo" /--> 
            <H4 style="padding:20px;"><i class="menu-icon mdi mdi-home-outline"></i></H4>
      </a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center">
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold d-none d-lg-block"><!--a href="javascript:void(0);">Help</a--></li>

      <form action="" method="post">
				<li class="nav-item dropdown language-dropdown">
					<a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
					<div class="d-inline-flex mr-0 mr-md-3">
						<div  class="flag-icon flag-icon-<?php echo $lang; ?>">
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
		</form>

    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator" id="messageDropdown" href="javascript:void(0);" data-toggle="dropdown">
          <i class="mdi mdi-email-outline"></i>
          <span id="message_count" class="count bg-success"><?php echo $unRead_number; ?></span>
        </a>
        <!-- messages items -->
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
          <a class="dropdown-item py-3" href="inbox.php">
            <p class="mb-0 font-weight-medium float-left"> <font id="message_count_all"> <?php echo $unRead_number; ?> </font> <?php echo _unread_mails; ?> </p>
            <span class="badge badge-pill badge-primary float-right"><?php echo _view_all; ?></span>
          </a>
          <div class="dropdown-divider"></div>
          <?php echo $unRead_messages; ?>
        </div>
      </li>
      <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <img class="img-xs rounded-circle" src="/images/company_logo/<?php echo $c_logo; ?>" alt="<?php echo _profile_image;?>">
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            <img class="img-md rounded-circle" src="/images/company_logo/<?php echo $c_logo; ?>" alt="<?php echo _profile_image;?>">
            <p class="mb-1 mt-3 font-weight-semibold"><?php echo $c_name; ?></p>
            <p class="font-weight-light text-muted mb-0"><?php echo $email; ?></p>
          </div>
          <a class="dropdown-item" href="profile.php"><i class="dropdown-item-icon mdi mdi-account-circle-outline"></i><?php echo _profile ;?></a>
          <a class="dropdown-item" href="inbox.php"><i class="dropdown-item-icon mdi mdi-email-outline"></i><?php echo _messages;?></a>
          <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline"></i><?php echo _faq;?></a>
          <a class="dropdown-item" href="javascript:SignOut();"><i class="dropdown-item-icon mdi mdi-logout"></i><?php echo _sign_out;?></a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>

