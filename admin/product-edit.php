<?php include("./tools/includes.php");?>
<!DOCTYPE html>
<html lang="<?php echolang();?>">
  <head>
    <?php
    include("./tools/metas.php");
    include("./tools/links.php");
    include("./tools/includes.php");
    ?>
    <link rel="stylesheet" href="assets/crop/ng-img-crop.css">
    <link rel="stylesheet" href="assets/crop/main.css">
    <link rel="stylesheet" href="./assets/css/product.css">
    <title><?php echo _edit_product;?></title>
  </head>
  <body>
    <?php include("./sameparts/session_control.php"); ?>
    <?php  include("../sameparts/preloader.php"); ?>
    <div class="container-scroller">
      <?php include("./sameparts/navbar.php"); ?>
      <div class="container-fluid page-body-wrapper">
      <?php include("./sameparts/sidebar.php"); ?>
        <div class="main-panel">
          <div class="content-wrapper">
          <?php include("./pages/products/update.php"); ?>
          </div>
          <!-- content-wrapper ends -->
         <?php include("./sameparts/footer.php"); ?>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php include("./tools/scripts.php"); ?>
    <script src="./assets/js/angular.min.js"></script>
    <script src="assets/crop/ng-img-crop.js"></script>
    <script src="assets/crop/main.js"></script>
    <script>
      $("#lang_edit").change(function(){
      $("#lang_edit-btn").trigger("click"); 
      });
    </script>
  </body>
</html>

