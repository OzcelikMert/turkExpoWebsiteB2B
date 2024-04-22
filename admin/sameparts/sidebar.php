

<!-- Sidebar -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="profile.php" class="nav-link">
          <div class="profile-image">
            <img class="img-xs rounded-circle" src="/images/company_logo/<?php echo $c_logo; ?>" alt="profile image">
          </div>
          <div class="text-wrapper">
            <p class="profile-name"><?php  if($c_type==2){echo $c_username;}else{ echo $c_name;} ?></p>
            <p class="designation"></p>
          </div>
        </a>
      </li>
      <li class="nav-item nav-category"><?php echo _main_menu; ?></li>
      <?php
      if($c_type == 2){
        echo '
        <li class="nav-item">
         <a class="nav-link" href="https://turkexpo.org/">
           <i class="menu-icon mdi mdi-home-outline"></i>
           <span class="menu-title">'._home.'</span>
         </a>
       </li>
 
       <li class="nav-item">
         <a class="nav-link" href="/admin/dashboard.php">
           <i class="menu-icon mdi mdi-view-dashboard"></i>
           <span class="menu-title">'._dashboard.'</span>
         </a>
       </li>
 
       <li class="nav-item">
         <a class="nav-link" href="/admin/profile.php">
           <i class="menu-icon mdi mdi-account-circle-outline"></i>
           <span class="menu-title">'._profile.'</span>
         </a>
       </li>
 
       <li class="nav-item">
         <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
           <i class="menu-icon mdi mdi-email-outline"></i>
           <span class="menu-title">'. _messages.'</span>
           <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="ui-basic" style="">
           <ul class="nav flex-column sub-menu">
             <li class="nav-item">
               <a class="nav-link" href="/admin/newmessage.php">'._new_message.'</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="/admin/inbox.php">'. _inbox.'</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="/admin/outbox.php">'._send_box_message.'</a>
             </li>
           </ul>
         </div>
       </li>
 
       <li class="nav-item">
         <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
           <i class="menu-icon mdi mdi-settings-outline"></i>
           <span class="menu-title">'._settings.'</span>
           <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="auth">
           <ul class="nav flex-column sub-menu">
             <li class="nav-item">
               <a class="nav-link" href="/admin/security.php">'._account_settings.'</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="javascript:SignOut();">'._sign_out.'</a>
             </li>
           </ul>
         </div>
       </li> ';

      }else{
      echo '
       <li class="nav-item">
        <a class="nav-link" href="https://turkexpo.org/">
          <i class="menu-icon mdi mdi-home-outline"></i>
          <span class="menu-title">'._home.'</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/dashboard.php">
          <i class="menu-icon mdi mdi-view-dashboard"></i>
          <span class="menu-title">'._dashboard.'</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/profile.php">
          <i class="menu-icon mdi mdi-account-circle-outline"></i>
          <span class="menu-title">'._profile.'</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/exports.php">
          <i class="menu-icon mdi mdi-label-outline"></i>
          <span class="menu-title">'._exports.'</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin/newevent.php">
          <i class="menu-icon mdi mdi-calendar-plus"></i>
          <span class="menu-title">'._share_event.'</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
          <i class="menu-icon mdi mdi-bookmark-outline"></i>
          <span class="menu-title">'._product.'</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="product" style="">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="/admin/product-add.php">'._add_product.'</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin/product-view.php">'._view_products.'</a>
            </li>
          </ul>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="menu-icon mdi mdi-email-outline"></i>
          <span class="menu-title">'. _messages.'</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic" style="">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="/admin/newmessage.php">'._new_message.'</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin/inbox.php">'. _inbox.'</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin/outbox.php">'._send_box_message.'</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="menu-icon mdi mdi-settings-outline"></i>
          <span class="menu-title">'._settings.'</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="/admin/security.php">'._account_settings.'</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:SignOut();">'._sign_out.'</a>
            </li>
          </ul>
        </div>
      </li> ';
    }

      ?>
    </ul>
</nav>

  <script>
  function SignOut(){
    var message = confirm("<?php echo _exit_confirm;?>");
    if(message == true){
      window.location.href = "?exit=true";
    }
  }
  </script>

