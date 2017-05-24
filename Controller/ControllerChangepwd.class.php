<?php


/**
* 
*/
class ControllerChangepwd extends Controller
{
	public function view()
	{

	}

	public function updatePwd()
	{
		if($_POST['password'] === $_POST['password2'])
		{
			$condition = array(
									'password'		=>		"'" . Routeur::$url['params'][0] . "'"
								);
			$set = array(
									'password'		=>		"'" . hash('whirlpool', $_POST['password']) . "'"
						);
			self::$up->update_value('users', $set, $condition);
			$this->add_buff('password_changed', '<div class="alert alert-success">Your password has been changed</div>');

		}
		else
			$this->add_buff('invalid_password_confirmation', '<div class="alert alert-danger">Invalid password confirmation</div>');
	}
}
