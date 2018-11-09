<?php
@session_start();
require_once 'pacotes/controller/ProdutoController.php';
$produtocontrol = new ProdutoController();

//if ($_REQUEST['buscaCategoriaGado'] != '' || $_REQUEST['buscaEstadoGado'] != '' || $_REQUEST['buscaQuantidadeGado'] != '' || $_REQUEST['buscaFaixaPrecoGado'] != '') {
	require_once 'pacotes/controller/GadoController.php';
	$gadocontrol = new GadoController();
	
	$post['status'] = 'true';
	$post['categoria'] = ($_REQUEST['buscaCategoriaGado']!='')?$_REQUEST['buscaCategoriaGado']:'';
	$post['estado'] = ($_REQUEST['buscaEstadoGado']!='')?$_REQUEST['buscaEstadoGado']:'';
	$post['quantidade'] = ($_REQUEST['buscaQuantidadeGado']!='')?html_entity_decode($_REQUEST['buscaQuantidadeGado']):'';
	$post['valor'] = ($_REQUEST['buscaFaixaPrecoGado']!='')?html_entity_decode($_REQUEST['buscaFaixaPrecoGado']):'';
	$post['id_anunciante'] = ($_REQUEST['buscaAnuncianteGado']!='')?$_REQUEST['buscaAnuncianteGado']:'';
	
	$post['cidade'] = ($_REQUEST['buscaCidadeGado']!='')?$_REQUEST['buscaCidadeGado']:'';
	$post['raca'] = ($_REQUEST['buscaRacaGado']!='')?$_REQUEST['buscaRacaGado']:'';
	$post['idade'] = ($_REQUEST['buscaIdadeGado']!='')?$_REQUEST['buscaIdadeGado']:'';
	$post['sexo'] = ($_REQUEST['buscaSexoGado']!='')?$_REQUEST['buscaSexoGado']:'';
	$post['finalidade'] = ($_REQUEST['buscaFinalidadeGado']!='')?$_REQUEST['buscaFinalidadeGado']:'';
	
	$pag = ($_REQUEST['p']!='')?$_REQUEST['p']:'';
	
	if ($post['quantidade']) {
		if (strpos($post['quantidade'], '|')) {
			$post['quantidade_entre'] = str_replace("|", " AND ", $post['quantidade']);
			unset($post['quantidade']);
		}
	}
	if ($post['valor']) {
		if (strpos($post['valor'], '|')) {
			$post['valor_entre'] = str_replace("|", " AND ", $post['valor']);
			unset($post['valor']);
		}
	}
	if ($post['idade']) {
		if (strpos($post['idade'], '|')) {
			$post['idade_entre'] = str_replace("|", " AND ", $post['idade']);
			unset($post['idade']);
		}
	}
	
	$offset = '';
	if ($pag) {
		if ($pag > 1) {
			$offset = 24 * ($pag - 1);
		}
	}
	
	if ($_SESSION['ga']['filtro_det']) {
		$post['id_in'] = $_SESSION['ga']['filtro_det'];
		unset($_SESSION['ga']['filtro_det']); 
	}
	
	if ($post['id_in'] == 'n')	 {
		$busca = array();
		$count_busca = 0;
	} else {
		$busca = $gadocontrol->pesquisaGado($post, 'id DESC', 24, $offset);
		$count_busca = $gadocontrol->countPesquisaGado($post);
	}
	unset($gadocontrol, $pag, $offset, $post);
//}

$produtos_busca_gado = $produtocontrol->pesquisaProduto(array('status'=>'true', 'aprovado'=>'true'), 'RANDOM()', 4);
unset($produtocontrol);
?>