<?
@session_start();
chdir('../../');
require_once 'pacotes/controller/CotacaoController.php';
$cotacaocontrol = new CotacaoController();

if ($_POST['valor1'] != '' && $_POST['valor2'] != '' && $_POST['valor3'] != '' && $_POST['valor4'] != '' && $_POST['valor5'] != '') {

	$cotacaocontrol->updateCotacao(1, array('valor' => $_POST['valor1']), array('valor' => $_POST['valor1']));
	$cotacaocontrol->updateCotacao(2, array('valor' => $_POST['valor2']), array('valor' => $_POST['valor1']));
	$cotacaocontrol->updateCotacao(3, array('valor' => $_POST['valor3']), array('valor' => $_POST['valor1']));
	$cotacaocontrol->updateCotacao(4, array('valor' => $_POST['valor4']), array('valor' => $_POST['valor1']));
	$cotacaocontrol->updateCotacao(5, array('valor' => $_POST['valor5']), array('valor' => $_POST['valor1']));
	
	$response = json_encode(array("ok" => "ok"));
			
} else {
	$response = json_encode(array("erro" => "Todos os campos são obrigatórios"));
}

unset($_POST, $cotacaocontrol);
exit($response);
?>