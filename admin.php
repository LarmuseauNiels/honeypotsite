<?php
session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("admin",$authenticator->getLogedin(),$authenticator->getRole());
if($authenticator->getLogedin()&& ($authenticator->getRole() == 'A')){
    $db = dbrepo::getdbinstance();
    if(isset($_GET['remuser']))
    {
        $useridtoremove=$_GET['remuser'];
        if(!($db->getUserFromID($useridtoremove) == null)){
            $db->deleteUser($useridtoremove);
        }
        if($useridtoremove == $authenticator->getUserid()){
            $authenticator->logoff();
        }
        header("Location: members.php");
    }
    if(isset($_GET['remmsg']))
    {
        $messageid=$_GET['remmsg'];
        $db->deletemessage($messageid);
        header("Location: chat.php");
    }
    if(isset($_GET['remprofmsg']))
    {
        $profilemessageid=$_GET['remprofmsg'];
        $db->deleteprofielmessage($profilemessageid);
        header("Location: profile.php");
    }
    
    $messages = $db->getFeedback();
    toonFeedback($messages,$db);


}else{
    echo "<h1>Err:Insufficient Permissions</h1>";
}


function toonFeedback($messages,$db)
{
  
  echo "<div id='chatmessages'>";
  echo "<p><span class='badge'>".sizeof($messages)."</span> Feedback:</p><br> ";
  echo "<div class='row'>";
    foreach($messages as $message){
      $profilePictureObj=$db->getPictureForUser($message->userid);
      $userObj=$db->getUserFromID($message->userid);
      echo "  <div class='col-sm-2 text-center'>";
      echo           '<a href="'.'profile.php?id='.$message->userid.'">';
      echo "    <img src='".$profilePictureObj->filepath."' class='img-circle' height='65' width='65' alt='Avatar'>";
      echo           '</a>';
      echo "  </div>";
      echo "  <div class='col-sm-10'>";
      echo "    <h4>".$userObj->username."<small>  </small></h4>";
      echo "    <p>".$message->message."</p>";
      echo "    <br>";
      echo "  </div>";
    }
  echo "</div>";
  echo "</div>";
}
output::pageend();