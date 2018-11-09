<?
	@session_start();
	if (!isset($_SESSION['ga']['id'])) {
		header('Location: login.php');
	}
?>
<?php $PAGE = "ANUNCIAR"; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<?php include "pacotes/work/work_edita_anuncio.php"; ?>
<div class="minha-conta">
	<div class="leftbar">
        <?php include "leftbar-acc.php"; ?>
    </div><!-- //leftbar -->
    
    <script type="text/javascript">
		function selecionaAnuncio(valor) {
			if (valor == 'p') {
				$('#cadastro-gado').hide();
				$('#cadastro-produto').show();
			} else {
				$('#cadastro-gado').show();
				$('#cadastro-produto').hide();
			}
		}
		
		function enviaContato() {
			if ($('#nomeAnuncio').val() != '' && $('#telefoneAnuncio').val() != '' && $('#emailAnuncio').val() != '' && 
				$('#estadoAnuncio').val() != '' && $('#enderecoAnuncio').val() != '') {
					$('.loading').show();
					$.post("ajax/enviaAnuncioGado.php", { nome:$('#nomeAnuncio').val(), telefone:$('#telefoneAnuncio').val(), 
														email:$('#emailAnuncio').val(), estado:$('#estadoAnuncio').val(), 
														endereco:$('#enderecoAnuncio').val(), id_anunciante:'<?=$_SESSION['ga']['id'];?>' }, 
						function(data){
							$('.loading').hide();
							if (data) {
								location.href = 'anunciar.php';
							} else {
								alert('Ocorreu algum erro ao enviar o contato');
							}
					},'json');
			} else {
				alert('Todos os campos são obrigatórios!');
			}
		}
		
		function cadastraGado() {
			if ($('#nomeGado').val() != '' && $('#valorKgGado').val() != '' && $('#racaGado').val() != '' && 
				$('#quantidadeGado').val() != '' && $('#sexoGado').val() != '' && 
			 	$('#idadeGado').val() != '' && $('#ufGado').val() != '' && $('#cidadeGado').val() != '' && $('#infosGado').val() != '' && 
		 	  	$('#enderecoGado').val() != '' && $('#latitudeGado').val() != '' && $('#longitudeGado').val() != '' && 
		   		$('#imgGado1').val() != '') {
		 	  		$('.loading').show();
					$.post("ajax/enviaAnuncioGado.php", { nome: $('#nomeGado').val(), valor_kg: $('#valorKgGado').val(), raca: $('#racaGado').val(), 
														quantidade: $('#quantidadeGado').val(), sexo: $('#sexoGado').val(), peso_medio: $('#pesoMedioGado').val(), 
														idade: $('#idadeGado').val(), estado: $('#ufGado').val(), cidade: $('#cidadeGado').val(), informacoes_gerais: $('#infosGado').val(), 
														id_anunciante:'<?=$_SESSION['ga']['id'];?>', endereco: $('#enderecoGado').val(), como_chegar: $('#comoChegarGado').val(), 
														id_categoria: $('#categoriaGado').val(), latitude: $('#latitudeGado').val(), longitude: $('#longitudeGado').val(),  
														finalidade: $('#finalidadeGado').val(), 
														img1: $('#imgGado1').val(), img2: $('#imgGado2').val(), 
														img3: $('#imgGado3').val(), img4: $('#imgGado4').val(), 
														video:$('#videoGado').val() }, 
						function(data){
							$('.loading').hide();
							if (data.msg) {
								alert(data.msg);
								location.href = 'anunciar.php';
							} else {
								alert(data.erro);
							}
					},'json');
			} else {
				alert('Todos os campos são obrigatórios!');
			}
		}
		
		function cadastraProduto() {
			if ($('#nome').val() != '' && $('#valor').val() != '' && 
				$('#estado').val() != '' && $('#informacoes_gerais').val() != '' && 
				$('#img1').val() != '') {
					$('.loading').show();
					$.post("ajax/enviaAnuncioProduto.php", { nome:$('#nome').val(), peso:$('#peso').val(), frete:$('#frete').val(), 
															valor:$('#valor').val(), estado:$('#estado').val(), 
															informacoes_gerais:$('#informacoes_gerais').val(),
															img1: $('#img1').val(), img2: $('#img2').val(), 
															img3: $('#img3').val(), img4: $('#img4').val(), 
															video:$('#video').val(), id_anunciante:'<?=$_SESSION['ga']['id'];?>' }, 
						function(data){
							$('.loading').hide();
							if (data.msg) {
								alert(data.msg);
								location.href = 'anunciar.php';
							} else {
								alert(data.erro);
							}
					},'json');
			} else {
				alert('Todos os campos são obrigatórios!');
			}
		}

		function editaProduto() {
			if ($('#nome').val() != '' && $('#peso').val() != '' && $('#valor').val() != '' && 
				$('#estado').val() != '' && $('#informacoes_gerais').val() != '' && 
				$('#img1').val() != '') {
					$('.loading').show();
					$.post("ajax/editaProduto.php", { id:$('#id').val(), nome:$('#nome').val(), peso:$('#peso').val(), frete:$('#frete').val(), 
														valor:$('#valor').val(), estado:$('#estado').val(), 
														informacoes_gerais:$('#informacoes_gerais').val(),
														img1: $('#img1').val(), img2: $('#img2').val(), 
														img3: $('#img3').val(), img4: $('#img4').val(), 
														video:$('#video').val(), dados_old: $('#dados_old').val() }, 
						function(data){
							$('.loading').hide();
							if (data.msg) {
								alert(data.msg);
								location.href = 'minhaconta.php';
							} else {
								alert(data.erro);
							}
					},'json');
			} else {
				alert('Todos os campos são obrigatórios!');
			}
		}

		function buscaCidade(uf) {
			$('.loading').show();
			$.get("ajax/buscaCidCorreio.php", { uf:uf }, 
				function(data){
					$('.loading').hide();
					$('#cidadeGado').html(data);
			});
		}

		function carregaVideo(){
			if ($('#video').val() != '' && $('#video').val() != 'LINK YOUTUBE') {
				var video = $('#video').val().split('=');
			 	if (video.length == 2) {
					$('#iframeVideo').attr('src', 'http://www.youtube.com/embed/' + video[1]);
					$('#video').val('http://www.youtube.com/embed/' + video[1]);
				}
			}
		}
		
		function carregaVideoGado(){
			if ($('#videoGado').val() != '' && $('#videoGado').val() != 'LINK YOUTUBE') {
				var video = $('#videoGado').val().split('=');
			 	if (video.length == 2) {
					$('#iframeVideoGado').attr('src', 'http://www.youtube.com/embed/' + video[1]);
					$('#videoGado').val('http://www.youtube.com/embed/' + video[1]);
				}
			}
		}

		$(function(){
			$("#frete").maskMoney();
			$("#valor").maskMoney();
			
			$("#valorKgGado").maskMoney();
			
			$('.number').numeric();
		});
	</script>
    
    <div class="rightbar anunciar">
    	<h1>ANUNCIAR NO GADO AQUI</h1>
        <div class="line line-pergunta">
        	<h4>O que gostaria de anunciar?</h4>
            <select name="" onchange="selecionaAnuncio(this.value);">
              	<option value="p">Produto</option>
              	<option value="g">Animal</option>
            </select>
      	</div>
        
       <!-- CADASTRAR PRODUTO -->
		<div id="cadastro-produto">
	        <div class="line">
	            <input type="hidden" id="id" name="id" value="<?=($produto)?$produto->getId():'';?>" />
	            <?
	            	if ($produto) {
						$imgs = $produto->getImagens();
		            	$prod['img1'] = $imgs[0];
		            	$prod['img2'] = $imgs[1];
		            	$prod['img3'] = $imgs[2];
		            	$prod['img4'] = $imgs[3];
		            	$prod['video'] = $produto->getVideo();
		            	$prod['nome'] = $produto->getNome();
		            	$prod['frete'] = $produto->getFrete();
		            	$prod['peso'] = $produto->getPeso();
		            	$prod['valor'] = $produto->getValor();
		            	$prod['informacoes_gerais'] = $produto->getInformacoes_gerais();
		            }
				?>
	            <input type="hidden" id="dados_old" name="dados_old" value="<?=str_replace('"', '\'', json_encode($prod));?>" />
	            
	            <!-- IMAGEM 1 -->
	            <div class="campo-foto">
		            <div class="imagem">
		           		<img id="imgprin1" src="<?=($produto&&$imgs[0])?'images/produto/'.$imgs[0]:'';?>" />
		            </div>
		            <ul id="img1ex"><?=($produto&&$imgs[0])?'<li><a href="javascript:;" onclick="$(\'#uploadImg1\')[0].contentWindow.removeAnexo(1)">Excluir Imagem</a></li>':'';?></ul>
		            <input type="hidden" name="img1" id="img1" value="<?=($produto)?$imgs[0]:'';?>" />
		            <iframe id="uploadImg1" name="uploadImg1" height="60" width="130" src="ajax/uploadpc.php?tp=1<?=($produto&&$imgs[0])?'&edit=1':'';?>" frameborder="0" scrolling="no"></iframe>
	            </div>
	            
	            <!-- IMAGEM 2 -->
	            <div class="campo-foto">
		            <div class="imagem">
		          		<img id="imgprin2" src="<?=($produto&&$imgs[1])?'images/produto/'.$imgs[1]:'';?>" />
	          		</div>
	            	<ul id="img2ex"><?=($produto&&$imgs[1])?'<li><a href="javascript:;" onclick="$(\'#uploadImg2\')[0].contentWindow.removeAnexo(2)">Excluir Imagem</a></li>':'';?></ul>
	            	<input type="hidden" name="img2" id="img2" value="<?=($produto)?$imgs[1]:'';?>" />
	            	<iframe id="uploadImg2" name="uploadImg2" height="60" width="130" src="ajax/uploadpc.php?tp=2<?=($produto&&$imgs[1])?'&edit=1':'';?>" frameborder="0" scrolling="no"></iframe>
	            </div>
	            
	            <!-- IMAGEM 3 -->
	            <div class="campo-foto">
	            	<div class="imagem">
		            	<img id="imgprin3" src="<?=($produto&&$imgs[2])?'images/produto/'.$imgs[2]:'';?>" />
		            </div>
		            <ul id="img3ex"><?=($produto&&$imgs[2])?'<li><a href="javascript:;" onclick="$(\'#uploadImg3\')[0].contentWindow.removeAnexo(3)">Excluir Imagem</a></li>':'';?></ul>
		            <input type="hidden" name="img3" id="img3" value="<?=($produto)?$imgs[2]:'';?>" />
	            	<iframe id="uploadImg3" name="uploadImg3" height="60" width="130" src="ajax/uploadpc.php?tp=3<?=($produto&&$imgs[2])?'&edit=1':'';?>" frameborder="0" scrolling="no"></iframe>
	            </div>
	            
	            <!-- IMAGEM 4 -->
	            <div class="campo-foto">
	            	<div class="imagem">
		            	<img id="imgprin4" src="<?=($produto&&$imgs[3])?'images/produto/'.$imgs[3]:'';?>" />
		            </div>
		            <ul id="img4ex"><?=($produto&&$imgs[3])?'<li><a href="javascript:;" onclick="$(\'#uploadImg4\')[0].contentWindow.removeAnexo(4)">Excluir Imagem</a></li>':'';?></ul>
		            <input type="hidden" name="img4" id="img4" value="<?=($produto)?$imgs[3]:'';?>" />
	            	<iframe id="uploadImg4" name="uploadImg4" height="60" width="130" src="ajax/uploadpc.php?tp=4<?=($produto&&$imgs[3])?'&edit=1':'';?>" frameborder="0" scrolling="no"></iframe>
	            </div>
	            
	            <div class="campo-video">
	            	<iframe name="iframeVideo" id="iframeVideo" frameborder="0" allowfullscreen></iframe>
	                <input name="video" id="video" type="text" value="LINK YOUTUBE" onfocus="clearIt(this)" onblur="setIt(this)">
	                <a href="javascript:;" onclick="carregaVideo();">Enviar Vídeo</a>
	                <?
	                	if ($produto && $produto->getVideo()) {
							$tmp = explode("embed/", $produto->getVideo());
                			echo '<script>$("#video").val("http://www.youtube.com/watch?v='.$tmp[1].'");carregaVideo();</script>';
	                	}
					?>
	            </div>
	        </div>
	        <div class="line line-campos">
	            <div class="campo" style="width:66%;">
	            	<label for="nome">Nome do Produto</label>
	                <br />
	                <input name="nome" id="nome" type="text" value="<?=($produto)?$produto->getNome():'';?>" maxlength="50" />
	            </div>
	            
	            <div class="campo ultimo-campo" style="width:28%;">
	            	<label for="frete">Frete R$</label>
	                <br />
	                <input name="frete" id="frete" type="text" value="<?=($produto)?$produto->getFrete():'';?>" onfocus="clearIt(this)" onblur="setIt(this)" /> <span>(vazio = a combinar)</span>
	            </div>
	            
	        </div>
	        
	        <div class="line line-campos">
	        	<div class="campo" style="width:25%;">
	            	<label for="peso">Peso</label>
	                <br />
	                <input name="peso" id="peso" type="text" class="number" value="<?=($produto)?$produto->getPeso():'';?>" /> <span>Kg</span>
	            </div>
	            
	        	<div class="campo" style="width:29%;">
	            	<label for="valor">Valor R$</label>
	                <br />
	                <input name="valor" id="valor" type="text" value="<?=($produto)?$produto->getValor():'';?>" onfocus="clearIt(this)" onblur="setIt(this)" />
	            </div>
	            
	        	<div class="campo ultimo-campo" style="width:42%;">
	            	<label for="estado">Estado</label>
	                <br />
	                <select name="estado" id="estado">
	                	<option value="">ESTADO</option>
						<?
							foreach($ufs as $uf) {
								$selected = '';
								if ($produto && $anunciante->getEstado() == $uf['sigla']) {
									$selected = 'selected="selected"';
								}
								echo '<option '.$selected.' value="'.$uf['sigla'].'">'.$uf['sigla'].'</option>';
		           			}
		           			unset($uf);
				   		?>
					</select>
	            </div>
	        </div>
	        
	        <div class="line line-campos">
	            <div class="campo" style="width:100%; margin:0;">
	            	<label for="informacoes_gerais">Informações Gerais</label>
	                <br />
	                <textarea name="informacoes_gerais" id="informacoes_gerais" cols="" rows="" ><?=($produto)?$produto->getInformacoes_gerais():'&nbsp;';?></textarea>
	            </div>
	        </div>
	        <div class="line line-campos">
	            <div class="campo ultimo-campo" style="width:20%;">
            	<?
            		if($produto)
            			echo '<input name="" onclick="editaProduto();" type="button" value="Editar" class="next">';
           			else
           				echo '<input name="" onclick="cadastraProduto();" type="button" value="Cadastrar" class="next">';
				?>
	            </div>
	        </div>
        </div>
        <!-- CADASTRAR PRODUTO -->
        
        
        <!-- CADASTRAR GADO -->
        <div id="cadastro-gado" style="display: none;">
	        <div class="line">
	            
	            <!-- IMAGEM 1 -->
	            <div class="campo-foto">
		            <div class="imagem">
		           		<img id="imgprinGado1" />
		            </div>
		            <ul id="imgGado1ex"></ul>
		            <input type="hidden" name="imgGado1" id="imgGado1"/>
		            <iframe id="uploadImgGado1" name="uploadImgGado1" src="ajax/uploadpcgado.php?tp=1" frameborder="0" scrolling="no"></iframe>
	            </div>
	            
	            <!-- IMAGEM 2 -->
	            <div class="campo-foto">
		            <div class="imagem">
		          		<img id="imgprinGado2" />
	          		</div>
	            	<ul id="imgGado2ex"></ul>
	            	<input type="hidden" name="imgGado2" id="imgGado2"/>
	            	<iframe id="uploadImgGado2" name="uploadImgGado2" src="ajax/uploadpcgado.php?tp=2" frameborder="0" scrolling="no"></iframe>
	            </div>
	            
	            <!-- IMAGEM 3 -->
	            <div class="campo-foto">
	            	<div class="imagem">
		            	<img id="imgprinGado3" />
		            </div>
		            <ul id="imgGado3ex"></ul>
		            <input type="hidden" name="imgGado3" id="imgGado3"/>
	            	<iframe id="uploadImgGado3" name="uploadImgGado3" src="ajax/uploadpcgado.php?tp=3" frameborder="0" scrolling="no"></iframe>
	            </div>
	            
	            <!-- IMAGEM 4 -->
	            <div class="campo-foto">
	            	<div class="imagem">
		            	<img id="imgprinGado4" />
		            </div>
		            <ul id="imgGado4ex"></ul>
		            <input type="hidden" name="imgGado4" id="imgGado4"/>
	            	<iframe id="uploadImgGado4" name="uploadImgGado4" src="ajax/uploadpcgado.php?tp=4" frameborder="0" scrolling="no"></iframe>
	            </div>
	            
	            <div class="campo-video">
	            	<iframe name="iframeVideoGado" id="iframeVideoGado" frameborder="0" allowfullscreen></iframe>
	                <input name="videoGado" id="videoGado" type="text" value="LINK YOUTUBE" onfocus="clearIt(this)" onblur="setIt(this)">
	                <a href="javascript:;" onclick="carregaVideoGado();">Enviar Vídeo</a>
	            </div>
	        </div>
	        <div class="line line-campos">
	            <div class="campo" style="width:20%;">
	                <label for="nomeGado">Título</label>
	                <br />
	                <input id="nomeGado" name="nomeGado" type="text" value="">
	            </div>
	            <div class="campo" style="width:15%;">
	                <label for="valorKgGado">Valor (R$ / Kg)</label>
	                <br />
	                <input id="valorKgGado" name="valorKgGado" type="text" value="">
	            </div>
	            <div class="campo" style="width:14%;">
	                <label for="categoriaGado">Tipo</label>
	                <br />
	                <select id="categoriaGado" name="categoriaGado" >
	            		<option value="" selected="selected">TIPO</option> 
	                    <?
							foreach($categorias as $categoria) {
								echo '<option value="'.$categoria->getId().'">'.$categoria->getNome().'</option>';
	               			}
	               			unset($categoria);
				   		?>
					</select> 
	  			</div>
	            <div class="campo" style="width:14%;">
	                <label for="racaGado">Raça</label>
	                <br />
	                <input id="racaGado" name="racaGado" type="text" value="">
	            </div>
	            <div class="campo" style="width:12%;">
	                <label for="quantidadeGado">Quantidade</label>
	                <br />
	                <input id="quantidadeGado" name="quantidadeGado" class="number" type="text" value="">
	            </div>
	            <div class="campo" style="width:10%;">
	                <label for="sexoGado">Sexo</label>
	                <br />
	                <select id="sexoGado" name="sexoGado" >
	                    <option selected="selected" value="M">M</option>
	                    <option value="F">F</option>
	                </select>
	            </div>
	            <div class="campo" style="width:20%;">
	                <label for="pesoMedioGado">Peso Médio (cabeça)</label>
	                <br />
	                <input id="pesoMedioGado" name="pesoMedioGado" class="number" type="text" value="">
	            </div>
	            <div class="campo" style="width:8%;">
	                <label for="idadeGado">ERA (meses)</label>
	                <br />
	                <input id="idadeGado" name="idadeGado" class="number" type="text" value="">
	            </div>
                <div class="campo" style="width:15%;">
                    <label for="finalidadeGado">Finalidade</label>
                    <br>
                    <select id="finalidadeGado" name="finalidadeGado">
                        <option value="CORTE" selected="selected">CORTE</option>
                        <option value="CRIA">CRIA</option>
                        <option value="ESPORTE">ESPORTE</option>
                        <option value="TRABALHO">TRABALHO</option>
                        <option value="LEITE">LEITE</option>
                        <option value="CRIA/CORTE">CRIA/CORTE</option>
                    </select>
                </div>
	            <div class="campo" style="width:14%;">
	                <label for="ufGado">Estado</label>
	                <br />
	                <select id="ufGado" name="ufGado" onchange="buscaCidade(this.value);" >
	                    <option value="" selected="selected">ESTADO</option> 
	                	<?
							foreach($ufs as $uf) {
								echo '<option value="'.$uf['sigla'].'">'.$uf['sigla'].'</option>';
	               			}
	               			unset($uf);
				   		?>  
	                </select>
	            </div>
	            <div class="campo" style="width:32%;">
	                <label for="cidadeGado">Cidade</label>
	                <br />
	                <select id="cidadeGado" name="cidadeGado" >
	                    <option value="" selected="selected">CIDADE</option>  
	                </select>
	            </div>
	            <div class="campo" style="width:100%;">
	                <label for="infosGado">Informações Gerais</label>
	                <br />
	                <textarea id="infosGado" name="infosGado" cols="" rows="" style="height:130px;"></textarea>
	            </div>
	        </div>
	        <div class="line line-mapa line-campos">
	            <h2>Localização do Gado</h2>
	            <div class="campo" style="width:40%;">
	                <input id="enderecoGado" name="enderecoGado" type="text" value="">
	            </div>
	            <iframe src="ajax/mapa_gado.php" frameborder="0" class="mapa_gado" style="height:300px;"></iframe>
	            
				<input type="hidden" id="latitudeGado" name="latitudeGado" />
	            <input type="hidden" id="longitudeGado" name="longitudeGado" />
	        </div>
	        <div class="line line-campos">
				<div class="campo" style="width:100%;">
	                <label for="comoChegarGado">Como Chegar</label>
	                <br />
	                <textarea id="comoChegarGado" name="comoChegarGado" cols="" rows="" style="height:130px;"></textarea>
	            </div>
			</div>
	        
	        <div class="line line-campos">
            	<div class="campo ultimo-campo" style="width:20%;">
	        		<input type="button" onclick="cadastraGado();" value="Salvar" class="next">
                </div>
	        </div>
 <? /*
            <div class="line">
                <p>
                    Gostaria de anunciar seu gado no <strong>GADO AQUI?</strong>
                    <br />
                    Preencha o formulário abaixo e conheça nosso serviço de anúncio. A equipe <strong>GADO AQUI</strong> irá até onde está o gado para realizar a pesagem, tirar fotos e fazer também uma filmagem para que seu anúncio seja completo e tenha muitos acessos.
                    
                    <br /><br /><br />
                </p>
            </div>
            <div class="line line-campos">
                <div class="campo" style="width:32%;">
                    <label for="nomeAnuncio">Seu nome</label>
                    <br />
                    <input id="nomeAnuncio" name="nomeAnuncio" type="text" value="<?=$_SESSION['ga']['nome'].' '.$_SESSION['ga']['sobrenome'];?>" />
                </div>
                
                <div class="campo" style="width:25%;">
                    <label for="telefoneAnuncio">Telefone</label>
                    <br />
                    <input id="telefoneAnuncio" name="telefoneAnuncio" type="text" value="<?=$_SESSION['ga']['telefone'];?>"/>
                </div>
                <div class="campo" style="width:24%;">
                    <label for="emailAnuncio">E-mail</label>
                    <br />
                    <input id="emailAnuncio" name="emailAnuncio" type="text" value="<?=$_SESSION['ga']['email'];?>"/>
                </div>
                <div class="campo ultimo-campo" style="width:13%;">
                    <label for="estadoAnuncio">Estado</label>
                    <br />
                    <select id="estadoAnuncio" name="estadoAnuncio">
						<option value="">ESTADO</option>
						<?
							foreach($ufs as $uf) {
								$sel = '';
								if ($_SESSION['ga']['estado'] == $uf['sigla'])
									$sel = 'selected="selected"';
								echo '<option value="'.$uf['sigla'].'" '.$sel.'>'.$uf['sigla'].'</option>';
		           			}
		           			unset($uf);
				   		?>
					</select>
                </div>
            </div>
            <div class="line line-campos">
                <div class="campo" style="width:100%; margin:0;">
                    <label for="enderecoAnuncio">Endereço completo de onde está localizado o Gado</label>
                    <br />
                    <input id="enderecoAnuncio" name="enderecoAnuncio" type="text" />
                </div>
            </div>
            <div class="line line-campos">
                <div class="campo ultimo-campo" style="width:30%;">
                    <input name="" type="button" onclick="enviaContato();" value="Enviar Contato" class="next">
                </div>
            </div>
*/ ?>
        </div>
        <!-- //CADASTRAR GADO -->
        
    </div><!-- //rightbar -->
</div>

<?php include "footer.php"; ?>