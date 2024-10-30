<?php
// coletar_noticia.php

require_once __DIR__ . '/../models/Noticia.php';

$noticia = new Noticia();

// URL do feed RSS do New York Times
$url = "https://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml";

// Coletar notícias do feed
$xml = simplexml_load_file($url);

if ($xml === false) {
    echo "Erro ao coletar notícias.";
} else {
    foreach ($xml->channel->item as $item) {
        $titulo = (string) $item->title;
        $descricao = (string) $item->description;
        $link = (string) $item->link;
        $data_publicacao = date("Y-m-d H:i:s"); // Data da Publicação

        // Inserir notícia
        if ($noticia->inserir($titulo, $descricao, $link, $data_publicacao)) {
            echo "Notícia inserida com sucesso: $titulo<br>";
        } else {
            echo "Erro ao inserir a notícia: $titulo<br>";
        }
    }
}
?>
