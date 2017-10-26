<?php
session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("members",$authenticator->getLogedin(),$authenticator->getRole());

$db = dbrepo::getdbinstance();
$users = $db->getUsers();
echo('<p><span class="badge">'.count($users).'</span> Members:</p><br>');
echo('<div class="row">');
foreach ($users as $user){
  echo ('<div>');
  echo ('<div class="col-sm-2 text-center">');
  echo ('<a href="'.'http://example.com'.'">');
  echo ('<img src="');
  echo ($user->filepath);
  echo('" class="img-circle" height="65" width="65" alt="Avatar"></a></div><div class="col-sm-10"><br><h4>');
  echo ('<a href="'.'http://example.com'.'">');
  echo ($user->username);
  echo(' </a>');
if($authenticator->getRole() === "A"){echo('<small>remove</small>');}
  echo('</h4><br></div></div>');
}
echo('</div>');
output::pageend();