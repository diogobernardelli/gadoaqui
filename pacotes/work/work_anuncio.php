<?php
if ($_GET['id']) {
	require_once 'pacotes/controller/GadoController.php';
	require_once 'pacotes/controller/AnuncianteController.php';
	require_once 'pacotes/controller/CategoriaController.php';
	$gadocontrol = new GadoController();
	$anunciantecontrol = new AnuncianteController();
	$categoriacontrol = new CategoriaController();
	
	$gado = $gadocontrol->getGado($_GET['id']);
	$anunciante = $anunciantecontrol->getAnunciante($gado->getId_anunciante());
	$gado_menor = $gadocontrol->getGadoMenorValor($_GET['id'], $gado->getIdade(), $gado->getPeso_medio(), $gado->getValor_kg(), $gado->getSexo(), $gado->getRaca());
	$gado_maior = $gadocontrol->getGadoMaiorValor($_GET['id'], $gado->getIdade(), $gado->getPeso_medio(), $gado->getValor_kg(), $gado->getSexo(), $gado->getRaca());
	
	if (!$gado->getStatus())
		die("<script>location.href='index.php';</script>");
	
	if (!$_GET['v'])	
		$gadocontrol->updateGado($_GET['id'], array('visualizacoes' => $gado->getVisualizacoes() + 1), array('visualizacoes' => $gado->getVisualizacoes()));	
		
	unset($gadocontrol, $anunciantecontrol);
} else {
	die("<script>location.href='index.php';</script>");
}
?>