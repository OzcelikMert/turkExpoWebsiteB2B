<?php /*


include("../admin/config/config.php");
$id;
    $sql= 'SELECT * from main_categorys';
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $id = $row["id"];
      $data_en = convertUrl($row["name"]);
      $data_tr = convertUrl($row["name_tr"]);
      $data_ru = convertUrl($row["name_ru"]);
      $data_ar = convertUrl($row["name_ar"]);
      $data_fr = convertUrl($row["name_fr"]);

      $sql_update= 'Update main_categorys set 
        `seourl` = "'.$data_en.'",
        `seourl_tr` = "'.$data_tr.'",
        `seourl_ru` = "'.$data_ru.'",
        `seourl_ar` = "'.$data_ar.'",
        `seourl_fr` = "'.$data_fr.'" where id = '.$id.'';
        $query2 = mysqli_query($conn, $sql_update);
        if ($query2) {
          echo "BAŞARILI";
        }else {
            echo $id." HATA <br>";
            
        }

    }


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









*/



?>