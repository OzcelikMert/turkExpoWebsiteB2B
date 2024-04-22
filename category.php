<!DOCTYPE html>
<html lang="en">
<head>
<title>TurkExpo</title>
<?php 
include("./tools/metas.php");
include("./tools/links.php");
include("./tools/includes.php");
?>
</head>
<body class="goto-here">
<?php include("./sameparts/preloader.php");  ?>
    <div class="super_container">
        <?php
        include("./sameparts/header.php");
        include("./sameparts/menu.php");
        //Main Categories or Sub Categories include
        if (!empty($_GET['category']) && isset($_GET["category"])) {
            include("./pages/category/functions/get_sub_categories.php");
            echo $Sub_Categories;
        }
        else{ 
            
            include("./pages/category/functions/get_main_categories.php");
            include("./pages/category/main-categories.php");

        }
        include("./sameparts/footer.php");
        ?>

    </div>
<?php include("./tools/scripts.php"); ?>
</body>
</html>


