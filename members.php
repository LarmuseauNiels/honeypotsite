<?php
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("members",$authenticator->getLoggedin(),$authenticator->getRole());




output::pageend();