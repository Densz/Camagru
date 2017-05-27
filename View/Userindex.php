<?php $form = new Form($_POST); ?>

<div id="cam_container" style="text-align: center;">
	<div id="filters">
		<?php if (isset($filters)) { echo $filters; } ?>
	</div>
	<div id="visualize" style="display: block;">
		<video id="video"></video><br>
		<input type="checkbox" id="greyScale_checkBox" name="greyScale"><span> Grey scale off</span><br>
		<button id="startbutton">Take picture</button>
		<button id="save" style="display: none;">Save picture</button>
		<button id="addfilter">Add filter</button>
	</div>
	<div style="text-align: center; display: block;">
		<img src="" id="photo" style="display: none;">
	</div>
		<canvas id="canvas" style="border:1px solid black;"></canvas>
</div>
<script src="../public/js/cam.js"></script>