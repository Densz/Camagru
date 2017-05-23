<?php


/**
* 
*/
class ControllerChangepwd extends Controller
{
	public function view()
	{

	}
/*
*	A FINIR !!!!
*/
	public function updatePwd()
	{
		$req = self::$sel->query_select('*', 'users', null, false);
		foreach ($req as $v)
		{
			if (hash('whirlpool', $v) === htmlspecialchars($_POST['email']))
				self::up->update_value('users', )
		}
	}
}
