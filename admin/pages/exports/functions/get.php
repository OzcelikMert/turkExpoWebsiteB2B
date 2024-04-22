<?php 

// Show Exports
$Exports = select_export($conn,(int)$id);
/* Select function Export*/
$GLOBALS["langdata"] = $langdata;

function select_export($connect,$cid){

    $exports = "";

    $sql = "SELECT exports.*, countrys.name".$GLOBALS["langdata"]." as CountryName FROM `exports` INNER JOIN countrys ON countrys.id = exports.country where exports.cid = '$cid' order by exports.date desc";

    $select=mysqli_query($connect,$sql);

    while( $data=mysqli_fetch_assoc($select) ){

        // Get Country Name

        $exports .= '<tr id="exportsitem'.$data["row"].'"> 
        <td>'.$data["CountryName"].'</td>
        <td>'.$data["price"]." ".$data["price_type"].'</td>
        <td>'.$data["date"].'</td>
        <td><form method="post"><input id="exports" type="button" onclick="DeleteExport('.$data["row"].');"  data="'.$data["date"].'" class="form-control"  style="background: #d81934;color: white;font-size: 14px;"  value="'._del.'"></form></td>
        </tr>'; 

    }

    return $exports;

}
/*

while( $data=mysqli_fetch_assoc($select) ){

    // Get Country Name

    $exports .= '<tr id="exportsitem'.$data["row"].'"> 
    <td>'.$data["CountryName"].'</td>
    <td>'.$data["product"].'</td>
    <td>'.number_format($data["count"], 0, ',', '.')." ".$data["count_type"].'</td>
    <td>'.$data["price"]." ".$data["price_type"].'</td>
    <td>'.$data["date"].'</td>
    <td><form method="post"><input id="exports" type="button" onclick="DeleteExport('.$data["row"].');"  data="'.$data["date"].'" class="form-control"  style="background: #d81934;color: white;font-size: 14px;"  value="'._del.'"></form></td>
    </tr>'; 

}
*/
?>