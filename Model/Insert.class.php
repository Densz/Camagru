<?php

class Insert{

	static function NewUser($username, $email, $password){
		$database = new Core\MysqlDb("mysql:dbname=camagru;host=localhost", $DB_USER, $DB_PASSWORD);
		$data = $database->prepare("INSERT INTO users VALUES (null, :username, :email, :password, 'no', 'no');", 
			array(
				'username'	=>	$username, 
				'email'		=>	$email,
				'password'	=>	$password
				));
	}

}