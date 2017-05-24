<?php

class ControllerUserindexphp extends Controller
{
	public function view()
	{
		if (!CB::my_assert($_SESSION['auth']))
			header('Location: ' . Routeur::redirect('Authsignin/noAccess'));
		else
		{
			$previews = null;
			$condition = array(
									'login'			=>		"'" . $_SESSION['auth'] . "'"
								);
			$extra = " ORDER BY date DESC LIMIT 3";
			$req = self::$sel->query_select("image_path", "posts", $condition, false, null, $extra);
			foreach ($req as $v) {
				$previews .= '<img src="../' . $v['image_path'] . '" class="img_preview" style="width: 200px;"><br>';
			}
			$this->add_buff('previews', $previews);
		}
	}

	public function upload()
	{

		if ($_POST['submit'] === 'Upload Image')
		{
			$valid_ext = array('jpg', 'jpeg', 'png', 'gif');
			$file_extension = strtolower(substr(strrchr($_FILES['upload']['name'], '.'), 1));
			if ($_FILES['error'] === UPLOAD_ERR_FORM_SIZE)
				die("The file is too big");
			else if (!in_array($file_extension, $valid_ext))
				die("Bad file type");
			$date_of_file = date('Y-m-d-H-i-s');
			$file = uniqid(date('Y-m-d-H-i-s'));
			$file_name = 'public/copies/' . $file . '.' . $file_extension;
			$res = move_uploaded_file($_FILES['upload']['tmp_name'], $file_name);
			$img_gd = imagecreatefromjpeg($file_name);
			$filter_gd = imagecreatefrompng('public/resources/filter/' . $_POST['filter']);
			$filter_size = getimagesize('public/resources/filter/' . $_POST['filter']);
			$img_with_filter = $this->imagecopymerge_alpha($img_gd, $filter_gd, 1, 1, 1, 1, $filter_size[0] - 1, $filter_size[1] - 1, 100);
			imagejpeg($img_with_filter, $file_name);
			$ins = $this->call_model('insert');
			$values = array	(
								'id'		=>		'null',
								'image_path'=>		"'" . $file_name . "'",
								'login'		=>		"'" . $_SESSION['auth'] . "'",
								'date'		=>		"'" . $date_of_file . "'"
							);
			$ins->insert_value('posts', $values);
			?>
			<script>
			window.onload = function () {
				var canvas = document.querySelector('#canvas');
				var video = document.querySelector('#video');
				var width = 500;
				var height = 500;

				base_image = new Image();
				base_image.src = '<?= '../' . $file_name; ?>';
				console.log(base_image.src);
				base_image.onload = function()
				{
					canvas.width = width;
					canvas.height = height;
					canvas.getContext('2d').drawImage(base_image, 0, 0, width, height);
				}
			}
			</script>
			<?php
		}
	}

	public function save()
	{
		$file = uniqid(date('Y-m-d-H-i-s'));
		$date = date('Y-m-d-H-i-s');
		$encodedData = str_replace(' ', '+', $_POST['contents']);
		$decodedData = base64_decode($encodedData);
		$img_gd = imagecreatefromstring($decodedData);
		$filter_gd = imagecreatefrompng('public/resources/filter/' . $_POST['filter']);
		$filter_size = getimagesize('public/resources/filter/' . $_POST['filter']);
		$img_with_filter = $this->imagecopymerge_alpha($img_gd, $filter_gd, 1, 1, 1, 1, $filter_size[0] - 1, $filter_size[1] - 1, 100);
		imagejpeg($img_with_filter, 'public/copies/' . $file . '.jpg');
		$ins = $this->call_model('insert');
		$values = array	(
												'id'		=>		'null',
												'image_path'=>		"'public/copies/" . $file . ".jpg'",
												'login'		=>		"'" . $_SESSION['auth'] . "'",
												'date'		=>		"'" . $date . "'"
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
