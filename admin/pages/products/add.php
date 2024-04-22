<?php include("./pages/products/functions/add-product.php"); ?>
<div class="row">
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"><?php echo _new_product; ?></h4>
      <div class="row">
        <?php echo $ErrorMessage_show; ?>
      </div>
      <!----- FORM ------->
      <form class="forms-sample" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title"><?php echo _title; ?></label>
          <input type="hidden" name="product_update_lang" value="<?php echo $editlang;?>">
          <input type="text" id="title" name="title" class="form-control" placeholder="<?php echo _title; ?>" value="<?php echo $_POST["title"];?>" required="">
        </div>
        <div class="form-group">
          <label for="email"><?php echo _type; ?></label>
          <input type="text" name="type" id="type" class="form-control" placeholder="<?php echo _type; ?>" value="<?php echo $_POST["type"];?>" required="">
      
        </div>
        <div class="form-group" ng-app="app" ng-controller="Ctrl">
          <label><?php echo _product_logo; ?></label>
          <input id="file-insput" type="file" multiple=""  class="file-upload-default" accept="image/x-png, image/jpeg">
          <div class="input-group">
          <img src="{{myCroppedImage}}" class="addimageicon" alt="" onclick="click_crop()">          
          </div>
          <?php include("crop_image.php"); ?>
        </div>  
    
        <div class="form-group">
          <label for="message"><?php echo _description; ?></label>
          <div class="input-group">
            <textarea class="form-control" id="message" name="message" rows="10" maxlength="1000" onkeyup="activitys_length()" required=""><?php echo $_POST["message"];?></textarea>
            <span class="input-group-append">
              <div id="length_text" style="position: absolute;right: 20px;top: 5px;font-size: x-small;z-index: 99;">0/600</div>
            </span>
          </div>
        </div>
        <div class="form-group">
          <label><?php echo _slider_images_max_10; ?></label>
          <input id="file-input" type="file" multiple="" name="files[]" class="file-upload-default" accept="image/x-png, image/jpeg">
          <div class="input-group">
            <input id="text-input" type="text" class="form-control file-upload-info" disabled="" placeholder="<?php echo _upload_file;?>">
            <span class="input-group-append">
              <button id="upload-button" class="file-upload-browse btn btn-info" type="button" onclick="click_uploadbutton()"><?php echo _upload_file; ?></button>
            </span>
          </div>
        </div>
        <input type="submit" class="button-green-v1 pad-15-10 float-left" value="<?php echo _add_product;?>">
      </form>
    </div>
  </div>
</div>
<script>
  function click_uploadbutton(){
    // Open file select window
    $("#file-input").trigger("click");
    // If item selected
    $('#file-input').change(function() {
      var fp = $("#file-input");
      var lg = fp[0].files.length; // get length
      var items = fp[0].files;
      var filename = "";
      var filesize = 0;
      for(var i = 0; i < lg; i++){
        filename += items[i].name+", ";
        filesize += items[i].size;
      }
      if(filesize > 10000000 || parseInt(fp.get(0).files.length) > 10){
        this.value = "";
        filename = "";
        alert("File is too big!");
      }
        $('#text-input').val(filename);
    });
    // end item selected
  }
  // Max character textarea
  function activitys_length(){
  var textarea_length = $("#message").val().length;
  $("#length_text").html(""+textarea_length+"/1000");
  }
</script>           
</div>

