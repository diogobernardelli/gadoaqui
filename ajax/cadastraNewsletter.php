<?
@session_start();
chdir('../');
require_once 'pacotes/controller/NewsletterController.php';
$newslettercontrol = new NewsletterController();

if ($_POST['nome'] != '' && $_POST['email'] != '') {
	$post['nome'] = $newslettercontrol->noInjection($_POST['nome']);
	$post['email'] = $newslettercontrol->noInjection($_POST['email']);
	$post['id_anunciante'] = ($_SESSION['ga']['id'])?$_SESSION['ga']['id']:null;
	
	$news = $newslettercontrol->getNewsletterByEmail($post['email']);

	if ($news) {
		$response = json_encode(array("erro" => "E-mail já cadastrado."));
	} else {
		if ($newslettercontrol->setNewsletter($post)) {
			if (isset($_SESSION['ga']['id'])) {
				$response = json_encode(array("msg" => "Newsletter cadastrado com sucesso!", 
												"nome" => $_SESSION['ga']['nome'], 
												"email" => $_SESSION['ga']['email']));						
			} else {
				$response = json_encode(array("msg" => "Newsletter cadastrado com sucesso!"));										
			}
		} else {
			$response = json_encode(array("erro" => "Ocorreu algum erro."));
		}
	}
} else {
	$response = json_encode(array("erro" => "Sem dados"));
}

unset($_POST, $post, $news, $newslettercontrol);
exit($response);
?>