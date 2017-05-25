(function() {

  var streaming = false,
	  video       	= document.querySelector('#video'),
	  cover       	= document.querySelector('#cover'),
	  canvas      	= document.querySelector('#canvas'),
	  photo       	= document.querySelector('#photo'),
	  startbutton 	= document.querySelector('#startbutton'),
	  saveButton	= document.querySelector('#save'),
	  addFilter 	= document.getElementById('addfilter');
	  width = 500,
	  height = 0;

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
		base_image = new Image();
		var filter = document.querySelector('input[name="filter"]:checked').value;

		base_image.src = '../public/resources/filter/' + filter;
		base_image.onload = function(){
			canvas.getContext('2d').drawImage(base_image, 0, 0, 100, 100);
		}
	});

	/**
	 *  Functions
	 */

	function takePicture() {
	canvas.width = width;
	canvas.height = height;
	canvas.getContext('2d').drawImage(video, 0, 0, width, height);
	var data = canvas.toDataURL('image/png');
	saveButton.style.display = 'inline';
	var alertMessage = document.getElementsByClassName('alert alert-success'),
		container = document.getElementById('cam_container');
	if (alertMessage.length != 0)
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