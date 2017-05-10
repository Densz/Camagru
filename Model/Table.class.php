<?php
class Table extends Core\Mysqldb {

	public static function select_all($table){
		$database = new Core\MysqlDb("mysql:dbname=camagru;host=localhost", $DB_USER, $DB_PASSWORD);
		$data = $database->query("SELECT * FROM $table");
		return $data;
	}

}

?>