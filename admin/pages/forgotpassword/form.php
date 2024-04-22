<!-- Form -->

<?php include("./pages/forgotpassword/functions/email_control.php"); ?>
<?php include_once("./tools/includes.php");?>
<div class="row">

  <?php echo $ErrorMessage_show; ?>

</div>

<form method="post">

    <div class="form-group">

      <label class="label"><?php echo _email; ?></label>

      <div class="input-group">

        <input type="email" name="email" id="mymail" class="form-control" required placeholder="Email" onkeyup="mail_control()">

      </div>

    </div>

    <div class="form-group">

      <button id="mybtn" class="btn btn-primary submit-btn btn-block"><?php echo _next; ?></button>

    </div>

    <div class="text-block text-center my-3">

      <a href="index.php" class="text-black text-small"><b>Turn Login Page</b></a>

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