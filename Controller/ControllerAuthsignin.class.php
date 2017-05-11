<?php

class ControllerAuthsignin extends Controller
{
	public function validEmail()
	{
		Update::accountConfirmed(Routeur::$url['params'][0]);
		$_SESSION['auth'] = Routeur::$url['params'][0];
		header('Location: http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/Userindex/view/');
	}

	public function signIn()
	{
		$sel = $this->call_model('select');
		if ($_POST['sign_in'] === 'Login')
		{
			/**
			 * Le model spe_select ne fait pas de Fetch_Assoc
			 */
			$array = $sel->spe_select("login, password", "users", array("login" => "'" . $_POST['login'] . "'"));
			if (CB::my_assert($array))
			{
				if (hash('whirlpool', $_POST['password']) === $array['password'])
				{
					$_SESSION['auth'] = $_POST['login'];
					echo $_SESSION['auth'] . ", you are now loggued";
					/**
					 * Header location ne marche pas je ne sais pas pourquoi
					 */
					/*echo Routeur::redirect('Userindex/view');
					header('Location: ' . Routeur::redirect('Userindex/view/'));*/
				}
				else
					echo '<div class="alert alert-danger">Invalid password</div>';
			}
			else
				echo '<div class="alert alert-danger">Invalid login</div>';
		}
	}

	public function view(){

	}
}

?>