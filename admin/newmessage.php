<?php include("./tools/includes.php");?>
<!DOCTYPE html>
<html lang="<?php echolang();?>">
  <head>
    <?php
    include("./tools/metas.php");
    include("./tools/links.php");
    include("./tools/includes.php");
    ?>
    <title><?php echo _new_message;?></title>
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
            <div class="row">
              <?php   include("./pages/message/new_message.php"); ?>
            </div>
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