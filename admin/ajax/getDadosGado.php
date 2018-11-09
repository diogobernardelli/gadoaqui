<?php
chdir('../../');
require_once 'pacotes/controller/AnuncianteController.php';
require_once 'pacotes/controller/GadoController.php';
$anunciantecontrol = new AnuncianteController();
$gadocontrol = new GadoController();

$gado = $gadocontrol->getGado($_GET['id']);
$anunciante = $anunciantecontrol->getAnunciante($gado->getId_anunciante());

$ret['nome'] = $gado->getNome();
$ret['valor_kg'] = $gado->getValor_kg();
$ret['categoria'] = $gado->getId_categoria();
$ret['raca'] = $gado->getRaca();
$ret['quantidade'] = $gado->getQuantidade();
$ret['sexo'] = $gado->getSexo();
$ret['peso_medio'] = $gado->getPeso_medio();
$ret['idade'] = $gado->getPeso_medio();
$ret['finalidade'] = $gado->getFinalidade();
$ret['uf'] = $gado->getEstado();
$ret['cidade'] = $gado->getCidade();
$ret['status'] = ($gado->getStatus())?'t':'f';
$ret['informacoes_gerais'] = $gado->getInformacoes_gerais();
$ret['anunciante'] = $anunciante->getNome().' '.$anunciante->getSobrenome();
$ret['endereco'] = $gado->getEndereco();
$ret['latitude'] = $gado->getLatitude();
$ret['longitude'] = $gado->getLongitude();
$ret['como_chegar'] = $gado->getComo_chegar();
$ret['video'] = $gado->getVideo();
$ret['data_cad'] = $gado->getData_cad();
$imgs = $gado->getImagens();
$ret['img1'] = $imgs[0];
$ret['img2'] = $imgs[1];
$ret['img3'] = $imgs[2];
$ret['img4'] = $imgs[3];

echo json_encode($ret);

unset($anunciantecontrol, $gadocontrol, $_GET);
?>