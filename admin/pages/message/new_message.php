<?php include("./pages/message/functions/send_message.php"); ?>
<div class="col-md-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"><?php echo _new_message; ?></h4>
      <?php echo $error_send_message; ?>
      <form class="forms-sample" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title"><?php echo _subject; ?></label>
          <input type="text" id="title" name="title" class="form-control" placeholder="<?php echo _subject; ?>" value="<?php if(!empty($_POST["title"])){ echo $_POST["title"];}else if(!empty($_GET["title"])){echo $_GET["title"];} ?>" required>
        </div>
        <div class="form-group">
          <label for="email"><?php echo _send_email_address; ?></label>
          <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _send_email_address; ?>" value="<?php if(!empty($_POST["email"])){ echo $_POST["email"];}else if(!empty($_GET["email"])){echo $_GET["email"];} ?>" required>
        </div>
        <div class="form-group">
          <label for="message"><?php echo _message; ?></label>
          <div class="input-group">
            <textarea class="form-control" id="message" name="message" placeholder="<?php echo _message; ?>" rows="10" maxlength="600" onkeyup="activitys_length()" required><?php if(!empty($_POST["message"])){ echo $_POST["message"];} ?></textarea>
            <span class="input-group-append">
              <div id="length_text" style="position: absolute;right: 20px;top: 5px;font-size: x-small;z-index: 99;">0/600</div>
            </span>
          </div>
        </div>
        <div class="form-group">
          <label><?php echo _file_upload; ?></label>
          <input id="file-input" type="file" multiple name="files[]" class="file-upload-default" accept="image/x-png, image/gif, image/jpeg, application/pdf">
          <div class="input-group">
            <input id="text-input" type="text" class="form-control file-upload-info" disabled="" placeholder="Upload File">
            <span class="input-group-append">
              <button id="upload-button" class="file-upload-browse btn btn-info" type="button" onclick="click_uploadbutton()"><?php echo _file_upload; ?></button>
            </span>
          </div>
        </div>
        <button type="submit" class="btn btn-success mr-2"><?php echo _send_mail; ?></button>
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
      if(filesize > 10000000){
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
  $("#length_text").html(""+textarea_length+"/600");
  }
</script>