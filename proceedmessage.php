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
output::pageend();