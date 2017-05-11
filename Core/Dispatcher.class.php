<?php

class Dispatcher
{
	public $content;
	public static $db;

	public function __construct($connection_data)
	{
		$routeur = new Routeur();
		Dispatcher::$db = new Model();
		Dispatcher::$db->init_connection($connection_data[0], $connection_data[1], $connection_data[2]);
		$controller = new Controller("Dispatcher");
		$controller->header();
		$controller->init();
		$controller->rend(Routeur::$url['controller']);
		$controller->footer();
	}



}
?>