<?
	chdir(dirname(__FILE__).'/../../../');
	include "pacotes/work/work_admin_anunciar.php";
	chdir('admin/');
	@session_start();
?>
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
	
	function getDadosAnuncianteGado(id) {
		$('.loading').show();
		$.getJSON('ajax/getDadosUsuario.php', { id: id }, function(data){
			if(data) {
				$('.loading').hide();
				$('#telefoneGado').val(data.telefone);
				$('#emailGado').val(data.email);
			}	
		});
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

	function cadastraGado() {
		if ($('#nomeGado').val() != '' && $('#valorKgGado').val() != '' && $('#racaGado').val() != '' && 
			$('#quantidadeGado').val() != '' && $('#sexoGado').val() != '' && 
		 	$('#idadeGado').val() != '' && $('#ufGado').val() != '' && $('#cidadeGado').val() != '' && $('#infosGado').val() != '' && 
	 	  	$('#anuncianteGado').val() != '' && $('#enderecoGado').val() != '' && 
	   		$('#latitudeGado').val() != '' && $('#longitudeGado').val() != '' && $('#imgGado1').val() != '') {
	 	  		
	 	  		$('.loading').show();
	 	  		
				$.post("ajax/cadastraGado.php", { nome: $('#nomeGado').val(), valor_kg: $('#valorKgGado').val(), raca: $('#racaGado').val(), 
													quantidade: $('#quantidadeGado').val(), sexo: $('#sexoGado').val(), peso_medio: $('#pesoMedioGado').val(), 
													idade: $('#idadeGado').val(), estado: $('#ufGado').val(), cidade: $('#cidadeGado').val(), informacoes_gerais: $('#infosGado').val(), 
													id_anunciante: $('#anuncianteGado').val(), endereco: $('#enderecoGado').val(), como_chegar: $('#comoChegarGado').val(), 
													id_categoria: $('#categoriaGado').val(), latitude: $('#latitudeGado').val(), longitude: $('#longitudeGado').val(),  
													finalidade: $('#finalidadeGado').val(), 
													img1: $('#imgGado1').val(), img2: $('#imgGado2').val(), 
													img3: $('#imgGado3').val(), img4: $('#imgGado4').val(), 
													video:$('#videoGado').val() }, 
					function(data){
						$('.loading').hide();
						if (data.msg) {
							alert(data.msg);
							mostraDivMenu('anuncios-cadastrar');
						} else {
							alert(data.erro);
						}
				},'json');
		} else {
			alert('Todos os campos são obrigatórios!');
		}
	}

	function getDadosAnunciante(id) {
		$('.loading').show();
		$.getJSON('ajax/getDadosUsuario.php', { id: id }, function(data){
			if(data) {
				$('.loading').hide();
				$('#telefone').val(data.telefone);
				$('#email').val(data.email);
			}	
		});
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

	function cadastraProduto() {
		if ($('#nome').val() != '' && $('#valor').val() != '' && 
			$('#estado').val() != '' && $('#informacoes_gerais').val() != '' && $('#anunciante').val() != '' && 
			$('#img1').val() != '') {
				
				$('.loading').show();
				
				$.post("ajax/cadastraProduto.php", { nome:$('#nome').val(), peso:$('#peso').val(), frete:$('#frete').val(), 
														valor:$('#valor').val(), estado:$('#estado').val(), 
														informacoes_gerais:$('#informacoes_gerais').val(),
														img1: $('#img1').val(), img2: $('#img2').val(), 
														img3: $('#img3').val(), img4: $('#img4').val(), 
														video:$('#video').val(), id_anunciante: $('#anunciante').val() }, 
					function(data){
						$('.loading').hide();
						if (data.msg) {
							alert(data.msg);
							mostraDivMenu('anuncios-cadastrar');
						} else {
							alert(data.erro);
						}
				},'json');
		} else {
			alert('Todos os campos são obrigatórios!');
		}
	}

	$(function(){
		$("#valorKgGado").maskMoney();
		
		$("#valor").maskMoney();
		$("#frete").maskMoney();
		
		$('.number').numeric();
	});

</script>

<h1>
	Cadastrar
    <select onchange="selecionaAnuncio(this.value);">
        <option selected="selected" value="g">Animal</option>
        <option value="p">Produto</option>
    </select>
</h1>

<div class="line">	
        
    <div id="cadastro-gado" class="anuncio-edicao">
        <!--<h2>Lote número: <strong>36</strong></h2>-->
        <div class="line">
            
            <!-- IMAGEM 1 -->
            <div class="imagem">
            	<a href="#" id="linkGado1" rel="shadowbox">
            		<div id="zoomGado1" class="zoom" style="display: none;"></div>
	            	<img id="imgprinGado1" class="classTitle" title="Clique para dar Zoom na imagem" />
	            </a>
             	<ul id="imgGado1ex"></ul>
				<input type="hidden" name="imgGado1" id="imgGado1"/>
	            <iframe id="uploadImgGado1" name="uploadImgGado1" src="ajax/uploadpcgado.php?tp=1" frameborder="0" scrolling="no"></iframe>
            </div>
            
            <!-- IMAGEM 2 -->
            <div class="imagem">
            	<a href="#" id="linkGado2" rel="shadowbox">
            		<div id="zoomGado2" class="zoom" style="display: none;"></div>
            		<img id="imgprinGado2" class="classTitle" title="Clique para dar Zoom na imagem" />
	            </a>
            	<ul id="imgGado2ex"></ul>
            	<input type="hidden" name="imgGado2" id="imgGado2"/>
            	<iframe id="uploadImgGado2" name="uploadImgGado2" src="ajax/uploadpcgado.php?tp=2" frameborder="0" scrolling="no"></iframe>
            </div>
            
            <!-- IMAGEM 3 -->
            <div class="imagem">
            	<a href="#" id="linkGado3" rel="shadowbox">
            		<div id="zoomGado3" class="zoom" style="display: none;"></div>
	            	<img id="imgprinGado3" class="classTitle" title="Clique para dar Zoom na imagem" />
	            </a>
	            <ul id="imgGado3ex"></ul>
	            <input type="hidden" name="imgGado3" id="imgGado3"/>
            	<iframe id="uploadImgGado3" name="uploadImgGado3" src="ajax/uploadpcgado.php?tp=3" frameborder="0" scrolling="no"></iframe>
            </div>
            
            <!-- IMAGEM 4 -->
            <div class="imagem">
            	<a href="#" id="linkGado4" rel="shadowbox">
            		<div id="zoomGado4" class="zoom" style="display: none;"></div>
	            	<img id="imgprinGado4" class="classTitle" title="Clique para dar Zoom na imagem" />
	            </a>
	            <ul id="imgGado4ex"></ul>
	            <input type="hidden" name="imgGado4" id="imgGado4"/>
            	<iframe id="uploadImgGado4" name="uploadImgGado4" src="ajax/uploadpcgado.php?tp=4" frameborder="0" scrolling="no"></iframe>
            </div>
            
            <!-- VIDEO -->
            <div class="imagem">
                <iframe name="iframeVideoGado" id="iframeVideoGado" src="images/over-video.png" frameborder="0" allowfullscreen></iframe>
                <input name="videoGado" id="videoGado" type="text" value="LINK YOUTUBE" onfocus="clearIt(this)" onblur="setIt(this)">
                <input name="" type="button" onclick="carregaVideoGado();" value="Carregar vídeo">
            </div>
        </div>
        <div class="line">
            <div class="campo" style="width:16%;">
                <label for="nomeGado">Título</label>
                <br />
                <input id="nomeGado" name="nomeGado" type="text" value="">
            </div>
            <div class="campo" style="width:10%;">
                <label for="valorKgGado">Valor (R$ / Cabeça)</label>
                <br />
                <input id="valorKgGado" name="valorKgGado" type="text" value="">
            </div>
            <div class="campo" style="width:10%;">
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
            <div class="campo" style="width:13%;">
                <label for="racaGado">Raça</label>
                <br />
                <input id="racaGado" name="racaGado" type="text" value="">
            </div>
            <div class="campo" style="width:8%;">
                <label for="quantidadeGado">Quantidade</label>
                <br />
                <input id="quantidadeGado" name="quantidadeGado" type="text" class="number" value="">
            </div>
            <div class="campo" style="width:6%;">
                <label for="sexoGado">Sexo</label>
                <br />
                <select id="sexoGado" name="sexoGado" >
                    <option selected="selected" value="M">M</option>
                    <option value="F">F</option>
                </select>
            </div>
            <div class="campo" style="width:12%;">
                <label for="pesoMedioGado">Peso Médio (cabeça)</label>
                <br />
                <input id="pesoMedioGado" name="pesoMedioGado" class="number" type="text" value="">
            </div>
            <div class="campo" style="width:8%;">
                <label for="idadeGado">ERA (meses)</label>
                <br />
                <input id="idadeGado" name="idadeGado" class="number" type="text" value="">
            </div>
        </div>
        <div class="line">        	            
            
            <div class="campo" style="width:15%;">
                <label for="finalidadeGado">Finalidade</label>
                <br />
                <select id="finalidadeGado" name="finalidadeGado" >
                    <option value="CORTE" selected="selected">CORTE</option>
                    <option value="CRIA">CRIA</option>
                    <option value="ESPORTE">ESPORTE</option>
                    <option value="TRABALHO">TRABALHO</option>
                    <option value="LEITE">LEITE</option>
                    <option value="CRIA/CORTE">CRIA/CORTE</option>
                </select>
            </div>
            
            <div class="campo" style="width:8%;">
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
            
            <div class="campo" style="width:20%;">
                <label for="cidadeGado">Cidade</label>
                <br />
                <select id="cidadeGado" name="cidadeGado" >
                    <option value="" selected="selected">CIDADE</option>
                </select>
            </div>                        
            
            <div class="campo" style="width:100%;">
                <label for="infosGado">Informações Gerais</label>
                <br />
                <textarea id="infosGado" name="infosGado" cols="" rows=""></textarea>
            </div>
        </div>
        <div class="line">
            <div class="campo" style="width:25%;">
                <label for="anuncianteGado">Anunciante</label>
                <br />
                <select id="anuncianteGado" name="anuncianteGado" onchange="getDadosAnuncianteGado(this.value);" >
                    <option value="" selected="selected">ANUNCIANTE</option> 
                	<?
						foreach($anunciantes as $anunciante) {
							echo '<option value="'.$anunciante->getId().'">'.$anunciante->getNome().' '.$anunciante->getSobrenome().'</option>';
               			}
               			unset($anunciante);
			   		?>  
                </select>
            </div>
            <div class="campo" style="width:25%;">
                <label for="telefoneGado">Telefone</label>
                <br />
                <input id="telefoneGado" name="telefoneGado" type="text" value="">
            </div>
            <div class="campo" style="width:25%;">
                <label for="emailGado">E-mail</label>
                <br />
                <input id="emailGado" name="emailGado" type="text" value="">
            </div>
        </div>
        <div class="line line-mapa">
            <h2>Localização do Gado</h2>
            <div class="campo" style="width:40%;">
                <input id="enderecoGado" name="enderecoGado" type="text" value="">
            </div>
            <iframe src="includes/mapa.php" frameborder="0" style="border:0; height:310px;"></iframe>
            
			<input type="hidden" id="latitudeGado" name="latitudeGado" />
            <input type="hidden" id="longitudeGado" name="longitudeGado" />
        </div>
        <div class="line" style="margin:0 0 40px 0;">
			<div class="campo" style="width:100%;">
                <label for="comoChegarGado">Como Chegar</label>
                <br />
                <textarea id="comoChegarGado" name="comoChegarGado" cols="" rows=""></textarea>
            </div>
		</div>
        
        <div class="line line-salvar">
        	<input type="button" onclick="cadastraGado();" value="Salvar">
        </div>
    </div><!-- /anuncio-edicao -->
    
    <!-- Cadastro produto -->
    <div id="cadastro-produto" class="anuncio-edicao" style="display: none;">
    	<div class="line">
            
            <!-- IMAGEM 1 -->
            <div class="imagem">
            	<a href="#" id="link1" rel="shadowbox">
            		<div id="zoom1" class="zoom" style="display: none;"></div>
	            	<img id="imgprin1" class="classTitle" title="Clique para dar Zoom na imagem" />
	            </a>
             	<ul id="img1ex"></ul>
				<input type="hidden" name="img1" id="img1"/>
	            <iframe id="uploadImg1" name="uploadImg1" src="ajax/uploadpc.php?tp=1" frameborder="0" scrolling="no"></iframe>
            </div>
            
            <!-- IMAGEM 2 -->
            <div class="imagem">
            	<a href="#" id="link2" rel="shadowbox">
            		<div id="zoom2" class="zoom" style="display: none;"></div>
            		<img id="imgprin2" class="classTitle" title="Clique para dar Zoom na imagem" />
	            </a>
            	<ul id="img2ex"></ul>
            	<input type="hidden" name="img2" id="img2"/>
            	<iframe id="uploadImg2" name="uploadImg2" src="ajax/uploadpc.php?tp=2" frameborder="0" scrolling="no"></iframe>
            </div>
            
            <!-- IMAGEM 3 -->
            <div class="imagem">
            	<a href="#" id="link3" rel="shadowbox">
            		<div id="zoom3" class="zoom" style="display: none;"></div>
	            	<img id="imgprin3" class="classTitle" title="Clique para dar Zoom na imagem" />
	            </a>
	            <ul id="img3ex"></ul>
	            <input type="hidden" name="img3" id="img3"/>
            	<iframe id="uploadImg3" name="uploadImg3" src="ajax/uploadpc.php?tp=3" frameborder="0" scrolling="no"></iframe>
            </div>
            
            <!-- IMAGEM 4 -->
            <div class="imagem">
            	<a href="#" id="link4" rel="shadowbox">
            		<div id="zoom4" class="zoom" style="display: none;"></div>
	            	<img id="imgprin4" class="classTitle" title="Clique para dar Zoom na imagem" />
	            </a>
	            <ul id="img4ex"></ul>
	            <input type="hidden" name="img4" id="img4"/>
            	<iframe id="uploadImg4" name="uploadImg4" src="ajax/uploadpc.php?tp=4" frameborder="0" scrolling="no"></iframe>
            </div>
            
            <!-- VIDEO -->
            <div class="imagem">
                <iframe name="iframeVideo" id="iframeVideo" src="images/over-video.png" frameborder="0" allowfullscreen></iframe>
                <input name="video" id="video" type="text" value="LINK YOUTUBE" onfocus="clearIt(this)" onblur="setIt(this)">
                <input name="" type="button" onclick="carregaVideo();" value="Carregar vídeo">
            </div>
        </div>
        <div class="line">
            <div class="campo" style="width:20%;">
                <label for="nome">Título</label>
                <br />
                <input id="nome" name="nome" type="text" value="">
            </div>
            <div class="campo" style="width:10%;">
                <label for="valor">Valor (R$)</label>
                <br />
                <input id="valor" name="valor" type="text" value="">
            </div>
            <div class="campo" style="width:8%;">
                <label for="frete">Frete (*vazio = a combinar)</label>
                <br />
                <input id="frete" name="frete" type="text" value="">
            </div>
            <div class="campo" style="width:8%;">
                <label for="peso">Peso (Kg)</label>
                <br />
                <input id="peso" name="peso" class="number" type="text" value="">
            </div>
            <div class="campo" style="width:7%;">
                <label for="estado">Estado</label>
                <br />
                <select id="estado" name="estado" >
                    <option value="" selected="selected">ESTADO</option> 
                	<?
						foreach($ufs as $uf) {
							echo '<option value="'.$uf['sigla'].'">'.$uf['sigla'].'</option>';
               			}
               			unset($uf);
			   		?>  
                </select>
            </div>
            <div class="campo" style="width:100%;">
                <label for="informacoes_gerais">Informações Gerais</label>
                <br />
                <textarea id="informacoes_gerais" name="informacoes_gerais" cols="" rows=""></textarea>
            </div>
        </div>
        <div class="line">
            <div class="campo" style="width:25%;">
                <label for="anunciante">Anunciante</label>
                <br />
                <select id="anunciante" name="anunciante" onchange="getDadosAnunciante(this.value);" >
                    <option value="" selected="selected">ANUNCIANTE</option> 
                	<?
						foreach($anunciantes as $anunciante) {
							echo '<option value="'.$anunciante->getId().'">'.$anunciante->getNome().' '.$anunciante->getSobrenome().'</option>';
               			}
               			unset($uf);
			   		?>  
                </select>
            </div>
            <div class="campo" style="width:25%;">
                <label for="telefone">Telefone</label>
                <br />
                <input id="telefone" name="telefone" type="text" value="">
            </div>
            <div class="campo" style="width:25%;">
                <label for="email">E-mail</label>
                <br />
                <input id="email" name="email" type="text" value="">
            </div>
        </div>
        <div class="line" style="height: 50px !important;">
        	&nbsp;
        </div>   
        <div class="line line-salvar">
        	<input onclick="cadastraProduto();" type="button" value="Salvar">
        </div>    
    
    </div>
    
</div>