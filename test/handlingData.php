<?php

	header("Content-Type: text/plain");
	
	$img = (isset($_POST['img']) ? $_POST['img'] : NULL);
	if ($img)
		echo 'OK';
	else
		echo 'FAIL';

?>
