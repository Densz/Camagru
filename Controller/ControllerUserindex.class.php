<?php

class ControllerUserindex extends Controller
{
	/**
	 * A revoir
	 * @return [type] [description]
	 */
	public function view()
	{
		if (!CB::my_assert($_SESSION['auth']))
		{
			//$this->check_access();
			$this->add_buff('no_access');
		}
		//$this->add_buff('first_var');
		$select = $this->call_model('select');
		$select->all('users', array('pseudo', 'password'));
	}

/*	public function check_access()
	{
		return '<div class="alert alert-danger">No access rights</div>';
	}*/
}