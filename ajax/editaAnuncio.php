<?
@session_start();
$_SESSION['ga']['editanuncio'] = $_POST['id'];

echo json_encode(array('ok'=>'ok'));
?>