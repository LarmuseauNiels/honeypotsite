<?php
session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("members",$authenticator->getLogedin(),$authenticator->getRole());

$db = dbrepo::getdbinstance();
$users = $db->getUsers();
echo('<p><span class="badge">'.count($users).'</span> Members:</p><br>');
echo('<div class="row members">');
foreach ($users as $user){
  $userurl = 'profile.php?id='.$user->userid;
  echo ('<div>');
  echo ('<div class="col-sm-2 text-center">');
  echo ('<a href="'.$userurl.'">');
  echo ('<img src="');
  if ($user->filepath !== null){echo ($user->filepath);}
  else{echo 'assets/images/default-user-image.png';}
  echo('" class="img-circle" height="65" width="65" alt="Avatar"></a></div><div class="col-sm-10"><br><h4>');
  echo ('<a href="'.$userurl.'">');
  echo ($user->username);
  echo(' </a>');
if($authenticator->getRole() == "A"){echo('<a href="admin.php?remuser='.$user->userid.'">     <svg width="16" height="16" viewBox="0 0 24 24"><path fill="#000000" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg></a>');}
  echo('</h4><br></div></div>');
}
echo('</div>');
output::pageend();