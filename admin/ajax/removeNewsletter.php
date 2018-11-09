<?
chdir('../../');
require_once 'pacotes/controller/NewsletterController.php';
$newslettercontrol = new NewsletterController();

if ($newslettercontrol->deleteNewsletter($_POST['id'])) {
	$response = json_encode(array('ok'=>'ok'));
} else {
	$response = json_encode(array('erro'=>'Ocorreu algum erro.'));
}

unset($_POST, $newslettercontrol);
exit($response);
?>