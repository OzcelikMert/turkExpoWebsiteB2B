<!DOCTYPE html>
<html lang="tr">
<head>
<title>TurkExpo</title>
<?php
include("./tools/metas.php");
include("./tools/links.php");
include("./tools/includes.php");
?>
<link rel="stylesheet" href="styles/search.css">
</head>
<body class="goto-here">
<?php 
    include("./sameparts/preloader.php");
    include("./pages/events/functions/values.php");
    include("./pages/events/functions/get_page_count_buttons.php");
    include("./pages/events/functions/get_values.php");
?>
    <div class="super_container">
        <?php
        include("./sameparts/header.php");
        include("./sameparts/menu.php");
        include("./pages/events/events-view.php");
        include("./sameparts/footer.php");
        include("./tools/scripts.php");
        ?>
    </div>
    
<script>
    $( "#search-sidebar" ).click(function() {
      $( ".w30" ).removeClass("searchf-close-tools").addClass("searchf-tools")
        $("html").css("overflow","hidden");
      $("#search-sidebar-c").toggle();
    });
    $( "#search-sidebar-c" ).click(function() {
      $( ".w30" ).removeClass("searchf-tools" ).addClass("searchf-close-tools");
        $("#search-sidebar-c").toggle();
            $("html").css("overflow","scroll");
    });
</script>
</body>
</html>


