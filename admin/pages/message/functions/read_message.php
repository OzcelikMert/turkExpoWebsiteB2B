<?php
require_once("../../../config/config.php");
/* Delete Message */
if(isset($_POST["message_id"])){
    $msg_id = htmlspecialchars(trim(strip_tags($_POST["message_id"])));
    if(!empty($msg_id)){
        session_start();
        $email = $_SESSION["email"];
        $self_id = GetID($conn, $email);
        $sql = "select * from messages where row = $msg_id and cid_get = '$self_id'";
        $read = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($read)){
            if($row["isread"] == "1"){
                $sql = "update messages set isread = '0' where row = $msg_id";
                if(mysqli_query($conn, $sql)){}
            }
        }
    }
}
?>