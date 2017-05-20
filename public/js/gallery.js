var likeButton = document.querySelectorAll(".like"),
	likeMsg = document.querySelectorAll(".countLikes"),
	i = 0,
	length = likeButton.length;



for (i; i < length; i++) {
	if (document.addEventListener) {
		var xhr = new XMLHttpRequest();

		likeMsg[i].addEventListener("click", getUser, false);
		likeMsg[i].params = [xhr, likeButton[i]];
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
