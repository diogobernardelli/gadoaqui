<?php include "pacotes/work/work_produto.php"; ?>
<?php $PAGE = $produto->getNome(); ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<div class="anuncio anuncio-produto">

	<script type="text/javascript">	
		function enviaContato() {
			if ($('#nomeAnuncio').val() != '' && $('#telefoneAnuncio').val() != '' && $('#emailAnuncio').val() != '' && 
				$('#cidadeAnuncio').val() != '' && $('#estadoAnuncio').val() != '' && $('#msgAnuncio').val() != '') {
					
					$('.loading').show();
					
					$.post("ajax/enviaContatoAnuncio.php", { nome:$('#nomeAnuncio').val(), telefone:$('#telefoneAnuncio').val(), 
														email:$('#emailAnuncio').val(), cidade:$('#cidadeAnuncio').val(), 
														estado:$('#estadoAnuncio').val(), msg:$('#msgAnuncio').val(), id:'<?=$_REQUEST['id'];?>'
														nome_anunciante:$('#nomeAnunciante').val() , email_anunciante:$('#emailAnunciante').val(), t: 'p' }, 
						function(data){
							$('.loading').hide();
							if (data) {
								location.href = 'produto.php?id=<?=$_REQUEST['id'];?>';
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
    	<h1><?=$produto->getNome();?></h1>
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
        <table width="100%" border="1">
            <tr>
                <td>
                	<div class="produto">        	
                        <div class="galeria-imagens galeria1">
                            <div class="imagem">
                                <a href="images/produto/<?=current($produto->getImagens());?>" rel="shadowbox">
                                    <div class="zoom"></div>
                                    <img src="images/produto/<?=current($produto->getImagens());?>"  class="classTitle" title="Clique para dar Zoom na imagem" />
                                </a>
                            </div>
                            <div class="thumbs">
                            <?
			                	$imgs = $produto->getImagens();
			                	for ($x = 1; $x < count($imgs); $x++) {
			                		echo '<div class="item">
					                    	<a href="images/produto/'.$imgs[$x].'" class="example-image-link classTitle" data-lightbox="example-1" title="Clique na imagem para ampliar">
					                        	<img src="images/produto/'.$imgs[$x].'" />
					                        </a>
					                    </div>';
			                	}
			                	
			                	?>
                            </div>
                        </div>
                        
                        <div class="galeria-imagens galeria2">
                            <div class="imagem">
                                <img src="images/produto/<?=current($produto->getImagens());?>" />
                            </div>
                            <?
								
								$imgs = $produto->getImagens();
			                	for ($x = 1; $x < count($imgs); $x++) {
			                		echo '<div class="imagem">
					                        <img src="images/produto/'.$imgs[$x].'" />
					                    </div>';
			                	}
                                
                                ?>
                        </div>
            
            
                        <div class="info">
                            <div class="valor">
                                <span>R$</span> <?=number_format($produto->getValor(), 2, ',', '.');?>
                            </div>
                            <p>Frete: <strong><?=($produto->getFrete())?$produto->getFrete():'A COMBINAR';?></strong></p>
                            <p>Peso: <strong><?=$produto->getPeso();?> Kg</strong></p>                
                            <p>Estado: <strong><?=$anunciante->getEstado();?></strong></p>
                            <div class="descricao">
                            <p><strong>Informações Gerais:</strong> <?=$produto->getInformacoes_gerais();?></p>
                            </div>
                        </div>                        
                    </div>
                </td>
                <td class="coluna2" style="position:relative;">
				<? if (count($lateral_banner) > 0) { ?>
                	<div class="ads">
                    	<p>publicidade</p>
						<a href="<?=current($lateral_banner)->getUrl();?>" onclick="incrementaClique(<?=current($lateral_banner)->getId();?>);" target="_blank">
                            <img src="images/parceiro/<?=current($lateral_banner)->getArquivo();?>" title="<?=current($lateral_banner)->getNome();?>"/>
                        </a>
                    </div>
				<? } ?>
                </td>
            </tr>
        </table>

        
        <div class="anunciante">
        	<h4>Quem está anunciando?</h4>
            <div class="coluna">
            	<span>Nome</span><br />
            	<?=$anunciante->getNome().' '.$anunciante->getSobrenome();?>
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
            	<form action="produtos.php" id="formAnunciosAnunciante" method="REQUEST">
            		<input type="hidden" id="buscaAnuncianteProduto" name="buscaAnuncianteProduto" value="<?=$anunciante->getId();?>"/>
	            	<a href="javascript:;" onclick="$('#formAnunciosAnunciante').submit();">
	                	Outros anúncios de <?=$anunciante->getNome().' '.$anunciante->getSobrenome();?>
	                </a>
                </form>
            </div>
        </div>
        <div class="mapa">
        	<h3>LOCALIZAÇÃO DO VENDEDOR</h3>
        	<p><?=$anunciante->getEndereco().' - '.$anunciante->getCidade().', '.$anunciante->getEstado();?></p>
            <iframe id="ifrmMapaRota" name="ifrmMapaRota" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="ajax/mapa.php"></iframe>
            <input id="destinoRota" name="destinoRota" type="hidden" value="<?=$anunciante->getEndereco().' - '.$anunciante->getCidade().', '.$anunciante->getEstado();?>" />
        </div>
        <div class="contato">
        	<h3>Fale com o Anunciante</h3>
            <input name="nomeAnuncio" id="nomeAnuncio" type="text" value="NOME" onfocus="clearIt(this)" onblur="setIt(this)" />
            <input name="emailAnuncio" id="emailAnuncio" type="text" value="E-MAIL" onfocus="clearIt(this)" onblur="setIt(this)" />
            <input name="telefoneAnuncio" id="telefoneAnuncio" type="text" value="TELEFONE" onfocus="clearIt(this);$(this).mask('(99) 9999-9999');" onblur="setIt(this)" />
            <input name="cidadeAnuncio" id="cidadeAnuncio" type="text" value="CIDADE" onfocus="clearIt(this)" onblur="setIt(this)" />
            <input name="estadoAnuncio" id="estadoAnuncio" type="text" value="ESTADO" onfocus="clearIt(this)" onblur="setIt(this)" />
            <textarea name="msgAnuncio" id="msgAnuncio" cols="" rows=""></textarea>
        	<input name="" onclick="enviaContato();" type="button" value="ENVIAR" />             
        </div>
        
        <!--<div class="relacionados">
        	<h2>PRODUTOS RELACIONADOS</h2>
			<?php for ($i = 1; $i <= 4; $i++) { ?>
            <div class="item">
                <a href="produto.php" >
                    <div class="imagem">
                        <img src="images/imagem-produto.jpg" />
                    </div>
                    <div class="info">
                        <h1>Ração</h1>
                        <br />
                        Peso: <strong>70 Kg</strong><br />
                        Estado: <strong>MS</strong><br />
                        Valor: <span>R$ 1.400,00</span><br />                    
                    </div>
                    <div class="botao">
                        mais informações
                    </div>
                </a>
            </div>
            <?php } ?>
            <a href="produtos.php" class="mais" >
            	Mais produtos
            </a>
        </div>-->
    </div>
</div>
<?php include "footer.php"; ?>