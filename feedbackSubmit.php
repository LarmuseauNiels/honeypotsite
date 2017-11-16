<?php

session_start();
require_once 'autoloader.php';
$authenticator = new auth();
$db = dbrepo::getdbinstance();
if(!$authenticator->getLogedin()){header("Location: login.php");}
else{
if(isset($_POST['submit']))
{
  if(captcha::checkresponce($response)){    
  $userid=$authenticator->getUserid();
  $message= $_POST['feedback'];	
  $db->addFeedback($userid, $message);
  header("Location: feadback.php?feedbackSucces");
  $response = $_POST["g-recaptcha-response"];
  
}
  else{ header("Location: feadback.php?feedbackFail");}
}
}
