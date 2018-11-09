<?php
chdir('../../');
require_once 'pacotes/controller/AnuncianteController.php';
require_once 'pacotes/controller/ProdutoController.php';
require_once 'pacotes/controller/GadoController.php';
$anunciantecontrol = new AnuncianteController();
$produtocontrol = new ProdutoController();
$gadocontrol = new GadoController();

$anunciante = $anunciantecontrol->getAnunciante($_GET['id']);
$produtos = $produtocontrol->pesquisaProduto(array('id_anunciante' => $_GET['id'], 'aprovado' => 'true', 'status' => 'true'), 'id DESC');
$gados = $gadocontrol->pesquisaGado(array('id_anunciante' => $_GET['id'], 'status' => 'true'), 'id DESC');

$ret['id'] = $_GET['id'];
$ret['nome'] = $anunciante->getNome();
$ret['sobrenome'] = $anunciante->getSobrenome();
$ret['telefone'] = $anunciante->getTelefone();
$ret['email'] = $anunciante->getEmail();
$ret['status'] = $anunciante->getStatus();   
$ret['anuncios'] = array();
$ret['gados'] = array();

foreach ($produtos as $prod) {
	$produto['id'] = $prod->getId();
	$produto['nome'] = $prod->getNome();
	$produto['valor'] = number_format($prod->getValor(), 2, ",", ".");
	$produto['video'] = $prod->getVideo();
	$produto['imagens'] = $prod->getImagens();
	
	$ret['anuncios'][] = $produto;
}

foreach ($gados as $g) {
	$gado['id'] = $g->getId();
	$gado['nome'] = $g->getNome();
	$gado['valor'] = number_format($g->getValor_kg(), 2, ",", ".");
	$gado['video'] = $g->getVideo();
	$gado['imagens'] = $g->getImagens();
	
	$ret['gados'][] = $gado;
}

echo json_encode($ret);

unset($anunciantecontrol, $produtocontrol, $gadocontrol, $_GET);
?>