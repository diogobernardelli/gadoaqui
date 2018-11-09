<?
@session_start();
chdir('../../');
require_once 'pacotes/controller/ProdutoController.php';
$produtocontrol = new ProdutoController();

if ($_POST['nome'] != '' && $_POST['valor'] != '' && $_POST['informacoes_gerais'] != '' 
	&& $_POST['img1'] != '') {
	
	//$_POST['dados_old'] = preg_replace('/\s+/', '', $_POST['dados_old']); 
	$dados_old = json_decode(stripslashes(str_replace('\'', '"', $_POST['dados_old'])));
	unset($_POST['dados_old']);

	$_POST['frete'] = ($_POST['frete'])?$_POST['frete']:null;
	$_POST['video'] = ($_POST['video']=='LINK YOUTUBE')?null:$_POST['video'];

	if ($_POST['video']) {
		$video = explode("=", $_POST['video']);
	 	if (count($video) == 2) {
			$_POST['video'] = 'http://www.youtube.com/embed/'.$video[1];
		}
	}

	$id = $_POST['id'];
	unset($_POST['id']);
	
	if ($dados_old->nome != $_POST['nome']) {
		$dados_new['nome'] = $_POST['nome'];
	} 
	if ($dados_old->peso != $_POST['peso']) {
		$dados_new['peso'] = $_POST['peso'];
	}
	if ($dados_old->valor != $_POST['valor']) {
		$dados_new['valor'] = $_POST['valor'];
	}
	if ($dados_old->informacoes_gerais != $_POST['informacoes_gerais']) {
		$dados_new['informacoes_gerais'] = $_POST['informacoes_gerais'];
	}
	if ($dados_old->frete != $_POST['frete']) {
		$dados_new['frete'] = $_POST['frete'];
	}
	if ($dados_old->status != $_POST['status']) {
		$dados_new['status'] = $_POST['status'];
	} 
	if ($dados_old->video != $_POST['video']) {
		$dados_new['video'] = $_POST['video'];
	}
	if ($dados_old->img1 != $_POST['img1']) {
		$dados_new_img['img1'] = $_POST['img1'];
	}
	if ($dados_old->img2 != $_POST['img2']) {
		$dados_new_img['img2'] = $_POST['img2'];
	}
	if ($dados_old->img3 != $_POST['img3']) {
		$dados_new_img['img3'] = $_POST['img3'];
	}
	if ($dados_old->img4 != $_POST['img4']) {
		$dados_new_img['img4'] = $_POST['img4'];
	}

	if (count($dados_new) > 0 || count($dados_new_img) > 0) {
		if ($produtocontrol->updateProduto($id, $dados_new, $dados_new_img, $dados_old)) {
			$response = json_encode(array("msg" => "Anúncio editado com sucesso!"));
		} else {
			$response = json_encode(array("erro" => "Ocorreu algum erro."));
		}
	} else {
		$response = json_encode(array("msg" => "Nenhum dado alterado."));
	}
} else {
	$response = json_encode(array("erro" => "Todos os campos são obrigatórios"));
}

unset($_POST, $produtocontrol, $dados_old, $dados_new, $dados_new_img, $id, $video);
exit($response);
?>