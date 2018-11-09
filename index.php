<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<link href="css/index.css" rel="stylesheet" type="text/css" />
<section class="destaques-index" data-speed="4" data-type="background">
	<!--<div class="content">-->
        <div class="busca-simples-gado busca-index">
            <img src="images/search.png" class="icon-search" /><h3>BUSCA</h3>
            <div class="box">
            	<form action="gadoaqui.php" method="REQUEST">
	                <select id="buscaCategoriaGado" name="buscaCategoriaGado">
	                    <option value="" selected="selected">TIPO</option> 
	                    <?
							foreach($categorias as $categoria) {
								echo '<option value="'.$categoria->getId().'">'.$categoria->getNome().'</option>';
	               			}
	               			unset($categoria);
				   		?>               	
	                </select>
	                <br />
	                <select id="buscaEstadoGado" name="buscaEstadoGado">
	                    <option value="" selected="selected">ESTADO</option> 
	                	<?
							foreach($ufs as $uf) {
								echo '<option value="'.$uf['sigla'].'">'.$uf['sigla'].'</option>';
	               			}
	               			unset($uf);
				   		?>             	
	                </select>
	                <br />
	                <select id="buscaFaixaPrecoGado" name="buscaFaixaPrecoGado">
	                    <option value="" selected="selected">FAIXA DE PREÇO</option>                	
	                    <option value="1|100">de R$1,00 até R$100,00</option> 
	                    <option value="101|300">de R$101,00 até R$300,00</option> 
	                    <option value="301|500">de R$301,00 até R$500,00</option> 
	                    <option value="501|1000">de R$501,00 até R$1.000,00</option> 
	                    <option value="1001|3000">de R$1.001,00 até R$3.000,00</option> 
	                    <option value="3001|10000">de R$3.001,00 até R$10.000,00</option> 
	                    <option value="10001">acima de R$10.000,00</option> 
	                </select>
	                <br />
	                <select name="buscaSexoGado" id="buscaSexoGado">
	                    <option value="">SEXO</option>
						<option value="M">M</option>
	     				<option value="F">F</option>             	
	                </select>
	                <br />
	                <select name="buscaFinalidadeGado" id="buscaFinalidadeGado">
	                	<option value="">FINALIDADE</option>
	                    <option value="CORTE">Corte</option>   
	                    <option value="CRIA">Cria</option>   
	                    <option value="ESPORTE">Esporte</option>   
	                    <option value="TRABALHO">Trabalho</option> 
                        <option value="LEITE">Leite</option> 
                        <option value="CRIA/CORTE">Cria/Corte</option>                	
	                </select>
	                <br />
	                <select name="buscaIdadeGado" id="buscaIdadeGado">
	                    <option value="">ERA</option>                	
	                    <option value="0|6">de 0 a 6 meses</option> 
	                    <option value="6|12">de 6 a 12 meses</option> 
	                    <option value="12|18">de 12 a 18 meses</option> 
	                    <option value="18|24">de 18 a 24 meses</option> 
	                    <option value="24|30">de 24 a 30 meses</option> 
	                    <option value="30|36">de 30 a 36 meses</option> 
                        <option value="36|48">de 36 a 48 meses</option> 
	                    <option value="49">acima de 48 meses</option>                 	
	                </select>
	                <br />
	                <input name="" type="submit" value="Buscar" class="buscar" />
                </form>
                <br />
                <a href="busca.php">
                    BUSCA DETALHADA
                </a>
            </div>
        </div>
        
        <div class="destaques">
            <h2>ÚLTIMOS ANÚNCIOS</h2>
            <?
				foreach ($gados_ultimos as $gado) {
					$categoria_gado = $categoriacontrol->getCategoria($gado->getId_categoria());
					$categoria_gado = $categoria_gado->getNome();
					
					$sexo = ($gado->getSexo() == 'M')?'MACHO':'FÊMEA';
					
					echo '<div class="item">
					        	<a href="anuncio.php?id='.$gado->getId().'">
					                <div class="imagem">
					                    <img src="images/gado/'.current($gado->getImagens()).'" />
					                </div>
					                <div class="info">
					                    <!--<h1>Lote '.$gado->getId().' - '.$categoria_gado.'</h1>-->
										<!--<h1>'.$categoria_gado.'</h1>-->
										<h1>'.$gado->getRaca().' / '.$sexo.'</h1>
					                    <br />
					                    <!--Quantidade: <strong>'.$gado->getQuantidade().'</strong><br />
					                    Estado: <strong>'.$gado->getEstado().'</strong><br />-->
					                    <span>R$ '.number_format($gado->getValor_kg(), 2, ',', '.').'</span><br />                    
					                </div>
					                <!--<div class="botao">
					                    mais informações
					                </div>-->
					            </a>
					        </div>';
				}
				unset($categoria_gado, $gado);
			
				if (count($gados_ultimos) < 14) {
					for ($x = count($gados_ultimos); $x < 14; $x++) {
						echo '<div class="item">
				            	<a href="anunciar.php" >
				                    <div class="imagem">
				                        <img src="images/item-anunciar.jpg" />
				                    </div>
				                    <div class="info">
				                        <h1>Seu Gado</h1>
				                        <br />
				                        Anuncie no<br /><strong>Gado Aqui</strong>!                
				                    </div>
				                    <!--<div class="botao">
				                        anuncie agora
				                    </div>-->
				                </a>
				            </div>';
					}
				}
				
				unset($gados_ultimos);
			?>  
            <div class="line botao-busca">
				<a href="busca.php">BUSCAR GADO</a>    
            </div>
        </div>
    <!--</div>-->
