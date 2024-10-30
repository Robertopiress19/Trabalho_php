<?php
// detalhes.php (Página para mostrar detalhes de uma Noticía)
require_once '../models/Noticia.php';

$noticia = new Noticia();
$id = $_GET['id'];
$noticiaData = $noticia->buscarPorId($id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Detalhes da Notícia</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1><?= $noticiaData['titulo'] ?></h1>
    <p><?= $noticiaData['descricao'] ?></p>
    <a href="<?= $noticiaData['link'] ?>" target="_blank">Leia mais</a>
    <p>Data de Publicação: <?= $noticiaData['data_publicacao'] ?></p>
    <a href="index.php">Voltar</a>
</body>
</html>
