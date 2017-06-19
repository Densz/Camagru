<?php

class Controller
{
	public static $cont;
	protected static $sel;
	protected static $del;
	protected static $ins;
	protected static $up;

	public function __construct()
	{
		/**
		 * a appele dans les sous controleurs
		 * @var [type]
		 */
		self::$sel = $this->call_model('select');
		self::$del = $this->call_model('delete');
		self::$ins = $this->call_model('insert');
		self::$up = $this->call_model('update');
	}

	public function header()
	{
		$logo = '<a class="navbar-brand" href="http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/Authsignin/view">Camagru</a>';
		$gallery = '<a class="navbar-brand" href="http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/Usergallery/view"><img class="img-bar" src="http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/public/resources/gallery.png"></a>';
		if (isset($_SESSION['auth']) && !empty($_SESSION['auth']))
		{
			$disconnect = '<a class="navbar-brand" href="http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/Authsignin/signOut"><img class="img-bar" src="http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/public/resources/door.png"></a>';
			$camjs = '<a class="navbar-brand" href="http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/Userindex/view"><img class="img-bar" src="http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/public/resources/logo_js.png"></a>';
			$camphp = '<a class="navbar-brand" href="http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/Userindexphp/view"><img class="img-bar" src="http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/public/resources/logo_php.png"></a>';
			$cam = '
			<div class="navbar-brand" id="cam"><img class="img-bar" src="http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/public/resources/favicon.png">
					<div class="nav-list">' . $camjs . '</div>
					<div class="nav-list">' . $camphp .  '</div>
			</div>';
			$profile = '<a class="navbar-brand" href="http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/Userprofile/view/' . $_SESSION['auth'] . '"><img class="img-bar" src="http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/public/resources/profile.png"></a>';
		}
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
		if (method_exists($func, $func_name) == true)
			$func->$func_name();
		else
			Routeur::redirect('Page404/view');
	}

	public function call_controller($name)
	{
	   $name = 'Controller' . ucfirst($name);
		if (file_exists('Controller/' . $name . '.class.php'))
			require_once('Controller/' . $name . '.class.php');
		else
		{
			Routeur::redirect('Page404/view');
			return ;
		}
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