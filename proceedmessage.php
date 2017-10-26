<?php
/**
 * Created by PhpStorm.
 * User: massi
 * Date: 26/10/2017
 * Time: 12:00
 */
session_start();
require_once 'autoloader.php';
$authenticator=new auth();
$userid=$authenticator->getUserid();
$db = dbrepo::getdbinstance();

if(isset($_POST['submit']))
{
    $message=$_POST['message'];
    $db->addProfileMessage($userid,$userid,$message);
}