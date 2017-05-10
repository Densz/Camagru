<?php

class ControllerAuthsignin extends Controller
{
	public function view(){
		$this->add_buff('first_var');
	}

	public function validEmail(){
		var_dump(Routeur::$url['params']);
		echo "<p>tasoeur</p>";
	}
}

?>