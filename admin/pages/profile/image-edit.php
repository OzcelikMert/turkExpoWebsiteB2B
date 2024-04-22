<?php require_once("functions/edit_image.php"); ?>
<div class="bg-full-black">
    <div class="edit-img">
        <form id="form-image" class="form-group" style="margin-top:73px;" action="profile.php" method="post" enctype="multipart/form-data">
        <div ng-app="app" ng-controller="Ctrl">
            <div>
                <div style="background: #4285F4;padding: 12px;margin-top: -80px;color: white;">
                    <input style="width: auto;display: inline-block;margin-left: 15px;" id="fileInput" type="file"  accept="image/x-png, image/jpeg">
                </div>
                <div class="cropArea">
                    <img-crop image="myImage" area-type="square" result-image-format="image/webp" result-image="myCroppedImage"></img-crop>
                </div>
            </div>
            <div>
                <input type="hidden" value="{{myCroppedImage}}" name="crop-image">
                <input type="submit"  onclick="click_uploadbutton();" value="<?php echo _save_image;?>" class="button-green-v1">
                <a href="#" onclick="click_uploadbutton();"  class="button-red-v1 button"><?php echo _cancel;?></a>
            </div>
        </div>
        </form>
    </div>
</div>

