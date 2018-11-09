<?php
@session_start();
if ($_SESSION['ga']['editanuncio']) {
	require_once 'pacotes/controller/ProdutoController.php';
	require_once 'pacotes/controller/AnuncianteController.php';
	$produtocontrol = new ProdutoController();
	$anunciantecontrol = new AnuncianteController();
	
	$produto = $produtocontrol->getProduto($_SESSION['ga']['editanuncio']);
	$anunciante = $anunciantecontrol->getAnunciante($produto->getId_anunciante());
	
	unset($produtocontrol, $anunciantecontrol);
	unset($_SESSION['ga']['editanuncio']);
}
?>