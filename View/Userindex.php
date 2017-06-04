<?php $form = new Form($_POST); ?>

<div id="helpBox" style="background: red; position: fixed; margin-top: 200px; padding-right: 20px; display: none; z-index: 1;">
	<span id="close" style="color: #aaaaaa; float: right; font-size: 28px; font-weight: bold;">&times;</span>
	<h3 style="text-align: center;">Few helps</h3>
	<ul>
		<li>Choose your filter</li>
		<li>Click on the live or on the canvas at the position where you want see your filter appears</li>
		<li>Take your picture</li>
		<li>Add your filter</li>
		<li>This one is perfect save itSave picture</li>
	</ul>
</div>
<div id="cam_container" style="text-align: center;">
	<button id="howToUse" style="letter-spacing: 1px; color: rgba(168, 168, 168, 0.8);">How to use</button>
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
<div>
<script src="../public/js/cam.js"></script>