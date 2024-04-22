<?php include_once("./pages/security/functions/change.php"); ?>
<div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"><?php echo _change_password; ?></h4>
        <div class="row">
          <?php echo $ErrorMessage_show; ?>
        </div>
        <form class="forms-sample" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1"><?php echo _self_password; ?></label>
            <input type="password" class="form-control" id="selfpassword" name="oldpass" placeholder="<?php echo _self_password; ?>" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1"><?php echo _new_password; ?></label>
            <input type="password" class="form-control" id="newpassword" name="newpass" placeholder="<?php echo _new_password; ?>" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">            <label for="exampleInputEmail1"><?php echo _retry_new_password; ?></label></label>
            <input type="password" class="form-control" id="repassword" name="newpassre" placeholder="<?php echo _retry_new_password; ?>" required>
          </div>
          <button type="submit" class="btn btn-success mr-2"><?php echo _change; ?></button>
        </form>
      </div>
    </div>
</div>