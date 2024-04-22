<?php 

if ($_POST) {
    include("../admin/config/config.php");
    $sql = 'INSERT INTO translate (key_name, en) VALUES ("'.str_replace(" ", "_", mb_strtolower($_POST['en'])).'", "'.$_POST["en"].'")';
    if ($conn->query($sql) === TRUE) {
        echo htmlspecialchars("<?php echo _".str_replace(" ", "_", mb_strtolower($_POST['en']))."; ?>");
        echo '<br><br>';

    } else {
        echo htmlspecialchars("<?php echo _".str_replace(" ", "_", mb_strtolower($_POST['en']))."; ?>");
    }



}

?>



<form action="" method="post">
<input type="text" name="en">
<input type="submit" value="kaydet">
</form>