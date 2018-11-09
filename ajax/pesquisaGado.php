<?
@session_start();
chdir('../');
require_once 'pacotes/controller/GadoController.php';
$gadocontrol = new GadoController();

$post['status'] = 'true';

$busca = $gadocontrol->pesquisaGado($post);

$array = array();
foreach($busca as $gado) {
	$array[] = $gado->getId().'|'.$gado->getLatitude().'|'.$gado->getLongitude();
}

unset($_POST, $gadocontrol, $busca, $post);
exit(json_encode($array));
?>