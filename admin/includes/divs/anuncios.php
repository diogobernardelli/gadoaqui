<?
	chdir(dirname(__FILE__).'/../../../');
	include "pacotes/work/work_admin_anuncios_todos.php";
	chdir('admin/');
	@session_start();
?>
<script type="text/javascript">
	function apagaForm() {
		//GADO
		$('#idGado').val('');
		$('#dados_oldGado').val('');
		
		$('#imgprinGado1').attr('src', '');
		$('#imgGado1ex').html('');
		$('#imgGado1').val('');
		$('#uploadImgGado1').attr('src', 'ajax/uploadpcgado.php?tp=1');
		
		$('#imgprinGado2').attr('src', '');
		$('#imgGado2ex').html('');
		$('#imgGado2').val('');
		$('#uploadImgGado2').attr('src', 'ajax/uploadpcgado.php?tp=2');
		
		$('#imgprinGado3').attr('src', '');
		$('#imgGado3ex').html('');
		$('#imgGado3').val('');
		$('#uploadImgGado3').attr('src', 'ajax/uploadpcgado.php?tp=3');
		
		$('#imgprinGado4').attr('src', '');
		$('#imgGado4ex').html('');
		$('#imgGado4').val('');
		$('#uploadImgGado4').attr('src', 'ajax/uploadpcgado.php?tp=4');
		
		//$('#iframeVideoGado').attr('src', 'images/over-video.png');
		$('#videoGado').val('LINK YOUTUBE');
		
		$('#linkVideoGado').attr('href', 'javascript:;');
		$('#imgVideoGado').attr('src', '');
		
		$('#nomeGado').val('');
		$('#valorKgGado').val('');
		$('#categoriaGado').val('');
		$('#quantidadeGado').val('');
		$('#sexoGado').val('');
		$('#pesoMedioGado').val('');
		$('#idadeGado').val('');
		$('#finalidadeGado').val('');
		$('#ufGado').val('');
		$('#cidadeGado').val('');
		$('#statusGado').val('');
		$('#infosGado').val('');
		$('#anuncianteGado').val('');
		$('#enderecoGado').val('');
		$('#latitudeGado').val('');
		$('#longitudeGado').val('');
		$('#comoChegarGado').val('');

		//PRODUTO
		$('#id').val('');
		$('#dados_old').val('');
		
		$('#imgprin1').attr('src', '');
		$('#img1ex').html('');
		$('#img1').val('');
		$('#uploadImg1').attr('src', 'ajax/uploadpc.php?tp=1');
		
		$('#imgprin2').attr('src', '');
		$('#img2ex').html('');
		$('#img2').val('');
		$('#uploadImg2').attr('src', 'ajax/uploadpc.php?tp=2');
		
		$('#imgprin3').attr('src', '');
		$('#img3ex').html('');
		$('#img3').val('');
		$('#uploadImg3').attr('src', 'ajax/uploadpc.php?tp=3');
		
		$('#imgprin4').attr('src', '');
		$('#img4ex').html('');
		$('#img4').val('');
		$('#uploadImg4').attr('src', 'ajax/uploadpc.php?tp=4');
		
		$('#iframeVideo').attr('src', 'images/over-video.png');
		$('#video').val('LINK YOUTUBE');
		
		$('#nome').val('');
		$('#valor').val('');
		$('#frete').val('');
		$('#status').val('');
		$('#informacoes_gerais').val('');
	}

	function pesquisaAnuncios() {
		$('.loading').show();
		apagaForm();
		
		$('#cadastro-produto').hide();
		$('#cadastro-gado').hide();
		$("#resultadoBusca").html("");
		
		$.get('ajax/pesquisaAnunciosTodos.php', { tipo: $('#tipoBusca').val(), titulo: $('#tituloBusca').val(), valor: $('#valorBusca').val(),
											video: $('#videoBusca').val(), anunciante: $('#anuncianteBusca').val(), status: $('#statusBusca').val() }, 
			function(data){
				$("#resultadoBusca").html(data.html);
				$('.loading').hide();
		}, 'json');
	}
	
	$(function(){
		$('#valorGado').maskMoney();
		$('#valor').maskMoney();
		$('.number').numeric();
		pesquisaAnuncios();
	});
	
	function carregaVideo(){
		if ($('#video').val() != '' && $('#video').val() != 'LINK YOUTUBE') {
			var video = $('#video').val().split('=');
		 	if (video.length == 2) {
				//$('#iframeVideo').attr('src', 'http://www.youtube.com/embed/' + video[1]);
				
				$('#linkVideo').attr('href', 'http://www.youtube.com/watch?v='+ video[1]);
				$('#imgVideo').attr('src', 'http://i1.ytimg.com/vi/'+video[1]+'/default.jpg');
				
				$('#video').val('http://www.youtube.com/embed/' + video[1]);
			}
		}
	}

	function editaProduto() {
		if ($('#nome').val() != '' && $('#valor').val() != '' && 
			$('#estado').val() != '' && $('#informacoes_gerais').val() != '' && $('#status').val() != '' && 
			$('#img1').val() != '') {
				
				$('.loading').show();
				
				$.post("ajax/editaProduto.php", { id:$('#id').val(), nome:$('#nome').val(), peso:$('#peso').val(), frete:$('#frete').val(), 
													valor:$('#valor').val(), estado:$('#estado').val(), 
													informacoes_gerais:$('#informacoes_gerais').val(), status: $('#status').val(), 
													img1: $('#img1').val(), img2: $('#img2').val(), 
													img3: $('#img3').val(), img4: $('#img4').val(), 
													video:$('#video').val(), dados_old: $('#dados_old').val() }, 
					function(data){
						$('.loading').hide();
						if (data.msg) {
							alert(data.msg);
							mostraDivMenu('anuncios');
						} else {
							alert(data.erro);
						}
				},'json');
		} else {
			alert('Todos os campos são obrigatórios!');
		}
	}
	
	function getDadosProduto(id) {
		apagaForm();
		
		$('.loading').show();
		
		$.get('ajax/getDadosProduto.php', { id: id }, function(data){	
				$('.loading').hide();
				
				var dados_old = JSON.stringify(data);
				dados_old = dados_old.replace(/"/g, '\'');
				$("#dados_old").val(dados_old);
				$("#id").val(id);
				$("#nome").val(data.nome);
				$("#valor").val(data.valor);
				$("#frete").val(data.frete);
				$("#peso").val(data.peso);
				$("#status").val(data.status);
				$("#informacoes_gerais").val(data.informacoes_gerais);
				$("#anunciante").val(data.anunciante);
				$("#dataCad").html(data.data_cad);
				
				if (data.img1) {
					$("#imgprin1").attr('src', '../images/produto/'+data.img1);
					$("#img1ex").html('<li><input name="" type="button" value="Excluir Imagem" onclick="$(\'#uploadImg1\')[0].contentWindow.removeAnexo(1)"></li>');
					$("#img1").val(data.img1);
					$("#uploadImg1").attr('src', 'ajax/uploadpc.php?tp=1&edit=1');
				}
				
				if (data.img2) {
					$("#imgprin2").attr('src', '../images/produto/'+data.img2);
					$("#img2ex").html('<li><input name="" type="button" value="Excluir Imagem" onclick="$(\'#uploadImg2\')[0].contentWindow.removeAnexo(2)"></li>');
					$("#img2").val(data.img2);
					$("#uploadImg2").attr('src', 'ajax/uploadpc.php?tp=2&edit=1');
				}
				
				if (data.img3) {
					$("#imgprin3").attr('src', '../images/produto/'+data.img3);
					$("#img3ex").html('<li><input name="" type="button" value="Excluir Imagem" onclick="$(\'#uploadImg3\')[0].contentWindow.removeAnexo(3)"></li>');
					$("#img3").val(data.img3);
					$("#uploadImg3").attr('src', 'ajax/uploadpc.php?tp=3&edit=1');
				}
				
				if (data.img4) {
					$("#imgprin4").attr('src', '../images/produto/'+data.img4);
					$("#img4ex").html('<li><input name="" type="button" value="Excluir Imagem" onclick="$(\'#uploadImg4\')[0].contentWindow.removeAnexo(4)"></li>');
					$("#img4").val(data.img4);
					$("#uploadImg4").attr('src', 'ajax/uploadpc.php?tp=4&edit=1');
				}
				
				if (data.video) {
					var video = data.video.split("embed/");
					$("#video").val("http://www.youtube.com/watch?v="+video[1]);
					carregaVideo();
				}
				
				$('#cadastro-gado').hide();
				$('#cadastro-produto').show();
		}, 'json');
	}
	
	function carregaVideoGado(){
		if ($('#videoGado').val() != '' && $('#videoGado').val() != 'LINK YOUTUBE') {
			var video = $('#videoGado').val().split('=');
		 	if (video.length == 2) {
				//$('#iframeVideoGado').attr('src', 'http://www.youtube.com/embed/' + video[1]);
				
				$('#linkVideoGado').attr('href', 'http://www.youtube.com/watch?v='+ video[1]);
				$('#imgVideoGado').attr('src', 'http://i1.ytimg.com/vi/'+video[1]+'/default.jpg');
				
				$('#videoGado').val('http://www.youtube.com/embed/' + video[1]);
			}
		}
	}
	
	function editaGado() {		
		if ($('#nomeGado').val() != '' && $('#valorKgGado').val() != '' && $('#racaGado').val() != '' && 
			$('#quantidadeGado').val() != '' && $('#sexoGado').val() != '' != '' && 
		 	$('#idadeGado').val() != '' && $('#ufGado').val() != '' && $('#infosGado').val() != '' && 
	 	  	$('#enderecoGado').val() != '' && $('#imgGado1').val() != '') {
	   			
	   			$('.loading').show();
	   			
				$.post("ajax/editaGado.php", { id:$('#idGado').val(), nome: $('#nomeGado').val(), valor_kg: $('#valorKgGado').val(), raca: $('#racaGado').val(), 
												quantidade: $('#quantidadeGado').val(), sexo: $('#sexoGado').val(), peso_medio: $('#pesoMedioGado').val(), 
												idade: $('#idadeGado').val(), estado: $('#ufGado').val(), cidade: $('#cidadeGado').val(), informacoes_gerais: $('#infosGado').val(), status: $('#statusGado').val(), 
												endereco: $('#enderecoGado').val(), como_chegar: $('#comoChegarGado').val(), 
												id_categoria: $('#categoriaGado').val(), latitude: $('#latitudeGado').val(), longitude: $('#longitudeGado').val(),  
												finalidade: $('#finalidadeGado').val(), 
												img1: $('#imgGado1').val(), img2: $('#imgGado2').val(), 
												img3: $('#imgGado3').val(), img4: $('#imgGado4').val(), 
												video:$('#videoGado').val(), dados_old: $('#dados_oldGado').val() }, 
					function(data){
						$('.loading').hide();
						if (data.msg) {
							alert(data.msg);
							mostraDivMenu('anuncios');
						} else {
							alert(data.erro);
						}
				},'json');
		} else {
			alert('Todos os campos são obrigatórios!');
		}
	}
	
	function getDadosGado(id) {
		apagaForm();
		
		$('.loading').show();
		
		$.get('ajax/getDadosGado.php', { id: id }, function(data){		
				//$('.loading').hide();
			
				var dados_old = JSON.stringify(data);
				dados_old = dados_old.replace(/"/g, '\'');
				$("#dados_oldGado").val(dados_old);
				$("#idGado").val(id);
				$("#nomeGado").val(data.nome);
				$("#valorKgGado").val(data.valor_kg);
				$("#categoriaGado").val(data.categoria);
				$("#racaGado").val(data.raca);
				$("#quantidadeGado").val(data.quantidade);
				$('#sexoGado').val(data.sexo);
				$('#pesoMedioGado').val(data.peso_medio);
				$('#idadeGado').val(data.idade);
				$('#finalidadeGado').val(data.finalidade);
				$('#ufGado').val(data.uf);
				$('#statusGado').val(data.status);
				$("#infosGado").val(data.informacoes_gerais);
				$("#anuncianteGado").val(data.anunciante);
				$("#enderecoGado").val(data.endereco);
				$("#latitudeGado").val(data.latitude);
				$("#longitudeGado").val(data.longitude);
				$("#comoChegarGado").val(data.como_chegar);
				$("#dataCadGado").html(data.data_cad);
				
				$.get("ajax/buscaCidCorreio.php", { uf:data.uf, cid:data.cidade }, 
					function(data2){
						$('.loading').hide();
						$('#cidadeGado').html(data2);
				});
				
				if (data.img1) {
					$("#imgprinGado1").attr('src', '../images/gado/'+data.img1);
					$("#imgGado1ex").html('<li><input name="" type="button" value="Excluir Imagem" onclick="$(\'#uploadImgGado1\')[0].contentWindow.removeAnexo(1)"></li>');
					$("#imgGado1").val(data.img1);
					$("#uploadImgGado1").attr('src', 'ajax/uploadpcgado.php?tp=1&edit=1');
				}
				
				if (data.img2) {
					$("#imgprinGado2").attr('src', '../images/gado/'+data.img2);
					$("#imgGado2ex").html('<li><input name="" type="button" value="Excluir Imagem" onclick="$(\'#uploadImgGado2\')[0].contentWindow.removeAnexo(2)"></li>');
					$("#imgGado2").val(data.img2);
					$("#uploadImgGado2").attr('src', 'ajax/uploadpcgado.php?tp=2&edit=1');
				}
				
				if (data.img3) {
					$("#imgprinGado3").attr('src', '../images/gado/'+data.img3);
					$("#imgGado3ex").html('<li><input name="" type="button" value="Excluir Imagem" onclick="$(\'#uploadImgGado3\')[0].contentWindow.removeAnexo(3)"></li>');
					$("#imgGado3").val(data.img3);
					$("#uploadImgGado3").attr('src', 'ajax/uploadpcgado.php?tp=3&edit=1');
				}
				
				if (data.img4) {
					$("#imgprinGado4").attr('src', '../images/gado/'+data.img4);
					$("#imgGado4ex").html('<li><input name="" type="button" value="Excluir Imagem" onclick="$(\'#uploadImgGado4\')[0].contentWindow.removeAnexo(4)"></li>');
					$("#imgGado4").val(data.img4);
					$("#uploadImgGado4").attr('src', 'ajax/uploadpcgado.php?tp=4&edit=1');
				}
				
				if (data.video) {
					var video = data.video.split("embed/");
					$("#videoGado").val("http://www.youtube.com/watch?v="+video[1]);
					carregaVideoGado();
				}

				$('#iframeEditaGado')[0].contentWindow.carregaDadosGado();				
				
				$('#cadastro-produto').hide();
				$('#cadastro-gado').show();
		}, 'json');
	}
</script>

<h1>Todos os Anúncios</h1>
<div class="line">

	<div class="busca">
    	<div class="line">
        	<div class="campo" style="width:10%;">
                <label for="tipoBusca">Tipo</label>
                <br />
                <select id="tipoBusca" name="tipoBusca">
                	<option value="p">Produto</option>
                    <option selected="selected" value="g">Animal</option>
                </select>
            </div>
        	<div class="campo" style="width:20%;">
            	<label for="tituloBusca">Produto</label>
                <br />
                <input id="tituloBusca" name="tituloBusca" type="text">
            </div>
            <div class="campo" style="width:18%;">
                <label for="valorBusca">Valor</label>
                <br />
                <select id="valorBusca" name="valorBusca">
                	<option value="">Todos</option>
                	<option value="1|100">de R$1,00 até R$100,00</option> 
                    <option value="101|300">de R$101,00 até R$300,00</option> 
                    <option value="301|500">de R$301,00 até R$500,00</option> 
                    <option value="501|1000">de R$501,00 até R$1.000,00</option> 
                    <option value="1001|3000">de R$1.001,00 até R$3.000,00</option> 
                    <option value="3001|10000">de R$3.001,00 até R$10.000,00</option> 
                    <option value="10001">acima de R$10.000,00</option> 
                </select>
            </div>
            <div class="campo" style="width:10%;">
            	<label for="videoBusca">Vídeo</label>
                <br />
                <select id="videoBusca" name="videoBusca">
                	<option selected="selected" value="">Todos</option>
					<option value="f">sem vídeo</option>
                    <option value="t">com vídeo</option>
                </select>
            </div>
            <div class="campo" style="width:12%;">
            	<label for="anuncianteBusca">Anunciante</label>
                <br />
                <select id="anuncianteBusca" name="anuncianteBusca">
                	<option selected="selected" value="">Todos</option>
                	<?
						foreach($anunciantes as $anunciante) {
							echo '<option value="'.$anunciante->getId().'">'.$anunciante->getNome().' '.$anunciante->getSobrenome().'</option>';
               			}
               			unset($anunciante);
			   		?>  
                </select>
            </div>
            <div class="campo" style="width:8%;">
            	<label for="statusBusca">Status</label>
                <br />
                <select id="statusBusca" name="statusBusca">
                	<option value="">Todos</option>
					<option selected="selected" value="t">Ativo</option>
                    <option value="f">Inativo</option>
                </select>
            </div>
            <div class="campo ultimo-campo">
            	<label for="aaa"></label>
                <br />
                <input onclick="pesquisaAnuncios();" type="button" value="Pesquisar">
            </div>
        </div>
        
        <div id="resultadoBusca" class="line">
        	&nbsp;
        </div>        
        
    </div><!-- //busca -->
        
    <div id="cadastro-gado" class="anuncio-edicao" style="display: none;">
        <!--<h2>Lote número: <strong>36</strong></h2>-->
        <div class="line">
            <input type="hidden" id="idGado" name="idGado" value="" />
            <input type="hidden" id="dados_oldGado" name="dados_oldGado" value="" />
            
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
                <a id="linkVideoGado" href="#" target="_blank">
                    <img src="images/over-video.png" class="over-video" />
                    <img id="imgVideoGado" src="" />
                </a>
                <input name="videoGado" id="videoGado" type="text" value="LINK YOUTUBE" onfocus="clearIt(this)" onblur="setIt(this)">
                <input name="" type="button" onclick="carregaVideoGado();" value="Carregar vídeo">
            </div>
        </div>
        <div class="line">
        	<div class="campo" style="width:10%;">
                <label for="nomeGado">Data de Cadastro</label>
                <br />
                <strong><span id="dataCadGado">&nbsp;</span></strong>
            </div>
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
                <input id="quantidadeGado" name="quantidadeGado" class="number" type="text" value="">
            </div>
            <div class="campo" style="width:6%;">
                <label for="sexoGado">Sexo</label>
                <br />
                <select id="sexoGado" name="sexoGado" >
                    <option selected="selected" value="M">M</option>
                    <option value="F">F</option>
                </select>
            </div>
            <div class="campo" style="width:10%;">
                <label for="pesoMedioGado">Peso Médio (cabeça)</label>
                <br />
                <input id="pesoMedioGado" name="pesoMedioGado" class="number" type="text" value="">
            </div>            
        </div>
        
        <div class="line"> 
        	<div class="campo" style="width:8%;">
                <label for="idadeGado">Era (meses)</label>
                <br />
                <input id="idadeGado" name="idadeGado" type="text" class="number" value="">
            </div>
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
            
            <div class="campo" style="width:7%;">
                <label for="ufGado">Estado</label>
                <br />
                <select id="ufGado" name="ufGado" >
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
            <div class="campo" style="width:8%;">
                <label for="statusGado">Status</label>
                <br />
                <select id="statusGado" name="statusGado">
					<option value="t">Ativo</option>
                    <option value="f">Inativo</option>
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
                <input type="text" id="anuncianteGado" name="anuncianteGado" disabled="disabled" >
            </div>
        </div>
        <div class="line line-mapa">
            <h2>Localização do Gado</h2>
            <div class="campo" style="width:40%;">
                <input id="enderecoGado" name="enderecoGado" type="text" value="">
            </div>
            <iframe id="iframeEditaGado" name="iframeEditaGado" src="includes/mapa.php" frameborder="0" style="border:0; height:310px;"></iframe>
            
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
        	<input type="button" onclick="editaGado();" value="Salvar">
        </div>
    </div><!-- /anuncio-edicao -->
    
    
    <!-- Cadastro produto -->
    <div id="cadastro-produto" class="anuncio-edicao" style="display: none;">
    	<div class="line">
            <input type="hidden" id="id" name="id" value="" />
            <input type="hidden" id="dados_old" name="dados_old" value="" />
            
            <!-- IMAGEM 1 -->
            <div class="imagem">
            	<a href="#" id="link1" rel="shadowbox">
            		<div id="zoom1" class="zoom" style="display: none;"></div>
	            	<img id="imgprin1" class="classTitle" title="Clique para dar Zoom na imagem" />
	            </a>
             	<ul id="img1ex"></ul>
				<input type="hidden" name="img1" id="img1" />
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
	            <input type="hidden" name="img3" id="img3" />
            	<iframe id="uploadImg3" name="uploadImg3" src="ajax/uploadpc.php?tp=3" frameborder="0" scrolling="no"></iframe>
            </div>
            
            <!-- IMAGEM 4 -->
            <div class="imagem">
            	<a href="#" id="link4" rel="shadowbox">
            		<div id="zoom4" class="zoom" style="display: none;"></div>
	            	<img id="imgprin4" class="classTitle" title="Clique para dar Zoom na imagem" />
	            </a>
	            <ul id="img4ex"></ul>
	            <input type="hidden" name="img4" id="img4" />
            	<iframe id="uploadImg4" name="uploadImg4" src="ajax/uploadpc.php?tp=4" frameborder="0" scrolling="no"></iframe>
            </div>
            
            <!-- VIDEO -->
            <div class="imagem">
                <a id="linkVideo" href="#" target="_blank">
                    <img src="images/over-video.png" class="over-video" />
                    <img id="imgVideo" src="" />
                </a>
                <input name="video" id="video" type="text" value="LINK YOUTUBE" onfocus="clearIt(this)" onblur="setIt(this)">
                <input name="" type="button" onclick="carregaVideo();" value="Carregar vídeo">
            </div>
        </div>
        <div class="line">
        	<div class="campo" style="width:10%;">
                <label for="nomeGado">Data de Cadastro</label>
                <br />
                <strong><span id="dataCad">&nbsp;</span></strong>
            </div>
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
            <div class="campo" style="width:8%;">
                <label for="status">Status</label>
                <br />
                <select id="status" name="status">
					<option value="t">Ativo</option>
                    <option value="f">Inativo</option>
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
                <input id="anunciante" name="anunciante" type="text" value="" disabled="disabled">
            </div>
        </div>
        <div class="line" style="height: 50px !important;">
        	&nbsp;
        </div>   
        <div class="line line-salvar">
        	<input onclick="editaProduto();" type="button" value="Salvar">
        </div>    
    
    </div>
    
</div>