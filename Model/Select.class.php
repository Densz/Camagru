<?php

class Select extends Core\Mysqldb {

	public static function select_all(){
		$data = query("SELECT * FROM users");
		var_dump($data);
	}

}

?>