<?php
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("admin",$authenticator->getLogedin(),$authenticator->getRole());




output::pageend();