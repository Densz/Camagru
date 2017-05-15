(function() {

  var streaming = false,
	  video       	= document.querySelector('#video'),
	  cover       	= document.querySelector('#cover'),
	  canvas      	= document.querySelector('#canvas'),
	  photo       	= document.querySelector('#photo'),
	  startbutton 	= document.querySelector('#startbutton'),
	  save			= document.querySelector('#save'),
	  width = 500,
	  height = 0;

  navigator.getMedia = ( navigator.getUserMedia ||
						 navigator.webkitGetUserMedia ||
						 navigator.mozGetUserMedia ||
						 navigator.msGetUserMedia);

  navigator.getMedia(
	{
	  video: true,
	  audio: false
	},
	function(stream) {
	  if (navigator.mozGetUserMedia) {
		video.mozSrcObject = stream;
	  } else {
		var vendorURL = window.URL || window.webkitURL;
		video.src = vendorURL.createObjectURL(stream);
	  }
	  video.play();
	},
	function(err) {
	  console.log("An error occured! " + err);
	}
  );

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

  function takepicture() {
	canvas.width = width;
	canvas.height = height;
	canvas.getContext('2d').drawImage(video, 0, 0, width, height);
	var data = canvas.toDataURL('image/png');
	photo.setAttribute('src', data);
  }

  function request(callback)
  {
		var xhr = new XMLHttpRequest(),
			sVar = encodeURIComponent(canvas.toDataURL('image/png'));

		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
				callback(xhr.responseText);
		}
		xhr.open("POST", "../test/handlingData.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("img=" + sVar);
  }

	function readData(sData)
	{
		if (sData == "OK")
			alert("Tout s'est bien passé !");
		else
			alert("Shit appended !");
	}


  save.addEventListener('click', function(){
		request(readData);
	});

  	startbutton.addEventListener('click', function(ev){
		takepicture();
		ev.preventDefault();
  	}, false);

  save.addEventListener('click', function(){
		
  }, false);

})();