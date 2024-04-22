<div class="row">
    <div class="alert alert-success col-md-12" role="alert" id="notes">
        <h4><?php echo _notes; ?></h4>
        <ul>
          <li><?php echo _verifcation_form_des_1; ?></li>
          <li><?php echo _verifcation_form_des_2;  ?> <a href="javascript:DoPost()"><? echo _resend_verification_email; ?></a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"></h4>
            <p class="card-description" style="text-align: center;"><?php echo _email_verification; ?></p>
            <div class="row">
              <?php echo $ErrorMessage_show; ?>
            </div>
            <form class="forms-sample" method="post">
              <div class="form-group row">
                <label class="col-sm-1 col-form-label"><?php echo _verification_code; ?></label>
                <div class="col-sm-9 input-group">
                  <input type="text" class="form-control" name="verify_code" style="height:44px;" placeholder="<?php echo _verification_code; ?>">
                </div>
              </div>
              <button type="submit" class="btn btn-success mr-2"><?php echo _confirm; ?></button>
            </form>
          </div>
        </div>
    </div>
</div>
<script language="javascript"> 
  function DoPost(){
    $.ajax({
  type: "POST",
  url: "dashboard.php",
  data: { resend: "resend", verify_code: "" },
  success: function (){
    alert("Email to Sent!");
  }
    });
  }
</script>