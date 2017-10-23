<?php
session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("members",$authenticator->getLogedin(),$authenticator->getRole());


?>
<p><span class="badge">2</span> Comments:</p><br>      
<div class="row">
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
</div

<?php
output::pageend();