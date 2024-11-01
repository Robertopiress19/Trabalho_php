<?php
// models/Noticia.php


//Incluir o arquivo de configuração do banco de dados 
require_once __DIR__ . '/../config/Database.php';

class Noticia {
    private $conn; // Conexão com o banco de dados
    private $table_name = "noticias"; // Nome da Tabela no banco de dados

    // Construtor: inicializa a conexão com o banco de dados, que permite que todos os metodos da classe possam usar a mesma conexão.
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para inserir uma nova notícia no banco de dados
    public function inserir($titulo, $descricao, $link, $data_publicacao) {
        $query = "INSERT INTO " . $this->table_name . " (titulo, descricao, link, data_publicacao) VALUES (:titulo, :descricao, :link, :data_publicacao)";
        $stmt = $this->conn->prepare($query);

        // Associa os parâmetros a uma variável específica para segurança e prevenção de SQL Injection
        // O uso de BindParam evita de pessoas inserirem código SQL maliciosos.
        $stmt->bindParam(':titulo', $titulo); 
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':data_publicacao', $data_publicacao);

        // Executa a consulta e retorna o resultado
        return $stmt->execute();
    }

    // Método para listar todas as notícias
    public function listar() {
        //SQL para selecionar todas as notícias ordenadas por data de publicação (da mais recente para a mais antiga)
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY data_publicacao DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        // Retorna os resultados como um array associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar uma notícia pelo ID
    public function buscarPorId($id) {
        // SQL para selecionar uma única notícia com base no ID
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id); // Associar o parâmetro do ID
        $stmt->execute();

        // Retorna o resultado como array associativo
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para editar uma notícia existente no banco de dados
    public function editar($id, $titulo, $descricao, $link, $data_publicacao) {
        //SQL para atualizar uma notícia com base no ID
        $query = "UPDATE " . $this->table_name . " SET titulo = :titulo, descricao = :descricao, link = :link, data_publicacao = :data_publicacao WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Associa os parâmetros
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':data_publicacao', $data_publicacao);

        // Executa a consulta e retorna o resultado
        return $stmt->execute();
    }

    // Método para deletar uma notícia com base no ID
    public function deletar($id) {
        // SQL para deletar uma notícia específica pelo ID
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id); // Associa o parâmetro do ID

        // Executa a consulta e retorna o resultado
        return $stmt->execute();
    }

    // Método para pesquisar notícias por título
    public function pesquisar($titulo) {
        // SQL para buscar notícias cujo título contenha o termo de pesquisa.
        // o uso do LIKE permite buscar parcialmente pelo título, melhorando assim a experiência do usuário.
        $query = "SELECT * FROM " . $this->table_name . " WHERE titulo LIKE :titulo ORDER BY data_publicacao DESC";
        $stmt = $this->conn->prepare($query);

        // Formata o termo de pesquisa para incluir coringas (%) antes e depois
        $titulo = "%{$titulo}%";
        $stmt->bindParam(':titulo', $titulo);

        // Executa a consulta e retorna os resultados como um array associativo
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
