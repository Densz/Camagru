<?php $form = new Form($_POST); ?>

<div style="display: inline;">
	<div style="text-align: center; display: block;">
		<video style="transform: scaleX(-1);" id="video"></video><br>
		<button id="startbutton">Prendre une photo</button>
		<button id="save">Sauvegarder une photo</button>
		
	</div>
	<div style="text-align: center; display: block;">
		<img src="" id="photo" alt="photo">
	</div>
		<canvas id="canvas"></canvas>
</div>
<script src="../public/js/cam.js"></script>