<?php

class ControllerUserprofile extends Controller
{
	function view()
	{
		$condition = array(
								'login' => "'" . $_SESSION['auth'] . "'"
						);
		$req = self::$sel->query_select('*', 'posts', $condition, false, 'date');
		$img = "";
		foreach ($req as $v) {
			$img .= '<img type="image" width="300px" height="200px" class="images" src="../' . $v['image_path'] . '">
					<img type="image" width="20px" height="20px" class="cross" src="http://pngimages.net/sites/default/files/red-delete-button-png-image-66582.png" style="display:none; margin-bottom: 20px; margin-left: -25px; position: absolute;">';
		}
		$this->add_buff('images', $img);
	}

	function delete()
	{
		if (isset($_POST['img_path']) && !empty($_POST['img_path']))
		{
			$conditions = array(
									'image_path'	=>		"'" . $_POST['img_path'] . "'",
									'login'			=>		"'" . $_SESSION['auth'] . "'"
								);
			self::$del->delete_value('posts', $conditions);
			unlink($_POST['img_path']);
		}
	}
}