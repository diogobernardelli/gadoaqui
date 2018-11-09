<?
	@session_start();
	if (!isset($_SESSION['ga']['admin'])) {
		header('Location: login.php');
	}
?>
<?php include "cabecalho.php"; ?>
<?php include "menu-lateral.php"; ?>
<div id="conteudo">
	<?php include "includes/divs/anuncios-novos.php"; ?>
</div>
<?php //include "footer.php"; ?>