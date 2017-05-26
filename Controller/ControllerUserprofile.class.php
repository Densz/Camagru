<?php

class ControllerUserprofile extends Controller
{
	function view()
	{
		if (isset(Routeur::$url['params'][0]))
		{
			$username = ucfirst(Routeur::$url['params'][0]);
			var_dump($username);
			var_dump(ucfirst($_SESSION['auth']));
			if ($username !== ucfirst($_SESSION['auth']))
				$this->add_buff('username', $username . "'s ");
			else	
				$this->add_buff('username', 'Your ');
		}
		else
			die('redirection 404');

		$condition = array(
								'login' => "'" . $username . "'"
						);
		$req = self::$sel->query_select('*', 'posts', $condition, false, 'date');
		$img = "";
		foreach ($req as $v) {
			$img .= '<img type="image" width="300px" height="200px" class="images" src="../../' . $v['image_path'] . '">
					<img type="image" width="20px" height="20px" class="cross" src="../../public/resources/delete.png" style="display:none; margin-bottom: 20px; margin-left: -25px; position: absolute;">';
		}
		$this->add_buff('images', $img);
		$value = "COUNT('id') AS 'nbLike'";
		$extra = " INNER JOIN posts ON likes.img_path = posts.image_path WHERE posts.login = '" . Routeur::$url['params'][0] . "'";
		$req = self::$sel->query_select($value, 'likes', null, true, null, $extra);
		$this->add_buff('nbLikes', $req['nbLike']);
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
