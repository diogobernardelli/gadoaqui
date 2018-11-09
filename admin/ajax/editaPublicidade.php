<?
@session_start();
chdir('../../');
require_once 'pacotes/controller/PublicidadeController.php';
$publicidadecontrol = new PublicidadeController();

//$_POST['dados_old'] = preg_replace('/\s+/', '', $_POST['dados_old']); 
$dados_old = json_decode(stripslashes($_POST['dados_old']));
unset($_POST['dados_old']);

if ($dados_old->nome != $_POST['nome']) {
	$dados_new['nome'] = $_POST['nome'];
} 
if ($dados_old->url != $_POST['url']) {
	if (!strpos($_POST['url'], "http"))
		$_POST['url'] = 'http://'.$_POST['url'];
	
	$dados_new['url'] = $_POST['url'];
}
if ($dados_old->tipo != $_POST['tipo']) {
	$dados_new['tipo'] = $_POST['tipo'];
}
if ($dados_old->data_inicio != $_POST['data_inicio']) {
	$tmp = explode("/", $_POST['data_inicio']);
	$tmp = $tmp[2]."-".$tmp[1]."-".$tmp[0];
	
	$dados_new['data_inicio'] = $tmp;
}
if ($dados_old->data_fim != $_POST['data_fim']) {
	$tmp = explode("/", $_POST['data_inicio']);
	$tmp = $tmp[2]."-".$tmp[1]."-".$tmp[0];

	if ($_POST['data_fim']) {
		$dt_fim = new DateTime($tmp." 00:00:00");
		$dt_fim->modify('+'.$_POST['data_fim'].' days');
		
		$_POST['data_fim'] = $dt_fim->format("Y-m-d");
		
		$dados_new['data_fim'] = $_POST['data_fim'];
	} else {
		$dados_new['data_fim'] = '';
	}
}
if ($dados_old->status != $_POST['status']) {
	$dados_new['status'] = $_POST['status'];
}
if ($dados_old->arquivo != $_POST['arquivo']) {
	$dados_new['arquivo'] = $_POST['arquivo'];
}

$id = $_POST['id'];
unset($_POST['id']);

if ($publicidadecontrol->updatePublicidade($id, $dados_new, $dados_old)) {
	$response = json_encode(array('ok'=>'ok'));
} else {
	$response = json_encode(array('erro'=>'Ocorreu algum erro.'));
}

unset($_POST, $publicidadecontrol, $dados_new, $dados_old, $id, $tmp);
exit($response);
?>