<?php 
$langdata = lang_check($lang);
$pid = safe($_POST['row']);
$edditlang = (isset($_POST["lang_edit"])) ? $editlang = safe($_POST["lang_edit"]) : $editlang = $lang;
$editlang_select = getset_languageq($conn,$langdata,$editlang,$pid);
$editlang_updatelang ='<input type="hidden" name="update_lang_product" value="'.safe($_POST["lang_edit"]).'">';

function getset_languageq($con,$langdata,$editlang,$pid){ 
  $sql= "SELECT * FROM languages"; 
    $query = mysqli_query($con, $sql);       
      $lang_menu =  '<form action="" method="post" style="witdh:auto; display:inline;"> <div style="display: block;width: 256px;float: right;"> <span style="margin-top: 6px;display: inline-block;">'._lang_edit_button.'</span> <select name="lang_edit" id="lang_edit"></div>';
        while ($row = mysqli_fetch_array($query)){
          if ($row["enabled"]==true) {
            $select = ($editlang == $row["short_code"]) ? "selected" : "";
            $lang_menu .= '<option value="'.$row["short_code"].'" '.$select.'>'.mb_strtoupper($row["lang".$langdata]).'</option>';
          }
        } return $lang_menu.'</select><input type="hidden" name="row" value="'.safe($pid).'"> <input type="submit" hidden="hidden" id="lang_edit-btn"></form>';
}
?>





