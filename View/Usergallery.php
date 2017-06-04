<?php
	$form = new Form();
?>
	<div id="likersBox" style="background: red; position: fixed; margin-top: 200px; padding-right: 20px; display: none; z-index: 1;"></div>
	<div id="gallery_container" style="text-align: center;">
		<h3>Gallery</h3><br>
		<?php ControllerUsergallery::five_imgs(0, $form); ?>
	</div>
	<script type="text/javascript" src="../public/js/gallery.js"></script>
