<?php include("./tools/includes.php");?>
<!DOCTYPE html>
<html lang="<?php echolang();?>">
  <head>
    <?php
    include_once("./tools/metas.php");
    include_once("./tools/links.php");
    include_once("./tools/includes.php");
    ?>
    <link rel="stylesheet" href="/admin/assets/crop/ng-img-crop.css">
    <link rel="stylesheet" href="/admin/assets/crop/main.css">
    <link rel="stylesheet" href="/admin/assets/css/profile.css">
    <title><?php echo _profile;?></title>
  </head>
  <?php include("./sameparts/session_control.php"); ?>
  <?php include("../sameparts/preloader.php"); ?>
  <body>
    <div class="container-scroller">
    <?php include("./sameparts/navbar.php"); ?>
      <div class="container-fluid page-body-wrapper">
      <?php include("./sameparts/sidebar.php"); ?>
        <div class="main-panel">
          <div class="content-wrapper"> 
              <?php 
              if($c_type==1){
              include("pages/profile/view.php");
              }else{
              include("pages/profile/view_user.php");
              }
              ?>
          </div>
          <!-- content-wrapper ends -->
          <?php include("./sameparts/footer.php"); ?>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <script src="/admin/assets/js/angular.min.js"></script>
    <script src="/admin/assets/crop/ng-img-crop.js"></script>
    <script src="/admin/assets/crop/main.js"></script>
    <?php include("./tools/scripts.php"); ?>
<script>

window.onload = function() {
    about_length();
    activitys_length();
};

  $("#banner-upload").click(function() {
    $("#banner-file").click();
    });

    $("#banner-file").change(function() {
   $("#banner-upload-btn").prop( "disabled", false );
  });

  $("#lang_profile").change(function(){
    $("#lang-profile-btn").trigger("click");
  });

function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#banner-image-src').attr('src', e.target.result);
      } 
      reader.readAsDataURL(input.files[0]); 
  }
}

 $("#banner-file").change(function(){
     readURL(this);
 });
</script>
</body>
</html>