<?php
	session_start();
	require_once 'autoloader.php';
	output::htmlheader();
	$authenticator = new auth();
	$authenticator->logoff();
	header("Location: chat.php");