<?php include("./tools/includes.php");?>
<!DOCTYPE html>
<html lang="<?php echolang();?>">
  <head>
    <?php
    include_once("./tools/metas.php");
    include_once("./tools/links.php");
    ?>
    <link rel="stylesheet" href="/admin/assets/crop/ng-img-crop.css">
    <link rel="stylesheet" href="/admin/assets/crop/main.css">
    <link rel="stylesheet" href="/admin/assets/css/profile.css">
    <title><?php echo _exports;?></title>
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
              <?php include("pages/exports/add.php");?>
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
  </body>
</html>