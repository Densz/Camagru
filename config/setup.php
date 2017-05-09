<?php

require 'database.php';
require 'MysqlDb.php';

$database = new Config\MysqlDb("mysql:dbname=camagru;host=localhost", $DB_USER, $DB_PASSWORD);
$database->query("CREATE TABLE IF NOT EXISTS users
(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	login VARCHAR(32) NOT NULL,
	email VARCHAR(128) NOT NULL,
	password VARCHAR(128) NOT NULL,
	admin ENUM('yes','no') DEFAULT 'no' NOT NULL
);");

$database->query("CREATE TABLE IF NOT EXISTS posts
(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    image_url VARCHAR(238) NOT NULL,
	login VARCHAR(32) NOT NULL,
    date DATETIME NOT NULL
);");

$database->query("CREATE TABLE IF NOT EXISTS likes
(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    image_url VARCHAR(238) NOT NULL,
	login VARCHAR(32) NOT NULL,
    img_like INT NOT NULL,
    date DATETIME NOT NULL    
);");

$database->query("CREATE TABLE IF NOT EXISTS comments
(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    image_url VARCHAR(238) NOT NULL,
	login VARCHAR(32) NOT NULL,
    img_comment LONGTEXT NOT NULL,
    date DATETIME NOT NULL    
);");

$database->query("INSERT INTO users VALUES
(null, 'admin', 'admin@admin.com', 'admin', 'yes')
;");