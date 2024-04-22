<?php include("./pages/profile/functions/banner.php") ?>
<div class="banner">
    <div class="banner-center">
        <form id="form-image-banner" class="form-group"  action="profile.php" method="post" enctype="multipart/form-data">
            <div class="banner-header">
                <h4> <?PHP echo _banner;?> <font style="font-size:14px">[<?php echo _banner_size; ?>: 200px * 800px]</font>
                </h4>
                <button class="button-red-v1 pad-5-15" onclick="tot(); return false;"><?php echo _cancel;?></button>
                <input type="submit" class="button-green-v1 pad-5-15"  value="<?php echo _upload_banner;?>">
                <input type="file" name="banner-image" style="float: right;padding-top: 9px;width: auto;display: block;" id="banner-file">
            </div>
            <div class="banner-select">
                <img style="width:800px;height:200px;" id="banner-image-src" src="" alt="">
                <!--a  id="banner-upload" href="javascript:void(0);"><?PHP //echo _select_banner_image;?></a-->
            </div>
            
            
        </form>
    </div>
</div>



