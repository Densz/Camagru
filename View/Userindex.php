<?php $form = new Form($_POST); ?>


<div id="helpBox">
	<span id="close">&times;</span>
	<h3 style="text-align: center;">Few helps</h3>
	<ul>
		<li>Choose your filter</li>
		<li>Click on the canvas at the position where you want see your filter appears</li>
		<li>Take your picture</li>
		<li>Add your filter</li>
		<li>If this one is perfect, save it by clicking on - Save picture -</li>
	</ul>
</div>
<h2>Js Cam</h2><br>
<div id="cam_container" style="text-align: center;">
	<button id="howToUse" style="letter-spacing: 1px; color: rgba(168, 168, 168, 0.8);">How to use</button>
	<div id="filters">
		<?php if (isset($filters)) { echo $filters; } ?>
	</div>
	<div id="visualize" style="display: block;">
		<div><video id="video"></video></div>
		<div id="ck-button">
		   <label><input type="checkbox" id="greyScale_checkBox" name="greyscale" value="1"><span>Greyscale off</span></label>
		</div>
		<div style="margin-bottom: 10px;">
			<button id="startbutton" class="btn btn-primary">Take picture</button>
			<button id="save" class="btn btn-primary" style="display: none;">Save picture</button>
			<button id="addfilter" class="btn btn-primary">Add filter</button>
		</div>
	</div>
	<div style="text-align: center; display: block;">
		<img src="" id="photo" style="display: none;">
	</div>
		<canvas id="canvas" style="border:1px solid black;"></canvas>
</div>
<script src="../public/js/cam.js"></script>