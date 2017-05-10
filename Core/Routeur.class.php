<?php

class Routeur
{
	public static $url = null;

	public function __construct()
	{
		$uri = $_SERVER['REQUEST_URI'];
		$url = explode('/', $uri);
		(CB::my_assert($url[2])) ? Routeur::$url['controller'] = $url[2] : header('Location: http://localhost:' . PORT . '/Camagru_AD/visitorsignup/view/');
		(CB::my_assert($url[3])) ? Routeur::$url['function'] = $url[3] : print_r("redirection 404");
		for ($i = 4; $i <= count($url) - 1; $i++)
			Routeur::$url['params'][] = $url[$i];
	}
}

?>