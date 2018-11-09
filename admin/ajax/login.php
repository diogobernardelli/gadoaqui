<?
@session_start();
chdir('../../');
require_once 'pacotes/controller/AnuncianteController.php';
$anunciantecontrol = new AnuncianteController();

if ($_POST['email'] != '' && $_POST['senha'] != '') {
	$post['login'] = $anunciantecontrol->noInjection($_POST['email']);
	$post['senha'] = $anunciantecontrol->noInjection($_POST['senha']);
	
	$login = $anunciantecontrol->loginAdm($post);

	//SE ENCONTROU O ADMIN, CONTINUA
	if ($login) {
		$_SESSION['ga']['admin'] = $login;
        
		/*if ($login['obriga_senha'] == 1) {
			unset($response);
			$response = json_encode(array("location" => "/painel_geral/altera_senha.php"));
		}*/
		
		$response = json_encode(array("location" => "index.php"));
	} else {
		$response = json_encode(array("erro" => "Usuário e/ou senha inválidos!"));
	}
} else {
	$response = json_encode(array("erro" => "Sem dados"));
}

unset($_POST, $post, $login, $anunciantecontrol);
exit($response);
?>