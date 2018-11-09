<?
chdir('../../');
require_once 'pacotes/controller/PublicidadeController.php';
$publicidadecontrol = new PublicidadeController();

if ($publicidadecontrol->updatePublicidade($_POST['id'], array('status'=>'false'), array('status'=>'true'))) {
	$response = json_encode(array('ok'=>'ok'));
} else {
	$response = json_encode(array('erro'=>'Ocorreu algum erro.'));
}

unset($_POST, $publicidadecontrol);
exit($response);
?>