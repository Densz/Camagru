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
		$pwd = htmlspecialchars($_POST['password']);
		if ($pwd === htmlspecialchars($_POST['password2']))
		{
			$conditions = array(
									'password'		=>		'?',
									'id'			=>		'?'
								);
			$attributes = array(
									Routeur::$url['params'][0],
									intval(Routeur::$url['params'][1])
								);
			$req = self::$sel->query_select('*', 'users', $conditions, true, null, null, $attributes);
			if (isset($req) && !empty($req))
			{
				if (!preg_match('/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $pwd))
					$this->add_buff('invalid_password', '<div class="alert alert-danger">Password conditions:<br>- Inclusion of one or more numerical digits<br>- The use of both upper-case and lower-case letters<br>- Min lenght: 6 characters</div>');
				else {
					$set = array(
											'password'		=>		"'" . hash('whirlpool', $pwd) . "'"
								);
					self::$up->update_value('users', $set, $conditions, $attributes);
					$this->add_buff('password_changed', '<div class="alert alert-success">Your password has been changed</div>');
				}	
			}
			else
				$this->add_buff('wrong_link', '<div class="alert alert-danger">User not found</div>');
		}
		else
			$this->add_buff('invalid_password_confirmation', '<div class="alert alert-danger">Invalid password confirmation</div>');
	}
}
