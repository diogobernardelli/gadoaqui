<?php
require_once 'pacotes/controller/ProdutoController.php';
require_once 'pacotes/controller/AnuncianteController.php';
$produtocontrol = new ProdutoController();
$anunciantecontrol = new AnuncianteController();

$produtos = $produtocontrol->pesquisaProduto(array('status'=>'true','aprovado'=>'false','reprovado'=>'false'), 'id ASC');

unset($produtocontrol);
?>