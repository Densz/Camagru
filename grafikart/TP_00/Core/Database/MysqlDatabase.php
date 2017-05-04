<?php

namespace Core\Database;

use \PDO;

class MysqlDatabase extends Database
{
	private $_db_name;
	private $_db_user;
	private $_db_pass;
	private $_db_host;
	private $_pdo;

	public function __construct($db_name, $db_user = 'root', $db_pass = 'root', $db_host = 'localhost')
	{
		$this->_db_name = $db_name;
		$this->_db_user = $db_user;
		$this->_db_pass = $db_pass;
		$this->_db_host = $db_host;

	}

	private function getPDO()
	{
		if ($this->_pdo === NULL)
		{
			$pdo = new PDO('mysql:dbname=blog;host=localhost', 'root', 'root');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->_pdo = $pdo;	
		}
		return $this->_pdo;
	}

	public function query($statement, $class_name = NULL, $one = false)
	{
		$res = $this->getPDO()->query($statement);
		if ($class_name === NULL)
			$res->setFetchMode(PDO::FETCH_OBJ);
		else
			$res->setFetchMode(PDO::FETCH_CLASS, $class_name);
		if ($one)
			$data = $res->fetch();
		else
			$data = $res->fetchAll();
		return $data;
	}

	public function prepare($statement, $attributes, $class_name, $one = false)
	{
		$res = $this->getPDO()->prepare($statement);
		$res->execute($attributes);
		$res->setFetchMode(PDO::FETCH_CLASS, $class_name);
		if ($one == true)
			$data = $res->fetch();
		else
			$data = $res->fetchAll();
		return $data;
	}
}

?>