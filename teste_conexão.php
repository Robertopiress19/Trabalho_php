<?php
// Configurações do banco de dados
$host = 'localhost';
$db = 'banco_noticia'; // Substitua pelo nome do seu banco
$user = 'root';
$password = ''; // Deixe vazio se não configurou senha

try {
    // Criação da conexão com o MySQL usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão com o banco de dados bem-sucedida!";
} catch (PDOException $e) {
    // Mensagem de erro caso a conexão falhe
    echo "Erro ao conectar: " . $e->getMessage();
}
