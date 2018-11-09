<?php $PAGE = "CONTATO"; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<div class="anuncios anuncios-gados">	
    
	<script type="text/javascript">
		function enviaContato() {
			if ($('#nomeContato').val() != '' && $('#telefoneContato').val() != '' && $('#cidadeEstadoContato').val() != '' && 
				$('#emailContato').val() != '' && $('#assuntoContato').val() != '' && $('#msgContato').val() != '') {
					
					$('.loading').show();
					
					$.post("ajax/enviaContato.php", { nome:$('#nomeContato').val(), telefone:$('#telefoneContato').val(), 
														cidade_estado:$('#cidadeEstadoContato').val(), email:$('#emailContato').val(), 
														assunto:$('#assuntoContato').val(), msg:$('#msgContato').val() }, 
						function(data){
							$('.loading').hide();
							if (data) {
								location.href = 'index.php';
							} else {
								alert('Ocorreu algum erro ao enviar o contato');
							}
					},'json');
			} else {
				alert('Todos os campos são obrigatórios!');
			}
		}
		
		$(function(){
			$('#telefoneContato').mask('(99) 9999-9999');
		});
	</script>
	
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
				include "pacotes/work/work_busca_gado.php";
				$cont = 1;
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
           			if ($cont == 2)
           				break;
       				
       				$cont++;
        		}
        		unset($produtos_busca_gado, $produto, $cont, $anunciante, $anunciantecontrol);

             	include "pacotes/work/work_busca_produto.php";
             	$cont = 1;
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
           			if ($cont == 2)
           				break;
       				
       				$cont++;
        		}
        		unset($gados_busca_produto, $gado, $cont);
			?>
        </div>
        
        <div class="facebook">
        	<div class="fb-like" data-href="https://www.facebook.com/omicareteiro" data-width="200" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
        </div>
    </div><!-- //leftbar -->
    
    <div class="rightbar">
    	<h1>FALE CONOSCO</h1>
        
        <div class="texto">
        	<p>Você pode entrar em contato conosco através do telefone (67) 9824.4580, do e-mail contato@gadoaqui.com.br ou utilizando o formulário de contato logo abaixo.<br />O prazo médio para o retorno do seu contato é de 1 dia útil.</p>
			
            <div class="contato-form">
                <div class="line">
                    <div class="campo" style="width:60%;">
                        <label for="nomeContato">Nome</label>
                        <br />
                        <input name="nomeContato" id="nomeContato" type="text" />
                    </div>
                    <div class="campo ultimo-campo" style="width:33%;">
                        <label for="telefoneContato">Telefone</label>
                        <br />
                        <input name="telefoneContato" id="telefoneContato" type="text" />
                    </div>
                </div>
                <div class="line">
                    <div class="campo" style="width:60%;">
                        <label for="cidadeEstadoContato">Cidade / Estado</label>
                        <br />
                        <input name="cidadeEstadoContato" id="cidadeEstadoContato" type="text" />
                    </div>  
                    <div class="campo ultimo-campo" style="width:33%;">
                        <label for="emailContato">E-mail</label>
                        <br />
                        <input name="emailContato" id="emailContato" type="text" />
                    </div>                                  
                </div>
                <div class="line">
                    <div class="campo" style="width:60%;">
                        <label for="assuntoContato">Assunto</label>
                        <br />
                        <select name="assuntoContato" id="assuntoContato" >
                          <option value="Dúvida">Dúvida</option>
                          <option value="Sugestão">Sugestão</option>
                          <option value="Orçamento">Orçamento</option>
                          <option value="Reclamação">Reclamação</option>
                          <option value="Outro Assunto">Outro Assunto</option>
                        </select>
                    </div>
                </div>
                <div class="line">
                    <textarea name="msgContato" id="msgContato" cols="" rows=""></textarea>
                </div>
                <div class="line">
                    <div class="campo ultimo-campo" style="width:30%;">
                        <input name="" type="button" onclick="enviaContato();" value="Enviar Contato" />
                    </div>
            	</div>
            </div>
        </div>
        
        
    </div><!-- //rightbar -->
</div>

<?php include "footer.php"; ?>