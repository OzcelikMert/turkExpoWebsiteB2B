<?php 
$langdata = lang_check($lang);
if (isset($_POST["lang_edit"])) {
  $editlang = safe($_POST["lang_edit"]);
}else{$editlang = $lang;}
$editlang_select = getset_languageq($conn,$langdata,$editlang);
function getset_languageq($con,$langdata,$editlang){ 
  $sql= "SELECT * FROM languages"; 
    $query = mysqli_query($con, $sql);       
      $lang_menu =  '<div class="lang_edit"><form action="" method="post" style="witdh:auto; display:inline;"><span style="margin-left: 18px;">'._lang_edit_button.'</span> <select  name="lang_edit" id="lang_profile">';
        while ($row = mysqli_fetch_array($query)){
          if ($row["enabled"]==true) {
            $select = ($editlang == $row["short_code"]) ? "selected" : "";
            $lang_menu .= '<option value="'.$row["short_code"].'" '.$select.'>'.mb_strtoupper($row["lang".$langdata]).'</option>';
          }
        } return $lang_menu.'</select></span> <input type="submit" hidden="hidden" id="lang-profile-btn"></form></div>';
}
?>





