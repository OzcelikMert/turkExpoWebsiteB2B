<?php // require_once("functions/edit_image.php"); ?>


<div class="bg-full-black">
    <div class="edit-img">
        <div style="margin-top:-10px;" >
            <div>
                <div style="background: #475ef2;padding: 12px;color: white;border-radius: 2px 2px 0px 0px;">
                  <input style="width: auto;display: inline-block;margin-left: 15px;" id="fileInput" type="file"  accept="image/x-png, image/jpeg">
                </div>

                <div class="cropArea"><img-crop image="myImage" area-type="square" result-image-format="image/webp" result-image="myCroppedImage"></img-crop></div>
            </div>
                 <input type="hidden" value="{{myCroppedImage}}" name="crop-image"> <a href="#" onclick="click_crop();"  class="cancel_btn"><?php echo _ok?></a>
        </div>
    </div>
</div>
    <script>
   function click_crop(){
        $(".edit-img").toggle();
        $(".bg-full-black").toggle();
    }
</script>