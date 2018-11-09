<?php
require_once 'pacotes/controller/CategoriaController.php';
$categoriacontrol = new CategoriaController();

$categorias = $categoriacontrol->listCategorias();

unset($categoriacontrol);
?>