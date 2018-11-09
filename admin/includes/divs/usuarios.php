<?
	@session_start();
?>

<script type="text/javascript">
	function reprovaAnuncio(id, iduser) {
		$('.loading').show();
		$.post('ajax/reprovaAnuncio.php', { id: id }, function(data){
			$('.loading').hide();
			if (data.ok)
				getDadosUsuario(iduser);
			else
				alert(data.erro);
		},'json');
	}
	
	function reprovaGado(id, iduser) {
		$('.loading').show();
		$.post('ajax/reprovaGado.php', { id: id }, function(data){
			$('.loading').hide();
			if (data.ok)
				getDadosUsuario(iduser);
			else
				alert(data.erro);
		},'json');
	}
	
	function alteraUsuario() {
		if ($('#id').val()) {
			if ($('#nome').val() != '' && $('#sobrenome').val() != '' && $('#telefone').val() != '' && $('#email').val() != '' && $('#status').val() != '') {
				if (parseInt($('#countAnuncios').html()) > 0 && $('#status').val() == 'false') {
					alert('O usuário possui anúncios ativos. Desative-os antes de inativar o usuário');
				} else {
					$('.loading').show();
					$.post('ajax/alteraUsuario.php', { nome: $('#nome').val(), sobrenome: $('#sobrenome').val(), telefone: $('#telefone').val(),
														email: $('#email').val(), status: $('#status').val(), id:$('#id').val() }, 
						function(data){	
							$('.loading').hide();
							if (data.erro)
								alert(data.erro);
							else
								pesquisaUsuarios();
					}, 'json');
				}
			} else {
				alert('Todos os campos são obrigatórios');
			}
		} else {
			alert('Selecione um usuário para alterar.');
		}
	}
	
	function apagaForm() {
		$('#nomeSobrenome').html('');
		$('#countAnuncios').html('');
		$('#anuncios').html('');
		
		$('#id').val('');
		$('#nome').val('');
		$('#sobrenome').val('');
		$('#telefone').val('');
		$('#email').val('');
		$('#status').val('');
	}
	
	function pesquisaUsuarios() {
		$('.loading').show();
		$('#anunciosUsuario').hide();
		apagaForm();
		$("#resultadoBusca").html("");
		$.get('ajax/pesquisaUsuarios.php', { nome: $('#nomeBusca').val(), sobrenome: $('#sobrenomeBusca').val(), telefone: $('#telefoneBusca').val(),
											email: $('#emailBusca').val(), status: $('#statusBusca').val() }, 
			function(data){
				$('.loading').hide();
				$("#resultadoBusca").html(data.html);
		}, 'json');
	}
	
	function getDadosUsuario(id) {
		$('.loading').show();
		apagaForm();
		$.get('ajax/getDadosUsuario.php', { id: id }, 
			function(data){	
				$('.loading').hide();
				
				$('#nomeSobrenome').html(data.nome+' '+data.sobrenome);
				var count = parseInt(data.anuncios.length) + parseInt(data.gados.length);
				$('#countAnuncios').html(count);
				
				$('#id').val(data.id);
				$('#nome').val(data.nome);
				$('#sobrenome').val(data.sobrenome);
				$('#telefone').val(data.telefone);
				$('#email').val(data.email);
				if (data.status)
					$('#status').val('true');
				else
					$('#status').val('false');
				
				var anuncios = '';
				for(var i in data.anuncios) {
					var anun = data.anuncios[i];
					anuncios += '<div class="anuncio anuncio-menor">';
		                anuncios += '<div class="imagem">';
		                    anuncios += '<img src="../images/produto/'+anun.imagens[0]+'">';
		                anuncios += '</div>';
		                anuncios += '<div class="info">';
		                    anuncios += '<h3>'+anun.nome+'</h3>';
		                    anuncios += '<div class="coluna">';                
		                        anuncios += 'Valor: <strong>R$ '+anun.valor+'</strong><br />';
		                        anuncios += anun.imagens.length+' fotos<br />';
		                        var icon = 'icon-delete.png';
								if (anun.video)
		                        	icon = 'icon-check.png';
		                        anuncios += 'Vídeo: <img src="images/'+icon+'"><br />';          
		                    anuncios += '</div>';
		                anuncios += '</div>';
		                anuncios += '<div class="acoes">';
		                    anuncios += '<a href="../produto.php?id='+anun.id+'&v=1" class="classTitle" target="_blank" title="Ver Anúncio"><img src="images/icon-see.png"></a>';
		                    anuncios += '<a href="javascript:;" onclick="reprovaAnuncio('+anun.id+', '+id+');" class="classTitle" title="Negar / Deletar Anúncio"><img src="images/icon-del.png"></a>';
		                anuncios += '</div>';
		            anuncios += '</div>';
				}
				for(var i in data.gados) {
					var anun = data.gados[i];
					anuncios += '<div class="anuncio anuncio-menor">';
		                anuncios += '<div class="imagem">';
		                    anuncios += '<img src="../images/gado/'+anun.imagens[0]+'">';
		                anuncios += '</div>';
		                anuncios += '<div class="info">';
		                    anuncios += '<h3>'+anun.nome+'</h3>';
		                    anuncios += '<div class="coluna">';                
		                        anuncios += 'Valor: <strong>R$ '+anun.valor+'</strong><br />';
		                        anuncios += anun.imagens.length+' fotos<br />';
		                        var icon = 'icon-delete.png';
								if (anun.video)
		                        	icon = 'icon-check.png';
		                        anuncios += 'Vídeo: <img src="images/'+icon+'"><br />';          
		                    anuncios += '</div>';
		                anuncios += '</div>';
		                anuncios += '<div class="acoes">';
		                    anuncios += '<a href="../anuncio.php?id='+anun.id+'&v=1" class="classTitle" target="_blank" title="Ver Anúncio"><img src="images/icon-see.png"></a>';
		                    anuncios += '<a href="javascript:;" onclick="reprovaGado('+anun.id+', '+id+');" class="classTitle" title="Negar / Deletar Anúncio"><img src="images/icon-del.png"></a>';
		                anuncios += '</div>';
		            anuncios += '</div>';
				}
				$('#anuncios').html(anuncios);
				
				$('#anunciosUsuario').show();
		}, 'json');
	}
	
	$(function(){
		$('#telefone').mask('(99) 9999-9999');
		$('#telefoneBusca').mask('(99) 9999-9999');
		pesquisaUsuarios();
	});
