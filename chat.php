<?php
session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
$userid=$authenticator->getUserid();
$db = dbrepo::getdbinstance();
output::navigation("chat",$authenticator->getLogedin(),$authenticator->getRole());
$a = "class='logedout'";
if($authenticator->getLogedin()){
  showPostaMessage();
  $a = "";
  if(isset($_POST['submit']))
  {
    $message=$_POST['message'];
    $db->addMessage($userid,$message);
    header("Location: chat.php");
  }
}
$messages = $db->getMessages();
toonMessages($messages,$db,$a,$authenticator->getRole());

function showPostaMessage()
{
  ?>
  <form role="form" method="POST" action="chat.php" class="chatpostmessage">
  <h4>Post a Message:</h4>
    <div class="form-group">
      <textarea name="message" class="form-control" rows="3" required></textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-success">Submit</button>
  </form>
  <?php
}

function toonMessages($messages,$db,$a,$role)
{
  
  echo "<div id='chatmessages' ".$a.">";
  echo "<p><span class='badge'>".sizeof($messages)."</span> Messages:</p><br> ";
  echo "<div class='row'>";
    foreach($messages as $message){
      $profilePictureObj=$db->getPictureForUser($message->userid);
      if($profilePictureObj == null){$picture = "assets/images/default-user-image.png";}
      else{$picture = $profilePictureObj->filepath;}
      $userObj=$db->getUserFromID($message->userid);
      echo "  <div class='col-sm-2 text-center'>";
      echo           '<a href="'.'profile.php?id='.$message->userid.'">';
      echo "    <img src='".$picture."' class='img-circle' height='65' width='65' alt='Avatar'>";
      echo           '</a>';
      echo "  </div>";
      echo "  <div class='col-sm-10'>";
      echo "    <h4>".$userObj->username."<small>  ".$message->timestamp."</small></h4>";
      echo "    <p>".$message->message;
      if($role == "A"){echo('<a href="admin.php?remmsg='.$message->messageid.'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="#000000" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg></a>');}      
      echo "</p>    <br>";
      echo "  </div>";
    }
  echo "</div>";
  echo "</div>";
}
output::pageend();

