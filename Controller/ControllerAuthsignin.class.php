<?php

class ControllerAuthsignin extends Controller
{
	public function view(){
		$this->add_buff('first_var');
	}

	public function validEmail(){
		Update::accountConfirmed(Routeur::$url['params'][0]);
		$_SESSION['auth'] = Routeur::$url['params'][0];
		header('Location: http://localhost:' . PORT . '/' . Routeur::$url['dir'] . '/Userindex/view/');
	}

	public function signIn()
	{
		if ($_POST['sign_in'] === 'Login')
		{
			$array = Select::login($_POST['login']);
			
		}
	}
}

?>