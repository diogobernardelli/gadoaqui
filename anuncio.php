<?php include "pacotes/work/work_anuncio.php"; ?>
<?php $PAGE = "LOTE ".$gado->getId()." - ".$gado->getNome(); ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<script type="text/javascript">
	$(function() {
		$('.black-back').hide();
		
		$('.over-video').click(function() {		
			$('.black-back').fadeIn(300);
		});
		
		$('.close-box').click(function() {		
			$('.black-back').fadeOut(300);
			$('#iframeVideo').attr('src', $('#iframeVideo').attr('src'));
		});
		$('.black-back').click(function() {		
			$('.black-back').fadeOut(300);
			$('#iframeVideo').attr('src', $('#iframeVideo').attr('src'));
		});		
	});
	$(document).keydown(function (e) {
		if(e.which == 27) { 
			$('.black-back').fadeOut(300);
			$('#iframeVideo').attr('src', $('#iframeVideo').attr('src'));
		}	
	});
</script> 
<div class="anuncio">

	<script type="text/javascript">
		function mostraRota(origem, destino) {
			if (origem != 'DIGITE SEU ENDEREÇO' && origem != '') {
				$('#linkRota').prop('href', 'https://www.google.com/maps/dir/'+origem+'/'+destino+'/data=!4m13!4m12!1m5!1m1!1s0x9486e618e06bf377:0x18c2d00734e64242!2m2!1m5!1m1!1s0x9486e8876d990c1d:0x8920bff5e2830a33!2m2!1d-54.6019971!2d-20.44254');
			} else
				alert('Digite um endereço válido!');
		}
		
		function enviaContato() {
			if ($('#nomeAnuncio').val() != '' && $('#telefoneAnuncio').val() != '' && $('#emailAnuncio').val() != '' && 
				$('#cidadeAnuncio').val() != '' && $('#estadoAnuncio').val() != '' && $('#msgAnuncio').val() != '') {
					
					$('.loading').show();
					
					$.post("ajax/enviaContatoAnuncio.php", { nome:$('#nomeAnuncio').val(), telefone:$('#telefoneAnuncio').val(), 
														email:$('#emailAnuncio').val(), cidade:$('#cidadeAnuncio').val(), 
														estado:$('#estadoAnuncio').val(), msg:$('#msgAnuncio').val(), id:'<?=$_REQUEST['id'];?>', 
														nome_anunciante:$('#nomeAnunciante').val() , email_anunciante:$('#emailAnunciante').val(), t:'g' }, 
						function(data){
							$('.loading').hide();
							if (data) {
								location.href = 'anuncio.php?id=<?=$_REQUEST['id'];?>';
							} else {
								alert('Ocorreu algum erro ao enviar o contato');
							}
					},'json');
			} else {
				alert('Todos os campos são obrigatórios!');
			}
		}
	</script>

		
	<div class="line">
    	<h1>LOTE <?=$gado->getId().' - '.$gado->getNome();?></h1>
        <div class="share">
        	<!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_facebook_share" fb:share:layout="button_count"></a>
            <a class="addthis_button_tweet"></a>
            <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
            </div>
            <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5050ae81103f0778"></script>
            <!-- AddThis Button END -->
        </div>
        <div class="produto">
        	<div class="galeria-imagens galeria1">
            	<div class="imagem">
                    <a class="example-image-link classTitle" href="images/gado/<?=current($gado->getImagens());?>" data-lightbox="example-1" title="Clique na imagem para ampliar">
                    	<div class="zoom"></div>
                        <img class="example-image" src="images/gado/<?=current($gado->getImagens());?>" alt="image-1">
                    </a>
                </div>
                <div class="thumbs">
                <?
                	$imgs = $gado->getImagens();
                	for ($x = 1; $x < count($imgs); $x++) {
                		echo '<div class="item">
		                    	<a href="images/gado/'.$imgs[$x].'" class="example-image-link classTitle" data-lightbox="example-1" title="Clique na imagem para ampliar">
		                        	<img src="images/gado/'.$imgs[$x].'" />
		                        </a>
		                    </div>';
                	}
                	
                	if ($gado->getVideo()) {
                		$video = explode('/embed/', $gado->getVideo());
               	?>
					<div class="black-back">
						<div class="box-video">
							<a href="javascript:;"><img src="images/close-box.png" class="close-box" /></a>
							<iframe id="iframeVideo" name="iframeVideo" src="//www.youtube.com/embed/<?=$video[1];?>" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
                    <div class="item">
                        <a href="javascript:;">
                            <img src="images/over-video.png" class="over-video" />
                            <!--<iframe src="<?=$gado->getVideo();?>" frameborder="0" allowfullscreen></iframe>-->
                            <img src="<?='http://i1.ytimg.com/vi/'.$video[1].'/default.jpg';?>" />
                        </a>
                    </div>
                <? } ?>
                </div>
            </div>
            
            
            <div class="galeria-imagens galeria2">
            	<div class="imagem">
                    <img class="example-image" src="images/gado/<?=current($gado->getImagens());?>" alt="image-1">
                </div>
                <?
                	$imgs = $gado->getImagens();
                	for ($x = 1; $x < count($imgs); $x++) {
                		echo '<div class="imagem">
		                       	<img src="images/gado/'.$imgs[$x].'" />
		                    </div>';
                	}
                	
                	if ($gado->getVideo()) {
						//echo '<a href="https://www.youtube.com/watch?v='.$video[1].'" target="_blank">';
                			//$video = explode('/embed/', $gado->getVideo());
						//echo '</a>';
               	?>
                    <div class="imagem">
                        <a href="https://www.youtube.com/watch?v=<? echo $video[1]; ?>" target="_blank" >
                        	<img src="images/over-video.png" class="over-video-mini" />
                            <img src="<?='http://i1.ytimg.com/vi/'.$video[1].'/default.jpg';?>" class="img-video" />
                        </a>
                    </div>
                <? } ?>
            </div>
            <div class="info">
            	<div class="valor">
                	<span>R$</span> <?=number_format($gado->getValor_kg(), 2, ',', '.');?> <font style="font-size:12px; color:#353535; font-weight:normal;">/ Cabeça</font>
                </div>
				<? if ($gado->getPeso_medio()) { ?>
					<p>Preço: <strong>R$ <?=number_format($gado->getValor_kg() / $gado->getPeso_medio(), 2, ',', '.');?> / Kg</strong></p>
				<? } ?>
                <p>Raça: <strong><?=$gado->getRaca();?></strong></p>
                <p>Quantidade: <strong><?=$gado->getQuantidade();?></strong></p>
                <p>Sexo: <strong><?=($gado->getSexo()=='F')?'Fêmea':'Macho';?></strong></p>
                <p>Finalidade: <strong><?=$gado->getFinalidade();?></strong></p>
                <p>ERA: <strong><?=$gado->getIdade();?> meses</strong></p>
                <p>Estado: <strong><?=$gado->getEstado();?></strong></p>
                <p>Cidade: <strong><?=$gado->getCidade();?></strong></p>
				<? if ($gado->getPeso_medio()) { ?>
					<p>Peso Médio por Cabeça: <strong><?=$gado->getPeso_medio();?> Kg</strong></p>
				<? } ?>
            </div>
        </div>
        <div class="descricao">
        	<p><strong>Informações Gerais:</strong><?=$gado->getInformacoes_gerais();?></p>
        </div>
        <div class="anunciante">
        	<h4>Quem está anunciando?</h4>
            <div class="coluna">
            	<span>Nome</span><br />
            	<?=$anunciante->getNome().' '.$anunciante->getSobrenome();?>
            	<input type="hidden" id="nomeAnunciante" value="<?=$anunciante->getNome().' '.$anunciante->getSobrenome();?>" />
            </div>
            <div class="coluna telefone">
            	<span>Telefone(s)</span><br />
            	<?=$anunciante->getTelefone();?>
            </div>
            <div class="coluna email">
            	<span>E-mail</span><br />
            	<?=$anunciante->getEmail();?>
            	<input type="hidden" id="emailAnunciante" value="<?=$anunciante->getEmail();?>" />
            </div>
            <div class="line">
            	<form action="gadoaqui.php" id="formAnunciosAnunciante" method="REQUEST">
            		<input type="hidden" id="buscaAnuncianteGado" name="buscaAnuncianteGado" value="<?=$anunciante->getId();?>"/>
	            	<a href="javascript:;" onclick="$('#formAnunciosAnunciante').submit();">
	                	Outros anúncios de <?=$anunciante->getNome().' '.$anunciante->getSobrenome();?>
	                </a>
                </form>
            </div>
        </div>
        <div class="mapa">
        	<h3>LOCALIZAÇÃO DO GADO</h3>
        	<p><?=$gado->getEndereco().' - '.$gado->getCidade().', '.$gado->getEstado();?></p>
            <iframe id="ifrmMapaRota" name="ifrmMapaRota" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="ajax/mapa.php"></iframe>
            
            <div class="como-chegar-descricao">
            	
            </div>
            
            <div class="como-chegar-descricao">
            	<input type="hidden" id="latitude" value="<?=$gado->getLatitude();?>" />
            	<input type="hidden" id="longitude" value="<?=$gado->getLongitude();?>" />
            	<strong><p>Distância aproximada:</p></strong>
                <span id="distanciaKm">&nbsp;</span><br  /><br  />
            	<strong><p>Como Chegar?</p></strong><br />
                <span><?=$gado->getComo_chegar();?></span>
            </div>
            
            <div class="como-chegar como-chegar-metade">            	
                <input id="origemRota" name="origemRota" type="text" value="DIGITE SEU ENDEREÇO" onfocus="clearIt(this)" onblur="setIt(this)" />
                <input id="destinoRota" name="destinoRota" type="hidden" value="<?=$gado->getEndereco().', '.$gado->getCidade().', '.$gado->getEstado();?>" />
                <input onclick="$('#ifrmMapaRota')[0].contentWindow.calcRota();" type="button" value="Descrever Rota" />
            </div>
            
            <div class="usuario-localizacao">
            	<p>Traçar rota a partir da minha seguinte localização:</p>
                <a id="rotaPorPosicaoNavegador" href="javascript:;"><img src="images/icon-pin.png" /><span id="enderecoNavegador">Posição não encontrada</span></a>
            </div>                        
            
        </div>
        <div class="contato">
        	<h3>Fale com o Anunciante</h3>
            <input name="nomeAnuncio" id="nomeAnuncio" type="text" value="NOME" onfocus="clearIt(this)" onblur="setIt(this)" />
            <input name="emailAnuncio" id="emailAnuncio" type="text" value="E-MAIL" onfocus="clearIt(this)" onblur="setIt(this)" />
            <input name="telefoneAnuncio" id="telefoneAnuncio" type="text" value="TELEFONE" onfocus="clearIt(thi's);$(this).mask('(99) 9999-9999');" onblur="setIt(this)" />
            <input name="cidadeAnuncio" id="cidadeAnuncio" type="text" value="CIDADE" onfocus="clearIt(this)" onblur="setIt(this)" />
            <input name="estadoAnuncio" id="estadoAnuncio" type="text" value="ESTADO" onfocus="clearIt(this)" onblur="setIt(this)" />
            <textarea name="msgAnuncio" id="msgAnuncio" cols="" rows=""></textarea>
        	<input name="" onclick="enviaContato();" type="button" value="ENVIAR" />             
        </div>
        <div class="comparacao">
	        <?					        
	        	if ($gado_menor || $gado_maior) {	        
	        		$categoria_gado = $categoriacontrol->getCategoria($gado->getId_categoria());
       		?>
       				<h3>Comparando <strong><?=$categoria_gado->getNome();?></strong> da raça <strong><?=$gado->getRaca();?></strong>, de idade média de <strong><?=$gado->getIdade();?> meses</strong>, sexo <strong><?=($gado->getSexo()=='F')?'Fêmea':'Macho';?></strong> e peso médio por cabeça de <strong><?=$gado->getPeso_medio();?>Kg</strong>:</h3>
			<?
					if ($gado_menor) {   
			?>        
			            <div class="item">
			            	<a href="anuncio.php?id=<?=$gado_menor->getId();?>" >
			                    <h4>Anúncio com <strong>menor valor</strong></h4>
			                    <div class="clear"></div>                
			                    <div class="imagem">
			                        <img src="images/gado/<?=current($gado_menor->getImagens());?>" />
			                    </div>
			                    <div class="info">
			                        <h1>Lote <?=$gado_menor->getId();?> - <?=$gado_menor->getNome();?></h1>
			                        <br />
			                        Quantidade: <strong><?=$gado_menor->getQuantidade();?></strong><br />
			                        Estado: <strong><?=$gado_menor->getEstado();?></strong><br />
			                        Valor: <span>R$ <?=number_format($gado_menor->getValor_kg(), 2, ',', '.');?> / kg</span><br />
			                        <div class="botao">
			                            mais informações
			                        </div>           
			                    </div>
			                    
			                </a>
			            </div>
            <? 
				}
				if ($gado_maior) {
			?>
		            <div class="item">
		            	<a href="anuncio.php?id=<?=$gado_maior->getId();?>" >
		                    <h4>Anúncio com <strong>maior valor</strong></h4>
		                    <div class="clear"></div>                
		                    <div class="imagem">
		                        <img src="images/gado/<?=current($gado_maior->getImagens());?>" />
		                    </div>
		                    <div class="info">
		                        <h1>Lote <?=$gado_maior->getId();?> - <?=$gado_maior->getNome();?></h1>
		                        <br />
		                        Quantidade: <strong><?=$gado_maior->getQuantidade();?></strong><br />
		                        Estado: <strong><?=$gado_maior->getEstado();?></strong><br />
		                        Valor: <span>R$ <?=number_format($gado_maior->getValor_kg(), 2, ',', '.');?> / kg</span><br />                    
		                    	<div class="botao">
		                            mais informações
		                        </div> 
		                    </div>
		                </a>
		            </div>
        <?
				} 
			}
		?>            
        </div>
    </div>
</div>
<? unset($_GET); ?>
<?php include "footer.php"; ?>