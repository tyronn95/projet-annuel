<?php
class Database {
    private $host = 'localhost';
    private $socket = '/Applications/MAMP/tmp/mysql/mysql.sock'; 
    private $db_name = 'bien_api';
    private $username = 'root';
    private $password = 'root';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $dsn = "mysql:unix_socket={$this->socket};dbname=" . $this->db_name;
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
            die();
        }
        return $this->conn;
    }  
}
?>