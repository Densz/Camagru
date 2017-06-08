(function() {

  var streaming = false,
	  video       	= document.querySelector('#video'),
	  cover       	= document.querySelector('#cover'),
	  canvas      	= document.querySelector('#canvas'),
	  photo       	= document.querySelector('#photo'),
	  startbutton 	= document.querySelector('#startbutton'),
	  saveButton	= document.querySelector('#save'),
	  addFilter 	= document.querySelector('#addfilter'),
	  gS_check		= document.querySelector('#greyScale_checkBox'),
	  how2Use		= document.querySelector('#howToUse'),
	  helpBox		= document.querySelector('#helpBox'),
	  close			= document.querySelector('#close'),
	  gS_checked	= false,
	  width 		= 500,
	  height 		= 0,
	  mousePos 		= {
	  	x: 0,
	  	y: 0
	  };

	navigator.getMedia = (navigator.getUserMedia ||
						navigator.webkitGetUserMedia ||
						navigator.mozGetUserMedia ||
						navigator.msGetUserMedia);

	navigator.getMedia(
	{
		video: true,
		audio: false
	}, function(stream) {
		if (navigator.mozGetUserMedia) {
		video.mozSrcObject = stream;
		} else {
			var vendorURL = window.URL || window.webkitURL;
			video.src = vendorURL.createObjectURL(stream);
		}
			video.play();
	}, function(err) {
		console.log("An error occured! " + err);
	}
	);

	/**
	 *  Event listener
	 */

	how2Use.addEventListener('click', function() {
		helpBox.style.display = "inline-block";
	})

	close.addEventListener('click', function(){
		helpBox.style.display = "none";
	})

	window.onclick = function(event) {
		if (event.target != helpBox && event.target != how2Use)
			helpBox.style.display = "none";
	}

	video.addEventListener('click', function(e) {
		mousePos.x = e.offsetX - 50;
		mousePos.y = e.offsetY - 50;
	})

	canvas.addEventListener('click', function(e) {
		mousePos.x = e.offsetX - 50;
		mousePos.y = e.offsetY - 50;
	})

	video.addEventListener('canplay', function(ev){
		if (!streaming) {
			height = video.videoHeight / (video.videoWidth/width);
			video.setAttribute('width', width);
			video.setAttribute('height', height);
			canvas.setAttribute('width', width);
			canvas.setAttribute('height', height);
			streaming = true;
		}
	}, false);

	save.addEventListener('click', function(){
		savePicture();
		saveButton.style.display = 'none';

		photo.style.display = 'none';
		var alert = document.createElement('div'),
			container = document.getElementById('cam_container');
		alert.className = 'alert alert-success';
		container.insertBefore(alert, container.firstChild);
		alert.appendChild(document.createTextNode("Your picture has been saved"));
	});

	startbutton.addEventListener('click', function(ev){
		takePicture();
		ev.preventDefault();
	}, false);

	addFilter.addEventListener('click', function(){
		if (document.querySelector('input[name="filter"]:checked')) {
			var base_image = new Image(),
			filter = document.querySelector('input[name="filter"]:checked').value;

			base_image.src = '../public/resources/filter/' + filter;
			base_image.onload = function(){
				canvas.getContext('2d').drawImage(base_image, mousePos.x, mousePos.y, 100, 100);
			}
		}
		else
		{
			var alert = document.createElement('div'),
				container = document.getElementById('cam_container');

			alert.className = 'alert alert-danger';
			container.insertBefore(alert, container.firstChild);
			alert.appendChild(document.createTextNode("Chose a filter before adding one !"));
		}
	});

	gS_check.addEventListener('click', function() {
		if (gS_checked === false)
		{
			gS_check.nextSibling.innerHTML = " Grey scale on";
			console.log("test" + video.style);
			video.setAttribute("class", "greyscale");
			gS_checked = true;
		}
		else
		{
			video.setAttribute("class", "");
			gS_check.nextSibling.innerHTML = " Grey scale off";
			gS_checked = false;
		}
	});

	/**
	 *  Functions
	 */

	function greyScale() {
		var imgPixels = canvas.getContext('2d').getImageData(0, 0, width, height);
		for(var y = 0; y < imgPixels.height; y++){
			for(var x = 0; x < imgPixels.width; x++){
				var i = (y * 4) * imgPixels.width + x * 4;
				var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
				imgPixels.data[i] = avg;
				imgPixels.data[i + 1] = avg;
				imgPixels.data[i + 2] = avg;
			}
		}
		canvas.getContext('2d').putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
	}

	function takePicture() {
		canvas.width = width;
		canvas.height = height;
		canvas.getContext('2d').drawImage(video, 0, 0, width, height);
		if (gS_check.checked === true)
			greyScale();
		var data = canvas.toDataURL('image/png');
		saveButton.style.display = 'inline';
		var alertMessage_ok = document.getElementsByClassName('alert alert-success'),
			alertMessage_fail = document.getElementsByClassName('alert alert-danger'),
			container = document.getElementById('cam_container');
		if (alertMessage_ok.length != 0)
			container.removeChild(container.childNodes[0]);
		if (alertMessage_fail.length != 0)
			container.removeChild(container.childNodes[0]);
	}

	function savePicture()
	{
	var head = /^data:image\/(png|jpeg);base64,/,
		data = '',
		xhr = new XMLHttpRequest();

		data = canvas.toDataURL('image/jpeg', 0.9).replace(head, '');
		xhr.open('POST', url() + 'Userindex/save', true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('contents=' + data);
	}

	function url(){
		var url =  window.location.href;
		url = url.split("/");
		return(url[0] + '//' + url[2] + '/' + url[3] + '/');
	}

})();