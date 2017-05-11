<?php
class Update
{

    static function accountConfirmed($login){
		$database = new Core\MysqlDb("mysql:dbname=camagru;host=localhost", $DB_USER, $DB_PASSWORD);
        $database->query("UPDATE users SET email_confirmed = 'yes' WHERE login = '$login'");
	}
}