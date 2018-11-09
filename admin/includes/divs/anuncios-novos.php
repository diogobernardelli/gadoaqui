<?
	chdir(dirname(__FILE__).'/../../../');
	include "pacotes/work/work_admin_produtos_novos.php";
	chdir('admin/');
	@session_start();
?>

<script type="text/javascript">
	$(function(){
		<? if (count($produtos) > 0) { ?>
			$('#countNovosAnuncios').html('<?=count($produtos);?>');
			$('#countNovosAnuncios').show();
		<? } else { ?>
			$('#countNovosAnuncios').html('');
			$('#countNovosAnuncios').hide();
		<? } ?>
	});
	
	function aprovaAnuncio(id) {
		$('.loading').show();
		$.post('ajax/aprovaAnuncio.php', { id: id }, function(data){
			$('.loading').hide();
			if (data.ok)
				mostraDivMenu('anuncios-novos');
			else
				alert(data.erro);
		},'json');
	}
	
	function reprovaAnuncio(id) {
		$('.loading').show();
		$.post('ajax/reprovaAnuncio.php', { id: id }, function(data){
			$('.loading').hide();
			if (data.ok)
				mostraDivMenu('anuncios-novos');
			else
				alert(data.erro);
		},'json');
	}
</script>

<h1>Novos Anúncios</h1>
<div class="line">
    <? 
		foreach ($produtos as $produto) {
			$anunciante = $anunciantecontrol->getAnunciante($produto->getId_anunciante());
 	?>
	    <div class="anuncio">
	        <div class="imagem">
	            <img src="../images/produto/<?=current($produto->getImagens());?>">
	        </div>
	        <div class="info">
	        	<h3><?=$produto->getNome();?></h3>
	            <div class="coluna">                
	                Valor: <strong>R$ <?=number_format($produto->getValor(), 2, ',', '.');?></strong><br />
	                <?=count($produto->getImagens());?> fotos<br />
	                Vídeo: <img src="images/<?=($produto->getVideo())?'icon-check':'icon-delete';?>.png"><br />
	                Localização: <img src="images/<?=($anunciante->getEndereco())?'icon-check':'icon-delete';?>.png">               
	            </div>
	            <div class="coluna">
	            	<strong><?=$anunciante->getNome().' '.$anunciante->getSobrenome();?></strong><br />
	                <?=$anunciante->getTelefone();?><br />
	                <?=$anunciante->getEmail();?><br />                
	            </div>
	        </div>
	        <div class="acoes">
	            <a href="../produto.php?id=<?=$produto->getId();?>&v=1" class="classTitle" target="_blank" title="Ver Anúncio"><img src="images/icon-see.png"></a>
	            <a href="javascript:;" onclick="aprovaAnuncio(<?=$produto->getId();?>);" class="classTitle" title="Autorizar Anúncio"><img src="images/icon-check-white.png"></a>
	            <a href="javascript:;" onclick="reprovaAnuncio(<?=$produto->getId();?>);" class="classTitle" title="Negar / Deletar Anúncio"><img src="images/icon-del.png"></a>
	        </div>
	    </div>
    <? } ?>
</div>