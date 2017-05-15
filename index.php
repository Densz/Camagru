<?php
	require('caller.php');
	define('PORT', '8888');
	session_start();
	$dispatcher = new Dispatcher(array($DB_DSN, $DB_USER, $DB_PASSWORD));
?>