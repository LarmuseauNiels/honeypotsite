<?php
session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("members",$authenticator->getLogedin(),$authenticator->getRole());

$db = dbrepo::getdbinstance();
$users = $db->getUsers();
var_dump($users);

echo('<p><span class="badge">'.count($users).'</span> Members:</p><br>');
echo('<div class="row">');
foreach ($users as $user){
  echo ('<div class="col-sm-2 text-center"><a href="');
  echo ('http://example.com');
  echo ('" style="display:block"><img src="');
  echo ($user->filepath);
  echo('" class="img-circle" height="65" width="65" alt="Avatar"></div><div class="col-sm-10"><br><h4>');
  echo ($user->username);
  echo('</h4></a>');
  echo('<small>remove</small>');
  echo('<br></div>');
}
echo('</div>');

/*

  <div class="col-sm-2 text-center">
    <img src="https://i.imgur.com/0W49c50.png" class="img-circle" height="65" width="65" alt="Avatar">
  </div>
  <div class="col-sm-10">
    <br>
    <h4>Niels <small>Sep 29, 2017, 9:12 PM</small></h4>
    <br>
  </div>

  <div class="col-sm-2 text-center">
    <img src="https://i.imgur.com/qWoHxMv.jpg" class="img-circle" height="65" width="65" alt="Avatar">
  </div>
  <div class="col-sm-10">
    <br>
    <h4>John <small>Sep 25, 2017, 8:25 PM</small></h4>
    <br>
  </div>
*/
output::pageend();