<?php

session_start();
require_once 'autoloader.php';
$authenticator = new auth();
$db = dbrepo::getdbinstance();
if(isset($_POST['submit']))
{
  $userid=$authenticator->getUserid();
  $message= $_POST['feedback'];	
  $db->addFeedback($userid, $message);
  header("Location: feadback.php?feedbackSucces");
  
}