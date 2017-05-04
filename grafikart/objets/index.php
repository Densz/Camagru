<?php
	require_once 'Personnage.php';
	require_once 'archer.php';

	$merlin = new Personnage("Merlin");
	$merlin->regenerer();
	$legolas = new Archer('Legolas');
	$legolas->attaque($merlin);
	var_dump($merlin, $legolas);
?>
