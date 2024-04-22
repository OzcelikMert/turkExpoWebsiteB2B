<?php

include_once("./config/config.php");

session_start();

if ($_GET['exit'] == "true") {
    session_destroy();
    header("Location: index.php");
}

if(!isset($_SESSION['email']) || !isset($_SESSION["password"])){
    session_destroy();
    header("Location: index.php");
}

if ($_SESSION) {

    $email = $_SESSION["email"];
    $password = $_SESSION["password"];

    // Session Info Control
    $sql = "select * from company_info where email = '$email' and pass = '$password'";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) < 1){

        session_destroy();
        header("Location: index.php");

    }

}
//76d80224611fc919a5d54f0ff9fba446
?>