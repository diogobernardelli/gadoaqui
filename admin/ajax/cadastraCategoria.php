<?
@session_start();
chdir('../../');
require_once 'pacotes/controller/CategoriaController.php';
$categoriacontrol = new CategoriaController();

if ($categoriacontrol->setCategoria($_POST)) {
	$response = json_encode(array('ok'=>'ok'));
} else {
	$response = json_encode(array('erro'=>'Ocorreu algum erro.'));
}

unset($_POST, $categoriacontrol);
exit($response);
?>