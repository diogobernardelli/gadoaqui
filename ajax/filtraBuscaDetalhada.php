<?php
header("Content-Type: text/html; charset=UTF-8");
@session_start();

if ($_GET['ids'] == "")
	$_GET['ids'] = 'n';
		
$_SESSION['ga']['filtro_det'] = $_GET['ids'];
?>