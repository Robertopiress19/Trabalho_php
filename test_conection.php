<?php
// test_connection.php

// Inclua o arquivo de configuração do banco de dados
require_once 'config/Database.php';

// Crie uma nova instância da classe Database
$database = new Database();

// Tente obter a conexão
$conn = $database->getConnection();

// Verifique se a conexão foi bem-sucedida
if ($conn) {
    echo "Conexão com o banco de dados bem-sucedida!";
} else {
    echo "Falha ao conectar ao banco de dados.";
}
?>