</script>

<h1>Usuários Cadastrados</h1>
<div class="line">
	<div class="busca">
    	<div class="line">
        	<div class="campo" style="width:14%;">
                <label for="nomeBusca">Nome</label>
                <br />
                <input id="nomeBusca" name="nomeBusca" type="text">
            </div>
            <div class="campo" style="width:14%;">
                <label for="sobrenomeBusca">Sobrenome</label>
                <br />
                <input id="sobrenomeBusca" name="sobrenomeBusca" type="text">
            </div>
        	<div class="campo" style="width:10%;">
            	<label for="telefoneBusca">Telefone</label>
                <br />
                <input id="telefoneBusca" name="telefoneBusca" type="text" >
            </div>
            <div class="campo" style="width:15%;">
            	<label for="emailBusca">E-mail</label>
                <br />
                <input id="emailBusca" name="emailBusca" type="text">
            </div>            
            <div class="campo" style="width:9%;">
            	<label for="statusBusca">Status</label>
                <br />
                <select id="statusBusca" name="statusBusca">
                	<option value="">todos</option>
                	<option value="true" selected="selected">ativo</option>
                    <option value="false">inativo</option>
                </select>
            </div>
            <div class="campo">
            	<label for="btnPesquisar"></label>
                <br />
                <input id="btnPesquisar" name="btnPesquisar" onclick="pesquisaUsuarios();" type="button" value="Pesquisar">
            </div>
        </div>
        
        <div id="resultadoBusca" class="line">
        	&nbsp;
        </div>
        
        
    </div><!-- //busca -->
        
    <div id="anunciosUsuario" class="anuncio-edicao" style="display: none;">
        <h2>Usuário Selecionado: <strong><span id="nomeSobrenome">&nbsp;</span></strong></h2>        
        <div class="line">
        	<input id="id" name="id" type="hidden"/>
            <div class="campo" style="width:15%;">
                <label for="nome">Nome</label>
                <br />
                <input name="nome" id="nome" type="text">
            </div>
            <div class="campo" style="width:15%;">
                <label for="sobrenome">Sobrenome</label>
                <br />
                <input name="sobrenome" id="sobrenome" type="text">
            </div>
            <div class="campo" style="width:12%;">
                <label for="telefone">Telefone</label>
                <br />
                <input name="telefone" id="telefone" type="text">
            </div>
            <div class="campo" style="width:20%;">
                <label for="email">Email</label>
                <br />
                <input name="email" id="email" type="text">
            </div>
            <div class="campo" style="width:9%;">
                <label for="status">Status</label>
                <br />
                <select name="status" id="status">
                	<option value="">selecione</option>
                	<option value="true">ativo</option>
                    <option value="false">inativo</option>
                </select>
            </div>
        </div>
        <div class="line" style="margin-bottom: 40px !important;">
        	<h2>Anuncios desse usuário <strong>(<span id="countAnuncios">&nbsp;</span>)</strong></h2>
			<div id="anuncios">      
	        	<?php/* for ($i = 1; $i <= 5; $i++) { ?>
	            <div class="anuncio anuncio-menor">
	                <div class="imagem">
	                    <img src="images/uploads/imagem-produto.jpg">
	                </div>
	                <div class="info">
	                    <h3>Ração para Boi</h3>
	                    <div class="coluna">                
	                        Valor: <strong>R$ 1.400,00</strong><br />
	                        4 fotos<br />
	                        Vídeo: <img src="images/icon-check.png"><br />
	                        Localização: <img src="images/icon-delete.png">               
	                    </div>
	                </div>
	                <div class="acoes">
	                    <a href="../produto.php" class="classTitle" target="_blank" title="Ver Anúncio"><img src="images/icon-see.png"></a>
	                    <a href="javascript:;" class="classTitle" title="Negar / Deletar Anúncio"><img src="images/icon-del.png"></a>
	                </div>
	            </div>
	            <?php }*/ ?>
            </div>
        </div>
        
        
        <div class="line line-salvar">
        	<input type="button" onclick="alteraUsuario();" value="Salvar">
        </div>
    </div><!-- /anuncio-edicao -->
    
</div>