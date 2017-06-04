<?php

require 'database.php';
require '../Core/Model.class.php';

$database = new Model();
$database->init_connection("mysql:dbname=camagru;host=localhost", $DB_USER, $DB_PASSWORD);
$database->query("CREATE TABLE IF NOT EXISTS users
(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	login VARCHAR(32) NOT NULL,
	email VARCHAR(128) NOT NULL,
	password VARCHAR(256) NOT NULL,
	email_confirmed ENUM('yes', 'no') DEFAULT 'no' NOT NULL,
	admin ENUM('yes','no') DEFAULT 'no' NOT NULL
);");

$database->query("CREATE TABLE IF NOT EXISTS posts
(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    image_path VARCHAR(238) NOT NULL,
	login VARCHAR(32) NOT NULL,
    date DATETIME NOT NULL
);");

$database->query("CREATE TABLE IF NOT EXISTS likes
(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    img_path VARCHAR(238) NOT NULL,
	login VARCHAR(32) NOT NULL
);");

$database->query("CREATE TABLE IF NOT EXISTS comments
(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    img_path VARCHAR(238) NOT NULL,
	login VARCHAR(32) NOT NULL,
    img_comment LONGTEXT NOT NULL,
    date DATETIME NOT NULL    
);");

$database->query("INSERT INTO users VALUES
(null, 'admin', 'admin@admin.com', '6a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94', 'yes', 'yes')
;");
?>
<a href="http://localhost:<?= substr($_SERVER['HTTP_HOST'], -4); ?>/<?= explode('/', $_SERVER['REQUEST_URI'])[1] ?>/Authsignin/signIn">Home</a>
