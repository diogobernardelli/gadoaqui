<?
	chdir('../../');
	include "pacotes/work/work_admin_produtos_novos.php";
	
	echo json_encode(array("count" => count($produtos)));
?>