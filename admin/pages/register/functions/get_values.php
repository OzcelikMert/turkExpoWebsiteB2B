<?php

include_once("./config/config.php");
// Get Values
$GetselectedCountry = htmlspecialchars(trim($_POST["country"]));
$GetselectedCountry_telCode1 = htmlspecialchars(trim($_POST["tel_1_country"]));
$GetselectedCountry_telCode2 = htmlspecialchars(trim($_POST["tel_2_country"]));
$Countrys = getCountry($conn, $GetselectedCountry);
$tel_1_code = getCountry_telCode($conn, $GetselectedCountry_telCode1);
$tel_2_code = getCountry_telCode($conn, $GetselectedCountry_telCode2);
$GLOBALS["langdata"] = $langdata;


// Get Country

function getCountry($connect, $selectedCountry){
    $countrys = "";
    $sql = "select * from countrys WHERE name".$GLOBALS["langdata"]." IS NOT NULL  order by name".$GLOBALS["langdata"]." asc";
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $selected = "";
        if ($selectedCountry == $row["id"]) {
            $selected = "selected";
        }
        $countrys .= "<option value='".$row["id"]."' $selected>".$row["name".$GLOBALS["langdata"]]."</option>";
    }
    return $countrys;
}


// Get Country Telephone Code
function getCountry_telCode($connect, $selectedCountry_telCode){
    $countrys_code = "";
    $sql = "select * from countrys WHERE tel_code IS NOT NULL order by tel_code asc ";
    $query = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $selected = "";
        if ($selectedCountry_telCode == $row["tel_code"]) {
            $selected = "selected";
        }
        $countrys_code .= "<option value='".$row["tel_code"]."' $selected>+".$row["tel_code"]."</option>";
    }
    return $countrys_code;
}

?>