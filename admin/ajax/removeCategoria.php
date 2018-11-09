<?
@session_start();
chdir('../../');
require_once 'pacotes/controller/CategoriaController.php';
require_once 'pacotes/controller/GadoController.php';
$categoriacontrol = new CategoriaController();
$gadocontrol = new GadoController();

if ($gadocontrol->countPesquisaGado(array('categoria'=>$_POST['id'])) > 0) {
	$response = json_encode(array('erro'=>'Não é possível excluir essa categoria pois existem anúncios vinculados à ela.'));
} else {
	if ($categoriacontrol->deleteCategoria($_POST['id'])) {
		$response = json_encode(array('ok'=>'ok'));
	} else {
		$response = json_encode(array('erro'=>'Ocorreu algum erro.'));
	}
}

unset($_POST, $categoriacontrol, $gadocontrol);
exit($response);
?>