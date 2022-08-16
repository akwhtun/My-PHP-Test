<?php

namespace Libs\Database;

use PDO;
use PDOException;

class MySQL
{
    private $db;

    public function __construct(
        private $dbhost = "localhost",
        private $dbname = "user_authentication",
        private $dbuser = "root",
        private $dbpassword = ""
    ) {

        $this->db = null;
    }

    public function connect()
    {
        try {
            $this->db = new PDO(
                "mysql:host=$this->dbhost;dbname=$this->dbname",
                $this->dbuser,
                $this->dbpassword,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]
            );
            return $this->db;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}