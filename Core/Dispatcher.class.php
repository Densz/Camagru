<?php

class Dispatcher
{
	public $content;

	public function __construct()
	{
		$routeur = new Routeur();
		ob_start();
		$controller = new Controller();
		$controller->init();
		$controller->rend(Routeur::$url['controller']);		
		$this->content = ob_get_clean();
		require('View/templates/default.php');
	}



}
?>