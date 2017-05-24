<?php

class ControllerUserindex extends Controller
{
	public function view()
	{
		if (!CB::my_assert($_SESSION['auth']))
			header('Location: ' . Routeur::redirect('Authsignin/noAccess'));
	}

	public function save()
	{
		$file = date('Y-m-d-H-i-u');
		$encodedData = str_replace(' ', '+', $_POST['contents']);
		$decodedData = base64_decode($encodedData);
		$fp = fopen('public/copies/' . $file . '.jpg', 'w');
		fwrite($fp, $decodedData);
		fclose($fp);
		$ins = $this->call_model('insert');
		$values = array	(
												'id'		=>		'null',
												'image_path'	=>		"'public/copies/" . $file . ".jpg'",
												'login'		=>		"'" . $_SESSION['auth'] . "'",
												'date'		=>		"'" . $file . "'"
						);
		$ins->insert_value('posts', $values);
	}
}