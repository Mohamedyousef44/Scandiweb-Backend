<?php

namespace Core;

use PDO;

class Database {
    public $pdo;

    public function __construct($host, $dbname, $user, $pass) {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $this->pdo = new PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function connect() {
        return $this->pdo;
    }

    public function close() {
        $this->pdo = null;
    }
}