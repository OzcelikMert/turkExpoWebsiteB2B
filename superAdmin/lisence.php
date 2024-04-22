<?php/*


if (isset($_POST["eposta"]) && isset($_POST["pass"])) {
    if(file_exists("../admin/config/config.php")){ include_once("../admin/config/config.php"); }

        $a = $_SERVER['HTTP_REFERER'];
        echo $a;
        if (strpos($a, 'https://turkexpo.org/superAdmin/lisence.php') !== false) { 
            session_start();
            $_SESSION['sitekontrol'] = 'ok';
        //  session_regenerate_id();
        }

    izinkontrol();

    
    $sql = "select * from super_admin where eposta = '".$_POST["eposta"]."' and pass = '".$_POST["pass"]."' ";
    if($query = mysqli_query($conn, $sql)){
        if($row = mysqli_fetch_array($query)){
            echo "yey";
    
        }else {echo "no";}
    }else {echo "noa";}
    
     
}else {echo "noaa";}








function izinkontrol(){
    if (empty($_SESSION['sitekontrol'])) { 
        echo "İZİNSİZ ERİŞİM TALEBİ."; 
        exit;
    }

}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <title>SP</title>
</head>
<body>

<form action="" method="post">
<input type="text" name="eposta" placeholder="eposta">
    <input type="text" name="pass" placeholder="pass">
    <input type="submit" value="gonder">
</form>


</body>
</html>*/?>