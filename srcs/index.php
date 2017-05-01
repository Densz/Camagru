<?php
	require_once "../includes/header.php";
	require_once "../includes/footer.php";
	if ($_POST['submit'] === "Inscription")
	{
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Camagru</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
</head>
<body>
	<div id="register-container">
		<form action="index.php" method="post">
			<p>Login</p>
			<input class="input-container" type="text" name="login" required="true"><br>
			<p>Mot de passe</p>
			<input class="input-container" type="password" name="passwd" required="true"><br>
			<input class="input-container" type="submit" name=submit value="Inscription">
		</form>
	</div>
</body>
</html>