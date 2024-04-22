<?php
require_once("../../../config/config.php");
/* Delete Message */
if(isset($_POST["message_id"])){
    $msg_id = htmlspecialchars(trim(strip_tags($_POST["message_id"])));
    if(!empty($msg_id)){
        session_start();
        $email = $_SESSION["email"];
        $self_id = GetID($conn, $email);
        $sql = "select * from messages where row = $msg_id";
        $delete = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($delete)){
            if($row["cid_get"] == $self_id){
                $sql = "update messages set cid_get = '-$self_id' where row = $msg_id";
                if(mysqli_query($conn, $sql)){
                    echo "Message is deleted.";
                }
            }else if($row["cid_set"] == $self_id){
                $sql = "update messages set cid_set = '-$self_id' where row = $msg_id";
                if(mysqli_query($conn, $sql)){
                    echo "Message is deleted.";
                }   
            }else{
                echo "Sorry, no such message found.";
            }
        }
    }
}
?>