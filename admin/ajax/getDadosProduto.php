<?php
chdir('../../');
require_once 'pacotes/controller/AnuncianteController.php';
require_once 'pacotes/controller/ProdutoController.php';
$anunciantecontrol = new AnuncianteController();
$produtocontrol = new ProdutoController();

$produto = $produtocontrol->getProduto($_GET['id']);
$anunciante = $anunciantecontrol->getAnunciante($produto->getId_anunciante());

$ret['nome'] = $produto->getNome();
$ret['valor'] = $produto->getValor();
$ret['frete'] = $produto->getFrete();
$ret['peso'] = $produto->getPeso();
$ret['status'] = ($produto->getStatus())?'t':'f';
$ret['informacoes_gerais'] = $produto->getInformacoes_gerais();
$ret['anunciante'] = $anunciante->getNome().' '.$anunciante->getSobrenome();
$ret['video'] = $produto->getVideo();
$ret['data_cad'] = $produto->getData_cad();
$imgs = $produto->getImagens();
$ret['img1'] = $imgs[0];
$ret['img2'] = $imgs[1];
$ret['img3'] = $imgs[2];
$ret['img4'] = $imgs[3];

echo json_encode($ret);

unset($anunciantecontrol, $produtocontrol, $_GET);
?>