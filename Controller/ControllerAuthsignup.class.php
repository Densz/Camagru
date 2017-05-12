<?php

class ControllerAuthsignup extends Controller
{
	public function view()
	{
		
	}

	public function signUp()
	{
		if ($_POST['signup'] === 'Submit' && $_POST['password'] === $_POST['password2'])
		{
			if ($this->checker($_POST))
			{
				$insert = $this->call_model('insert');
				$values = array(
									'id' 				=>	'null',
									'login' 			=>	"'" . $_POST['login'] . "'", 
									'email'				=>	"'" . $_POST['email'] . "'", 
									'password'			=>	"'" . hash('whirlpool', $_POST['password']) . "'",
									'email_confirmed' 	=>	"'no'",
									'admin'				=>	"'no'"
								);
				$insert->insert_value('users', $values);
				$this->sendEmail($_POST);
				$this->add_buff('email_sent','<div class="alert alert-info">An email has been sent to you</div>');
			}
		}
		else
		{
			$this->add_buff('wrong_password_confirmation', '<div class="alert alert-danger">Invalid password confirmation</div>');
		}
	}

	private function checker($array)
	{
		return true;
	}

	private function sendEmail($userinfo)
	{
		$url = explode('MyWebSite/', getcwd());
		$emailTo = $userinfo['email'];
		$emailFrom = 'tasoeur@camagru.com';
		$subject = "Camagru - Confirm Your Account";
		$message = "To create your account, confirm by clicking on the link below <br/> <a href='http://localhost:" . PORT . "/" . $url[1] . "/Authsignin/validEmail/" . $_POST['login'] . "'>Confirm account</a>";
		$headers = "From: " . $emailFrom . "\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($emailTo, $subject, $message, $headers);
	}
}
?>