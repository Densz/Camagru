<?php $form = new Form($_POST); ?>

<div id="cam_container" style="text-align: center;">
	<div style="display: inline">
		<div style="display: inline-block"><img height="50px" src="../public/filter/filter_42.png"><br /><input type="radio" name="filter" value="filter_42.png"></div>
		<div style="display: inline-block"><img height="50px" src="../public/filter/filter_42_2.png"><br /><input type="radio" name="filter" value="filter_42_2.png"></div>
	</div>
	<div id="visualize" style="display: block;">
		<video style="transform: scaleX(-1);" id="video"></video><br>
		<button id="startbutton">Prendre une photo</button>
		<button id="save" style="display: none;">Sauvegarder une photo</button>
	</div>
	<div style="text-align: center; display: block;">
		<img src="" id="photo" style="display: none;">
	</div>
		<canvas id="canvas" style="border:1px solid black;"></canvas>
</div>
<script src="../public/js/cam.js"></script>