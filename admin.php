<?php
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("admin",$authenticator->getLoggedin(),$authenticator->getRole());




output::pageend();