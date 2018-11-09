<?
@session_start();
chdir('../../');
require_once 'pacotes/controller/GadoController.php';
$gadocontrol = new GadoController();

if ($_POST['nome'] != '' && $_POST['valor_kg'] != '' && $_POST['raca'] != '' && 
	$_POST['quantidade'] != '' && $_POST['sexo'] != '' && 
	$_POST['idade'] != '' && $_POST['estado'] != '' && $_POST['informacoes_gerais'] != '' && 
	$_POST['endereco'] != '' && $_POST['img1'] != '') {

	//$_POST['dados_old'] = preg_replace('/\s+/', '', $_POST['dados_old']); 
	$dados_old = json_decode(stripslashes(str_replace('\'', '"', $_POST['dados_old'])));
	unset($_POST['dados_old']);

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
	if ($dados_old->valor_kg != $_POST['valor_kg']) {
		$dados_new['valor_kg'] = $_POST['valor_kg'];
	}
	if ($dados_old->raca != $_POST['raca']) {
		$dados_new['raca'] = $_POST['raca'];
	}
	if ($dados_old->quantidade != $_POST['quantidade']) {
		$dados_new['quantidade'] = $_POST['quantidade'];
	}
	if ($dados_old->sexo != $_POST['sexo']) {
		$dados_new['sexo'] = $_POST['sexo'];
	}
	if ($dados_old->peso_medio != $_POST['peso_medio']) {
		$dados_new['peso_medio'] = $_POST['peso_medio'];
	}
	if ($dados_old->idade != $_POST['idade']) {
		$dados_new['idade'] = $_POST['idade'];
	}
	if ($dados_old->finalidade != $_POST['finalidade']) {
		$dados_new['finalidade'] = $_POST['finalidade'];
	}
	if ($dados_old->estado != $_POST['estado']) {
		$dados_new['estado'] = $_POST['estado'];
	}
	if ($dados_old->cidade != $_POST['cidade']) {
		$dados_new['cidade'] = $_POST['cidade'];
	}
	if ($dados_old->informacoes_gerais != $_POST['informacoes_gerais']) {
		$dados_new['informacoes_gerais'] = $_POST['informacoes_gerais'];
	}
	if ($dados_old->endereco != $_POST['endereco']) {
		$dados_new['endereco'] = $_POST['endereco'];
	}
	if ($dados_old->como_chegar != $_POST['como_chegar']) {
		$dados_new['como_chegar'] = $_POST['como_chegar'];
	}
	if ($dados_old->categoria != $_POST['id_categoria']) {
		$dados_new['id_categoria'] = $_POST['id_categoria'];
	}
	if ($dados_old->latitude != $_POST['latitude']) {
		$dados_new['latitude'] = $_POST['latitude'];
	}
	if ($dados_old->longitude != $_POST['longitude']) {
		$dados_new['longitude'] = $_POST['longitude'];
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
		if ($gadocontrol->updateGado($id, $dados_new, $dados_new_img, $dados_old)) {
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