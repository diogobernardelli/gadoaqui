<?php
@session_start();
require_once 'pacotes/controller/GadoController.php';
$gadocontrol = new GadoController();
	
//if ($_REQUEST['buscaNomeProduto'] != '' || $_REQUEST['buscaEstadoProduto'] != '' || $_REQUEST['buscaValorProduto'] != '') {
	require_once 'pacotes/controller/ProdutoController.php';
	$produtocontrol = new ProdutoController();
	
	$post['status'] = 'true';
	$post['aprovado'] = 'true';
	$post['nome'] = ($_REQUEST['buscaNomeProduto']!='')?$_REQUEST['buscaNomeProduto']:'';
	$post['estado'] = ($_REQUEST['buscaEstadoProduto']!='')?$_REQUEST['buscaEstadoProduto']:'';
	$post['valor'] = ($_REQUEST['buscaValorProduto']!='')?html_entity_decode($_REQUEST['buscaValorProduto']):'';
	$pag = ($_REQUEST['p']!='')?$_REQUEST['p']:'';
	
	if ($post['valor']) {
		if (strpos($post['valor'], '|')) {
			$post['valor_entre'] = str_replace("|", " AND ", $post['valor']);
			unset($post['valor']);
		}
	}
	
	$offset = '';
	if ($pag) {
		if ($pag > 1) {
			$offset = 24 * ($pag - 1);
		}
	}
		
	$busca = $produtocontrol->pesquisaProduto($post, 'id DESC', 24, $offset);
	$count_busca = $produtocontrol->countPesquisaProduto($post);
	
	unset($produtocontrol, $pag, $offset, $post);
//}

$gados_busca_produto = $gadocontrol->pesquisaGado(array('status'=>'true'), 'RANDOM()', 4);
unset($gadocontrol);
?>