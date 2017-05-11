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
		$data = $sel->spe_select("login", "users", array("id"=>2));
		$this->add_buff("my_post", $data);
		/*if ($_POST['sign_in'] === 'Login')
		{
			//$array = Select::login($_POST['login']);
			$array = null;
			if (CB::my_assert($array))
			{
				if (hash('whirlpool', $_POST['password']) === $array['password'])
				{
					$_SESSION['auth'] = $_POST['login'];
					header('Location: http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/Userindex/view/');
				}
				else
					echo '<div class="alert alert-danger">Invalid password</div>';
			}
			else
				echo '<div class="alert alert-danger">Invalid login</div>';
		}*/
	}
}

?>