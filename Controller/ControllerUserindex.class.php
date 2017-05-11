<?php

class ControllerUserindex extends Controller
{
	public function view(){
		if (!CB::my_assert($_SESSION['auth']))
		{
			$this->check_access();
			$this->add_buff('no_access');
		}
		else
		{

		}
		//$this->add_buff('first_var');
		$sel = $this->call_model('select');
		$sel->select_all('user', array('pseudo', 'password'));
	}

	public function check_access()
	{
		return '<div class="alert alert-danger">No access rights</div>';
	}
}