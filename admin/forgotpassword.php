<?php include("./tools/includes.php");?>
<!DOCTYPE html>
<html lang="<?php echolang();?>">
  <head>
      <?php 
        include("./tools/metas.php");
        include("./tools/links.php");
        include_once("./tools/includes.php");
      ?>
    <title><?php echo _forgot_password;?></title>
  </head>
  <body>
  <?php include("../sameparts/preloader.php"); ?>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth forgotpassword-bg-1 theme-one">
          <div class="row w-100" style="margin-right: 0px; margin-left: 0px;">
            <div class="col-lg-4 mx-auto">
              <h2 class="text-center mb-4" style="color:white;"><?php echo _forgot_password;?></h2>
              <div class="auto-form-wrapper">
              <?php include("./pages/forgotpassword/form.php"); ?>  
              </div>
              <?php include("./pages/forgotpassword/copyright.php"); ?>  
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <?php include("./tools/scripts.php"); ?>
  </body>
</html>