<?
@session_start();
chdir('../../');
require_once 'pacotes/controller/GadoController.php';
$gadocontrol = new GadoController();

if ($gadocontrol->updateGado($_POST['id'], array('status'=>'false'), array('status'=>'true'))) {
	$response = json_encode(array('ok'=>'ok'));
} else {
	$response = json_encode(array('erro'=>'Ocorreu algum erro.'));
}

unset($_POST, $gadocontrol);
exit($response);
?>