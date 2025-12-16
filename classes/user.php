<?php
class User{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getData(){
        $result = array();
        $sql = $this->pdo->query("SELECT * FROM users");
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>