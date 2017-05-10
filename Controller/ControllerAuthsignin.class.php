<?php

class ControllerAuthsignin extends Controller
{
	public function view(){
		$this->add_buff('first_var');
	}

	public function validEmail(){
		Update::accountConfirmed(Routeur::$url['params'][0]);
		// Update la db pour valider le compte
		// Connecter l'utilisateur
		// Rediriger la page sur la vue principale

	}
}

?>