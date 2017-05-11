<?php
class Update
{

	public function __cosntruct()
	{
		echo test;
	}

    static function accountConfirmed($login){
		$database = new Core\MysqlDb("mysql:dbname=camagru;host=localhost", $DB_USER, $DB_PASSWORD);
        $database->query("UPDATE users SET email_confirmed = 'yes' WHERE login = '$login'");
	}
}