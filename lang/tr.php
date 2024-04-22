<?php 
    include("../admin/config/config.php");
    $data= "";
    $data_tr= "";
    $data_ru= "";
    $data_fr= "";
    $data_uz= "";
    $data_ar= "";


    $sql= 'SELECT * from translate';
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($query)) {
      if (!empty($row["en"])) {
        $data .='define("_'.$row["key_name"].'", "'.$row["en"].'");';
      }
      
      if (!empty($row["tr"])) {
        $data_tr .='define("_'.$row["key_name"].'"," '.$row["tr"].'");';
      }else if(empty($row["tr"])){
       $data_tr .='define("_'.$row["key_name"].'"," '.$row["[key_name]"].'");';
      }
      
      if (!empty($row["ru"])) {
        $data_ru .='define("_'.$row["key_name"].'"," '.$row["ru"].'");';
      }else if(empty($row["ru"])){
       $data_ru .='define("_'.$row["key_name"].'","['.$row["key_name"].']");';
      }
      
      if (!empty($row["fr"])) {
        $data_fr .='define("_'.$row["key_name"].'"," '.$row["fr"].'");';
      }else if(empty($row["fr"])){
       $data_fr .='define("_'.$row["key_name"].'","['.$row["key_name"].']");';
      }
      
      if (!empty($row["uz"])) {
        $data_uz .='define("_'.$row["key_name"].'"," '.$row["uz"].'");';
      }else if(empty($row["uz"])){
       $data_uz .='define("_'.$row["key_name"].'","['.$row["key_name"].']");';
      }
      
      if (!empty($row["ar"])) {
        $data_ar .='define("_'.$row["key_name"].'"," '.$row["ar"].'");';
      }else if(empty($row["ar"])){
       $data_ar .='define("_'.$row["key_name"].'","['.$row["key_name"].']");';
      }
    }

    langcreate("lang.php",$data);
    langcreate("lang_tr.php",$data_tr);
    langcreate("lang_ru.php",$data_ru);
    langcreate("lang_fr.php",$data_fr);
    langcreate("lang_uz.php",$data_uz);
    langcreate("lang_ar.php",$data_ar);

function langcreate($name,$data){
  $myfile = fopen($name, "wr") or die("Unable to open file!");
  $txt = '<?php '.$data.' ?>';
  fwrite($myfile, $txt);
  fclose($myfile);
}

      ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Langue</title>
    <style>
      pre{    background: #f1f1f1;
    width: auto;
    display: inline;}
    </style>
  </head>
  <body>
<BR>
    <h1>ENGILISH</h1>
    
    <pre><?PHP echo $data?></pre>
<BR><BR>
    <h1>TURKISH</h1>
    <pre><?PHP echo $data_tr;?></pre>
<BR><BR>
        <h1>Russian</h1>
    <pre><?PHP echo $data_ru;?></pre>


  </body>
</html>