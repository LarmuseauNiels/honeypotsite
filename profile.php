<?php
session_start();
require_once 'autoloader.php';
output::htmlheader();
$authenticator = new auth();
output::navigation("loggin",$authenticator->getLogedin(),$authenticator->getRole());




output::pageend();