<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
    include("./tools/metas.php");
    include("./tools/links.php");
    include("./tools/includes.php");
    include("./sameparts/lang_edit.php");
   // $langdata = lang_check(safe($_POST["product_update_lang"]));
    ?>
    <link rel="stylesheet" href="/admin/assets/crop/ng-img-crop.css">
    <link rel="stylesheet" href="/admin/assets/crop/main.css">
    <link rel="stylesheet" href="/admin/assets/css/product.css">
    <title><?php echo _add_product;?></title>
  </head>
  <body>
    <?php include("./sameparts/session_control.php"); ?>
    <?php include("../sameparts/preloader.php"); ?>
    <div class="container-scroller">
      <?php include("./sameparts/navbar.php"); ?>
      <div class="container-fluid page-body-wrapper">
      <?php include("./sameparts/sidebar.php"); ?>
        <div class="main-panel">
          <div class="content-wrapper">
          <?php include("./pages/products/add.php"); ?>
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
    <script src="/admin/assets/js/angular.min.js"></script>
    <script src="/admin/assets/crop/ng-img-crop.js"></script>
    <script src="/admin/assets/crop/main.js"></script>
  </body>
</html>

