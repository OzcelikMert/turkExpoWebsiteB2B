<?php
include_once("./admin/config/config.php");
// Values
$langdata = lang_check($lang);
$AllCategories_Values = Getmain_categories($conn,$langdata);
// end Values
/*
    Functions
*/
function Getmain_categories($connect,$langdata){
    $values = "";
   /* $sql = "SELECT main_categorys.name$langdata as MC_name, main_categorys.seourl$langdata as MC_seourl, main_categorys.img as MC_img, sub_categorys.name$langdata as SC_name,
    sub_categorys.seourl$langdata as SC_seourl FROM `main_categorys` INNER JOIN sub_categorys ON sub_categorys.mcid = main_categorys.id ORDER BY main_categorys.name$langdata asc";
   */
  $sql = "SELECT name$langdata as MC_name, seourl$langdata as MC_seourl, img as MC_img FROM main_categorys ORDER BY name_tr asc ";
    $query = mysqli_query($connect, $sql);
    // First finished divs values
    $first_category = false;
    // *******************
    // Get Values
    /*
    while ($row = mysqli_fetch_array($query)) {
        if ($main_category_name != $row["MC_name"]) {
            if ($first_category != false) {
                $values .= '
                            </div>
                        </div>
                    </div>
                </div>
                ';  
            }
            
            $values .= '
            <div class="col-md-6 category-main">
                <div class="card category-card">
                    <div class="card-body" id="col-1">
                        <a href="category/'.$row["MC_seourl"].'/"><h4 id="category-title">'.$row["MC_name"].'</h4></a>
                        <img id="category-img" src="/images/category_images/'.$row["MC_img"].'" alt="'.$row["MC_name"].'">
                        <div class="categorty-type">
            ';
        }
        */
        $count =0;
        while ($row = mysqli_fetch_array($query)) {
            if ($main_category_name != $row["MC_name"]) {
                 $count++;
                $values .= '
                <div class="col-md-6 category-main">
                    <div class="card category-card">
                        <div class="card-body" id="col-1">
                            <a href="category/'.$row["MC_seourl"].'/"><h4 id="category-title"><font style="color:red;">'.$count.'-)</font> '.$row["MC_name"].'</h4></a>';
                        if(!empty($row["MC_img"])){
                            $values .= '<a href="category/'.$row["MC_seourl"].'/" ><img id="category-img" src="/images/category_images/'.$row["MC_img"].'" alt="'.$row["MC_name"].'"></a>';
                        }
                        $values .= '
                            <div class="categorty-type">
                            </div>
                        </div>
                     </div>
                </div>
                ';
            }
       /* $values .= '
        <a href="search/'.$row["MC_seourl"].'/'.$row["SC_seourl"].'">'.$row["SC_name"].'<i class="fa fa-arrow-right"></i></a>
        ';*/
    }
    return $values; 
}
/*
    end Functions
*/
?>