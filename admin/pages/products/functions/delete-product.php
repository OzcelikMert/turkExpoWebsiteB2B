<?php 
require_once("../../../config/config.php");

if (isset($_POST["product_id"])) {
    $msg_id = htmlspecialchars(trim(strip_tags($_POST["product_id"])));
    if (!empty($msg_id)) {
        session_start();
        $email = $_SESSION["email"];
        $self_id = GetID($conn, $email);
        $sql = "select row from products where row = ".$msg_id." and cid = '".$self_id."' ";
        $delete = mysqli_query($conn, $sql);
      
        if ($row = mysqli_fetch_assoc($delete)) {
            $dsql = "DELETE FROM products WHERE row = ".$row['row']."";
                if(mysqli_query($conn, $dsql)){ 
                    // Delete Success
                }  
                else{  } 
        }
    }
}


?>