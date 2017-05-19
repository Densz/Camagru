<?php
	$i = 0;
	$form = new Form();
	$sel = $this->call_model('select');
	$posts = $sel->query_select('image_path', 'posts', null, false);
?>
	<div style="text-align: center">
		<h3>Gallery</h3><br>
		<form method="">
			<?php ControllerUsergallery::five_imgs(0, $form, $posts); ?>
		</form>
	</div>

