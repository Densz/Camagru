<?php

class ControllerUsergallery extends Controller
{
	public function view()
	{
		if (!CB::my_assert($_SESSION['auth']))
			header('Location: ' . Routeur::redirect('Authsignin/noAccess'));
	}

	public function five_imgs($begin, $form, $posts)
	{
		$finish = $begin + 5;
		while ($begin < $finish && CB::my_assert($posts[$begin]))
		{
			echo '<div class="img-thumbnail" style="margin-bottom: 20px;">';
			echo $form->img('../' . $posts[$begin]['image_path']);
    		echo $form->submit('like', 'Like', 'btn btn-primary');
			echo $form->input('comment', 'Comment this photo', null, 'form-control', true);
			echo '<br>';
			echo '</div>';
			$begin++;
		}
	}
}

?>