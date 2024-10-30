<?php
// editar.php (Página para editar uma notícia.)
require_once '../models/Noticia.php';

$noticia = new Noticia();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $link = $_POST['link'];
    $data_publicacao = $_POST['data_publicacao'];

    if ($noticia->editar($id, $titulo, $descricao, $link, $data_publicacao)) {
        header("Location: index.php");
    } else {
        echo "Erro ao editar notícia.";
    }
} else {
    $id = $_GET['id'];
    $noticiaData = $noticia->buscarPorId($id);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Notícia</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Editar Notícia</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $noticiaData['id'] ?>">
        <input type="text" name="titulo" value="<?= $noticiaData['titulo'] ?>" required>
        <textarea name="descricao" required><?= $noticiaData['descricao'] ?></textarea>
        <input type="url" name="link" value="<?= $noticiaData['link'] ?>" required>
        <input type="date" name="data_publicacao" value="<?= $noticiaData['data_publicacao'] ?>" required>
        <button type="submit">Salvar</button>
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>
