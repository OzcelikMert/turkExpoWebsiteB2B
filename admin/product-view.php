<?php include("./tools/includes.php");?>
<!DOCTYPE html>
<html lang="<?php echolang();?>">
  <head>
    <?php
    include("./tools/metas.php");
    include("./tools/links.php");
    ?>
    <link rel="stylesheet" href="./assets/css/product.css">
    <title><?php echo _view_products;?></title>
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
          <?php include("../admin/pages/products/functions/get-product.php");?>
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
  </body>
</html>