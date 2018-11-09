<?
	@session_start();
	if (!isset($_SESSION['ga']['id'])) {
		header('Location: login.php');
	}
?>
<?php $PAGE = "MEUS DADOS"; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<div class="minha-conta">
	<script type="text/javascript">
		function alteraCadastro() {
			$('.loading').show();
			$.post("ajax/alteraCadastro.php", { nome:$('#nome').val(), sobrenome:$('#sobrenome').val(), 
												telefone:$('#telefone').val(), cep:$('#cep').val(), 
												estado:$('#estado').val(), cidade:$('#cidade').val(), 
												endereco:$('#endereco').val(), bairro:$('#bairro').val(), 
												complemento:$('#complemento').val() }, 
				function(data){
					$('.loading').hide();
					if (data.location) {
						location.href = data.location;
					} else if (data.msg) {
						alert(data.msg);
						location.href = 'meusdados.php';
					} else {
						alert(data.erro);
					}
			},'json');
		}
		
		function alteraSenha() {
			if ($('#senha').val() != $('#confsenha').val()) {
				alert ("As senhas não conferem.");
			} else if ($('#senha').val().length <= 3) {
				alert ("A senha deverá ter mais que 3 caracteres.");
			} else {
				$('.loading').show();
				$.post("ajax/alteraCadastro.php", { senha:$('#senha').val() }, 
					function(data){
						$('.loading').hide();
						if (data.location) {
							location.href = data.location;
						} else if (data.msg) {
							alert(data.msg);
							location.href = 'meusdados.php';
						} else {
							alert(data.erro);
						}
				},'json');
			}
		}
		
		function buscaCidades(ufid, campo, cidid) {
			$('.loading').show();
			$.get("ajax/buscaCidCorreio.php", { uf:ufid, cid:cidid },
				function(data) {
					$("#"+campo).html(data);
					$('.loading').hide();
			}); 				
		}
		
		function buscaEndereco(cep){
			$('.loading').show();
			$.get("ajax/buscaEndereco.php", { cep:cep }, function(data) {
				$("#endereco").val(data.rua);
				$("#bairro").val(data.bairro);			    
				$("#estado").val(data.uf);
				buscaCidades(data.uf, 'cidade', data.cidade);
				$('.loading').hide();
			},'json');
		}
		
		$(function(){
			$('#cep').mask('99999-999');
			
			<?
				if ($_SESSION['ga']['estado']) {
					echo "buscaCidades('".$_SESSION['ga']['estado']."', 'cidade', '".$_SESSION['ga']['cidade']."');";
				}
			?>
		});
	</script>
	<div class="leftbar">
        <?php include "leftbar-acc.php"; ?>
    </div><!-- //leftbar -->
    
    <div class="rightbar meus-dados">
    	<h1>INFORMAÇÕES DA SUA CONTA</h1>
        
        <!--<div class="line">
            <p>
                Gostaria de anunciar seu gado no <strong>GADO AQUI?</strong>
                <br />
                Preencha o formulário abaixo e conheça nosso serviço de anúncio. A equipe <strong>GADO AQUI</strong> irá até onde está o gado para realizar a pesagem, tirar fotos e fazer também uma filmagem para que seu anúncio seja completo e tenha muitos acessos.
                
                <br /><br /><br />
            </p>
        </div>-->
        <div class="line line-campos">
        	<div class="campo" style="width:40%;">
                <label for="">E-mail de Cadastro</label>
                <br />
                <input type="text" value="<?=$_SESSION['ga']['email'];?>" readonly="readonly" />
            </div>
        </div>
        <div class="line line-campos">                        
            <div class="campo" style="width:25%;">
                <label for="nome">Nome</label>
                <br />
                <input name="nome" id="nome" type="text" value="<?=$_SESSION['ga']['nome'];?>"/>
            </div>
            <div class="campo" style="width:25%;">
                <label for="sobrenome">Sobrenome</label>
                <br />
                <input name="sobrenome" id="sobrenome" type="text" value="<?=$_SESSION['ga']['sobrenome'];?>"/>
            </div>
            <div class="campo" style="width:25%;">
                <label for="telefone">Telefone</label>
                <br />
                <input name="telefone" id="telefone" type="text" value="<?=$_SESSION['ga']['telefone'];?>" onfocus="clearIt(this)" onblur="setIt(this)">
            </div>
            
        </div>        
        
        <div class="line">
        	<h1>ENDEREÇO</h1>
        </div>
        <div class="line line-campos">   
        	<div class="campo" style="width:25%;">
                <label for="cep">Cep</label>
                <br />
                <input name="cep" id="cep" onblur="buscaEndereco(this.value);" type="text" value="<?=$_SESSION['ga']['cep'];?>"/>
            </div>                     
           	<div class="campo" style="width:15%;">
                <label for="estado">Estado</label>
                <br />
                <select onchange="buscaCidades(this.value, 'cidade');" name="estado" id="estado">
					<option value="" selected="selected">ESTADO</option> 
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
            <div class="campo" style="width:40%;">
                <label for="cidade">Cidade</label>
                <br />
                <select name="cidade" id="cidade"></select>
            </div>
            <div class="campo" style="width:50%;">
                <label for="endereco">Endereço</label>
                <br />
                <input name="endereco" id="endereco" type="text" value="<?=$_SESSION['ga']['endereco'];?>"/>
            </div>
            <div class="campo" style="width:27%;">
                <label for="bairro">Bairro</label>
                <br />
                <input name="bairro" id="bairro" type="text" value="<?=$_SESSION['ga']['bairro'];?>"/>
            </div> 
            <div class="campo" style="width:35%;">
                <label for="complemento">Complemento</label>
                <br />
                <input name="complemento" id="complemento" type="text" value="<?=$_SESSION['ga']['complemento'];?>"/>
            </div> 
        </div>
        
        <div class="line line-campos">
            <div class="campo ultimo-campo" style="width:30%;">
                <input name="" type="button" onclick="alteraCadastro();" value="Salvar Informações" class="">
            </div>
        </div>
        
        <div class="line">
        	<h1>DEFINIR NOVA SENHA DE ACESSO</h1>
        </div>
        
        <div class="line line-campos">
          	<div class="campo" style="width:30%;">
                <label for="senha">Nova senha</label>
                <br />
                <input name="senha" id="senha" type="password" />
            </div>
            <div class="campo" style="width:30%;">
                <label for="confsenha">Repetir senha</label>
                <br />
                <input name="confsenha" id="confsenha" type="password" />
            </div>            
        </div>
        
        <div class="line line-campos">
            <div class="campo ultimo-campo" style="width:30%;">
                <input name="" type="button" onclick="alteraSenha();" value="Alterar Senha" class="">
            </div>
        </div>
    
    </div><!-- //rightbar -->
</div>

<?php include "footer.php"; ?>