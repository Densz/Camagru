<?php

	header("Content-Type: text/plain");
	$img = (isset($_POST['img']) ? $_POST['img'] : NULL);
	if ($img)
		echo 'OK';
	else
		echo 'FAIL';
	//On recupere bien l'image en base 64 grace a post plus qu'a faire une classe qui stocke ca dans la base de donnée
?>
