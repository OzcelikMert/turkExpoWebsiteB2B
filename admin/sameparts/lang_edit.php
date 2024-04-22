<?php 


$langdata = lang_check($lang);
if (isset($_POST["lang_edit"])) {$editlang = safe($_POST["lang_edit"]);}else{$editlang = $lang;}
$editlang_select = getset_languageq($conn,$langdata,$editlang);

function getset_languageq($con,$langdata,$editlang){ 
  $sql= "SELECT * FROM languages"; 
    $query = mysqli_query($con, $sql);       
      $lang_menu =  '<form action="" method="post" style="witdh:auto; display:inline;">  <select name="lang_edit" id="lang_profile" >';
        while ($row = mysqli_fetch_array($query)){
            $select = ($editlang == $row["short_code"]) ? "selected" : "";
            $lang_menu .= '<option value="'.$row["short_code"].'" '.$select.'>'.mb_strtoupper($row["lang".$langdata]).'</option>';
        } return $lang_menu.'</select> <input type="submit" hidden="hidden" id="lang-profile-btn"></form>';
}



?>





