<?php include "pacotes/work/work_leftbar-acc.php"; ?>
<div class="menu-lateral">
    <ul>
        <li><a href="anunciar.php">Anunciar</a></li>
        <li><a href="minhaconta.php">Meus Anúncios</a></li>
        <li><a href="meusdados.php">Meus Dados</a></li>
    </ul>
</div>
<div class="ads">
<?
	foreach ($lateral_banner as $pub) {
		echo '<a href="'.$pub->getUrl().'" onclick="incrementaClique('.$pub->getId().');" target="_blank">
                    <img src="images/parceiro/'.$pub->getArquivo().'" title="'.$pub->getNome().'"/>
                </a>';
	}
?>
</div>    