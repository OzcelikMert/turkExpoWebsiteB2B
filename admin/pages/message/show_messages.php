<?php
// Show Messages
function showMessages($connect, $get_set, $id_, $min, $max){
  // Have Message Owner
  $sql = "select * from messages where cid_".$get_set." = '$id_' order by date desc limit $min, $max";
  if($result = mysqli_query($connect, $sql)){
    if(mysqli_num_rows($result) > 0) {
      // show messages
      $c_message_number = 0;
      while($row = mysqli_fetch_assoc($result)) {
        // Values Control
        if(strlen($row["files_url"]) > 0){
            $file_attach = '<i class="mdi mdi-paperclip"></i>';
        }else{
            $file_attach = "";
        }
        $c_message_number++;
        $max_line = strpos($row["message"],"<hr>");
        $sql2 = "select * from company_info where id = ".$row["cid_set"]."";
        $query = mysqli_query($connect, $sql2);
        if($row2 = mysqli_fetch_assoc($query)){
           $company_name = $row2["company_name"];
           $company_name_seo = $row2["seo_company_name"];
           $company_email = $row2["email"];
        }
        if($max_line === false || $max_line > 80){
            $max_line = 80;
        }
        // Inbox or Sent box messages BG color
        if($get_set == "get"){
          if($row["isread"] == "1"){
            // Unread Messages BG color
            $bgColor = "#fff";
            $onClick_messageRead = 'onclick="messageRead('.$row["row"].')"';
          }else{
            // Readed Messages BG Color
            $bgColor = "#e1e1e18c";
            $onClick_messageRead = "";
          }
        }else if($get_set == "set"){
          // Sent Messages BG Color
          if($row["isread"] == "1"){
            // Unread Messages BG color
            $bgColor = "#fff";
            $onClick_messageRead = "";
          }else{
            // Readed Messages BG Color
            $bgColor = "#e1e1e18c";
            $onClick_messageRead = "";
          }
        }
        // Show Messages
        if($get_set == "set"){
          echo '
          <tr style="background: '.$bgColor.';" id="msg_'.$row["row"].'">
            <td class="mailbox-delete-check"><input type="checkbox" id="checkItem" name="check[]" value="'.$row["row"].'"></td>
            <td class="mailbox-delete"><a href="javascript:void(0);" id="DLT'.$row["row"].'" data="'.$row["date"].'" onclick="messageDelete('.$row["row"].')"><i class="mdi mdi-delete-circle-outline" style="font-size: 20px;color: red;"></i></a></td>
            <td class="mailbox-show"><a href="#c_message_'.$c_message_number.'" '.$onClick_messageRead.'><i class="mdi mdi-comment-eye" style="font-size: 20px;color: #007bff;"></i></a></td>
            <td class="mailbox-name"><a href="../profile.php?company_name='.$company_name_seo.'" target="_blank">'.$company_name.'</a></td>
            <td class="mailbox-subject"><b>'.$row["title"].'</b> - '.substr($row["message"], 0, $max_line).'</td>
            <td class="mailbox-attachment">'.$file_attach.'</td>
            <td class="mailbox-date">'.$row["date"].'</td>
          </tr>
          ';
        }else{
          echo '
          <tr style="background: '.$bgColor.';" id="msg_'.$row["row"].'">
            <td class="mailbox-delete-check"><input type="checkbox" id="checkItem" name="check[]" value="'.$row["row"].'"></td>
            <td class="mailbox-delete"><a href="javascript:void(0);" id="DLT'.$row["row"].'" data="'.$row["date"].'" onclick="messageDelete('.$row["row"].')"><i class="mdi mdi-delete-circle-outline" style="font-size: 20px;color: red;"></i></a></td>
            <td class="mailbox-show"><a href="#c_message_'.$c_message_number.'" '.$onClick_messageRead.'><i class="mdi mdi-comment-eye" style="font-size: 20px;color: #007bff;"></i></a></td>
            <td class="mailbox-reply"><a href="newmessage.php?title='.$row["title"].'&email='.$company_email.'"><i class="mdi mdi-reply" style="font-size: 20px; color:#52c50a;"></i></a></td>
            <td class="mailbox-name"><a href="../profile.php?company_name='.$company_name_seo.'" target="_blank">'.$company_name.'</a></td>
            <td class="mailbox-subject"><b>'.$row["title"].'</b> - '.substr($row["message"], 0, $max_line).'</td>
            <td class="mailbox-attachment">'.$file_attach.'</td>
            <td class="mailbox-date">'.$row["date"].'</td>
          </tr>
          ';
        }
        // end Show Messages
        /*
        Message Popup Show
        */
        echo '
        <div id="c_message_'.$c_message_number.'" class="message_popup">
          <div class="message_popup__block">
            <h1 class="message_popup__title">'.$row["title"].'</h1>
            <p>'.$row["message"].'</p>
            <a href="#" class="message_popup__close btn btn-danger"><i class="mdi mdi-close-outline"></i></a>
          </div>
        </div>
        ';
        /*
        end Message Popup Show
        */
      }
    }
  }
}
?>