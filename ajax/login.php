<?
@session_start();
chdir('../');
require_once 'pacotes/controller/AnuncianteController.php';
$anunciantecontrol = new AnuncianteController();

if ($_POST['email'] != '' && $_POST['senha'] != '') {
	$post['login'] = $anunciantecontrol->noInjection($_POST['email']);
	$post['senha'] = $anunciantecontrol->noInjection($_POST['senha']);
	
	$login = $anunciantecontrol->login($post);

	//SE ENCONTROU O ANUNCIANTE, CONTINUA
	if ($login) {
		$_SESSION['ga']['id'] = $login->getId();
        $_SESSION['ga']['nome'] = $login->getNome();
        $_SESSION['ga']['sobrenome'] = $login->getSobrenome();
		$_SESSION['ga']['telefone'] = $login->getTelefone();
		$_SESSION['ga']['email'] = $_POST['email'];
		$_SESSION['ga']['associado'] = $login->getAssociado();
		$_SESSION['ga']['cep'] = $login->getCep();
		$_SESSION['ga']['endereco'] =  $login->getEndereco();
		$_SESSION['ga']['bairro'] = $login->getBairro();
		$_SESSION['ga']['estado'] = $login->getEstado();
		$_SESSION['ga']['complemento'] = $login->getComplemento();
		$_SESSION['ga']['cidade'] = $login->getCidade();
        
		/*if ($login['obriga_senha'] == 1) {
			unset($response);
			$response = json_encode(array("location" => "/painel_geral/altera_senha.php"));
		}*/
		
		$response = json_encode(array("location" => "minhaconta.php"));
	} else {
		$response = json_encode(array("erro" => "Usuário e/ou senha inválidos!"));
	}
} else {
	$response = json_encode(array("erro" => "Sem dados"));
}

unset($_POST, $post, $login, $anunciantecontrol);
exit($response);
?>