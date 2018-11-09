<?
@session_start();
chdir('../../');
require_once 'pacotes/controller/ProdutoController.php';
$produtocontrol = new ProdutoController();

if ($_POST['nome'] != '' && $_POST['valor'] != '' && $_POST['estado'] != '' && $_POST['informacoes_gerais'] != '' 
	&& $_POST['img1'] != '' && $_POST['id_anunciante'] != '') {
		
	$_POST['status'] = 'true';
	$_POST['aprovado'] = 'true';
	$_POST['reprovado'] = 'false';
	$_POST['frete'] = ($_POST['frete'])?$_POST['frete']:null;
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
		
	if ($produtocontrol->setProduto($_POST, $imgs)) {
		$response = json_encode(array("msg" => "Anúncio cadastrado com sucesso!"));
	} else {
		$response = json_encode(array("erro" => "Ocorreu algum erro."));
	}

} else {
	$response = json_encode(array("erro" => "Todos os campos são obrigatórios"));
}

unset($_POST, $produtocontrol, $imgs);
exit($response);
?>