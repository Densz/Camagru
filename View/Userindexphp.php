<?php $form = new Form($_POST); ?>

<?php if(isset($fileErr)) { echo $fileErr; } ?>

<div id="cam_container" style="text-align: center; display: inline-block; width: 800px;">
	<form method="post" enctype="multipart/form-data" action="<?= Routeur::redirect('Userindexphp/upload'); ?>">
	<div style="display: inline">
		<div style="display: inline-block"><img height="50px" src="../public/resources/filter/filter_42.png"><br /><input type="radio" name="filter" value="filter_42.png" checked></div>
		<div style="display: inline-block"><img height="50px" src="../public/resources/filter/filter_42_2.png"><br /><input type="radio" name="filter" value="filter_42_2.png"></div>
	</div>
	<div id="visualize" style="display: block;">
		<video id="video"></video><br>
		<button id="startbutton">Take picture</button><br><br><br>
			<div style="display: inline-block">
				<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
				<input type="file" name="upload" id="upload" required='true'>
			</div>
			<div style="display: inline-block">
				<input type="submit" value="Upload Image" name="submit">
			</div>
		</form>
		<br><br><br>
	<div style="text-align: center; display: block;">
		<img src="" id="photo" style="display: none;">
	</div>
		<canvas id="canvas"></canvas>
	</div>
</div>
<div id="side_container" style="display: inline-block; width: 200px; height: 445px; vertical-align: top;">
	<h3 style="text-align: center;">Preview</h3>
	<?php if(isset($previews)) { echo $previews; } ?>
</div>
<script src="../public/js/cam_php.js"></script>