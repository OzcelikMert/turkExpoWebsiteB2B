<?php
include_once("./config/config.php");
session_start();
$email = $_SESSION["email"];
$id = GetID($conn, $email);

// Control Post
if($_POST){
    if (count($_POST["check"]) > 0 ) {
        $all = implode(",", $_POST["check"]);
        $all = htmlspecialchars(trim(strip_tags($all)));
        $all = str_replace("'", '', $all);

        GetSet_control($conn, $id, $all, $_POST["getSet"]);
    }else{

    }
}

function GetSet_control($connect, $id_, $row, $GetorSet){
    if ($GetorSet == "get") {
        $query="update messages set cid_get = '-$id_' WHERE cid_get = '$id_' AND row IN($row)";
        if(mysqli_query($connect, $query)){
            echo "<script>document.location.href = 'inbox.php'</script>";
        }
    }else if($GetorSet == "set"){
        $query="update messages set cid_set = '-$id_' WHERE cid_set = '$id_' AND row IN($row)";
        if(mysqli_query($connect, $query)){
            echo "<script>document.location.href = 'outbox.php'</script>";
        }
    }
}
?>