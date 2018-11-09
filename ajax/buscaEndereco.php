<?php
header("Content-Type: text/html; charset=UTF-8");
chdir('../');

if (!empty($_GET['cep'])){
	include 'pacotes/controller/AjaxController.php';
	$control =  new AjaxController();
	$endereco = $control->buscaEndereco($_GET['cep']);
	echo json_encode(array("rua"=>$endereco['rua'],"bairro"=>$endereco['bairro'],"cidade"=>$endereco['cidade'],"uf"=>$endereco['uf']));
	unset($endereco,$control,$_GET);
}else{
	echo json_encode(array("rua"=>"","bairro"=>"","cidade"=>"","uf"=>""));
}
?>