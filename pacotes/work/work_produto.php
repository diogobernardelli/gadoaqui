<?php
if ($_GET['id']) {
	require_once 'pacotes/controller/ProdutoController.php';
	require_once 'pacotes/controller/AnuncianteController.php';
	$produtocontrol = new ProdutoController();
	$anunciantecontrol = new AnuncianteController();
	
	$produto = $produtocontrol->getProduto($_GET['id']);
	$anunciante = $anunciantecontrol->getAnunciante($produto->getId_anunciante());
	
	if (!$produto->getAprovado() && !$produto->getReprovado() && !$_SESSION['ga']['admin'])
		die("<script>location.href='index.php';</script>");
	
	if (!$produto->getStatus())
		die("<script>location.href='index.php';</script>");
	
	if (!$_GET['v'])
		$produtocontrol->updateProduto($_GET['id'], array('visualizacoes' => $produto->getVisualizacoes() + 1), array('visualizacoes' => $produto->getVisualizacoes()));
	
	unset($produtocontrol, $anunciantecontrol);
} else {
	die("<script>location.href='index.php';</script>");
}
?>