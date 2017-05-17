<?php $form = new Form($_POST); ?>

<div id="container" style="display: inline;">
	<div id="visualize" style="text-align: center; display: block;">
		<video style="transform: scaleX(-1);" id="video"></video><br>
		<button id="startbutton">Prendre une photo</button>
		<button id="save" style="display: none;">Sauvegarder une photo</button>
		
	</div>
	<div style="text-align: center; display: block;">
		<img src="" id="photo">
	</div>
		<canvas id="canvas" style="display: none;"></canvas>
</div>
<script src="../public/js/cam.js"></script>