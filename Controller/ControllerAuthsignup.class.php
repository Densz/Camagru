<?php

class ControllerAuthsignup extends Controller
{
	public function signUp(){
		if ($_POST['signup'] === 'Submit' && $_POST['password'] === $_POST['password2']){
			if ($this->checker($_POST)){
				Insert::NewUser($_POST['login'], $_POST['email'], hash('whirlpool', $_POST[password]));
				$this->sendEmail($_POST);
				echo '<div class="alert alert-info">An email has been sent to you</div>';
			}
		} else {
			echo '<div class="alert alert-danger">Invalid password confirmation</div>';
		}
	}

	/**
	 * Checker a faire pour verifier si l'inscription peut se faire
	 * @param  [type] $array [description]
	 * @return [type]        [description]
	 */
	private function checker($array){
		return true;
	}

	private function sendEmail($userinfo){
		$url = explode('MyWebSite/', getcwd());
		$emailTo = $userinfo['email'];
		$emailFrom = 'tasoeur@camagru.com';
		$subject = "Camagru - Confirm Your Account";
		$message = "To create your account, confirm by clicking on the link below <br/> <a href='http://localhost:" . PORT . "/" . $url[1] . "/Authsignin/validEmail/" . $_POST['login'] . "'>Confirm account</a>";
		$headers = "From: " . $emailFrom . "\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($emailTo, $subject, $message, $headers);
	}

	public function view(){
		$this->add_buff('first_var');
	}

}
?>