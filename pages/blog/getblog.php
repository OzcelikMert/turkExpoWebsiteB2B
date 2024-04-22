<?php 
include_once("./admin/config/config.php");
$blog_url = safe($_GET["blog"]);


    $sql = 'select * from blog where seourl'.$GLOBALS["langdata"].' = "'.$blog_url.'"';
    $query = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_array($query)) {
        $data = "";
       // $data .= '<h3>'.$row["title".$GLOBALS["langdata"]].'</h3>';
        $data .= '<div class="blog-des"><p>'.html_entity_decode($row["des".$GLOBALS["langdata"]]).'</p></div>';
        $data .= '<span style="float:right;">'.$row["date"].'</span>';
    }else{
        echo '<script>window.location = "https://www.turkexpo.org"</script>';
       
    }


  /*  $sql = 'select title'.$GLOBALS["langdata"].' as title ,seourl'.$GLOBALS["langdata"].' as url from blog order by date asc';
    $query = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_array($query)) {
        $datas = '<div class="blog-list">';
        $datas .= '<p><a href="https://turkexpo.org/blog/'.$row["url"].'"> '.$row["title"].' </a></p>';
        $datas .='</div>';
    }
*/
?>

<div class="container" style="margin-top: 110px;min-height: 65vh;background: white;border: 2px dashed #181d2e45;margin-bottom: 35px;">
    <div class="row">

        <div class="blog_panel col-md-12 text-center" style="display:block;">
        <?php echo $data;?>
        </div>

        <!--div class="blog_panel col-md-4 text-center full-height">
            <h4><?php// echo _write_event; ?></h4>
            <?php// echo $datas;?>
        </div-->


    </div>
</div>


