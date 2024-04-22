<?php
require_once("./config/config.php");
require_once("./inc/send_smtp_mail.php");
session_start();
$self_email = $_SESSION["email"];
// Send Email Function
function send_companyMail($connect, $title_, $message_, $email_, $self_email_){
    if(!upload_images(1)){
        echo "<script>alert('"._alert_img_not_allowed."');</script>";
    }else{
        // GET self id
        $sql = "select * from company_info where email = '$self_email_'";
        if($result = mysqli_query($connect, $sql)){
            if (mysqli_num_rows($result) > 0) {
                // Get id
                if($row = mysqli_fetch_assoc($result)) {
                    $self_id = $row["id"];
                    $c_name = $row["company_name"];
                    $c_website = $row["website_url"];
                }
            }
        }
        // end GET self id
        // GET other id
        $sql = "select * from company_info where email = '$email_'";
        if($result = mysqli_query($connect, $sql)){
            if (mysqli_num_rows($result) > 0) {
                // Get id
                if($row = mysqli_fetch_assoc($result)) {
                    $other_id = $row["id"];
                    $other_name = $row["company_name"];
                }
            }else{
                echo "<script>alert('"._message_not_account."');</script>";
                return;
            }
        }
        // end GET other id
        // Files control and add message content
        if(!empty($_FILES['files']["name"][0])){
            $files_url = upload_images(0);
            $files_url_db = "";
            if(count($files_url) > 0){
                $message_ .= "<hr>";
                $message_ .= '<h6 color="darkred">'._message_added_files.'</h6>';
                for($i = 0; $i < count($files_url); $i++){
                    $message_ .= 'File '.($i+1).': <a target="_blank" href="mailupload_files/'.$files_url[$i].'">'.$files_url[$i].'</a><br>';
                    $files_url_db .= $files_url[$i].", ";
                }
            }
        }
        // Send Message
        // Sent by info
        $message_ .= "<hr>";
        $message_ .= '<h6 color="darkred">>Sender Information<</h6>';
        if(!empty($c_name)){
            $message_ .= '<p>'.$c_name.'</p>';
        }
        $message_ .= '<p>'.$self_email_.'</p>';
        $date = date("Y-m-d H:i:s");
        $sql = "insert into messages(cid_set, cid_get, title, message, files_url, isread, date) values
        ('$self_id', '$other_id', '$title_', '$message_', '$files_url_db', '1', '$date')";
        if($result = mysqli_query($connect, $sql)){
            $message = "<h3 style='color: green;'>TurkExpo.Org in you have a new mail</h3>";
            $message .= "<h4><a href='TurkExpo.Org/admin/inbox.php'>Please click to go!</a><h4>";
            sendMail_smtp($email_, $message, $other_name, "New Mail");
            echo "<script>window.location.href = 'outbox.php';</script>";
        }else{
            echo "<script>alert('"._report_support."');</script>";
        }
    }
}
// Get POST Values
if($_POST){
    $title = htmlspecialchars(trim(strip_tags($_POST['title'])));
    $email = filter_var(htmlspecialchars(trim(strip_tags($_POST['email']))), FILTER_VALIDATE_EMAIL);    
    $message = htmlspecialchars(trim(strip_tags($_POST['message'])));
    if(empty($title) || empty($message) || empty($email)){
        $error_send_message = "<p style='color: red'>Please don't leave any space!</p>";
    }else {
        $message = substr($message, 0, 600);
        send_companyMail($conn, $title, $message, $email, $self_email);
    }
}
/* Get files function (again change file name) */
function upload_images($control){
    $files = $_FILES['files'];
    if(!empty($files["name"][0]))
    {
        $file_desc = reArrayFiles($files);
        if($control == 1){
            // Make a control files
            foreach($file_desc as $val)
            {
                $path_info = strtolower(pathinfo($val['name'], PATHINFO_EXTENSION));
                if($path_info != "png" && $path_info != "jpg" && $path_info != "jpeg" && $path_info != "gif" && $path_info != "pdf"){
                    return false;
                }else{
                    return true;
                }
            }
        }else if($control == 0){
            // Make a upload files
            $array_number = 0;
            $array_url = array();
            foreach($file_desc as $val)
            {
                $path_info = strtolower(pathinfo($val['name'], PATHINFO_EXTENSION));
                $newname = date("YmdHis").mt_rand().".".$path_info;
                move_uploaded_file($val['tmp_name'],'./mailupload_files/'.$newname);
                $array_url[$array_number] = $newname;
                $array_number++;
            }
            return $array_url;
        }
    }else{
        return true;
    }
}

// Multiple file function
function reArrayFiles(&$fileName)
{
    $file_ary = array();
    $file_count = count($fileName['name']);
    $file_key = array_keys($fileName);

    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $fileName[$val][$i];
        }
    }
    return $file_ary;
}
?>