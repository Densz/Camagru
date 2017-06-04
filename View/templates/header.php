<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" href="../../public/resources/favicon_camagru.png">
	<title>Camagru</title>
	<link href="http://localhost:<?= PORT ?>/<?= Routeur::$url['dir'] ?>/public/css/style.css" rel="stylesheet">
	<link href="http://localhost:<?= PORT ?>/<?= Routeur::$url['dir'] ?>/public/css/header.css" rel="stylesheet">
</head>

<body>
<div class="header">
	<div class="container-header">
		<a class="navbar-brand" href="http://localhost:<?= PORT ?>/<?= Routeur::$url['dir'] ?>/authsignin/View/"">CAMAGRU	&nbsp;&nbsp;&nbsp; |</a>
		<?php if (isset($profile))echo $profile; ?>
		<?php if (isset($camjs))echo $camjs; ?>
		<?php if (isset($camphp))echo $camphp; ?>
		<?php if (isset($gallery))echo $gallery; ?>
		<?php if (isset($disconnect))echo $disconnect; ?>
	</div>
</div>
<div class="container">
	<div class="starter-template" style="padding-top: 100px;">