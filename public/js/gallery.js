var likeButton = document.querySelectorAll(".like"),
	likeMsg = document.querySelectorAll(".countLikes");
var i = 0, length = likeButton.length;
for (i; i < length; i++) {
	if (document.addEventListener) {
		likeButton[i].addEventListener("click", function() {
			var xhr = new XMLHttpRequest();
			if (this.src.indexOf("empty") !== -1) {
				xhr.open('POST', 'http://localhost:8080/camagru/Usergallery/like', true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				this.src = "../public/resources/colored_heart.png";
				var countLikes = parseInt(this.nextSibling.nextSibling.innerHTML) + 1;
				this.nextSibling.nextSibling.innerHTML = countLikes + ' like' + (countLikes > 1 ? 's' : '');
				xhr.send('image_path=' + this.id);
			} else {
				xhr.open('POST', 'http://localhost:8080/camagru/Usergallery/unlike', true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				this.src = "../public/resources/empty_heart.png";
				var countLikes = parseInt(this.nextSibling.nextSibling.innerHTML) - 1;
				this.nextSibling.nextSibling.innerHTML = countLikes + ' like' + (countLikes > 1 ? 's' : '');
				xhr.send('image_path=' + this.id);
			}
		});
	} else {
		likeButton[i].attachEvent("onclick", function() {
			console.log(this);
		});
	};
};

//<span onclick="alert('Voici le contenu de l\'élément que vous avez cliqué :\n\n' + this.innerHTML);">Cliquez-moi !</span>