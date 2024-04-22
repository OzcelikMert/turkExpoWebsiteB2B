<?php 

$lang_ctr = lang_control($conn);
$lang = $lang_ctr["lang"];
$lang_long = $lang_ctr["lang_long"];
$lang_menu = $lang_ctr["lang_menu"];
$GLOBALS["lang"] = $lang;
$GLOBALS["langdata"] = lang_check($lang);
GetLangueDefine($lang,$language_page_index);

function lang_control($conn_){
  if (isset($_POST['lang'])) {
         $lang = ($_POST['lang']);
         echo '<script> window.location.href = window.location.href; </script>';
   }else{
      if (isset($_COOKIE["language"])) { 
        $lang = safe($_COOKIE["language"]);    
      }
      else{
         $lang = "tr"; setcookie("language",$lang, time() + (10 * 365 * 24 * 60 * 60),"/"); 

        }
   }

    $sql= 'SELECT * FROM languages where short_code = "'.$lang.'"'; 
     $query = mysqli_query($conn_, $sql);
      if ($row = mysqli_fetch_array($query)){
         if ($lang == $row["short_code"]) {
              $lang = $row["short_code"];
               if ($lang !="gb") { $lang_long = $row["lang_".$lang];}
               else{ $lang_long = $row["lang"];}
              setcookie("language",$lang,time() + (10 * 365 * 24 * 60 * 60),"/");
              
         }
      }else{
          $lang = "gb";
          $lang_long = "English";
          setcookie("language",$lang,time() + (10 * 365 * 24 * 60 * 60),"/");
      }

      $lang_menu = getset_language($conn_,$lang);
      $langvalues["lang"]= $lang;  
      $langvalues["lang_long"]= $lang_long;
      $langvalues["lang_menu"] = $lang_menu;
      return $langvalues;
}


function getset_language($con,$lang){ 
    $sql= "SELECT * FROM languages"; 
      $query = mysqli_query($con, $sql);
        $lang_menu = "";
        while ($row = mysqli_fetch_array($query)){
        if ($row["enabled"]==true) {
          if ($lang!="gb") {
                if ($lang != $row["short_code"]) { $lang_menu .= lang_menu($row["short_code"],$row["lang_".$lang]); } // Kendine Eşitse Gözükmüyecek
              }else{ 
                  if ($lang != $row["short_code"]) { $lang_menu .= lang_menu($row["short_code"],$row["lang"]); }        // Kendine Eşitse Gözükmüyecek         
              }
        }
     }
  return $lang_menu;
}



function lang_menu($lang,$lang_country){
        $lang_menu = 
        '<input type="submit" id="lang_'.$lang.'" hidden="hidden" name="lang" value="'.$lang.'">
         <a class="dropdown-item" href="javascript:selectLang(\''.$lang.'\')">
            <div class="flag-icon-holder" style="height: auto;display: contents;">
              <i class="flag-icon flag-icon-'.$lang.'"></i>
            </div>'.$lang_country.' 
         </a>';
  return $lang_menu;

}



function lang_check($lang){
  if ($lang!="gb") { $langdata = "_".$lang; }
   else { 
    $langdata = "";
  }return $langdata;
}

function echolang(){
  if(empty($GLOBALS["langdata"])){
      echo "en";
  }else{
      echo str_replace("_","",$GLOBALS["langdata"]);
  }
}

function GetlangueCompany($connect,$country){ 
    $sql = "SELECT languages.short_code as ShortCode , countrys.name".$GLOBALS["langdata"]." as CountryName FROM countrys INNER JOIN languages ON languages.id = countrys.id where countrys.name ='$country'";
    $query = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($query)){
      $data["ShortCode"] = $row["ShortCode"];
      $data["CountryName"] = $row["CountryName"];
        return $data;
    }
}



function GetlangueCompanyLangId($connect,$id){ 
  $sql= 'SELECT short_code FROM languages where id ='.$id.'';
  $query = mysqli_query($connect, $sql);
  if($row = mysqli_fetch_array($query)){
     return $row["short_code"];
  }
}

function GetLangueDefine($lang,$index){
  if ($index==0) {
        include("./lang/lang".lang_check($lang).".php");
  }else if($index==1){
        include("../lang/lang".lang_check($lang).".php");
  }else if($index == 3){
        include("../../../../lang/lang".lang_check($lang).".php");
  }
}

?>

<script>
function selectLang(lang){
  $("#lang_"+lang).trigger("click");
}
</script>