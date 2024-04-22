<?php

include_once("./config/config.php");

session_start();

$email = $_SESSION["email"];
$id = GetID($conn, $email);
$Countrys = getCountry($conn, $id);
$tel_1_code = getCountry_telCode($conn, $id, "tel_1");
$tel_2_code = getCountry_telCode($conn, $id, "tel_2");

$GLOBALS["langdata"] = $langdata;

// Get Country

function getCountry($connect, $id_){
    $sql = "select * from company_info where id = ".(int)$id_."";
    $query = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($query)){
        $selectedCountry = $row["country"];
    }

    $countrys = "";
    $sql = "select * from countrys order by name".$GLOBALS["langdata"]." asc";
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
function getCountry_telCode($connect, $id_, $tel_number){
    $sql = "select * from company_info where id = ".(int)$id_."";
    $query = mysqli_query($connect, $sql);
    if($row = mysqli_fetch_array($query)){
        $selectedCountry_telCode = $row["".$tel_number.""."_country"];
    }
    $countrys_code = "";
    $sql = "select * from countrys order by tel_code asc";
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