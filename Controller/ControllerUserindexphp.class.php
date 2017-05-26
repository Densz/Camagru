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
		$this->view();
		if ($_POST['submit'] === 'Upload Image')
		{
			$valid_ext = array('jpg', 'jpeg');
			$file_extension = strtolower(substr(strrchr($_FILES['upload']['name'], '.'), 1));
			if (isset($_FILES['upload']['error']))
				if ($this->UploadError($_FILES, $file_extension, $valid_ext) == true)
					return ;
			$date_of_file = date('Y-m-d-H-i-s');
			$file = uniqid(date('Y-m-d-H-i-s'));
			$file_name = 'public/copies/' . $file . '.' . $file_extension;
			$res = move_uploaded_file($_FILES['upload']['tmp_name'], $file_name);
			list($width, $height) = getimagesize($file_name);
			$newheight = round((500 * $height) / $width, 0);
			$img_gd = $this->resize_image($file_name, 500, $newheight, false);
			$filter_gd = imagecreatefrompng('public/resources/filter/' . $_POST['filter']);
			$filter_size = getimagesize('public/resources/filter/' . $_POST['filter']);


// A finir avec des ratio proportionnels
// A finir aussi pour les resize des filtres de la caméra
// creer une sous fonction dans le controleur serait cool
$nWidth = 100;
$nHeight = 100;
$newImg = imagecreatetruecolor($nWidth, $nHeight);
imagealphablending($newImg, false);
imagesavealpha($newImg,true);
$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);
imagecopyresampled($newImg, $filter_gd, 0, 0, 0, 0, $nWidth, $nHeight, $filter_size[0], $filter_size[1]);

			$img_with_filter = $this->imagecopymerge_alpha($img_gd, $newImg, 1, 1, 1, 1, $nWidth - 1, $nHeight - 1, 100);
			imagejpeg($img_with_filter, $file_name);
			$ins = $this->call_model('insert');
			$values = array	(
								'id'			=>		'null',
								'image_path'	=>		"'" . $file_name . "'",
								'login'			=>		"'" . $_SESSION['auth'] . "'",
								'date'			=>		"'" . $date_of_file . "'"
							);
			$ins->insert_value('posts', $values);
			?>
			<script>
			function putPreview(imgPath)
			{
				var imgPreview = document.querySelectorAll('.img_preview'),
					parentDiv = document.getElementById('side_container'),
					newImg = document.createElement('img');

				if (imgPreview.length == 3)
				{
					parentDiv.removeChild(imgPreview[2]);
					imgPreview.length -= 1;
				}
				newImg.src = imgPath;
				newImg.style.width = '200px';
				newImg.className = 'img_preview';
				parentDiv.insertBefore(newImg, imgPreview[0]);
			}

			window.onload = function () {
				var canvas = document.querySelector('#canvas');
				var video = document.querySelector('#video');
				var width = 500;
				var height = <?= $newheight ?>;

				base_image = new Image();
				base_image.src = '<?= '../' . $file_name; ?>';
				base_image.onload = function()
				{
					canvas.width = width;
					canvas.height = height;
					canvas.getContext('2d').drawImage(base_image, 0, 0, width, height);
				}
				putPreview(base_image.src);
			}
			</script>
			<?php
		}
	}

	private function UploadError($FILES, $file_extension, $valid_ext){
		if ($FILES['upload']['error'] === UPLOAD_ERR_FORM_SIZE || $FILES['upload']['error'] === UPLOAD_ERR_INI_SIZE)
		{
			$this->add_buff('fileErr','<div class="alert alert-danger">File size too big, limit 2Mo</div>');
			return true;
		}
		else if (!in_array($file_extension, $valid_ext))
		{
			$this->add_buff('fileErr','<div class="alert alert-danger">Bad type file : jpeg</div>');
			return true;
		}
		return false;
	}


	private function resize_image($file, $w, $h, $crop=FALSE) {
		list($width, $height) = getimagesize($file);
		$ratio = $width / $height;
		if ($crop)
		{
			if ($width > $height) {
				$width = ceil($width-($width*abs($ratio-$w/$h)));
			} else {
				$height = ceil($height-($height*abs($ratio-$w/$h)));
			}
			$newwidth = $w;
			$newheight = $h;
		} 
		else
		{
			if ($w/$h > $ratio)
			{
				$newwidth = $h*$ratio;
				$newheight = $h;
			}
			else 
			{
				$newheight = $w/$ratio;
				$newwidth = $w;
			}
		}
		$src = imagecreatefromjpeg($file);
		$dst = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		return $dst;
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
