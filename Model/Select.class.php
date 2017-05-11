<?php
class Select{

	public static function all($table){
		$database = new Core\MysqlDb("mysql:dbname=camagru;host=localhost", $DB_USER, $DB_PASSWORD);
		$data = $database->query("SELECT * FROM $table");
		return $data;
	}

	public static function login($login)
	{
		$database = new Core\MysqlDb("mysql:dbname=camagru;host=localhost", $DB_USER, $DB_PASSWORD);
		return $database->prepare("SELECT login, password FROM users WHERE login = ?", [$login]);
	}

}

?>