<?php include "pacotes/work/work_index.php"; ?>
<div class="topo">
	<div class="barra-topo">
    	<div class="logo">
            <a href="index.php">
                <img src="images/logogadoaqui.png" />
            </a>
        </div>
        <? if (count($full_banner) > 0) { ?>
            <div class="super-banner-index-topo">
                <a href="<?=current($full_banner)->getUrl();?>" onclick="incrementaClique(<?=current($full_banner)->getId();?>);" target="_blank">
                    <img src="images/parceiro/<?=current($full_banner)->getArquivo();?>" title="<?=current($full_banner)->getNome();?>"/>
                </a>
            </div>
        <? } ?>
        <div class="botoes">
        	<? if (isset($_SESSION['ga']['id'])) { ?>
	        	<div class="ola-big"><span>Olá,<br /><a href="minhaconta.php"><?=$_SESSION['ga']['nome'];?></a></span></div>
                <div class="ola-small"><span>Olá, <a href="minhaconta.php"><?=$_SESSION['ga']['nome'];?></a></span></div>
          	  	<a href="anunciar.php" class="classTitle botao botao1" title="Anuncie seu Gado ou <br />Produto Agrícola <strong>Aqui</strong>!">
	                <img src="images/topo-anuncie.png" />Anuncie Aqui!
	            </a>
	            <a href="ajax/logout.php" class="botao" >
	                <img src="images/topo-login.png" />LOGOUT
	            </a>
            <? } else { ?>
            	<a href="login.php" class="classTitle botao" title="Anuncie seu Gado ou <br />Produto Agrícola <strong>Aqui</strong>!">
	                <img src="images/topo-anuncie.png" />Anuncie Aqui!
	            </a>
	            <a href="login.php" class="botao" >
	                <img src="images/topo-login.png" />LOGIN
	            </a>
			<? } ?>
        </div>
    </div> 
    <div class="menu">
        <ul>
            <li>
                <a href="index.php">
                    HOME
                </a>
            </li>
            <li>
                <a href="gadoaqui.php">
                    GADO AQUI
                </a>
            </li>
            <li>
                <a href="produtos.php">
                    PRODUTOS
                </a>
            </li>
            <li class="menu-anuncie">
                <a href="anunciar.php">
                    ANUNCIE
                </a>
            </li>
            <li>
                <a href="contato.php">
                    CONTATO
                </a>
            </li>
        </ul>
    </div>
    
</div>
