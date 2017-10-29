<?php
/**
 * Created by PhpStorm.
 * User: massi
 * Date: 26/10/2017
 * Time: 12:00
 */

session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator=new auth();
$userid=$authenticator->getUserid();
$db = dbrepo::getdbinstance();
if($userid == null){header("Location: login.php");}
else{
if(isset($_POST['submit']))
{
    $profileid=$_POST['profileid'];
    if($db->getUserFromID($profileid) == null){$profileid = $userid;}
    $message=$_POST['message'];
    $db->addProfileMessage($profileid,$userid,$message);
}
header("Location: profile.php?id=".$profileid);
}
/*
$profileMessagesObj=$db->getProfileMessagesForUser($userid);
$profilePictureObj=$db->getPictureForUser($userid);
$userObj=$db->getUserFromID($userid);


function toonAlleMessages($profileMessagesObj,$profilePictureObj,$userObj)
{
    foreach ($profileMessagesObj as $obj){
        toonProfileMessage($userObj->username,$profilePictureObj->filepath,$obj->timestamp,$obj->message);
    }
}

function toonProfileMessage($username,$userPicture,$datePostedComment,$postedProfileMessage)
{
       echo     "<div>";
       echo         "<div class='col-sm-2 text-center'>";
       echo             "<img src='".$userPicture."' class='img-circle' height='65' width='65' alt='Avatar'>";
       echo         "</div>";
       echo         "<div class='col-sm-10'>";
       echo             "<h4>".$username."<small>".$datePostedComment."</small></h4>";
       echo             "<p>".$postedProfileMessage."</p>";
       echo             "<br>";
       echo         "</div>";
       echo     "</div>";
}
toonAlleMessages($profileMessagesObj,$profilePictureObj,$userObj);*/
output::pageend();