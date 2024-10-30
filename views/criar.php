<?php
// criar.php
require_once '../models/Noticia.php'; // Ajuste o caminho aqui

$noticia = new Noticia();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $link = $_POST['link'];
    $data_publicacao = $_POST['data_publicacao']; // Certifique-se de que essa data está no formato correto (YYYY-MM-DD)

    // Verifica se a data de publicação é válida
    if ($data_publicacao) {
        if ($noticia->inserir($titulo, $descricao, $link, $data_publicacao)) {
            header("Location: index.php"); // Ajuste o caminho aqui
            exit(); // Adicione exit após header para evitar que o restante do código seja executado
        } else {
            echo "Erro ao inserir notícia.";
        }
    } else {
        echo "Data de publicação inválida.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Nova Notícia</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Ajuste o caminho aqui -->
</head>
<body>
    <h1>Criar Nova Notícia</h1>
    <form method="POST">
        <input type="text" name="titulo" placeholder="Título" required>
        <textarea name="descricao" placeholder="Descrição" required></textarea>
        <input type="url" name="link" placeholder="Link" required>
        <input type="date" name="data_publicacao" required>
        <button type="submit">Adicionar</button>
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>
