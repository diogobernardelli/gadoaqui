<?
@session_start();
chdir('../../');
require_once 'pacotes/controller/ProdutoController.php';
$produtocontrol = new ProdutoController();

if ($produtocontrol->updateProduto($_POST['id'], array('aprovado'=>'true'), array('aprovado'=>'false'))) {
	$response = json_encode(array('ok'=>'ok'));
} else {
	$response = json_encode(array('erro'=>'Ocorreu algum erro.'));
}

unset($_POST, $produtocontrol);
exit($response);
?>