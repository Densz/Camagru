<?php
	require_once ('database.php');
	try
	{
		$DB_LINK = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
	}
	catch (PDOException $e)
	{
		echo 'Connexion échouée : ' . $e->getMessage();
	}
?>