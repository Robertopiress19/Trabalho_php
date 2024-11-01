<?php
// config/Database.php

// Define a classe Database para gerenciar a conexão com o banco de dados
class Database {
    // Propriedades privadas para armazenar os detalhes da conexão
    private $host = 'localhost'; // Endereço do servidor de banco de dados
    private $db_name = 'banco_noticia';  // Nome do banco de dados
    private $username = 'root';       // Nome de usuário do banco de dados
    private $password = '';         // Senha do banco de dados
    private $conn; // Armazena a conexão com o banco, protegida e acessível apenas dentro da classe

    // Método público para obter a conexão com o banco de dados
    public function getConnection() {
        // Inicializa a conexão como null
        $this->conn = null;
        
        // Tenta estabelecer a conexão com o banco de dados
        try {
            // Cria uma nova instância de PDO para a conexão
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Define o modo de erro do PDO para lançar exceções
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // Captura qualquer exceção e exibe a mensagem de erro
            echo "Erro na conexão: " . $e->getMessage();
        }

        // Retorna a conexão estabelecida (ou null se falhou)
        return $this->conn;
    }
}
