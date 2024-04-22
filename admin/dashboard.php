<?php include("./tools/includes.php");?>
<!DOCTYPE html>
<html lang="<?php echolang(); ?>">
  <head>
    <?php
    include("./tools/metas.php");
    include("./tools/links.php");
    ?>
    <title><?php echo _dashboard;?></title>
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
          <?php include("./pages/dashboard/functions/new_account_control.php"); ?>
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
    <script type="text/javascript" src="/admin/assets/vendors/js/vendor.bundle.addons.js"></script>
    <script type="text/javascript" src="/admin/assets/js/demo_1/dashboard.js"></script>
  </body>
</html>