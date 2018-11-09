<?php $PAGE = "BUSCA DETALHADA"; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<?php include "pacotes/work/work_busca_gado.php"; ?>

<div class="anuncios anuncios-gados">
	<script type="text/javascript">
		var resBusca = new Array();
		
		$(document).ready(function() { 
			$('.line-endereco').hide();
			$('#show-endereco').click(function() {		
				$('.line-endereco').show();
				$('.buscar-comum').hide();
				$('#show-endereco').hide();
				$('#hide-endereco').show();
			});
			$('#hide-endereco').click(function() {		
				$('.line-endereco').hide();
				$('.buscar-comum').show();
				$('#show-endereco').show();
				$('#hide-endereco').hide();
				$('input[name="buscaTipoEnderecoGado"]').removeAttr('checked');
				$('#buscaEnderecoGado').val('');
				$('#buscaEnderecoGado').attr('readonly', 'readonly');
				$('#buscaRaioGado').val('');
			});
			
			$('.loading').show();
			$.get("ajax/pesquisaGado.php", function(data){
				for (var i in data) {
					resBusca.push(data[i]);
				}
				$('.loading').hide();
			},'json');
		});
		
		function buscaCidade(uf) {
			$('.loading').show();			
			$.get("ajax/buscaCidCorreio.php", { uf:uf, cid:'<?=$_REQUEST['buscaCidadeGado'];?>' }, 
				function(data){
					$('.loading').hide();
					$('#buscaCidadeGado').html(data);
			});
		}
		
		function verificaTipoEndereco(tipo) {
			if (tipo == '1' || tipo == '2') {
				$('#buscaEnderecoGado').val('');
				$('#buscaEnderecoGado').attr('readonly', 'readonly');
				
				if (tipo == '1') {
					if ($('#enderecoNavegador').val() == '') {
						alert('Você não permitiu sua localização no navegador');
						$('input[name="buscaTipoEnderecoGado"]').removeAttr('checked');
					} else {
						$('#ifrmMapaBusca')[0].contentWindow.getPosicaoNavegador();
					}
				} else if (tipo == '2') {
					if ($('#enderecoCadastro').val() == '' || $('#enderecoCadastro').val() == ',,') {
						alert('Seu cadastro está incompleto. Termine de preenchê-lo para utilizar essa opção');
						$('input[name="buscaTipoEnderecoGado"]').removeAttr('checked');
					} else {
						$('#ifrmMapaBusca')[0].contentWindow.buscarPosicao($('#enderecoCadastro').val());
					}
				}
			} else {
				$('#buscaEnderecoGado').removeAttr('readonly');
			}
		}
		
		function filtraLatLon() {
			if ($('input[name="buscaTipoEnderecoGado"]:checked').val() == 3 && $('#buscaEnderecoGado').val() != '') {
				$('#ifrmMapaBusca')[0].contentWindow.buscarPosicao($('#buscaEnderecoGado').val());
			}
		}
		
		function submitForm() {
			if ($('#buscaRaioGado').val() != '' && $('input[name="buscaTipoEnderecoGado"]:checked').val() != '') {
				if ($('input[name="buscaTipoEnderecoGado"]:checked').val() == 3 && $('#buscaEnderecoGado').val() == '')
					alert('Local é obrigatório para esse tipo de busca');	
				else
					$('#ifrmMapaBusca')[0].contentWindow.pointInCircle($('#buscaRaioGado').val());
			} else
				alert('Raio e tipo de endereço obrigatórios para esse tipo de busca');
		}
	</script>
	<div class="busca-detalhada">
    	<h3>BUSCA DETALHADA</h3>
    	<?
			if ($_REQUEST['buscaEstadoGado']) {
	    		echo '<script>buscaCidade("'.$_REQUEST['buscaEstadoGado'].'");</script>';
    		}
		?>
    	<form id="formBuscaDet" name="formBuscaDet" action="busca.php" method="REQUEST">
	        <div class="line">
	            <div class="campo campo1">
	            	<label for="buscaEstadoGado">ESTADO</label>
	                <br />
	                <select name="buscaEstadoGado" id="buscaEstadoGado" onchange="buscaCidade(this.value);">
	                    <option value="" selected="selected">--</option> 
	                	<?
							foreach($ufs as $uf) {
								$sel = '';
								if ($uf['sigla'] == $_REQUEST['buscaEstadoGado'])
									$sel = 'selected="selected"';
								echo '<option value="'.$uf['sigla'].'" '.$sel.'>'.$uf['sigla'].'</option>';
	               			}
	               			unset($uf);
				   		?>            	
	                </select>
	            </div>
	            <div class="campo campo2">
	            	<label for="buscaCidadeGado">CIDADE</label>
	                <br />
	                <select name="buscaCidadeGado" id="buscaCidadeGado">
	                    <option value="" selected="selected">--</option>               	
	                </select>
	            </div>
	            <div class="campo campo3">
	            	<label for="buscaCategoriaGado">TIPO</label>
	                <br />
	                <select name="buscaCategoriaGado" id="buscaCategoriaGado">
	                    <option value="" selected="selected">--</option> 
	                    <?
							foreach($categorias as $categoria) {
								$sel = '';
								if ($categoria->getId() == $_REQUEST['buscaCategoriaGado'])
									$sel = 'selected="selected"';
								echo '<option value="'.$categoria->getId().'" '.$sel.'>'.$categoria->getNome().'</option>';
	               			}
	               			unset($categoria);
				   		?>            	
	                </select>
	            </div>
	            <div class="campo campo4">
	            	<label for="buscaRacaGado">RAÇA</label>
	                <br />
	                <input type="text" name="buscaRacaGado" id="buscaRacaGado" value="<?=$_REQUEST['buscaRacaGado'];?>">
	            </div>
	
	            <div class="campo campo5">
	            	<label for="buscaIdadeGado">ERA</label>
	                <br />
	                <select name="buscaIdadeGado" id="buscaIdadeGado">
	                    <option value="" <?=($_REQUEST['buscaIdadeGado']=='')?'selected="selected"':'';?>>--</option>                	
	                    <option value="0|6" <?=($_REQUEST['buscaIdadeGado']=='0|6')?'selected="selected"':'';?>>de 0 a 6 meses</option> 
	                    <option value="6|12" <?=($_REQUEST['buscaIdadeGado']=='6|12')?'selected="selected"':'';?>>de 6 a 12 meses</option> 
	                    <option value="12|18" <?=($_REQUEST['buscaIdadeGado']=='12|18')?'selected="selected"':'';?>>de 12 a 18 meses</option> 
	                    <option value="18|24" <?=($_REQUEST['buscaIdadeGado']=='18|24')?'selected="selected"':'';?>>de 18 a 24 meses</option> 
	                    <option value="24|30" <?=($_REQUEST['buscaIdadeGado']=='24|30')?'selected="selected"':'';?>>de 24 a 30 meses</option> 
	                    <option value="30|36" <?=($_REQUEST['buscaIdadeGado']=='30|36')?'selected="selected"':'';?>>de 30 a 36 meses</option> 
                        <option value="36|48" <?=($_REQUEST['buscaIdadeGado']=='36|48')?'selected="selected"':'';?>>de 36 a 48 meses</option> 
	                    <option value="49" <?=($_REQUEST['buscaIdadeGado']=='49')?'selected="selected"':'';?>>acima de 48 meses</option>                 	
	                </select>
	            </div>            
	
	        </div>
	        
	        <div class="line">        	            
	        	<div class="campo campo6">
	            	<label for="buscaSexoGado">SEXO</label>
	                <br />
	                <select name="buscaSexoGado" id="buscaSexoGado">
	                    <option value="" <?=($_REQUEST['buscaSexoGado']=='')?'selected="selected"':'';?>>--</option>
						<option value="M" <?=($_REQUEST['buscaSexoGado']=='M')?'selected="selected"':'';?>>M</option>
	     				<option value="F" <?=($_REQUEST['buscaSexoGado']=='F')?'selected="selected"':'';?>>F</option>             	
	                </select>
	            </div>
	            <div class="campo campo7">
	            	<label for="buscaFaixaPrecoGado">VALOR</label>
	                <br />
	                <select name="buscaFaixaPrecoGado" id="buscaFaixaPrecoGado">
						<option value="" <?=($_REQUEST['buscaFaixaPrecoGado']=='')?'selected="selected"':'';?>>--</option>                	
	                    <option value="1|100" <?=($_REQUEST['buscaFaixaPrecoGado']=='1|100')?'selected="selected"':'';?>>de R$1,00 até R$100,00</option> 
	                    <option value="101|300" <?=($_REQUEST['buscaFaixaPrecoGado']=='101|300')?'selected="selected"':'';?>>de R$101,00 até R$300,00</option> 
	                    <option value="301|500" <?=($_REQUEST['buscaFaixaPrecoGado']=='301|500')?'selected="selected"':'';?>>de R$301,00 até R$500,00</option> 
	                    <option value="501|1000" <?=($_REQUEST['buscaFaixaPrecoGado']=='501|1000')?'selected="selected"':'';?>>de R$501,00 até R$1.000,00</option> 
	                    <option value="1001|3000" <?=($_REQUEST['buscaFaixaPrecoGado']=='1001|3000')?'selected="selected"':'';?>>de R$1.001,00 até R$3.000,00</option> 
	                    <option value="3001|10000" <?=($_REQUEST['buscaFaixaPrecoGado']=='3001|10000')?'selected="selected"':'';?>>de R$3.001,00 até R$10.000,00</option> 
	                    <option value="10001" <?=($_REQUEST['buscaFaixaPrecoGado']=='10001')?'selected="selected"':'';?>>acima de R$10.000,00</option>  	
	                </select>
	            </div>
	            <div class="campo campo8">
	            	<label for="buscaFinalidadeGado">FINALIDADE</label>
	                <br />
	                <select name="buscaFinalidadeGado" id="buscaFinalidadeGado">
	                	<option value="" <?=($_REQUEST['buscaFinalidadeGado']=='')?'selected="selected"':'';?>>--</option>
	                    <option value="CORTE" <?=($_REQUEST['buscaFinalidadeGado']=='CORTE')?'selected="selected"':'';?>>Corte</option>   
	                    <option value="CRIA" <?=($_REQUEST['buscaFinalidadeGado']=='CRIA')?'selected="selected"':'';?>>Cria</option>   
	                    <option value="ESPORTE" <?=($_REQUEST['buscaFinalidadeGado']=='ESPORTE')?'selected="selected"':'';?>>Esporte</option>   
	                    <option value="TRABALHO" <?=($_REQUEST['buscaFinalidadeGado']=='TRABALHO')?'selected="selected"':'';?>>Trabalho</option> 
                        <option value="LEITE" <?=($_REQUEST['buscaFinalidadeGado']=='LEITE')?'selected="selected"':'';?>>Leite</option> 
                        <option value="CRIA/CORTE" <?=($_REQUEST['buscaFinalidadeGado']=='CRIA/CORTE')?'selected="selected"':'';?>>Cria/Corte</option>                	
	                </select>
	            </div>
                <div class="campo campo-link campo9">
				    <label for="">&nbsp;</label>
                    <br /><br />
                    <a href="javascript:;" id="show-endereco">Buscar por Endereço</a>
                    <a href="javascript:;" id="hide-endereco" style="display: none;">Esconder busca com Endereço</a>
                </div>
	            <div class="ultimo-campo campo14">
	            	<label for="">&nbsp;</label>
	                <br />
	                <input name="" type="submit" value="Buscar" class="buscar buscar-comum" style="position:relative; bottom:10px;" />
	            </div>
	        </div>
            
            <div class="line line-endereco">
            	<div class="campo campo10">
                    <input name="buscaTipoEnderecoGado" type="radio" style="width:auto;" value="1" onclick="verificaTipoEndereco(this.value);" /> Utilizar endereço atual
                    <br />
                    <? if (isset($_SESSION['ga']['id'])) { ?>
	                    <input name="buscaTipoEnderecoGado" type="radio" style="width:auto;" value="2" onclick="verificaTipoEndereco(this.value);" /> Utilizar endereço cadastrado
	                    <br />
                    <? } ?>
	                <input name="buscaTipoEnderecoGado" type="radio" style="width:auto;" value="3" onclick="verificaTipoEndereco(this.value);" /> Digitar um endereço
	            </div>
            	<div class="campo campo11">
	            	<label for="buscaEnderecoGado">Local:</label>
	                <br />
	                <input name="buscaEnderecoGado" type="text" id="buscaEnderecoGado" value="" readonly onblur="filtraLatLon();">
	            </div>
                <div class="campo campo12">
	            	<label for="buscaRaioGado">Raio de busca (km):</label>
	                <br />
	                <input type="text" name="buscaRaioGado" id="buscaRaioGado" value="" style="width:50px; text-align:center;">
	            </div>     
                <div class="ultimo-campo campo13">
	            	<label for="">&nbsp;</label>
	                <br />
	                <input name="" type="button" onclick="submitForm();" value="Buscar" class="buscar" style="position:relative; bottom:10px;"  />
	            </div>           
            </div>
        </form>
        <iframe id="ifrmMapaBusca" name="ifrmMapaBusca" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="0" height="0" src="ajax/mapa_busca.php" style="display: none;"></iframe>
        <input type="hidden" id="enderecoNavegador" value="" />
        <input type="hidden" id="enderecoCadastro" value="<?=$_SESSION['ga']['endereco'].','.$_SESSION['ga']['cidade'].','.$_SESSION['ga']['estado'];?>" />
	</div>
    
	<div class="leftbar">        	
        
        <div class="ads">
    	<?
    	foreach ($lateral_banner as $pub) {
    		echo '<a href="'.$pub->getUrl().'" onclick="incrementaClique('.$pub->getId().');" target="_blank">
                        <img src="images/parceiro/'.$pub->getArquivo().'" title="'.$pub->getNome().'"/>
                    </a>';
    	}
		?>
        </div>
        
        <div class="chamada-anunciar">
        	<a href="login.php" class="classTitle botao" title="Anuncie seu Gado ou <br />Produto Agrícola <strong>Aqui</strong>!">
                <img src="images/topo-anuncie.png" />Anuncie Aqui!
            </a>
        </div>
        
        <div class="resumo-produtos">
        	<h4>Veja também</h4>
			<?
        		foreach($produtos_busca_gado as $produto) {
        			$anunciante = $anunciantecontrol->getAnunciante($produto->getId_anunciante());
        			echo '<div class="item">
				                <a href="produto.php?id='.$produto->getId().'" >
				                    <div class="imagem">
				                        <img src="images/produto/'.current($produto->getImagens()).'" />
				                    </div>
				                    <div class="info">
				                        <h1>'.$produto->getNome().'</h1>
				                        <br />
				                        Peso: <strong>'.$produto->getPeso().' Kg</strong><br />
				                        Estado: <strong>'.$anunciante->getEstado().'</strong><br />
				                        Valor: <span>R$ '.number_format($produto->getValor(), 2, ',', '.').'</span><br />                    
				                    </div>
				                    <div class="botao">
				                        mais informações
				                    </div>
				                </a>
				            </div>';
        		}
        		unset($produtos_busca_gado, $produto);
			?>
        </div>
        
        <div class="facebook">
        	<div class="fb-like" data-href="https://www.facebook.com/gadoaqui" data-width="200" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
        </div>
    </div><!-- //leftbar -->
    
    <div class="rightbar">
    	<h1>GADO AQUI</h1>
        
        <div class="paginacao">
			<ul>
			<?
				if ($busca) {
					$quant_pg = ceil($count_busca/24);
					
					$max_links = 4;// número máximo de links da paginação: na verdade o total será cinco 4+1=5
					
					if (!isset($_REQUEST['p']) || $_REQUEST['p'] == '')
						$sel = 1;
					else
						$sel = $_REQUEST['p'];
					
					if ($sel > 1) {
						echo '<li class="arrow"><a href="gadoaqui.php?buscaCategoriaGado='.$_REQUEST['buscaCategoriaGado'].'&buscaEstadoGado='.$_REQUEST['buscaEstadoGado'].'
								&buscaQuantidadeGado='.$_REQUEST['buscaQuantidadeGado'].'&buscaFaixaPrecoGado='.$_REQUEST['buscaFaixaPrecoGado'].'&p='.($sel-1).'">
								<img src="images/previous.png" /></a></li>';
					}
		
					$links_laterais = ceil($max_links / 2);
					
					$inicio = $sel - $links_laterais;
					$limite = $sel + $links_laterais;
	
					for ($i = $inicio; $i <= $limite; $i++) {
						if ($i == $sel) {
							echo ' <li class="selected"><a href="javascript:;">' . $i . '</a></li> ';
						} else {
							if ($i >= 1 && $i <= $quant_pg) {
								echo ' <li><a href="gadoaqui.php?buscaCategoriaGado='.$_REQUEST['buscaCategoriaGado'].'&buscaEstadoGado='.$_REQUEST['buscaEstadoGado'].'
								&buscaQuantidadeGado='.$_REQUEST['buscaQuantidadeGado'].'&buscaFaixaPrecoGado='.$_REQUEST['buscaFaixaPrecoGado'].'&p='.$i.'">' . $i . '</a></li> ';
							}
						}
					}
	
					if ($sel < ($quant_pg)) {
						echo '<li class="arrow"><a href="gadoaqui.php?buscaCategoriaGado='.$_REQUEST['buscaCategoriaGado'].'&buscaEstadoGado='.$_REQUEST['buscaEstadoGado'].'
								&buscaQuantidadeGado='.$_REQUEST['buscaQuantidadeGado'].'&buscaFaixaPrecoGado='.$_REQUEST['buscaFaixaPrecoGado'].'&p='.($sel-1).'">
								<img src="images/next.png" /></a></li>';
					}
				}
				
				//unset($_REQUEST, $busca, $count_busca);
			?>
			</ul>
		</div>
        
        <? if (count($full_banner) > 0) { ?>
			<div class="super-banner">
				<a href="<?=current($full_banner)->getUrl();?>" onclick="incrementaClique(<?=current($full_banner)->getId();?>);" target="_blank">
					<img src="images/parceiro/<?=current($full_banner)->getArquivo();?>" title="<?=current($full_banner)->getNome();?>"/>
				</a>
			</div>
        <? } ?>
        
        <?	$i = 1;
			foreach ($busca as $gado) {
				$categoria_gado = $categoriacontrol->getCategoria($gado->getId_categoria());
				$categoria_gado = $categoria_gado->getNome();
				
				$anunciante = $anunciantecontrol->getAnunciante($gado->getId_anunciante());
				
		        echo '<div class="item">
				            <a href="anuncio.php?id='.$gado->getId().'">
				                <div class="imagem">
				                    <img src="images/gado/'.current($gado->getImagens()).'" />
				                </div>
				                <div class="info">
									<table width="100%" border="0">
										<tr>
											<td><h5>'.$categoria_gado.'</h5>
											<h3>'.$gado->getRaca().'</h3></td>
											<td><strong>Era</strong><br />'.$gado->getIdade().' meses</td>
											<td><strong>Valor</strong><br /><span class="valor">R$ '.number_format($gado->getValor_kg(), 2, ',', '.').' / Kg</span></td>
											<td><strong>Anunciante</strong><br />'.$anunciante->getNome().' '.$anunciante->getSobrenome().'<br /><br />'.$gado->getCidade().'<br />'.$gado->getEstado().'</td>
										</tr>
									</table>
				                </div>
				            </a>
				        </div>';
						/*if ($i == 5) { 
							echo "<div class='clear'></div>";
							$i = 1;
						} else
							$i++;*/
        	}
		?>
        
		<div class="paginacao">
			<ul>
			<?
				if ($busca) {
					$quant_pg = ceil($count_busca/24);
					
					$max_links = 4;// número máximo de links da paginação: na verdade o total será cinco 4+1=5
					
					if (!isset($_REQUEST['p']) || $_REQUEST['p'] == '')
						$sel = 1;
					else
						$sel = $_REQUEST['p'];
					
					if ($sel > 1) {
						echo '<li class="arrow"><a href="gadoaqui.php?buscaCategoriaGado='.$_REQUEST['buscaCategoriaGado'].'&buscaEstadoGado='.$_REQUEST['buscaEstadoGado'].'
								&buscaQuantidadeGado='.$_REQUEST['buscaQuantidadeGado'].'&buscaFaixaPrecoGado='.$_REQUEST['buscaFaixaPrecoGado'].'&p='.($sel-1).'">
								<img src="images/previous.png" /></a></li>';
					}
		
					$links_laterais = ceil($max_links / 2);
					
					$inicio = $sel - $links_laterais;
					$limite = $sel + $links_laterais;
	
					for ($i = $inicio; $i <= $limite; $i++) {
						if ($i == $sel) {
							echo ' <li class="selected"><a href="javascript:;">' . $i . '</a></li> ';
						} else {
							if ($i >= 1 && $i <= $quant_pg) {
								echo ' <li><a href="gadoaqui.php?buscaCategoriaGado='.$_REQUEST['buscaCategoriaGado'].'&buscaEstadoGado='.$_REQUEST['buscaEstadoGado'].'
								&buscaQuantidadeGado='.$_REQUEST['buscaQuantidadeGado'].'&buscaFaixaPrecoGado='.$_REQUEST['buscaFaixaPrecoGado'].'&p='.$i.'">' . $i . '</a></li> ';
							}
						}
					}
	
					if ($sel < ($quant_pg)) {
						echo '<li class="arrow"><a href="gadoaqui.php?buscaCategoriaGado='.$_REQUEST['buscaCategoriaGado'].'&buscaEstadoGado='.$_REQUEST['buscaEstadoGado'].'
								&buscaQuantidadeGado='.$_REQUEST['buscaQuantidadeGado'].'&buscaFaixaPrecoGado='.$_REQUEST['buscaFaixaPrecoGado'].'&p='.($sel-1).'">
								<img src="images/next.png" /></a></li>';
					}
				}
				
				unset($_REQUEST, $busca, $count_busca);
			?>
			</ul>
		</div>
        
    </div><!-- //rightbar -->
</div>
	
<?php include "footer.php"; ?>