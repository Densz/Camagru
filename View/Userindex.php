<p><?= $no_access; ?></p>
<div>
	<div style="width: 600px; text-align: center; display: inline-block; background-color: red;">
		<video id="video"></video>
		<button id="startbutton">Prendre une photo</button>
	</div>
	<div style="width: 600px; text-align: center;display: inline-block; background-color: grey;">
		<img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
	</div>

		<canvas id="canvas" style="display: none;"></canvas>
</div>
<script src="../public/js/cam.js"></script>