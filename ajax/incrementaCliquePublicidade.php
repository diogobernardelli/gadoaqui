<?
chdir('../');
require_once 'pacotes/controller/PublicidadeController.php';
$publicidadecontrol = new PublicidadeController();

$publicidade = $publicidadecontrol->getPublicidade($_POST['id']);
$publicidadecontrol->updatePublicidade($_POST['id'], array('cliques' => $publicidade->getCliques() + 1), array('cliques' => $publicidade->getCliques()));

unset($publicidade, $publicidadecontrol, $_POST);
exit();
?>