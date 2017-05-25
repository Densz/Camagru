<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">
	<title>Camagru</title>

	<!-- Bootstrap core CSS -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="../public/css/style.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="http://localhost:<?= PORT ?>/<?= Routeur::$url['dir'] ?>/authsignin/View/"">CAMAGRU	&nbsp;&nbsp;&nbsp; |</a>
			<?php if (isset($profile))echo $profile; ?>
			<?php if (isset($camjs))echo $camjs; ?>
			<?php if (isset($camphp))echo $camphp; ?>
			<?php if (isset($gallery))echo $gallery; ?>
			<?php if (isset($disconnect))echo $disconnect; ?>
		</div>
	</div>
</nav>
<div class="container">
	<div class="starter-template" style="padding-top: 100px;">