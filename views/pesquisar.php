<?php
// pesquisar.php (Pagína para Pesquisar Notícias)
require_once '../models/Noticia.php';

$noticia = new Noticia();
$noticias = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $noticias = $noticia->pesquisar($titulo);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pesquisar Notícias</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Pesquisar Notícias</h1>
    <form method="POST">
        <input type="text" name="titulo" placeholder="Título da Notícia" required>
        <button type="submit">Pesquisar</button>
    </form>

    <?php if (!empty($noticias)): ?>
        <h2>Resultados da Pesquisa:</h2>
        <ul>
            <?php foreach ($noticias as $noticia): ?>
                <li>
                    <a href="detalhes.php?id=<?= $noticia['id'] ?>"><?= $noticia['titulo'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    
    <a href="index.php">Voltar</a>
</body>
</html>
