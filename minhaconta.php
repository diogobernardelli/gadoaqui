<?
	@session_start();
	if (!isset($_SESSION['ga']['id'])) {
		header('Location: login.php');
	}
?>
<?php $PAGE = "MEUS ANÚNCIOS"; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<?php include "pacotes/work/work_minhaconta.php"; ?>
<div class="minha-conta">

	<script type="text/javascript">
		function desativaAnuncio(id) {
			$('.loading').show();
			$.post('ajax/desativaAnuncio.php', { id: id }, function(data){
				$('.loading').hide();
				if (data.ok)
					location.href = 'minhaconta.php';
				else
					alert(data.erro);
			},'json');
		}
		
		function editaAnuncio(id) {
			$('.loading').show();
			$.post('ajax/editaAnuncio.php', { id: id }, function(data){
				$('.loading').hide();
				if (data.ok)
					location.href = 'anunciar.php';
			},'json');
		}
	</script>

<? /*
	<div class="help">
    	Seu anúncio <strong>LOTE 39 - NOVILHOS</strong> foi bloequaedo.<br />Um e-mail foi enviado para <strong>diogo@diogobernardelli.com.br</strong> com o motivo do bloqueio e os procedimentos para reativar o anúncio.
    </div>
*/ ?>
	<div class="leftbar">
        <?php include "leftbar-acc.php"; ?>
    </div><!-- //leftbar -->
    
    <div class="rightbar">
    	<h1>MEUS ANÚNCIOS</h1>
        <div class="line">
        <? foreach ($gados as $gado) { ?>
        	<div class="item <?=($gado->getStatus())?'':'item-desativado';?>">
                <div class="imagem">
                    <div class="lote">
                        LOTE <?=$gado->getId();?>
                    </div>
                    <img src="images/gado/<?=current($gado->getImagens());?>" />
                </div>
                <div class="info">
                    <h5><?=$gado->getNome();?></h5>
                    <div class="coluna">
                        Visualizações: <strong><?=$gado->getVisualizacoes();?></strong><br />
                        Status: <strong><?=($gado->getStatus())?'Ativo':'Inativo';?></strong><br />                        
                    </div>
                    <div class="acoes">
                    	<? if ($gado->getStatus()) { ?>
	                        <a href="anuncio.php?id=<?=$gado->getId();?>&v=1" class="classTitle" title="Ver Anúncio"><img src="images/icon-see.png" /></a>
	                        <!--<a href="anunciar.php" class="classTitle" title="Editar"><img src="images/icon-edit.png" /></a>
	                        <a href="javascript:;" class="classTitle" title="Deletar"><img src="images/icon-del.png" /></a>-->
                        <? } else { ?>
                        	Anúncio Desativado Temporariamente
                        <? } ?>
                    </div>
                </div>                
            </div>
        <? } ?>
		
		<? foreach ($produtos as $produto) {
			$des = '';
	 		if ((!$produto->getAprovado() && !$produto->getReprovado()) || ($produto->getReprovado()) || (!$produto->getStatus())) {
 				$des = 'item-desativado';
			}
		?>
        	<div class="item <?=$des;?>">
                <div class="imagem">
                    <img src="images/produto/<?=current($produto->getImagens());?>" />
                </div>
                <div class="info">
                    <h5><?=$produto->getNome();?></h5>
                    <div class="coluna">
                        Visualizações: <strong><?=$produto->getVisualizacoes();?></strong><br />
                        Status: <strong><?=($produto->getStatus())?'Ativo':'Inativo';?></strong><br />                        
                    </div>
                    <div class="acoes">
                    	<? if (!$produto->getAprovado() && !$produto->getReprovado()) { ?>
                    		Anúncio Aguardando <br /> Aprovação
                   		<? } else if ($produto->getReprovado()) { ?>
                   			Anúncio <br /> Reprovado
						<? } else if ($produto->getStatus()) { ?>
	                        <a href="produto.php?id=<?=$produto->getId();?>&v=1" class="classTitle" title="Ver Anúncio"><img src="images/icon-see.png" /></a>
	                        <a href="javascript:;" onclick="editaAnuncio(<?=$produto->getId();?>);" class="classTitle" title="Editar"><img src="images/icon-edit.png" /></a>
	                        <a href="javascript:;" onclick="desativaAnuncio(<?=$produto->getId();?>);" class="classTitle" title="Deletar"><img src="images/icon-del.png" /></a>
                        <? } else { ?>
                        	Anúncio Desativado Temporariamente
                        <? } ?>
                    </div>
                </div>                
            </div>
         <? } ?>	

        </div>
    </div><!-- //rightbar -->
</div>

<?php include "footer.php"; ?>