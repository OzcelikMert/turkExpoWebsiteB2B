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
include("./pages/blog/getblog.php");
include("./sameparts/footer.php");
?>
</div>
<?php include("./tools/scripts.php"); 
?>
<script>
$( ".lang-select").click(function() {
  $( ".ld" ).toggle();
});
</script>
</body>
</html>