<?
@session_start();
if (!isset($_SESSION['ga']['id'])) {
	exit(json_encode(array("location" => "login.php")));
}

chdir('../');
require_once 'pacotes/controller/AnuncianteController.php';
$anunciantecontrol = new AnuncianteController();

function noInjection($obj) {
	GLOBAL $anunciantecontrol;
	
	return $anunciantecontrol->noInjection($obj);
}

$_POST = array_map('noInjection', $_POST);

$post = array();
foreach ($_POST as $chave => $valor) {
	if ($valor) {
		$post[$chave] = $valor;
		if ($chave == 'senha')
			$post[$chave] = md5 ( $post[$chave] . "_" . substr ( $post[$chave], -3 ) );
	}
}

if ($anunciantecontrol->updateAnunciante($_SESSION['ga']['id'], $post)) {
	foreach ($post as $chave => $valor) {
		$_SESSION['ga'][$chave] = $valor;
	}
	$response = json_encode(array("msg" => "Dados alterados com sucesso!"));
} else {
	$response = json_encode(array("erro" => "Ocorreu algum erro."));
}

unset($_POST, $post, $anunciantecontrol);
exit($response);
?>