</section>
<div class="line index index-superior">
	<div class="valores valores-superior">
        <table width="100%" border="0">
        <?
            $arr = array();
            foreach($cotacoes as $cot) {
                $arr[] = $cot->getValor();
            }
        ?>
            <tr class="title-valores">
                <td class="center-valores">Categoria</td>
                <td class="center-valores">Valor (R$)</td>
            </tr>
            <tr>
                <td>Arroba Boi Gordo</td>
                <td class="center-valores"><?=number_format($arr[0], 2, ",", ".");?></td>
            </tr>
            <tr>
                <td>Arroba Vaca Gorda</td>
                <td class="center-valores"><?=number_format($arr[1], 2, ",", ".");?></td>
            </tr>
            <tr>
                <td>Vaca Boiadeira</td>
                <td class="center-valores"><?=number_format($arr[2], 2, ",", ".");?></td>
            </tr>
            <tr>
                <td>Macho Desmama</td>
                <td class="center-valores"><?=number_format($arr[3], 2, ",", ".");?></td>
            </tr>
            <tr>
                <td>Fêmea Desmama</td>
                <td class="center-valores"><?=number_format($arr[4], 2, ",", ".");?></td>
            </tr>
        </table>

    </div>                       
</div>
<div class="content">
	<div class="index">
    
        <table border="0" style="width:100%;">
            <tr>
                <td class="primeira-coluna">
                    <div class="title">
                        <h2>OUTROS ANÚNCIOS</h2>
                    </div>
                    <div class="ultimos-anuncios line">
                	<?
						$i = 1;
						foreach ($gados_outros as $gado) {
							$categoria_gado = $categoriacontrol->getCategoria($gado->getId_categoria());
							$categoria_gado = $categoria_gado->getNome();
							
							$sexo = ($gado->getSexo() == 'M')?'MACHO':'FÊMEA';
							
       						echo '<div class="item" title="'.$gado->getNome().'">
			                            <a href="anuncio.php?id='.$gado->getId().'">
			                                <div class="imagem">
			                                    <!--<div class="lote">
			                                        LOTE '.$gado->getId().'
			                                    </div>-->
			                                    <img src="images/gado/'.current($gado->getImagens()).'" />
			                                </div>
			                                <div class="info">
			                                    <!--<h5>'.$categoria_gado.'</h5>-->
												<h5>'.$gado->getRaca().' / '.$sexo.'</h5>
			                                    <!--<div class="coluna">
			                                        Tipo: '.$categoria_gado.'<br />
			                                        Qtd.: '.$gado->getQuantidade().'<br />                        
			                                    </div>
			                                    <div class="coluna coluna2">                                                            
			                                        Valor:<br /><span>R$ '.number_format($gado->getValor_kg(), 2, ',', '.').'</span>                                    
			                                    </div>-->
												<span>R$ '.number_format($gado->getValor_kg(), 2, ',', '.').'</span>
			                                    <!--<div class="botao">
			                                        mais informações
			                                    </div>-->
			                                </div>
			                            </a>
			                        </div>';
									if ($i == 7) { 
										echo "<div class='clear'></div>";
										$i = 1;
									} else
										$i++;																		
						}
						unset($categoria_gado, $gado);
						
						if (count($gados_outros) < 14) {
							for ($x = count($gados_outros); $x < 14; $x++) {
								echo '<div class="item">
				                            <a href="anunciar.php">
				                                <div class="imagem">
				                                    <img src="images/item-anunciar.jpg" />
				                                </div>
				                                <div class="info">
				                                    <h5>Seu Gado</h5>
				                                    <div class="coluna3">
				                                        Anuncie no <br /><strong>Gado Aqui</strong>!                       
				                                    </div>
				                                    <!--<div class="botao">
				                                        anuncie agora
				                                    </div>-->
				                                </div>
				                            </a>
				                        </div>';
							}
						}
						unset($gados_outros);
					?>
                    </div>
                    <? if (count($full_banner) > 0) { ?>
						<!--<div class="line line-publicidade">
							<div class="super-banner-index">
								<a href="<?=current($full_banner)->getUrl();?>" onclick="incrementaClique(<?=current($full_banner)->getId();?>);" target="_blank">
									<img src="images/parceiro/<?=current($full_banner)->getArquivo();?>" title="<?=current($full_banner)->getNome();?>"/>
								</a>
							</div>
							<div class="clear"></div>
						</div>-->
					<? } ?>
                    <div class="line produtos">
                    	<h2>ÚLTIMOS PRODUTOS</h2>
                        <div class="busca-produtos busca-index">
                            <img src="images/search-white.png" class="icon-search" /><h3>BUSCA</h3>
                            <div class="box">
                            	<form action="produtos.php" method="REQUEST" onsubmit="($('#buscaNomeProduto').val()=='PALAVRAS CHAVE')?$('#buscaNomeProduto').val(''):true;">
	                            	<div class="campo" style="width:26%;">
	                                	<input id="buscaNomeProduto" name="buscaNomeProduto" type="text" value="PALAVRAS CHAVE" onfocus="clearIt(this)" onblur="setIt(this)" />
	                                </div>
	                                <div class="campo" style="width:8%;">
	                                	<select id="buscaEstadoProduto" name="buscaEstadoProduto">
	                                        <option value="" selected="selected">ESTADO</option> 
		                                    <?
												foreach($ufs as $uf) {
													echo '<option value="'.$uf['sigla'].'">'.$uf['sigla'].'</option>';
						               			}
						               			unset($uf, $ufs);
									   		?>                       	
	                                    </select>
	                                </div>
	                                <div class="campo" style="width:20%;">
	                                	<select id="buscaCategoriaProduto" name="buscaCategoriaProduto">
	                                        <option value="Tipo">CATEGORIA</option>                	
	                                    </select>
	                                </div>
	                                <div class="campo" style="width:20%;">
	                                	<select id="buscaValorProduto" name="buscaValorProduto">
	                                        <option value="" selected="selected">VALOR</option> 
	                                        <option value="1|100">de R$1,00 até R$100,00</option> 
	                                        <option value="101|300">de R$101,00 até R$300,00</option> 
	                                        <option value="301|500">de R$301,00 até R$500,00</option> 
	                                        <option value="501|1000">de R$501,00 até R$1.000,00</option> 
	                                        <option value="1001|3000">de R$1.001,00 até R$3.000,00</option> 
	                                        <option value="3001|10000">de R$3.001,00 até R$10.000,00</option> 
	                                        <option value="10001">acima de R$10.000,00</option>                	
	                                    </select>
	                                </div>
	                                <div class="campo" style="width:15%;">
	                                	<input name="" type="submit" value="Buscar" class="buscar" />
	                                </div>
                                </form>
                            </div>
                        </div>        
                        
                        <div class="destaques-produtos">
                            <div class="destaques">
                            <?
								$i = 1;
								foreach ($produtos_ultimos as $produto) {
									$anunciante = $anunciantecontrol->getAnunciante($produto->getId_anunciante());
	                                echo '<div class="item">
			                                    <a href="produto.php?id='.$produto->getId().'" >
			                                        <div class="imagem">
			                                            <img src="images/produto/'.current($produto->getImagens()).'" />
			                                        </div>
			                                        <div class="info">
			                                            <h1>'.$produto->getNome().'</h1>
			                                            <br />
			                                            <!--Peso: <strong>'.$produto->getPeso().' Kg</strong><br />
			                                            Estado: <strong>'.$anunciante->getEstado().'</strong><br />-->
			                                            <span>R$ '.number_format($produto->getValor(), 2, ',', '.').'</span><br />                    
			                                        </div>
			                                        <!--<div class="botao">
			                                            mais informações
			                                        </div>-->
			                                    </a>
			                                </div>';
											if ($i == 7) { 
												echo "<div class='clear'></div>";
												$i = 1;
											} else
												$i++;
        						}
        						unset($produtos_ultimos, $produto, $anunciantecontrol, $anunciante);
							?>
                            </div>
                        </div>
                        
                    </div>
                    <div class="line botao-busca">
                        <a href="produtos.php">BUSCAR PRODUTOS</a>    
                    </div>
                </td>
                <td class="segunda-coluna">
                    <div class="line segunda-coluna-line" >
                        <div class="line-widgets">
                            <link href="css/widgets.css" rel="stylesheet" type="text/css" />
                            <div class="valores valores-inferior">
                                <table width="100%" border="0">
                             	<?
                             		$arr = array();
								    foreach($cotacoes as $cot) {
								    	$arr[] = $cot->getValor();
			               			}
		               			?>
                                    <tr class="title-valores">
                                        <td class="center-valores">Categoria</td>
                                        <td class="center-valores">Valor (R$)</td>
                                    </tr>
                                    <tr>
                                        <td>Arroba Boi Gordo</td>
                                        <td class="center-valores"><?=number_format($arr[0], 2, ",", ".");?></td>
                                    </tr>
                                    <tr>
                                        <td>Arroba Vaca Gorda</td>
                                        <td class="center-valores"><?=number_format($arr[1], 2, ",", ".");?></td>
                                    </tr>
                                    <tr>
                                        <td>Vaca Boiadeira</td>
                                        <td class="center-valores"><?=number_format($arr[2], 2, ",", ".");?></td>
                                    </tr>
                                    <tr>
                                        <td>Macho Desmama</td>
                                        <td class="center-valores"><?=number_format($arr[3], 2, ",", ".");?></td>
                                    </tr>
                                    <tr>
                                        <td>Fêmea Desmama</td>
                                        <td class="center-valores"><?=number_format($arr[4], 2, ",", ".");?></td>
                                    </tr>
                                </table>

                            </div>                                                        
                            
                            <div class="clima-tempo">       
                                <div id="cont_31e95c6ff8ede22f4db817d1b2a0dbfd">
                                	<span id="h_31e95c6ff8ede22f4db817d1b2a0dbfd"><a href="http://www.tempo.com/campo-grande-aeroporto.htm" target="_blank">Campo Grande - MS</a></span>
                                	<script type="text/javascript" src="http://www.tempo.com/wid_loader/31e95c6ff8ede22f4db817d1b2a0dbfd"></script>
                                </div>                     
                            </div>
                            
                            <div class="ads-index">
                            <?
                            	foreach ($lateral_banner as $pub) {
                            		echo '<a href="'.$pub->getUrl().'" onclick="incrementaClique('.$pub->getId().');" target="_blank">
			                                    <img src="images/parceiro/'.$pub->getArquivo().'" title="'.$pub->getNome().'"/>
			                                </a>';
                            	}
							?>
                            </div>
                            
                            <div class="chamada-anunciar">
                                <a href="anunciar.php" class="classTitle botao" title="Anuncie seu Gado ou Produto no Gado Aqui">
                                    <img src="images/topo-anuncie.png">Anuncie Aqui!
                                </a>
                            </div>
                            
                            <div class="fb-grande">
                            	<div class="fb-like" style="position:relative; margin:50px 0 0 0; float:right;" data-href="https://www.facebook.com/gadoaqui" data-width="347" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                            </div>
                            
                            <div class="fb-medio">
                            	<div class="fb-like" style="position:relative; margin:50px 0 0 0; float:right;" data-href="https://www.facebook.com/gadoaqui" data-width="217" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                            </div>
                            
                            <div class="fb-pequeno">
                            	<div class="fb-like" style="position:relative; margin:50px 0 0 0; float:right;" data-href="https://www.facebook.com/gadoaqui" data-width="137" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                            </div>
                            
                        </div>
                    </div>
                </td>
            </tr>
        </table>                     
        
    </div><!-- //index -->
</div><!-- //page -->

<?php include "footer.php"; ?>
