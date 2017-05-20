<?php

class ControllerUsergallery extends Controller
{
	private static $posts;
	private static $sel;

	public function view()
	{
		if (!CB::my_assert($_SESSION['auth']))
			header('Location: ' . Routeur::redirect('Authsignin/noAccess'));
		self::$sel = $this->call_model('select');
		self::$posts = self::$sel->query_select('*', 'posts', null, false, 'image_path');

	}

	public function five_imgs($begin, $form)
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
			echo $form->img('../' . self::$posts[$begin]['image_path']);
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
			echo $form->surround($output, 'p', 'countLikes');
			echo $form->input('comment', 'Comment this photo', null, 'form-control', false);
			echo '<br>';
			echo '</div>';
			$begin++;
		}
	}

	public function like(){
		$ins = $this->call_model('insert');
		if (CB::my_assert($_POST['image_path'])){
			$values = array (	'id'			=>		'null', 
								'img_path'		=> 		"'" . $_POST['image_path'] . "'",
								'login'			=>		"'" . $_SESSION['auth'] . "'"
							);
			$ins->insert_value('likes', $values);
		}
	}

	public function unlike(){
		$del = $this->call_model('delete');
		if (CB::my_assert($_POST['image_path'])){
			$condition = array (
									'img_path' 	=>		"'" . $_POST['image_path'] . "'",
									'login'		=>		"'" . $_SESSION['auth'] . "'"
								);
			$del->delete_value('likes', $condition);
		}
	}
}

?>