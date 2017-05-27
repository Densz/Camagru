<?php $form = new Form($_POST); ?>

<?php if(isset($fileErr)) { echo $fileErr; } ?>

<div id="cam_container" style="text-align: center; display: inline-block; width: 800px;">
	<h3>1. Select or Upload your filter</h3>
	<form method="post" enctype="multipart/form-data" action="<?= Routeur::redirect('Userindexphp/uploadFilter'); ?>">
		<div style="display: inline-block">
			<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
			<input type="file" name="upload_filter" id="upload_filter" required='true'>
		</div>
		<div style="display: inline-block">
			<input type="submit" value="Upload_filter" name="submit">
		</div>
	</form>
	<form method="post" enctype="multipart/form-data" action="<?= Routeur::redirect('Userindexphp/upload'); ?>">
	<div id="filters">
		<?php if (isset($filters)) { echo $filters; } ?>
	</div>
	<h3>2. Cheese</h3>
	<div id="visualize" style="display: block; margin-top: 20px;">
		<video id="video"></video><br>
		<button id="startbutton">Take picture</button><br>
			<div style="display: inline-block">
				<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
				<input type="file" name="upload" id="upload" required='true'>
			</div>
			<div style="display: inline-block">
				<input type="submit" value="Upload Image" name="submit">
			</div>
	</form>
	<div style="text-align: center; display: block;">
		<img src="" id="photo" style="display: none;">
	</div>
		<canvas id="canvas"></canvas>
	</div>
</div>
<div id="side_container" style="display: inline-block; width: 200px; vertical-align: top;">
	<h3>3. Admire</h3>
	<?php if(isset($previews)) { echo $previews; } ?>
</div>
<script src="../public/js/cam_php.js"></script>