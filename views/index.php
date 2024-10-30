<?php
// views/index.php
require_once '../models/Noticia.php'; // Atualizado para o caminho correto

$noticia = new Noticia();
$resultados = [];

// Verifica se o parâmetro de deletar foi passado
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    if ($noticia->deletar($id)) {
        // Mensagem de sucesso
        echo "<script>alert('Notícia deletada com sucesso!');</script>";
    } else {
        // Mensagem de erro
        echo "<script>alert('Erro ao deletar a notícia.');</script>";
    }
    // Redireciona após a ação de deletar
    header("Location: index.php");
    exit();
}

// Verifica se o parâmetro de pesquisa foi passado
if (isset($_GET['pesquisar'])) {
    $termo = $_GET['pesquisar'];
    $resultados = $noticia->pesquisar($termo);
} else {
    $resultados = $noticia->listar();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css"> <!-- Atualizado para o caminho correto -->
    <title>Lista de Notícias</title>
</head>
<body>
    <h1>Lista de Notícias</h1>

    <form action="" method="GET">
        <input type="text" name="pesquisar" placeholder="Pesquisar notícia" required>
        <button type="submit">Pesquisar</button>
    </form>

    <!-- Adicionando o botão para criar nova notícia -->
    <a href="criar.php" style="display: inline-block; margin-top: 20px; padding: 10px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Criar Nova Notícia</a>

    <ul>
        <?php foreach ($resultados as $noticia): ?>
            <li>
                <h2><?php echo htmlspecialchars($noticia['titulo']); ?></h2>
                <p><?php echo htmlspecialchars($noticia['descricao']); ?></p>
                <a href="detalhes.php?id=<?php echo $noticia['id']; ?>">Detalhes</a>
                <a href="editar.php?id=<?php echo $noticia['id']; ?>">Editar</a>
                <a href="?deletar=<?php echo $noticia['id']; ?>" onclick="return confirm('Tem certeza que deseja deletar?');">Deletar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
