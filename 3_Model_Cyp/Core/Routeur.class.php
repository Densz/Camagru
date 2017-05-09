<?php

class Routeur
{
	public static $url = null;

	public function __construct()
	{
		$uri = $_SERVER['REQUEST_URI'];
		$url = explode('/', $uri);
		(CB::my_assert($url[3])) ? Routeur::$url['controller'] = $url[3] : header('Location: http://localhost:8888/camagru/3_Model_Cyp/visitorsignup/view/');
		(CB::my_assert($url[4])) ? Routeur::$url['function'] = $url[4] : print_r("redirection 404");
		for ($i = 5; $i <= count($url) - 1; $i++)
			Routeur::$url['params'][] = $url[$i];
	}
}

?>