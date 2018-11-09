<?
	@session_start();
	if (isset($_SESSION['ga']['id'])) {
		header('Location: minhaconta.php');
	}
?>
<?php $PAGE = "CADASTRO"; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<div class="cadastro">

	<script type="text/javascript">
		function cadastraAnunciante() {
			if ($('#nome').val() != '' && $('#telefone').val() != '' && $('#email').val() != '' && $('#senha').val() != '' && $('#confsenha').val() != '') {
				if ($('#senha').val() != $('#confsenha').val()) {
					alert ("As senhas não conferem.");
				} else if ($('#senha').val().length <= 3) {
					alert ("A senha deverá ter mais que 3 caracteres.");
				} else {
					$('.loading').show();
					
					var news = '0';
					if ($('#news').prop('checked')) 
						news = '1';
						
					$.post("ajax/cadastraAnunciante.php", { nome:$('#nome').val(), sobrenome:$('#sobrenome').val(), 
														telefone:$('#telefone').val(), email:$('#email').val(), 
														senha:$('#senha').val(), news:news }, 
						function(data){
							$('.loading').hide();
							if (data.msg) {
								alert(data.msg);
								location.href = 'login.php';
							} else {
								alert(data.erro);
							}
					},'json');
				}
			} else {
				alert ("Os campos com asterisco(*) são obrigatórios.");
			}
		}
		
		$(function(){
			$('#telefone').mask('(99) 9999-9999');
		});
	</script>

    <table width="100%" border="0">
        <tr>
        	<td valign="top" style="position:relative;">
                <div class="formulario">
                    <div class="sub-title">
                        <h2>Dados Pessoais</h2>
                    </div>
                    <div class="line">
                        <div class="campo" style="width:30%;">
                            <label>Nome *</label>
                            <br />
                            <input name="nome" id="nome" type="text" />
                        </div>
                        <div class="campo" style="width:30%;">
                            <label>Sobrenome</label>
                            <br />
                            <input name="sobrenome" id="sobrenome" type="text" />
                        </div>
                        <div class="campo" style="width:30%;">
                            <label>Telefone</label>
                            <br />
                            <input name="telefone" id="telefone" type="text" onfocus="clearIt(this)" onblur="setIt(this)" />
                        </div>
                        <div class="clear"></div>
                        <div class="campo" style="width:30%;">
                            <label>E-mail *</label>
                            <br />
                            <input name="email" id="email" type="text" />
                        </div>
                        <div class="campo" style="width:30%;">
                            <label>Senha *</label>
                            <br />
                            <input name="senha" id="senha" type="password" />
                        </div> 
                        <div class="campo" style="width:30%;">
                            <label>Repetir Senha *</label>
                            <br />
                            <input name="confsenha" id="confsenha" type="password" />
                        </div>             
                    </div>
                    <div class="line">
                        <div class="campo" style="width:60%; padding-top:35px;">
                            <input name="news" id="news" type="checkbox" checked="checked" value="" />
                            <label for="news">Quero receber novidades e ofertas por e-mail</label>
                        </div>
                        <div class="campo ultimo-campo" style="width:20%;">
                            <input onclick="cadastraAnunciante();" name="" type="button" value="Finalizar Cadastro" class="next" />
                        </div>
                    </div>
                    <div class="line">
                        <span class="obs">Ao cadastrar-me, declaro que sou maior de idade e aceito a <a href="politicasdeprivacidade.php">Política de Privacidade</a> do <a href="index.php">GadoAqui</a>.<br />* = Dados obrigatórios</span>
                    </div>
                </div>    
            </td>
        	<td width="160">
            	<div class="ads">
                <?
			    	foreach ($lateral_banner as $pub) {
			    		echo '<a href="'.$pub->getUrl().'" onclick="incrementaClique('.$pub->getId().');" target="_blank">
			                        <img src="images/parceiro/'.$pub->getArquivo().'" title="'.$pub->getNome().'"/>
			                    </a>';
			    	}
				?>
                </div>
            </td>
        </tr>
    </table>
	
</div>
<div class="clear"></div>
<?php include "footer.php"; ?>