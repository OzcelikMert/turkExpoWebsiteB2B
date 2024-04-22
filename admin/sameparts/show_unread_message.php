<?php
include_once("./config/config.php");
session_start();
$email = $_SESSION["email"];
$self_id = GetID($conn, $email);
if(!empty($self_id)){
	$unRead_number = 0;
	$unRead_messages = "";
    // Look self id in isread message 
    $sql = "select * from messages where cid_get = '$self_id' and isread = '1' order by date desc";
    if($query = mysqli_query($conn, $sql)){
        // Sent Company info
        while($row = mysqli_fetch_array($query)){
        	$sql2 = "select * from company_info where id = ".$row["cid_set"]."";
        	$query2 = mysqli_query($conn, $sql2);
        	if($row2 = mysqli_fetch_array($query2)){
        		$c_logo = $row2["c_logo"];
        		$c_name = $row2["company_name"];
        	}
          $unRead_number++;
            if($unRead_number <= 3) {
            	$unRead_messages .= '
          		<a id="shortcutMessage_'.$unRead_number.'" class="dropdown-item preview-item" href="inbox.php?#c_message_'.$unRead_number.'" onclick="Shortcut_messageRead('.$unRead_number.'); messageRead('.$row["row"].');">
          		  <div class="preview-thumbnail">
          		    <img src="../images/company_logo/'.$c_logo.'" alt="'.$c_name.'" class="img-sm profile-pic">
          		  </div>
          		  <div class="preview-item-content flex-grow py-2">
          		    <p class="preview-subject ellipsis font-weight-medium text-dark">'.$c_name.'</p>
          		    <p class="font-weight-light small-text">'.$row["title"].'</p>
          		  </div>
          		</a>
            	';
            }
        }
    }
}
?>