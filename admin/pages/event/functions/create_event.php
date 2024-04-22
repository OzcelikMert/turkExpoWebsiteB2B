<?php

require_once("./config/config.php");

$GLOBALS["error"] = _error;
$GLOBALS["event_succes"] = _event_succes;
$GLOBALS["alert_fill_title"] = _alert_fill_title;
$GLOBALS["alert_verylong_title"] = _alert_verylong_title;
$GLOBALS["alert_fill_comment"] = _alert_fill_comment;
$GLOBALS["alert_comment_verylong"] = _alert_comment_verylong;
$GLOBALS["alert_event_category_propely"] = _alert_event_category_propely;
$GLOBALS["bussines_seourl"] = $c_seourl;
// Event Functions
// Delete Event

function deleteEvent($connect, $id_){
    $sql = "delete from events where cid = '$id_'";
    if($query = mysqli_query($connect, $sql)){
        return true;
    }else{
        return false;
    }
}


// Get POST Values

if (isset($_POST["title"])) {
    session_start();
    $self_email = $_SESSION["email"];
    $id = GetID($conn, $email);
    $title = safe($_POST['title']);
    $title_en = safe($_POST['title_en']);
    $title_fr = safe($_POST['title_fr']);
    $comment = safe($_POST['comment']);
    $comment_en = safe($_POST['comment_en']);
    $comment_fr = safe($_POST['comment_fr']);
    
    //$category = safe($_POST['category']);

$errorMessage = valueControl($title,$title_en,$title_fr, $comment,$comment_en,$comment_fr /*,$category*/);
    
    if (empty($errorMessage)) {
        createEvent($conn /*,$category*/, $title,$title_en,$title_fr, $comment,$comment_en,$comment_fr,$id);
    }else{
        $ErrorMessage_show = '
        <div class="alert alert-danger col-md-12" role="alert" id="notes">
            <ul>
                '.$errorMessage.'
            </ul>
        </div>
        ';
    }
}

// Create Event
function createEvent($connect /*,$category_*/, $title_, $title_en, $title_fr, $message_,$message_en,$message_fr, $id_){
    if(deleteEvent($connect, $id_)){
        $date = date("Y-m-d");
        $seourl = $GLOBALS['bussines_seourl'];
        $sql = "insert into events(cid, title_tr, title,title_fr ,message_tr, message, message_fr ,date, seourl) 
        values('$id_', '$title_', '$title_en', '$title_fr', '$message_', '$message_en', '$message_fr', '$date', '$seourl')";
        if($query = mysqli_query($connect, $sql)){
            echo "<script>alert('".$GLOBALS["event_succes"]."');</script>";
            echo "<script>document.location.href = 'dashboard.php';</script>";
        }else{
            echo "<script>alert('".$GLOBALS["error"]."a');</script>";
        }
    }else{
        echo "<script>alert('".$GLOBALS["error"]."');</script>";
    }
}


// Title, Comment and Category control

function valueControl($title, $title_en, $title_fr, $comment, $comment_en, $comment_fr /*,$category_*/){
    $errorMessagge = "";
        $alert = $GLOBALS["alert_event_category_propely"];
    // Title Control

    if (empty($title)){
        $errorMessagge .= '<li>'.$GLOBALS["alert_fill_title"].'<li>';
    }else if((strlen($title) > 65) || (strlen($title_en) > 65) || (strlen($title_fr) > 65)){
        $errorMessagge .= '<li>3'.$GLOBALS["alert_verylong_title"].'<li>';
    }

    // Comment Control

    if (empty($comment)) {
        $errorMessagge .= '<li>'.$GLOBALS["alert_fill_comment"].'<li>';
    }else if((strlen($comment) > 600) || (strlen($comment_en) > 600) || (strlen($comment_en) > 600)){
        $errorMessagge .= '<li>'.$GLOBALS["alert_comment_verylong"].'<li>';
    }

    // Category Control
/*
    switch ($category_) {
        case '1': break;
        case '2': break;
        case '3': break;
        case '4': break;
        default: $errorMessagge .= '<li>'.$GLOBALS["alert_event_category_propely"].'</li>'; break;
    }*/

    return $errorMessagge;
}



?>