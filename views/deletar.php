<?php
require_once '../models/Noticia.php';

if(isset($_GET['id'])) {
    $noticia = new Noticia();
    $id = $_GET['id'];

    if ($noticia->deletar($id)) {
        header("Location: index.php?mensagem=Noticia deletada com sucesso!");
        exit;
    } else{
        echo "Erro ao deletar a notícia.";
    }
} else {
    echo "ID da notícia não fornecido";
}
?>