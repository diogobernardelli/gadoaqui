<?
chdir('../../');
require_once 'pacotes/controller/AnuncianteController.php';
$anunciantecontrol = new AnuncianteController();

$id = $_POST['id'];
unset($_POST['id']);

if ($anunciantecontrol->updateAnunciante($id, $_POST)) {
	$response = json_encode(array("ok" => "ok"));
} else {
	$response = json_encode(array("erro" => "Ocorreu algum erro."));
}

unset($_POST, $id, $anunciantecontrol);
exit($response);
?>