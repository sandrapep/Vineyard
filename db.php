<?php
class Database {
    private $host = 'localhost'; // ili IP adresa baze
    private $db_name = 'u404219440_bazavinograd';
    private $username = 'u404219440_bazavinograd';
    private $password = 'Vinograd1234';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
