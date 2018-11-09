<?
chdir('../');
require_once 'pacotes/controller/AnuncianteController.php';
$anunciantecontrol = new AnuncianteController();

function noInjection($obj) {
	GLOBAL $anunciantecontrol;
	
	return $anunciantecontrol->noInjection($obj);
}

$news = $_POST['news'];
unset($_POST['news']);

$_POST = array_map('noInjection', $_POST);

$post = array();
foreach ($_POST as $chave => $valor) {
	if ($valor) {
		$post[$chave] = $valor;
		if ($chave == 'senha')
			$post[$chave] = md5 ( $post[$chave] . "_" . substr ( $post[$chave], -3 ) );
	}
}

$id_anunciante = $anunciantecontrol->getAnuncianteByEmail($post['email']);

if (!$id_anunciante) {
	$id_anunciante = $anunciantecontrol->setAnunciante($post);
	if ($id_anunciante) {
		if ($news == '1') {
			require_once 'pacotes/controller/NewsletterController.php';
			$newslettercontrol = new NewsletterController();
			
			$post['id_anunciante'] = $id_anunciante;
			$newslettercontrol->setNewsletter($post);
		}
		$response = json_encode(array("msg" => "Cadastro efetuado com sucesso! Prossiga com o login."));
	} else {
		$response = json_encode(array("erro" => "Ocorreu algum erro."));
	}
} else {
	$response = json_encode(array("erro" => "E-mail já cadastrado."));
}

unset($_POST, $post, $anunciantecontrol, $newslettercontrol, $id_anunciante, $news);
exit($response);
?>