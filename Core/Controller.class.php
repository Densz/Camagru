<?php

class Controller
{
	public static $cont;

	public function header()
	{
		if (CB::my_assert($_SESSION['auth']))
			$disconnect = '<a class="navbar-brand" href="http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/Authsignin/signOut">Disconnect</a>';
		require_once('View/templates/header.php');
	}

	public function footer()
	{
		require_once('View/templates/footer.php');
	}

	public function init()
	{
		$name = Routeur::$url['controller'];
		$func = $this->call_controller($name);
		$func_name = Routeur::$url['method'];
		$func->$func_name();
	}

	public function call_controller($name)
	{
	   $name = 'Controller' . ucfirst($name);
	   require_once('Controller/' . $name . '.class.php');
	   return (new $name());
	}

	public function rend($name)
	{
		if (isset(Controller::$cont))
			extract(Controller::$cont, EXTR_OVERWRITE);
		$this->header();
		require_once('View/' . ucfirst($name) . '.php');
		$this->footer();
	}

	public function add_buff($name, $value)
	{
		Controller::$cont[$name] = $value;
	}

	public function call_model($model_name)
	{
		$name = ucfirst($model_name);
		require_once('Model/' . $name . '.class.php');
		return (new $name());
	}
}

?>