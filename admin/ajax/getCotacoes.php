<?php
chdir('../../');
require_once 'pacotes/controller/CotacaoController.php';
$cotacaocontrol = new CotacaoController();

$busca = $cotacaocontrol->listCotacoes();

$array = array();
foreach($busca as $cot) {
	$c = array();
	
	$c['id'] = $cot->getId();
	$c['valor'] = $cot->getValor();
	
	$array[] = $c; 
}

echo json_encode($array);

unset($cotacaocontrol, $_GET, $busca);
?>