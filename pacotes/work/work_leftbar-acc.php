<?php
	require_once 'pacotes/controller/PublicidadeController.php';
	$publicidadecontrol = new PublicidadeController();
	
	$lateral_banner = $publicidadecontrol->pesquisaPublicidade(array('status'=>'true', 'tipo' => '2', 'listagem' => true), 'RANDOM()', 2);

	unset($publicidadecontrol);
?>