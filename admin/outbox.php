<?php include("./tools/includes.php");?>
<!DOCTYPE html>
<html lang="<?php echolang();?>">
  <head>
    <?php
    include("./tools/metas.php");
    include("./tools/links.php");
    ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/message.css">
    <title><?php echo _send_box_message;?></title>
  </head>
  <?php include("./sameparts/session_control.php"); ?>
  <?php include("../sameparts/preloader.php"); ?>
  <body>
    <div class="container-scroller">
    <?php include("./sameparts/navbar.php"); ?>
      <div class="container-fluid page-body-wrapper">
      <?php include("./sameparts/sidebar.php"); ?>
        <div class="main-panel">
          <div class="content-wrapper message-full">
            <div class="message-full col-lg-12">   
              <div class="card inbox-message">
                <div class="card-body">
                  <h3><?php echo _send_box_message;?></h3>
                  <?php $get_set = "set"; include("./pages/message/functions/get_mcount.php");?>
                  <div class="mailbox-controls">
                    <div class="pull-right"><?php echo $mp_number."/".$show_count; ?>
                      <div class="btn-group">
                        <a href="<?php echo $minusPage; ?>"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button></a>
                        <a href="<?php echo $plusPage; ?>"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button></a>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                  <?php include_once("./pages/message/functions/delete_all_messages.php"); ?>
                  <form method="post" onsubmit="return deleteConfirm();">
                    <input type="hidden" name="getSet" value="set">
                    <table class="table table-striped table-hover">
                      <div id="delete-all-div"><input type="checkbox" id="checkAl"> <?php echo _select_all; ?>
                      <button  id='delete-messages' class='delete-all-btn btn btn-danger' style="display:none"><?php echo _delete_all;?></button>
                      </div>
                      <tbody>
                        <?php include("./pages/message/functions/outbox_message.php");?>
                      </tbody>
                    </table>
                    </form>
                  </div>
              </div>
        </div>     
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