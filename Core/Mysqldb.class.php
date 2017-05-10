<?php
namespace Core;
use \PDO;

class Mysqldb{
	private $db_dsn;
	private $db_user;
	private $db_pass;
	private $pdo;

	public function __construct($db_dsn, $db_user = 'root', $db_pass = 'root'){
		$this->db_dsn = 'mysql:db_name=';
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->getPDO()->query('CREATE DATABASE IF NOT EXISTS camagru');
		$this->db_dsn = $db_dsn;
		$this->pdo = null;
	}

	private function getPDO(){
		if ($this->pdo === null){
			$pdo = new PDO($this->db_dsn, $this->db_user, $this->db_pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo = $pdo;           
		}
		return $this->pdo;
	}

	public function query($statement){
		$query = $this->getPDO()->query($statement);
		if (strpos($statement, 'UPDATE') === 0 ||
			strpos($statement, 'CREATE') === 0 ||
			strpos($statement, 'INSERT') === 0 ||
			strpos($statement, 'DELETE') === 0) {
			return null;
		}
		$datas = $query->fetch();
		return $datas;
	}

	// public function prepare($statement, $attributes, $class_name = null, $one = false){
	//     $req = $this->getPDO()->prepare($statement);
	//     $res = $req->execute($attributes);
	//     if(
	//         strpos($statement, 'UPDATE') === 0 ||
	//         strpos($statement, 'INSERT') === 0 ||
	//         strpos($statement, 'DELETE') === 0
	//     ) {
	//         return $res;
	//     }
	//     if($class_name === null){
	//         $req->setFetchMode(PDO::FETCH_OBJ);
	//     } else {
	//         $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
	//     }
	//     if($one) {
	//         $datas = $req->fetch();
	//     } else {
	//         $datas = $req->fetchAll();
	//     }
	//     return $datas;
	// }
}