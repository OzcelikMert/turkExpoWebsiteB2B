<!-- Form -->
<?php include("./pages/login/functions/login_control.php"); ?>
<div class="row">
  <?php echo $ErrorMessage_show; ?>
</div>
<form method="post">
    <div class="form-group">
      <label class="label"><?php echo _email; ?></label>
      <div class="input-group">
        <input type="email" name="email" id="mymail" class="form-control" required placeholder="<?php echo _email; ?>" onkeyup="mail_control()" value="<?php echo $cookie_email; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="label"><?php echo _password; ?></label>
      <div class="input-group">
        <input id="mypass" type="password" name="pass" class="form-control" required placeholder="<?php echo _password; ?>" onkeyup="pass_control()" value="">
      </div>
    </div>
    <div class="form-group">
      <button id="mybtn" class="btn btn-primary submit-btn btn-block"><?php echo _login; ?></button>
    </div>
    <div class="form-group d-flex justify-content-between">
      <div class="form-check form-check-flat mt-0">
        <label class="form-check-label">
          <input type="checkbox" name="keep" class="form-check-input" value="Keep" checked> <?php echo _keep_me_signed_in; ?> </label>
      </div>
      <a href="forgotpassword.php" class="text-small forgot-password text-black"><?php echo _forgot_password; ?></a>
    </div>
    <div class="text-block text-center my-3">
      <span class="text-small font-weight-semibold"><?php echo _not_a_member; ?> ?</span>
      <a href="register.php" class="text-black text-small"><?php echo _create_new_account; ?></a>
    </div>
</form>

<!-- Mail Values Control -->
<script>
  function control(){
    var email = $("#mymail").val();
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }
  
  function mail_control(){
    var a = control();
    if(a === true){
      $("#mymail").css("background-color","#19d89587");
    }else if(a != true) {
      $("#mymail").css("background-color","#ffe0de");
    }
  }
</script>
<!-- end Mail Values Control -->