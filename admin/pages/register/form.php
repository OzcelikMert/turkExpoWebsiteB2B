<!-- Form -->

<?php 
  include_once("./pages/register/functions/register_control.php"); 
  include_once("./pages/register/functions/get_values.php"); 
?>

<div class="row">
  <?php echo $ErrorMessage_show; ?>
</div>

<form method="post">
    <p class="card-description text-center" style="font-size: 15px;color: blue;font-weight: bold;"><?php echo _register;?></p>
    <div class="row">

    <div class="col-md-12">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label"><?php echo _select_account_type; ?></label>
          <div class="col-sm-9 input-group">
            <select name="account_type" id="account_type" class="form-control" id="">
              <option value="1" selected><?php echo _type_bussines_tr;?></option>
              <option value="2"><?php echo _type_bussines_other;?></option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-12" id="bussines-name">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label"><?php echo _company_name; ?></label>
          <div class="col-sm-9 input-group">
            <input id="company_name" name="company_name" type="text" class="form-control" onkeyup="name_control()" maxlength="200" placeholder="<?php echo _company_name; ?>" value="<?php echo $_POST["company_name"]; ?>" required/>
          </div>
        </div>
      </div>
      <div class="col-md-6" id="username_colum">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label"><?php echo _user_name; ?></label>
          <div class="col-sm-9 input-group">
            <input id="user_name" name="user_name" type="text" class="form-control"  minlength="4" maxlength="50" placeholder="<?php echo _user_name; ?>" value="<?php echo $_POST["user_name"]; ?>" required/>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label"><?php echo _email; ?></label>
          <div class="col-sm-9 input-group">
            <input id="email" name="email" type="email" class="form-control" onkeyup="mail_control()" maxlength="100" placeholder="<?php echo _email; ?>" value="<?php echo $_POST["email"]; ?>" required/>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label"><?php echo _phone; ?> 1</label>
          <div class="col-sm-9 input-group">
            <div class="input-group-prepend bg-primary border-primary tel-select-div">
              <select name="tel_1_country" class="form-control input-group-text bg-transparent" required>
                <?php echo $tel_1_code; ?>
              </select>
            </div>
            <input id="tel_1" name="tel_1" type="number" class="form-control" style="border-radius: 0px;" min="1000000000" max="9999999999" onkeyup="tel_control('tel_1')" placeholder="<?php echo _phone; ?> 1" value="<?php echo $_POST["tel_1"]; ?>" required/>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label"><?php echo _phone; ?> 2</label>
          <div class="col-sm-9 input-group">
            <div class="input-group-prepend bg-primary border-primary tel-select-div">
              <select name="tel_2_country" class="form-control input-group-text bg-transparent">
                <?php echo $tel_2_code; ?>
              </select>
            </div>
            <input id="tel_2" name="tel_2" type="number" class="form-control" style="border-radius: 0px;" min="1000000000" max="9999999999" placeholder="<?php echo _phone; ?> 2 (not required)" value="<?php echo $_POST["tel_2"]; ?>"/>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label"><?php echo _password; ?></label>
          <div class="col-sm-9 input-group">
            <input id="pass" name="pass" type="password" class="form-control" maxlength="30" onkeyup="pass_control()" placeholder="<?php echo _password;?>" required/>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label"><?php echo _re_password;?></label>
          <div class="col-sm-9 input-group">
            <input id="pass_re" name="pass_re" type="password" class="form-control" maxlength="30" onkeyup="pass_re_control()" placeholder="<?php echo _re_password;?>" required/>
          </div>
        </div>
      </div>
    </div>
    <p class="card-description text-center" style="font-size: 15px;color: blue;font-weight: bold;padding-top: 20px;"><?php echo _address; ?></p>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label"><?php echo _address;?></label>
          <div class="col-sm-9 input-group">
            <input id="address" name="address" type="text" class="form-control" maxlength="125" onkeyup="address_control()" placeholder="<?php echo _address; ?>" value="<?php echo $_POST["address"]; ?>" required/>
          </div>
        </div>
      </div>
      <div class="col-md-6" id="country_colum">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label"><?php echo _country; ?></label>
          <div class="col-sm-9 input-group-selectbox">
            <select name="country" id="country" class="form-control" required>
              <?php echo $Countrys; ?>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label"><?php echo _city; ?></label>
          <div class="col-sm-9 input-group">
            <input id="city" name="city" type="text" class="form-control" onkeyup="city_control()" maxlength="25" placeholder="<?php echo _city; ?>" value="<?php echo $_POST["city"]; ?>" required/>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label"><?php echo _post_code;?></label>
          <div class="col-sm-9 input-group">
            <input id="postcode" name="postcode" type="text" class="form-control" onkeyup="postcode_control()" maxlength="10" placeholder="<?php echo _post_code; ?>" value="<?php echo $_POST["postcode"]; ?>" required/>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label"><?php echo _web_site; ?></label>
          <div class="col-sm-9 input-group">
            <input type="text" name="website" class="form-control" placeholder="www.site.com" value="<?php echo $_POST["website"]; ?>"/>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group d-flex">
      <div class="form-check form-check-flat mt-0">
        <label class="form-check-label">
          <input type="checkbox" id="agree_check" class="form-check-input" checked required><?php echo _agree_terms;?> </label>
      </div>
    </div>
    <div class="form-group">
      <button class="btn btn-primary submit-btn btn-block"><?php echo _register;?></button>
    </div>
    <div class="text-block text-center my-3">
      <span class="text-small font-weight-semibold"><?php echo _already_account;?></span>
      <a href="index.php" class="text-black text-small"><?php echo _login;?></a>
    </div>
</form>



<!-- Register Personal Values Control -->

<script>

  /* Detects */

  function email_detect(){
    var email = $("#email").val();
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

  }

  // email Control

  function mail_control(){
    var a = email_detect();
    if(a === true){
      $("#email").css("background-color","#19d89587");
    }else if(a != true) {
      $("#email").css("background-color","#ffe0de");
    }
  }



</script>

<!-- end Register Personal Values Control -->