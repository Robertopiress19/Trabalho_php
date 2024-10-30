<?php
// listar_noticia.php

require_once __DIR__ . '/../models/Noticia.php';

$noticia = new Noticia();
$noticias = $noticia->listar();

if (count($noticias) > 0) {
    foreach ($noticias as $item) {
        echo "<h2>" . htmlspecialchars($item['titulo']) . "</h2>";
        echo "<p>" . htmlspecialchars($item['descricao']) . "</p>";
        echo "<a href='" . htmlspecialchars($item['link']) . "'>Leia mais</a>";
        echo "<p>Publicada em: " . htmlspecialchars($item['data_publicacao']) . "</p>";
        echo "<hr>";
    }
} else {
    echo "Nenhuma notícia encontrada.";
}
?>
