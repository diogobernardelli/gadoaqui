<?
@session_start();
chdir('../../');
require_once 'pacotes/controller/GadoController.php';
$gadocontrol = new GadoController();

if ($_POST['nome'] != '' && $_POST['valor_kg'] != '' && $_POST['raca'] != '' && 
	$_POST['quantidade'] != '' && $_POST['sexo'] != '' && 
	$_POST['idade'] != '' && $_POST['estado'] != '' && $_POST['informacoes_gerais'] != '' && 
	$_POST['id_anunciante'] != '' && $_POST['endereco'] != '' && $_POST['img1'] != '') {
	
	$_POST['status'] = 'true';	
	$_POST['video'] = ($_POST['video']=='LINK YOUTUBE')?null:$_POST['video'];
	
	if ($_POST['video']) {
		$video = explode("=", $_POST['video']);
	 	if (count($video) == 2) {
			$_POST['video'] = 'http://www.youtube.com/embed/'.$video[1];
		}
	}
	
	$imgs = array();
	$imgs[] = $_POST['img1'];
	if ($_POST['img2'])
		$imgs[] = $_POST['img2'];
	if ($_POST['img3'])
		$imgs[] = $_POST['img3'];
	if ($_POST['img4'])
		$imgs[] = $_POST['img4'];
	
	unset($_POST['img1'], $_POST['img2'], $_POST['img3'], $_POST['img4']);
		
	if ($gadocontrol->setGado($_POST, $imgs)) {
		$response = json_encode(array("msg" => "Anúncio cadastrado com sucesso!"));
	} else {
		$response = json_encode(array("erro" => "Ocorreu algum erro."));
	}

} else {
	$response = json_encode(array("erro" => "Todos os campos são obrigatórios"));
}

unset($_POST, $gadocontrol, $imgs);
exit($response);
?>