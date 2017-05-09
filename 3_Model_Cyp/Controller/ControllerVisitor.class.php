<?php

class ControllerVisitor extends Controller
{
	public function view()
	{
		$this->form();
		$this->add_buff('first_var');
	}

	public function form()
	{
		
	}
}

?>