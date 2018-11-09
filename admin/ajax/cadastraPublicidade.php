<?
@session_start();
chdir('../../');
require_once 'pacotes/controller/PublicidadeController.php';
$publicidadecontrol = new PublicidadeController();
	
if ($_POST['data_fim']) {
	$tmp = explode("/", $_POST['data_inicio']);
	$tmp = $tmp[2]."-".$tmp[1]."-".$tmp[0];

	$dt_fim = new DateTime($tmp." 00:00:00");
	$dt_fim->modify('+'.$_POST['data_fim'].' days');
	
	$_POST['data_fim'] = $dt_fim->format("d/m/Y");
}

$tmp = explode("/", $_POST['data_inicio']);
$_POST['data_inicio'] = $tmp[2]."-".$tmp[1]."-".$tmp[0];

if (!strpos($_POST['url'], "http"))
	$_POST['url'] = 'http://'.$_POST['url'];

if ($publicidadecontrol->setPublicidade($_POST)) {
	$response = json_encode(array('ok'=>'ok'));
} else {
	$response = json_encode(array('erro'=>'Ocorreu algum erro.'));
}

unset($_POST, $publicidadecontrol);
exit($response);
?>