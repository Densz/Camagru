<?php

class Dispatcher
{
	public $content;

	public function __construct()
	{
		//Initialisation des variables serveurs
		$config = new Config();
		//Parse l'url -- pour savoir quel controller on va utiliser sinon page 404
		$routeur = new Routeur();
		//Connexion a la base de donnees
		$db = new Model('mysql:dbname=camagru');
		ob_start();
		$controller = new Controller();
		$controller->init();
		$controller->rend(Routeur::$url['controller']);		
		$this->content = ob_get_clean();
		require('View/templates/default.php');
	}
}
?>