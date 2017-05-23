<?php

class ControllerUsergallery extends Controller
{
	private static $posts;

	public function view()
	{
		if (!CB::my_assert($_SESSION['auth']))
			header('Location: ' . Routeur::redirect('Authsignin/noAccess'));
		self::$posts = self::$sel->query_select('*', 'posts', null, false, 'image_path');

	}

	private static function displayCom($img_path)
	{
		$condition = array(
								'img_path'		=>		"'{$img_path}'"
							);
		$req = self::$sel->query_select('*', 'comments', $condition, false, 'date');
		echo '<br><div class="com_container" style="text-align:left;">';
		if (CB::my_assert($req))
		{
			foreach ($req as $v) {
				echo "<p><b>{$v['login']}:</b>&nbsp;{$v['img_comment']}</p>";
			}
		}
		echo '</div>';
	}

	public static function five_imgs($begin, $form)
	{
		$finish = $begin + 5;
		$condition = array (
								'login' => "'" . $_SESSION['auth'] . "'"
							);
		$likes = self::$sel->query_select('img_path', 'likes', $condition, false);
		$value = "Count(id) AS 'countLikes'";
		while ($begin < $finish && CB::my_assert(self::$posts[$begin]))
		{
			$bool = false;
			echo '<div class="img-thumbnail" style="margin-bottom: 20px;">';
			echo 'Posted by ';
			echo $form->surround(self::$posts[$begin]['login'], 'a', 'text-left');
			echo $form->img('../' . self::$posts[$begin]['image_path'], 'image');
			foreach ($likes as $v) {
				if ($v['img_path'] === self::$posts[$begin]['image_path'])
				{
					echo '<img class="like" src="../public/resources/colored_heart.png" id="' . self::$posts[$begin]['image_path'] . '" />';
					$bool = true;
				}
			}
			if ($bool === false)
				echo '<img class="like" src="../public/resources/empty_heart.png" id="' . self::$posts[$begin]['image_path'] . '" />';
			echo '<br>';
			$condition = array (
									'img_path' => "'" . self::$posts[$begin]['image_path'] . "'"
								);
			$req = self::$sel->query_select($value, 'likes', $condition);
			$output = $req['countLikes'] . " like" . ($req['countLikes'] > 1 ? "s" : "");
			echo $form->surround($output, 'a', 'countLikes');
			echo $form->input('comment', 'Comment this photo', null, 'form-control', false);
			echo '<button class="test">Comment</button>';
			echo '<br>';
			self::displayCom(self::$posts[$begin]['image_path']);
			echo '</div>';
			$begin++;
		}
	}

	public function like(){
		if (CB::my_assert($_POST['image_path'])){
			$values = array (	'id'			=>		'null', 
								'img_path'		=> 		"'" . $_POST['image_path'] . "'",
								'login'			=>		"'" . $_SESSION['auth'] . "'"
							);
			self::$ins->insert_value('likes', $values);
		}
	}

	public function unlike(){
		if (CB::my_assert($_POST['image_path'])){
			$condition = array (
									'img_path' 	=>		"'" . $_POST['image_path'] . "'",
									'login'		=>		"'" . $_SESSION['auth'] . "'"
								);
			self::$del->delete_value('likes', $condition);
		}
	}

	public function showLikers()
	{
		if (CB::my_assert($_POST['image_path']))
		{
			$condition = array  (
									'img_path' 	=>		"'" . $_POST['image_path'] . "'"
								);
			$userWhoLiked = self::$sel->query_select('login', 'likes', $condition, false);
			$ret = array ();
			foreach ($userWhoLiked as $v) {
				array_push($ret, $v['login']);
			}
			header('Content-type: text/plain');
			// A afficher proprement dans une pop-up
			print_r($ret);
		}
	}

	public function comment()
	{
		if (CB::my_assert($_POST['comment']))
		{
			$values = array(
								'id'			=>		'null',
								'img_path'		=>		"'" . $_POST['img_path'] . "'",
								'login'			=>		"'" . $_SESSION['auth'] . "'",
								'img_comment'	=>		"'" . $_POST['comment'] . "'",
								'date'			=>		"'" . date('Y-m-d-H-i-s') . "'"
							);
			self::$ins->insert_value('comments', $values);
		}
		echo json_encode(array('user' => "{$_SESSION['auth']}"));
	}
}

?>