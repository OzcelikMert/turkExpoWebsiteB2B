<?php
    include_once("./pages/profile/functions/get_values.php"); 
    require_once("functions/get_user.php");
    require_once("functions/edit_user.php"); 
?>
<!-- Company info -->
<?php 

//Lang Icon
?>
<div class="col-lg-12" id="col-2">
    <div class="card">
        <div class="p-4 border-bottom bg-light">
            <h4 class="card-title mb-0"><?php echo _profile; ?></h4>
        </div>
    <div class="card-body">

            <div class="company-image" >
                <img style="width:128px; height:128px; border-radius:10px;" onclick="click_uploadbutton();" id="company_image" src="/images/company_logo/<?php echo $c_logo;?>" alt="">
                <i class="mdi mdi-square-edit-outline" style="font-size: 20px;color: #c93d00;" onclick="click_uploadbutton();"  id="profile-edit-image"></i>
               <b id="mobile_hide" style="padding-left:20px;"><?php echo $c_username;?></b>
               <P id="mobile_name"> <b><?php echo $c_username;?></b></P>
            </div>

            <div class="profile-right-button">
                <button id="profile_user_edit" class="btn btn-success mr-2 edit-profile"><?php echo _edit_profile; ?> </button>
            </div>

            <?php include("image-edit.php");?>
        </div>

        <div class="card-body">
            <div class="row">
                <?php echo $ErrorMessage_show; ?>
            </div>

            <form action="profile.php" id="profile" method="post">
            <input type="hidden" name="profile_update_lang" value="<?php echo $editlang ?>">
            <table class="table">
            <thead>
                <tr>
                <th><?php echo _type;?></th>
                <th><?php echo _value;?></th>
                </tr>
             </thead>
             <tbody>
                <!----------->
                <tr>
                <td><?php echo _user_name; ?></td>
                <td><input id="user_name" type="text" class="form-control" maxlenght="50" minlenght="4"  name="user_name" disabled="disabled" value="<?php echo $c_username;?>"></td>
                </tr>
                <!----------->
                <tr>
                <td><?php echo _email; ?></td>
                <td><input type="text" class="form-control" disabled="disabled" value="<?php echo $c_email;?>"></td>
                </tr>
                <!----------->
                <tr>
                <td><?php echo _web_site; ?></td>
                <td><input id="input_website" type="text" maxlength="70" name="website" class="form-control" disabled="disabled" value="<?php echo $c_web;?>">
                </td>
                </tr>
                <!----------->

                <tr>
                <td><?php echo _address; ?></td>
                <td><input id="input_address" type="text" name="address" maxlength="255" class="form-control" required disabled="disabled" value="<?php echo $c_adress;?>">
                </td>
                </tr>

                <!----------->
                <tr>
                <td><?php echo _country; ?></td>
                <td>
                <select id="input_country" disabled="disabled" name="country" class="form-control" required>
                    <?php echo $Countrys; ?>
                </select>
                </td>
                </tr>
                <!----------->
                <tr>
                <td><?php echo _city; ?></td>
                <td><input id="input_city" type="text" required name="city" maxlength="70" class="form-control"  disabled="disabled" value="<?php echo $c_city;?>"></td>
                </tr>
               <!----------->
                <tr>
                <td><?php echo _post_code; ?></td>
                <td><input id="input_postcode" type="text" required name="postcode" maxlength="15" class="form-control"  disabled="disabled" value="<?php echo $c_postcode;?>"></td>
                </tr>
               <!----------->
                <tr>
                <td><?php echo _phone; ?></td>
                <td>
                    <div class="input-group">
                        <div id="responsive-btn-t" class="input-group-prepend bg-primary border-primary tel-select-div" style="height:32px;">
                            <!--select name="tel_1_country" id="responsive-btn" class="form-control input-group-text bg-transparent" required disabled="disabled">
                                <?php// echo $tel_1_code; ?>
                            </select-->
                        </div>
                        <div style="width:40px;"><input id="responsive-btn" type="number" max="999" min="1" required name="tel_1_country" class="form-control" disabled="disabled" value="<?php echo $c_tel_c; ?>"> </div>
                        <input id="input_tel" type="tel" required name="tel" class="form-control" disabled="disabled" value="<?php echo $c_tel;?>">
                    </div>
                </td>
                </tr>
            </tbody>
        </table>

        <div id="form_action" stlye="display: none;"></div>
        <input type="hidden" name="form_value" value="profile">
        </form>
        <div id="change_div" style="text-align:center;">
        <button id="update_button" style="display:none;" class="btn btn-success "><?php echo _update;?></button>
            <button id="cancel_button" style="display:none;" class="btn btn-light"><?php echo _cancel;?></button>
        </div>
        </div>
    </div>
</div>



<script>

   function tot(){
        $(".banner").toggle();
    }

   function click_uploadbutton(){
        $(".edit-img").toggle();
        $(".bg-full-black").toggle();
    }


    function about_length(){
        var textarea_length = $("#input_about").val().length;
        $("#length_text").html(""+textarea_length+"/1600");
    }

    function activitys_length(){
        var activity_length = $("#input_activity").val().length;
        $("#activity_text").html(""+activity_length+"/200");
    }

//banner-image-src

</script>





