<?php $PAGE = "ANÚNCIOS"; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<?php include "pacotes/work/work_busca_produto.php"; ?>
<div class="anuncios anuncios-gados">
	<div class="leftbar">
    
    	<div class="busca-simples-gado">
            <img src="images/search.png" class="icon-search" /><h3>BUSCA</h3>
            <div class="box">
            	<form action="produtos.php" method="REQUEST" onsubmit="($('#buscaNomeProduto').val()=='PALAVRAS CHAVE')?$('#buscaNomeProduto').val(''):true;">
            		<input id="buscaNomeProduto" name="buscaNomeProduto" type="text" value="<?=($_REQUEST['buscaNomeProduto'])?$_REQUEST['buscaNomeProduto']:'PALAVRAS CHAVE';?>" onfocus="clearIt(this)" onblur="setIt(this)" />
                    <br />
                    <select id="buscaEstadoProduto" name="buscaEstadoProduto">
                        <option value="" selected="selected">ESTADO</option> 
                        <?
							foreach($ufs as $uf) {
								$sel = '';
								if ($uf['sigla'] == $_REQUEST['buscaEstadoProduto'])
									$sel = 'selected="selected"';
								echo '<option value="'.$uf['sigla'].'" '.$sel.'>'.$uf['sigla'].'</option>';
	               			}
	               			unset($uf, $ufs);
				   		?>                       	
                    </select>
                    <br />
                    <select id="buscaValorProduto" name="buscaValorProduto">
                        <option value="" <?=($_REQUEST['buscaValorProduto']=='')?'selected="selected"':'';?>>FAIXA DE PREÇO</option>                	
	                    <option value="1|100" <?=($_REQUEST['buscaValorProduto']=='1|100')?'selected="selected"':'';?>>de R$1,00 até R$100,00</option> 
	                    <option value="101|300" <?=($_REQUEST['buscaValorProduto']=='101|300')?'selected="selected"':'';?>>de R$101,00 até R$300,00</option> 
	                    <option value="301|500" <?=($_REQUEST['buscaValorProduto']=='301|500')?'selected="selected"':'';?>>de R$301,00 até R$500,00</option> 
	                    <option value="501|1000" <?=($_REQUEST['buscaValorProduto']=='501|1000')?'selected="selected"':'';?>>de R$501,00 até R$1.000,00</option> 
	                    <option value="1001|3000" <?=($_REQUEST['buscaValorProduto']=='1001|3000')?'selected="selected"':'';?>>de R$1.001,00 até R$3.000,00</option> 
	                    <option value="3001|10000" <?=($_REQUEST['buscaValorProduto']=='3001|10000')?'selected="selected"':'';?>>de R$3.001,00 até R$10.000,00</option> 
	                    <option value="10001" <?=($_REQUEST['buscaValorProduto']=='10001')?'selected="selected"':'';?>>acima de R$10.000,00</option>             	
                    </select>
                    <br />
                    <input name="" type="submit" value="Buscar" class="buscar" />
            	</form>
				<br />
                <!--<a href="javascript:;">
                    BUSCA DETALHADA
                </a>-->
            </div>
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
        
        <div class="chamada-anunciar">
        	<a href="login.php" class="classTitle botao" title="Anuncie seu Gado ou <br />Produto Agrícola <strong>Aqui</strong>!">
                <img src="images/topo-anuncie.png" />Anuncie Aqui!
            </a>
        </div>
        
        <div class="resumo-produtos">
        	<h4>Veja também</h4>
        	<?
        		foreach($gados_busca_produto as $gado) {
        			$categoria_gado = $categoriacontrol->getCategoria($gado->getId_categoria());
					$categoria_gado = $categoria_gado->getNome();
        			echo '<div class="item">
				                <a href="anuncio.php?id='.$gado->getId().'" >
				                    <div class="imagem">
				                        <img src="images/gado/'.current($gado->getImagens()).'" />
				                    </div>
				                    <div class="info">
				                        <h1>'.$gado->getNome().'</h1>
				                        <br />
				                        Tipo: <strong>'.$categoria_gado.'</strong><br />
				                        Qtd: <strong>'.$gado->getQuantidade().'</strong><br />
				                        Valor: <span>R$ '.number_format($gado->getValor_kg(), 2, ',', '.').' / Kg</span><br />                    
				                    </div>
				                    <div class="botao">
				                        mais informações
				                    </div>
				                </a>
				            </div>';
        		}
        		unset($gados_busca_produto, $gado);
			?>
        </div>
        
        <div class="facebook">
        	<div class="fb-like" data-href="https://www.facebook.com/gadoaqui" data-width="200" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
        </div>
    </div><!-- //leftbar -->
    
    <div class="rightbar">
    	<h1>PRODUTOS</h1>
        <div class="busca-simples-gado busca-simples-gado-rightbar">
            <img src="images/search.png" class="icon-search" /><h3>BUSCA</h3>
            <div class="box">
            	<form action="produtos.php" method="REQUEST" onsubmit="($('#buscaNomeProduto').val()=='PALAVRAS CHAVE')?$('#buscaNomeProduto').val(''):true;">
            		<input id="buscaNomeProduto" name="buscaNomeProduto" type="text" value="<?=($_REQUEST['buscaNomeProduto'])?$_REQUEST['buscaNomeProduto']:'PALAVRAS CHAVE';?>" onfocus="clearIt(this)" onblur="setIt(this)" class="campo1" />
                    
                    <select id="buscaEstadoProduto" name="buscaEstadoProduto" class="campo2">
                        <option value="" selected="selected">ESTADO</option> 
                        <?
							foreach($ufs as $uf) {
								$sel = '';
								if ($uf['sigla'] == $_REQUEST['buscaEstadoProduto'])
									$sel = 'selected="selected"';
								echo '<option value="'.$uf['sigla'].'" '.$sel.'>'.$uf['sigla'].'</option>';
	               			}
	               			unset($uf, $ufs);
				   		?>                       	
                    </select>
                    
                    <select id="buscaValorProduto" name="buscaValorProduto" class="campo3">
                        <option value="" <?=($_REQUEST['buscaValorProduto']=='')?'selected="selected"':'';?>>FAIXA DE PREÇO</option>                	
	                    <option value="1|100" <?=($_REQUEST['buscaValorProduto']=='1|100')?'selected="selected"':'';?>>de R$1,00 até R$100,00</option> 
	                    <option value="101|300" <?=($_REQUEST['buscaValorProduto']=='101|300')?'selected="selected"':'';?>>de R$101,00 até R$300,00</option> 
	                    <option value="301|500" <?=($_REQUEST['buscaValorProduto']=='301|500')?'selected="selected"':'';?>>de R$301,00 até R$500,00</option> 
	                    <option value="501|1000" <?=($_REQUEST['buscaValorProduto']=='501|1000')?'selected="selected"':'';?>>de R$501,00 até R$1.000,00</option> 
	                    <option value="1001|3000" <?=($_REQUEST['buscaValorProduto']=='1001|3000')?'selected="selected"':'';?>>de R$1.001,00 até R$3.000,00</option> 
	                    <option value="3001|10000" <?=($_REQUEST['buscaValorProduto']=='3001|10000')?'selected="selected"':'';?>>de R$3.001,00 até R$10.000,00</option> 
	                    <option value="10001" <?=($_REQUEST['buscaValorProduto']=='10001')?'selected="selected"':'';?>>acima de R$10.000,00</option>             	
                    </select>
                    <br />
                    <input name="" type="submit" value="Buscar" class="buscar" />
            	</form>
				<br />
                <!--<a href="javascript:;">
                    BUSCA DETALHADA
                </a>-->
            </div>
        </div>
        
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
						echo '<li class="arrow"><a href="produtos.php?buscaNomeProduto='.$_REQUEST['buscaNomeProduto'].'&buscaEstadoProduto='.$_REQUEST['buscaEstadoProduto'].'
								&buscaValorProduto='.$_REQUEST['buscaValorProduto'].'&p='.($sel-1).'">
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
								echo ' <li><a href="produtos.php?buscaNomeProduto='.$_REQUEST['buscaNomeProduto'].'&buscaEstadoProduto='.$_REQUEST['buscaEstadoProduto'].'
								&buscaValorProduto='.$_REQUEST['buscaValorProduto'].'&p='.$i.'">' . $i . '</a></li> ';
							}
						}
					}
	
					if ($sel < ($quant_pg)) {
						echo '<li class="arrow"><a href="produtos.php?buscaNomeProduto='.$_REQUEST['buscaNomeProduto'].'&buscaEstadoProduto='.$_REQUEST['buscaEstadoProduto'].'
								&buscaValorProduto='.$_REQUEST['buscaValorProduto'].'&p='.($sel-1).'">
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
        <?
			$i = 1;
        	foreach($busca as $produto) {
      			$anunciante = $anunciantecontrol->getAnunciante($produto->getId_anunciante());
        		echo '<div class="item">
				            <a href="produto.php?id='.$produto->getId().'">
				                <div class="imagem">
				                    <img src="images/produto/'.current($produto->getImagens()).'" />
				                </div>
				                <div class="info">
									<table width="100%" border="0">
										<tr>
											<td><h4>'.$produto->getNome().'</h4></td>
											<td><strong>Peso</strong><br />'.$produto->getPeso().'</td>
											<td><strong>Valor</strong><br /><span class="valor">R$ '.number_format($produto->getValor(), 2, ',', '.').'</span></td>
											<td><strong>Anunciante</strong><br />Eduardo Alessi<br /><br />Campo Grande<br />MS</td>
										</tr>
									</table>
				                    <!--<h5>'.$produto->getNome().'</h5>
				                    <div class="coluna">
				                        Peso: '.$produto->getPeso().' Kg<br />
				                        Estado: '.$anunciante->getEstado().'<br />                        
				                    </div>
				                    <div class="valor">
				                    	R$ '.number_format($produto->getValor(), 2, ',', '.').'
				                    <div class="botao">
				                        mais informações
				                    </div>-->
				                </div>
				            </a>
				        </div>';
						if ($i == 5) { 
							echo "<div class='clear'></div>";
							$i = 1;
						} else
							$i++;
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
						echo '<li class="arrow"><a href="produtos.php?buscaNomeProduto='.$_REQUEST['buscaNomeProduto'].'&buscaEstadoProduto='.$_REQUEST['buscaEstadoProduto'].'
								&buscaValorProduto='.$_REQUEST['buscaValorProduto'].'&p='.($sel-1).'">
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
								echo ' <li><a href="produtos.php?buscaNomeProduto='.$_REQUEST['buscaNomeProduto'].'&buscaEstadoProduto='.$_REQUEST['buscaEstadoProduto'].'
								&buscaValorProduto='.$_REQUEST['buscaValorProduto'].'&p='.$i.'">' . $i . '</a></li> ';
							}
						}
					}
	
					if ($sel < ($quant_pg)) {
						echo '<li class="arrow"><a href="produtos.php?buscaNomeProduto='.$_REQUEST['buscaNomeProduto'].'&buscaEstadoProduto='.$_REQUEST['buscaEstadoProduto'].'
								&buscaValorProduto='.$_REQUEST['buscaValorProduto'].'&p='.($sel-1).'">
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