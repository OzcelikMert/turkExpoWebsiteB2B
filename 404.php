<!DOCTYPE html>
<html lang="tr">
<head>
<title>TurkExpo</title>
<?php 
include("./tools/metas.php");
include("./tools/links.php");
include("./tools/includes.php");
?>
</head>
<body id="body">
<?php
    include("./sameparts/preloader.php"); 
    include("./pages/home/functions/get_values.php");
?>
<div class="super_container">
<?php
include("./sameparts/header.php");
include("./sameparts/menu.php");
include("./pages/home/home.php");
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <br><br><br><br><br><br><br><br><br>
            <h2><?php echo _404_page; ?></h2>
            <br><br><br><br><br><br><br><br><br>
        </div>
    </div>
</div>


<?php
include("./sameparts/footer.php");?>
</div>
<?php include("./tools/scripts.php"); ?>
<script> $(".lang-select").click(function(){ $(".ld").toggle();});</script>
</body>
</html>