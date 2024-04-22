

<?php include("./pages/forgotpassword/functions/change_password.php"); ?>

<div class="row">

  <?php echo $ErrorMessage_show; ?>

</div>

<form class="forms-sample" method="post">

  <div class="form-group row">

    <label for="exampleInputEmail2" class="col-sm-3 col-form-label"><?php echo _verify_code; ?></label>

    <div class="col-sm-9">

      <input type="text" class="form-control" id="verifycode" name="verifycode" placeholder="<?php echo _verify_code; ?>">

    </div>

  </div>

  <div class="form-group row">

    <label for="exampleInputPassword2" class="col-sm-3 col-form-label"><?echo _retry_new_password; ?></label>

    <div class="col-sm-9">

      <input type="password" class="form-control" id="newpass" name="newpass" placeholder="<?echo _retry_new_password; ?>">

    </div>

  </div>

  <div class="form-group row">

    <label for="exampleInputPassword2" class="col-sm-3 col-form-label"><?echo _retry_new_password; ?></label>

    <div class="col-sm-9">

      <input type="password" class="form-control" id="newpassre" name="newpassre" placeholder="<?echo _retry_new_password; ?>">

    </div>

  </div>

  <button class="btn btn-success mr-2"><?php echo _change_password; ?></button>

  <a href="forgotpassword.php" class="btn btn-light"><?php echo _cancel; ?></a>

</form>

