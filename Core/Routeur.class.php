<?php

class Routeur
{
	public static $url = null;

	public function __construct()
	{
		$uri = $_SERVER['REQUEST_URI'];
		$url = explode('/', $uri);
		Routeur::$url['dir'] = $url[1];
		(CB::my_assert($url[2])) ? Routeur::$url['controller'] = $url[2] : header('Location: http://localhost:' . PORT . '/' . $url[1] . '/authsignup/view/');
		(CB::my_assert($url[3])) ? Routeur::$url['function'] = $url[3] : print_r("redirection 404");
		for ($i = 4; $i <= count($url) - 1; $i++)
			Routeur::$url['params'][] = $url[$i];
	}

}

?>