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

	public function infiniteScroll()
	{
		$condition = array(
								'image_path'	=>	"'" . $_POST['img_path'] . "'"
							);
		$req = self::$sel->query_select('id', 'posts', $condition);
		$extra = " WHERE id < " . $req['id'] . " ORDER BY id DESC LIMIT 1";
		$req2 = self::$sel->query_select('image_path', 'posts', null, false, null, $extra);
		echo json_encode($req2);
	}

	public static function five_imgs($begin, $form)
	{
		$finish = $begin + 5;
		$condition = array (
								'login' => "'" . $_SESSION['auth'] . "'"
							);
		$likes = self::$sel->query_select('img_path', 'likes', $condition, false);
		$value = "Count(id) AS 'countLikes'";
		if (empty(self::$posts[$begin]))
			echo '<h1>You didn\'t take any picture yet</h1>';
		while ($begin < $finish && isset(self::$posts[$begin]))
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
			echo '</div><br>';
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
								'img_path'		=>		'?',
								'login'			=>		'?',
								'img_comment'	=>		'?',
								'date'			=>		"'" . date('Y-m-d-H-i-s') . "'"
							);
			$attributes = array(
									"'" . $_POST['img_path'] . "'",
									"'" . $_SESSION['auth'] . "'",
									"'" . $_POST['comment'] . "'"
								);
			self::$ins->insert_value('comments', $values, $attributes);
			$condition = array(
									'image_path'	=>		"'" . $_POST['img_path'] . "'"
								);
			$req = self::$sel->query_select('login', 'posts', $condition);

			if ($req['login'] !== $_SESSION['auth'])
			{
				$condition = array(
										'login'		=>	"'" . $req['login'] . "'"
									);
				$q2 = self::$sel->query_select('email', 'users',  $condition);
				$emailTo = htmlspecialchars($q2['email']);
				$emailFrom = 'tatante@camagru.com';
				$subject = "Camagru - " . $_SESSION['auth'] . " commented your photo";
				$img_link = "http://localhost:" . PORT . "/" . Routeur::$url['dir'] . "/" . $_POST['img_path'];
				/*A mettre le href vers le profil, filter l'image en question*/
				$message = "Hi " . ucfirst($req['login']) . "<br/> Awesome, " . $_SESSION['auth'] . " just comments your photo !<br/> <a href='#'>Click here to see the comment</a><br/><label>Comment:</label><br/><p>" . $_POST['comment'] . "</p>";
				$headers = "From: " . $emailFrom . "\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				mail($emailTo, $subject, $message, $headers);
			}
		}
		echo json_encode(array('user' => "{$_SESSION['auth']}"));
	}
}

?>
