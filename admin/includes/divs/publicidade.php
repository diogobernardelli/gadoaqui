<script type="text/javascript">		
	function apagaForm() {
		$('#dados_old').val('');
		$('#id').val('');
		$('#nome_span').html('&nbsp;');
		$('#nome').val('');
		$('#url').val('');
		$('#tipo').val('');
		$('#data_fim').val('');
		$('#data_inicio').val('<?=date('d/m/Y');?>');
		$('#status').val('true');
		
		$('#img1').val('');
		$('#imgprin1').attr('src', '');
		$('#img1ex').html('');
		$("#uploadImg1").contents().find("#upload").show();
		
		$('#btnPublicidade').unbind('click');
		$('#btnPublicidade').bind('click', function(){
			cadastraPublicidade();
		});
	}
	
	function cadastraPublicidade() {
		if ($('#nome').val() != '' && $('#url').val() != '' && $('#tipo').val() != '' && 
			$('#data_inicio').val() != '' && $('#status').val() != '' && $('#img1').val()) {
				
				$('.loading').hide();
				
				$.post("ajax/cadastraPublicidade.php", { nome:$('#nome').val(), url:$('#url').val(), tipo:$('#tipo').val(), 
														data_inicio:$('#data_inicio').val(), data_fim:$('#data_fim').val(), 
														status:$('#status').val(), arquivo: $('#img1').val() }, 
					function(data){
						$('.loading').hide();
						if (data.ok) {
							mostraDivMenu('publicidade');
						} else {
							alert(data.erro);
						}
				},'json');
		} else {
			alert('Todos os campos são obrigatórios!');
		}
	}
	
	function editaPublicidade() {
		if ($('#nome').val() != '' && $('#url').val() != '' && $('#tipo').val() != '' && 
			$('#data_inicio').val() != '' && $('#status').val() != '' && $('#img1').val()) {
				
				$('.loading').show();
				
				$.post("ajax/editaPublicidade.php", { id: $('#id').val(), nome:$('#nome').val(), url:$('#url').val(), tipo:$('#tipo').val(), 
														data_inicio:$('#data_inicio').val(), data_fim:$('#data_fim').val(), 
														status:$('#status').val(), arquivo: $('#img1').val(), dados_old: $('#dados_old').val() }, 
					function(data){
						$('.loading').hide();
						if (data.ok) {
							mostraDivMenu('publicidade');
						} else {
							alert(data.erro);
						}
				},'json');
		} else {
			alert('Todos os campos são obrigatórios!');
		}
	}
	
	function pesquisaPublicidade() {
		$('.loading').show();
		$("#resultadoBusca").html("");
		apagaForm();
		$.get('ajax/pesquisaPublicidade.php', 
			function(data){		
				$('.loading').hide();
				$("#resultadoBusca").html(data.html);
		}, 'json');
	}
	
	function removePublicidade(id) {
		$('.loading').show();
		$.post('ajax/removePublicidade.php', { id: id }, function(data){
			$('.loading').hide();
			if (data.ok)
				pesquisaPublicidade();
			else
				alert(data.erro);
		},'json');
	}
	
	function getPublicidade(id) {
		$('.loading').show();
		$.get('ajax/getPublicidade.php', { id: id }, function(data){
			if (data) {
				$('.loading').hide();
				
				$('#dados_old').val(JSON.stringify(data));
				$('#id').val(id);
				$('#nome_span').html(data.nome);
				$('#nome').val(data.nome);
				$('#url').val(data.url);
				$('#tipo').val(data.tipo);
				$('#data_fim').val(data.data_fim);
				$('#data_inicio').val(data.data_inicio);
				$('#status').val(data.status);
				$('#img1').val(data.arquivo);
				$('#imgprin1').attr('src', '../images/parceiro/'+data.arquivo);
				$('#img1ex').html('<input name="" type="button" value="Excluir Imagem" onclick="$(\'#uploadImg1\')[0].contentWindow.removeAnexo(\'1\')" \/>');
				$("#uploadImg1").contents().find("#upload").hide();
				
				$('#btnPublicidade').unbind('click');
				$('#btnPublicidade').bind('click', function(){
					editaPublicidade();
				});
			} 
		},'json');
	}
	
	$(function(){
		pesquisaPublicidade();
	});
</script>

<h1>Publicidade</h1>
<div class="line">
	<div class="busca">
    	<div class="line">
            <div class="campo ultimo-campo">
                <input type="button" onclick="apagaForm();" value="Novo Anúncio">
            </div>
        </div>
        
        <div id="resultadoBusca" class="line">
        	&nbsp;
        </div>
        
        
    </div><!-- //busca -->
        
    <div class="imagem-edicao">
        <h2>Anúncio Selecionado: <strong><span id="nome_span">&nbsp;</span></strong></h2>        
        <div class="line">
        	<input type="hidden" id="dados_old" name="dados_old" />
        	<input type="hidden" id="id" name="id" />
        	<div class="campo" style="width:15%; overflow:hidden;">
            	<label for="aaa">Imagem (.jpg, .gif, .png, .flv)</label>
                <br />
            	<img id="imgprin1" class="classTitle" />
             	<ul id="img1ex"></ul>
				<input type="hidden" name="img1" id="img1"/>
	            <iframe id="uploadImg1" name="uploadImg1" src="ajax/uploadpc.php?tp=1" frameborder="0" scrolling="no"></iframe>
            </div>
            <div class="campo" style="width:12%;">
                <label for="nome">Nome</label>
                <br />
                <input id="nome" name="nome" type="text">
            </div>
            <div class="campo" style="width:19%;">
                <label for="url">URL de Destino</label>
                <br />
                <input id="url" name="url" type="text">
            </div>
            <div class="campo" style="width:15%;">
                <label for="tipo">Tipo</label>
                <br />
                <select id="tipo" name="tipo">
                	<option value="">Selecione</option>
                	<option value="1">FullBanner (970x80px)</option>
                    <option value="2">Lateral (40x200px)</option>
                </select>
            </div>
            <div class="campo" style="width:12%;">
                <label for="data_fim">Ativo por</label>
                <br />
                <select id="data_fim" name="data_fim">
                	<option value="">Eu irei removê-lo manualmente</option>
                	<option value="10">10 dias</option>
                    <option value="30">30 dias</option>
                    <option value="60">60 dias</option>
                    <option value="90">90 dias</option>
                </select>
            </div>
            <div class="campo" style="width:8%;">
                <label for="data_inicio">Data</label>
                <br />
                <input id="data_inicio" name="data_inicio" type="text" value="<?=date('d/m/Y');?>" >
            </div>   
            <div class="campo ultimo-campo" style="width:8%;">
                <label for="status">Status</label>
                <br />
                <select id="status" name="status">
                	<option value="true" selected="selected">Ativo</option>
                    <option value="false">Inativo</option>
                </select>
            </div>         
        </div>        
        
        
        <div class="line line-salvar">
        	<input type="button" id="btnPublicidade" value="Salvar">
        </div>
    </div><!-- /anuncio-edicao -->
    
</div>