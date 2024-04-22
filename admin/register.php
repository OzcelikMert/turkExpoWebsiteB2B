<?php include("./tools/includes.php");?>
<!DOCTYPE html>
<html lang="<?php echolang();?>">
  <head>
      <?php
      include("./tools/metas.php");
      include("./tools/links.php");
      ?>
    <title><?php echo _register;?></title>
  </head>
  <body>
  <?php include("../sameparts/preloader.php"); ?>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
          <div class="row w-100" style="margin-right: 0px; margin-left: 0px;">
            <div class="col-lg-7 mx-auto">
              <h2 class="text-center mb-4" style="color:white;"><?php echo _register;?></h2>
              <div class="auto-form-wrapper">
              <?php include("./pages/register/form.php"); ?>
              </div>
              <?php include("./pages/register/copyright.php"); ?>  
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
<script>
  $(document).ready(function() {
    $("#country").prop("disabled", true);
    $("#country_colum").prop("disabled", true);
    $("#country_colum").toggle();
  });

  $("#account_type").change(function(){
        var selectedCountry = $(this).children("option:selected").val();
        if(selectedCountry==1){
          $("#bussines-name").toggle();
          $("#company_name").prop("disabled", false);
          $("#country").prop("disabled", false);
          $("#country_colum").toggle();
        }else if(selectedCountry==2){
          $("#bussines-name").toggle();
          $("#company_name").prop("disabled", true);
          $("#country").prop("disabled", false);
          $("#country_colum").toggle();
        }

    });
</script>