<?php
	require_once 'pacotes/controller/GadoController.php';
	require_once 'pacotes/controller/ProdutoController.php';
	$gadocontrol = new GadoController();
	$produtocontrol = new ProdutoController();
	
	$gados = $gadocontrol->pesquisaGado(array('id_anunciante' => $_SESSION['ga']['id']), 'id DESC');
	$produtos = $produtocontrol->pesquisaProduto(array('id_anunciante' => $_SESSION['ga']['id']), 'id DESC');
		
	unset($gadocontrol, $produtocontrol);
?>