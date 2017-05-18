<?php

class ControllerUserindexphp extends Controller
{
	public function view()
	{
		if (!CB::my_assert($_SESSION['auth']))
			header('Location: ' . Routeur::redirect('Authsignin/noAccess'));
	}

	public function save()
	{
		$file = date('Y-m-d-H-i-s');
		$encodedData = str_replace(' ', '+', $_POST['contents']);
		$decodedData = base64_decode($encodedData);
		$img_gd = imagecreatefromstring($decodedData);
		$filter_gd = imagecreatefrompng('public/filter/' . $_POST['filter']);
		$filter_size = getimagesize('public/filter/' . $_POST['filter']);
		$img_with_filter = $this->imagecopymerge_alpha($img_gd, $filter_gd, 1, 1, 1, 1, $filter_size[0] - 1, $filter_size[1] - 1, 100);
		imagejpeg($img_with_filter, 'public/copies/' . $file . '.jpg');
		$ins = $this->call_model('insert');
		$values = array	(
												'id'		=>		'null',
												'image_path'=>		"'public/copies/" . $file . ".jpg'",
												'login'		=>		"'" . $_SESSION['auth'] . "'",
												'date'		=>		"'" . $file . "'"
						);
		$ins->insert_value('posts', $values);
		header('Content-type: application/json');
		echo json_encode($values);
	}

	public function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){ 
		$cut = imagecreatetruecolor($src_w, $src_h); 
		imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h); 
		imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h); 
		imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
		return $dst_im;
	} 
}