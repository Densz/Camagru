
var likeButton = document.querySelectorAll(".like"),
	likeMsg = document.querySelectorAll(".countLikes"),
	comButton = document.querySelectorAll(".test"),
	currImg = document.querySelectorAll(".image"),
	i = 0,
	length = likeButton.length;

for (i; i < length; i++) {
	if (document.addEventListener) {
		var xhr = new XMLHttpRequest();

		likeMsg[i].addEventListener("click", getUser);
		likeMsg[i].params = [xhr, likeButton[i]];
		comButton[i].addEventListener("click", comment);
		comButton[i].params = [xhr, currImg[i], comButton[i]];
		likeButton[i].addEventListener("click", function() {
			if (this.src.indexOf("empty") !== -1) {
				like(this, xhr);
			} else {
				unlike(this, xhr);
			}
		});
	}
	else {
		likeButton[i].attachEvent("onclick", function(){});
		likeMsg[i].attachEvent("onclick", function(){});
		comButton[i].attachEvent("onclick", function(){});
	}
};

function url(){
	var url =  window.location.href;
	url = url.split("/");
	return(url[0] + '//' + url[2] + '/' + url[3] + '/');
}

function like(likeClicked, xhr)
{
	xhr.open('POST', url() + 'Usergallery/like', true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	likeClicked.src = "../public/resources/colored_heart.png";
	var countLikes = parseInt(likeClicked.nextSibling.nextSibling.innerHTML) + 1;
	likeClicked.nextSibling.nextSibling.innerHTML = countLikes + ' like' + (countLikes > 1 ? 's' : '');
	xhr.send('image_path=' + likeClicked.id);
}

function unlike(likeClicked, xhr)
{
	xhr.open('POST', url() + 'Usergallery/unlike', true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	likeClicked.src = "../public/resources/empty_heart.png";
	var countLikes = parseInt(likeClicked.nextSibling.nextSibling.innerHTML) - 1;
	likeClicked.nextSibling.nextSibling.innerHTML = countLikes + ' like' + (countLikes > 1 ? 's' : '');
	xhr.send('image_path=' + likeClicked.id);
}

function getUser(evt)
{
	var xhr = evt.target.params[0],
		likeClicked = evt.target.params[1].id;
	xhr.open('POST', url() + 'Usergallery/showLikers', true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('image_path=' + likeClicked);
	xhr.onload = function ()
	{
		if (xhr.readyState === xhr.DONE)
		{
			if (xhr.status === 200 || xhr.status === 0)
			{
				var string = xhr.responseText.substring(0, xhr.responseText.indexOf("<"));
				alert(string);
			}
		}
	}
}

function comment(evt)
{
	var xhr = evt.target.params[0],
		currImg = evt.target.params[1],
		button = evt.target.params[2],
		tmp_path = currImg.src.split("/"),
		imgPath = "public/copies/" + tmp_path[tmp_path.length - 1],
		commentHTML = document.createElement('p'),
		com_contain = button.nextSibling.nextSibling.nextSibling,
		commenText = button.previousSibling.lastChild.value;

	if (commenText !== "")
	{
		xhr.open('POST', url() + 'Usergallery/comment', true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("comment=" + commenText + "&img_path=" + imgPath);

		xhr.onload = function ()
		{
			if (xhr.readyState === xhr.DONE)
			{
				if (xhr.status === 200 || xhr.status == 0)
				{
					var string = xhr.responseText.substring(0, xhr.responseText.indexOf("}") + 1);
					var json = JSON.parse(string);
					var tmp = json['user'] + ': ';
					var user = tmp.bold();

					com_contain.insertBefore(commentHTML, com_contain.firstChild);
					commentHTML.innerHTML = user + commenText;
					button.previousSibling.lastChild.value = "";
				}
			}
		};
	}
}

window.onscroll = function() {
	var posY = document.body.scrollTop,
		winSize = window.innerHeight,
		pageSize = document.documentElement.scrollHeight,
		imgs = document.querySelectorAll('.image'),
		lastImg = imgs[imgs.length - 1];

	console.log('Position relative en Y: ' + posY);
	console.log('Taille de la fenetre: ' + winSize);
	console.log('Taille totale de la fenetre: ' + pageSize);
	if (posY + winSize > pageSize - 100)
	{
		var xhr = new XMLHttpRequest(),
			imgPath = lastImg.src.split("/");

		xhr.open('POST', url() + 'Usergallery/infiniteScroll', true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('img_path=' + "public/copies/" + imgPath[imgPath.length - 1]);
	}
};

