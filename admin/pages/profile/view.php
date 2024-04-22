<?php
    include_once("./pages/profile/functions/get_values.php"); 
    include_once("./pages/profile/functions/lang_edit.php");
    require_once("functions/get.php");
    require_once("functions/edit.php"); 
?>
<!-- Company info -->
<?php 

//Lang Icon

$mlang = '<i class="mdi mdi-translate" style="font-size: 24px;display: block; float: right;" title="'._support_multi_languages.'"></i>';
$site_profile_page = "https://turkexpo.org/profile/";
?>

<div class="col-lg-12" id="col-2">
    <div class="card">
        <div class="p-4 border-bottom bg-light">
            <h4 class="card-title mb-0"><?php echo _profile; ?></h4>
        </div>
    <div class="card-body">
        <div class="container" style="max-width: 100% !important;">
        <div class="row">
        <div class="col-md-6">
                <div class="company-image" >
                    <img style="width:128px; height:128px; border-radius:10px;" onclick="click_uploadbutton();" id="company_image" src="/images/company_logo/<?php echo $c_logo;?>" alt="">
                    <p style="display:inline-block;"> <i class="mdi mdi-square-edit-outline" style="font-size: 20px;color: #c93d00;" onclick="click_uploadbutton();"  id="profile-edit-image"></i>
                    <a style="font-size: 18px;margin-left: 15px;" target="_blank" href="<?php echo $site_profile_page."".$c_seourl;?>"><b><?php echo $c_name;?></b></a> </p>
                <p id="mobile_name"><a href="<?php echo $site_profile_page."".$c_seourl;?>"><b><?php echo $c_name;?></b></a> </p>
                </div>
            </div>

            <div class="col-md-6">
            <div class="buttons-profile">
                <button id="profile-btn-addbanner" class="button-blue-v1" onclick="tot()"><?php echo _add_banner;?></button></b></span>
                <button id="profile_edit" class="button-blue-v1" ><?php echo _edit_profile; ?> </button>
                <?php /* lang_edit.php*/ echo  $editlang_select;?>

            </div>
            </div>

        </div>
        </div>






            <?php include("image-edit.php");?>
            <?php include("./pages/profile/banner.php") ?>
        </div>



        <div class="card-body">
            <div class="row">
                <?php echo $ErrorMessage_show; ?>
            </div>

            <form action="profile.php" id="profile" method="post">
            <input type="hidden" name="profile_update_lang" value="<?php echo $editlang ?>">
            <table class="table">
            <!--thead>
                <tr>
                <th><?php echo _type;?></th>
                <th><?php echo _value;?></th>
                </tr>
             </thead-->
             <tbody>
                <!----------->
                <tr>
                <td><?php echo _email; ?></td>
                <td><input type="text" class="form-control" disabled="disabled" value="<?php echo $c_email;?>"></td>
                </tr>
                <!----------->
                <tr>
                <td><?php echo _company_name; ?></td>
                <td><input id="input_company" name="c_name" type="text" class="form-control" disabled="disabled" value="<?php echo $c_name;?>" required></td>
                </tr>
                <!----------->

                <!--tr>
                <td><?php// echo _slogan.$mlang; ?></td>
                <td><input id="input_slogan" type="text" maxlength="200" name="slogan" class="form-control" disabled="disabled" value="<?php echo $c_slogan;?>">
                </td>
                </tr-->
                <!----------->

                <tr>
                <td><?php echo _about.$mlang; ?></td>
                <td>
                    <textarea id="input_about" maxlength="2000" rows="6" name="about" class="form-control" disabled="disabled" onkeyup="about_length()"><?php echo $c_about;?></textarea>
                    <div id="length_text" style="font-size: x-small;">0/2000</div>
                </td>
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

                <!----------->
                <tr>
                <td><?php echo _phone_wp; ?></td>
                <td>
                    <div class="input-group">
                        <div id="responsive-btn-t" class="input-group-prepend bg-primary border-primary tel-select-div"  style="height:32px;">
                            <!--select name="tel_2_country" id="responsive-btn2" class="form-control input-group-text bg-transparent" disabled="disabled">
                                <?php// echo $tel_2_code; ?>
                            </select-->
                        </div>
                        <div style="width:40px;"><input id="responsive-btn2" type="number" max="999" min="1" required name="tel_2_country" class="form-control" disabled="disabled" value="<?php echo $c_tel2_c; ?>"> </div>
                        <input id="input_tel2" type="tel" name="tel2"  max="9999999999" min="1000000000" class="form-control" disabled="disabled" value="<?php echo $c_tel2;?>">
                    </div>
                </td>
                </tr>
               <!----------->
               <tr>
               <td><?php echo _main_category; ?></td>
               <td><input id="input_category" type="text" class="form-control" disabled="disabled" value="<?php echo $c_category;?>"></td>
               </tr>
               <!----------->
               <tr>
               <td><?php echo _sub_category; ?></td>
               <td>
                <select id="input_subcategory" disabled="disabled" name="sub_category" class="form-control">
                <?php echo $sub_categorys; ?>
                </select>
               </td>
               </tr>
               <!----------->
               <tr>
               <td><?php echo _tags.$mlang; ?></td>
               <td>
                    <input id="input_activity" type="text" name="activity" maxlength="200" class="form-control" disabled="disabled" value="<?php echo $c_tags;?>">
                    <div id="activity_text" style="font-size: x-small;margin-top: 2px;">0/200</div>
                </td>
               </tr>
               <!----------->
               <tr>
               <td><?php echo _number_employees; ?>	</td>
               <td><input id="input_employees" type="number" name="ecount" max="999999999" min="1" class="form-control" disabled="disabled" value="<?php echo $c_ecount;?>"></td>
               </tr>
            </tbody>

        </table>

        <div id="form_action" stlye="display: none;"></div>
        <input type="hidden" name="form_value" value="profile">
        </form>
        <div id="change_div" style="text-align:center;">
            <!-- Update Button & Cancel Button -->
            <br>
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





