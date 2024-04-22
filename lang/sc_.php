<?php


include("../admin/config/config.php");

/*
    $sql= 'SELECT * from sub_categorys';
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $id = $row["row"];
      $data_tr = convertUrl($row["name_tr"]);
  
        $sql_update= 'Update sub_categorys set 
        `seourl_tr` = "'.$data_tr.'"
        where row = '.$id.'';

        $query2 = mysqli_query($conn, $sql_update);
        if ($query2) {
          echo "BAŞARILI";
        }else {
            echo $id." HATA <br>";
            
        }

    }
*/
/*
$sql= 'SELECT * from main_categorys';
$query = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($query)) {
    $id = $row["id"];
 

    $sql_update= 'Update main_categorys set `img` = "'.$id.'.jpg" where id = '.$id.'';

    $query2 = mysqli_query($conn, $sql_update);
    if ($query2) {
      echo "BAŞARILI";
    }else {
        echo $id." HATA <br>";
        
    }

}*/
/*
$sql= 'SELECT * from frr';
$query = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($query)) {
    $i = $row["id"];
    $fr =  $row["fr"];
    $sql_update= "Update translate set uz = '".$fr."'  where id = ".$i."";

    $query2 = mysqli_query($conn, $sql_update);
    if ($query2) {
      echo "BAŞARILI";
    }else {
        echo $id." HATA <br>";
        
    }

}
*/
/*

    $sql= 'SELECT * from sub_categorys';
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($query)) {

        $sql_update= 'update sub_categorys set `seourl_tr` = "'.convertUrl($row["name_tr"]).'" where row = '.$row["row"].'';
        $query2 = mysqli_query($conn, $sql_update);
        if ($query2) {
          echo "BAŞARILI";
        }else {
            echo $id." HATA <br>";
            
        }

    }
*/


function convertUrl($url) {
  // Convert Seo Url
  $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',','!');
  $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','');
  $url = str_replace($tr, $eng, $url);
  $url = strtolower($url);
  $url = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $url);
  $url = preg_replace('/\s+/', '-', $url);
  $url = preg_replace('|-+|', '-', $url);
  $url = preg_replace('/#/', '', $url);
  $url = str_replace('.', '', $url);
  $url = str_replace("'", '', $url);
  $url = trim($url, '-');
  // end Convert Seo Ur
  return $url;
}
/*
include("../admin/config/config.php");
$id;
    $sql= 'SELECT * from main_categorys';
    $query = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_array($query)) {
      $id = $row["id"];
      $data_tr = convertUrl($row["name_tr"]);
  
        $sql_update= 'Update main_categorys set 
        `seourl_tr` = "'.$data_tr.'"
        where id = '.$id.'';

        $query2 = mysqli_query($conn, $sql_update);
        if ($query2) {
          echo "BAŞARILI";
        }else {
            echo $id." HATA <br>";
            
        }
    }

*/





//



?>