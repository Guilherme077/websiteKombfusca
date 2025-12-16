<?php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            $dbName = 'kombfusca_db';
            $host = 'localhost';
            $user = 'root';
            $pass = 'root';

            $this->pdo = new PDO("mysql:dbname=$dbName;host=$host", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar com o banco de dados: " . $e->getMessage());
        }
    }

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }
    private function __clone() {}
    public function __wakeup() {}
}

$pdo_connection = Database::getInstance()->getConnection();

?>