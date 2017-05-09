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
        return $query;
    }
}