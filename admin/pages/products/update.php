<?php include("./pages/products/functions/edit-product.php"); 
include("./pages/products/functions/lang_edit.php");
?>
<div class="row">
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"><?php echo _product_name; echo $editlang_select; ?></h4>
      <div class="row">
        <?php echo $ErrorMessage_show; ?>
      </div>
          
          <form class="forms-sample" method="post" enctype="multipart/form-data">
        <?php  echo $editlang_updatelang; ?>
        <div class="form-group">
          <input type="hidden" name="product_update_lang" value="<?php echo $editlang;?>">
          <label for="title"><?php echo _title; ?></label>
          <input type="text" id="title" name="title" class="form-control" placeholder="<?php echo _title; ?>" value = "<?php echo $title;?>" required>
        </div>
        <div class="form-group">
          <label for="type"><?php echo _type; ?></label>
          <input type="text" name="type" id="type" class="form-control" value="<?php echo $type; ?>" placeholder="<?php echo _type; ?>" required>
        </div>
        <div class="form-group" ng-app="app" ng-controller="Ctrl">
          <label><?php echo _product_logo; ?></label>
          <div class="input-group">
            <div>
              <img id="userlogo" onclick="click_crop()" class="addimageicon" src="../images/products_images/<?php  echo $plogo; ?>" style="width:200px; height:200px; background:#d9d9d9;position: absolute;z-index:1;" alt="">
              <img id="cropted" onclick="click_crop()"  class="addimageicon" src="{{myCroppedImage}}" style="width:200px; height:200px; background:#d9d9d9;position: relative;z-index:0;" alt="">
            </div>
            <!--span class="input-group-append">
              <button id="upload-button" style="margin-left:10px;" class="file-upload-browse btn btn-info" type="button" onclick="click_crop()"><?php echo _upload_product_logo; ?> </button>
            </span-->
          </div>
          <?php include("crop_image.php"); ?>
        </div>    
        <div class="form-group">
          <label for="message"><?php echo _description; ?></label>
          <div class="input-group">
            <textarea class="form-control" id="message" name="desc" rows="10" maxlength="1000" onkeyup="activitys_length()" required><?php echo $desc; ?></textarea>
            <span class="input-group-append">
              <div id="length_text" style="position: absolute;right: 20px;top: 5px;font-size: x-small;z-index: 99;">0/1000</div>
            </span>
          </div>
        </div>
        <div class="form-group" style="text-align: -webkit-center;">
          <label><?php echo _slider_images; ?></label>
          <div class="input-group col-md-8" id="slider-images" style="justify-content: center;">
            <div id="slider-images-values">
              <?php echo $Sliders; ?>
            </div>
          </div>
        </div>
        <input id="row__" type="hidden" name="row" value="<?php echo $_POST["row"]; ?>">
        <input type="submit" class="btn btn-success mr-2" value="<?php echo _update; ?>">
        <a href="product-view.php" class="btn btn-secondary btn-fw"><?php echo _cancel; ?></a>
      </form>
    </div>
  </div>
</div>
<script>
// Real time change img
function readURL(id, img) {
  var input = $("#"+id);
  if (input[0].files && input[0].files[0]) {
      var reader = new FileReader();
      
      reader.onload = function (e) {
        $('#'+img).css('background-color', '');
          $('#'+img).css('background-image', 'url('+e.target.result+')');
      }
      reader.readAsDataURL(input[0].files[0]);
    }
  }
  function edit_image(id, id2){
    $("#"+id).trigger("click");
    $("#"+id).change(function() {
      var fp = $("#"+id);
      var items = fp[0].files;
      var filename = "", filesize = 0;
      filesize = items.size;
      if(filesize > 10000000){
        this.value = "";
        filename = "";
        alert("Max File Size  10 MB");
      }else{
        readURL(id, id2);
      }
    });
  }
  // Max character textarea
  function activitys_length(){
  var textarea_length = $("#message").val().length;
  $("#length_text").html(""+textarea_length+"/1000");
  }
</script>           
</div>



