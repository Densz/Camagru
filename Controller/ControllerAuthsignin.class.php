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
			$array = $sel->query_select("login, password", "users", array("login" => "'" . $_POST['login'] . "'"));
			if (CB::my_assert($array))
			{
				if (hash('whirlpool', $_POST['password']) === $array['password'])
				{
					$_SESSION['auth'] = $_POST['login'];
					header('Location: ' . Routeur::redirect('Userindex/view'));
				}
				else
					$this->add_buff('wrong_pwd', '<div class="alert alert-danger">Invalid password</div>');
			}
			else
				$this->add_buff('wrong_log', '<div class="alert alert-danger">Invalid login</div>');
		}
	}

	public function view(){

	}
}

?>