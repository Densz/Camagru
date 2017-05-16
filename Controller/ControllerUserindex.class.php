<?php

class ControllerUserindex extends Controller
{
	public function view()
	{
		if (!CB::my_assert($_SESSION['auth']))
			header('Location: ' . Routeur::redirect('Authsignin/noAccess'));
	}

	public static function save()
	{
		$file = date('Y-m-d-H-i-s');
		$encodedData = str_replace(' ', '+', Routeur::$url['params'][0]);
		$decodedData = base64_decode($encodedData);
		$fp = fopen('../copies/' . $file . '.jpg', 'w');
		fwrite($fp, $decodedData);
		fclose($fp);
/*		$ins = $this->call_model('insert');
		$ins->insert_value('posts', array	(
												'id'		=>		null,
												'image_url'	=>		"'/copies/" . $file . ".jpg'",
												'login'		=>		"'" . $_SESSION['auth'] . "'",
												'date'		=>		"'" . $file . "'"
											)
		);
*/	}
}