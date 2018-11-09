<?php
@session_start();
require_once 'pacotes/controller/CategoriaController.php';
require_once 'pacotes/controller/GadoController.php';
require_once 'pacotes/controller/ProdutoController.php';
require_once 'pacotes/controller/AjaxController.php';
require_once 'pacotes/controller/AnuncianteController.php';
require_once 'pacotes/controller/PublicidadeController.php';
require_once 'pacotes/controller/CotacaoController.php';
$categoriacontrol = new CategoriaController();
$gadocontrol = new GadoController();
$produtocontrol = new ProdutoController();
$ajaxcontrol = new AjaxController();
$anunciantecontrol = new AnuncianteController();
$publicidadecontrol = new PublicidadeController();
$cotacaocontrol = new CotacaoController();

$categorias = $categoriacontrol->listCategorias();
$gados_ultimos = $gadocontrol->pesquisaGado(array('status'=>'true'), 'id DESC', 14);
$gados_fora = array();
foreach($gados_ultimos as $gd) {
	$gados_fora[] = $gd->getId();
}
$gados_outros = $gadocontrol->pesquisaGado(array('status'=>'true', 'id_not_in' => implode(',', $gados_fora)), 'RANDOM()', 14);
$produtos_ultimos = $produtocontrol->pesquisaProduto(array('status'=>'true', 'aprovado'=>'true'), 'id DESC', 14);
$ufs = $ajaxcontrol->listEstados();

$full_banner = $publicidadecontrol->pesquisaPublicidade(array('status'=>'true', 'tipo' => '1', 'listagem' => true), 'RANDOM()', 1);
$lateral_banner = $publicidadecontrol->pesquisaPublicidade(array('status'=>'true', 'tipo' => '2', 'listagem' => true), 'RANDOM()', 2);

$cotacoes = $cotacaocontrol->listCotacoes();

unset($gadocontrol, $produtocontrol, $ajaxcontrol, $publicidadecontrol, $gados_fora, $publicidadecontrol, $cotacaocontrol);
?>