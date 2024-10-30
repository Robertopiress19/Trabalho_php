<?php
// config/Database.php

class Database {
    private $host = 'localhost';
    private $db_name = 'banco_noticia';  // Nome do banco
    private $username = 'root';       // Usuário do banco
    private $password = '';         // Senha do banco
    private $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }

        return $this->conn;
    }
}
