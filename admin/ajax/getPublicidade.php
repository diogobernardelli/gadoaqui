<?php
chdir('../../');
require_once 'pacotes/controller/PublicidadeController.php';
$publicidadecontrol = new PublicidadeController();

$publicidade = $publicidadecontrol->getPublicidade($_GET['id']);

$ret['id'] = $_GET['id'];
$ret['nome'] = $publicidade->getNome();
$ret['url'] = $publicidade->getUrl();
$ret['tipo'] = $publicidade->getTipo();
$ret['data_inicio'] = $publicidade->getData_inicio();
$ret['data_fim'] = $publicidade->getData_fim();
$ret['status'] = ($publicidade->getStatus())?"true":"false";
$ret['arquivo'] = $publicidade->getArquivo();

$tmp = explode("/", $publicidade->getData_inicio());
$dt_ini = strtotime($tmp[2]."-".$tmp[1]."-".$tmp[0]);

if ($publicidade->getData_fim()) {
	$tmp = explode("/", $publicidade->getData_fim());
	$dt_fim = strtotime($tmp[2]."-".$tmp[1]."-".$tmp[0]);
	
	$tmp = $dt_fim - $dt_ini;
	$ret['data_fim'] = floor($tmp/(60*60*24));
}

echo json_encode($ret);

unset($publicidadecontrol, $publicidade, $_GET, $tmp);
?>