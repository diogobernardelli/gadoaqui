<?php $PAGE = "CADASTRO"; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>

<script type="text/javascript">
$(document).ready(function() { 
	$("#pagseguro").click(function() {	
		$(".box-pagseguro").fadeIn(600);
	});
	
	$(".box-pagseguro").click(function() {	
		$(".box-pagseguro").fadeOut(600);
	});
});
</script>

<div class="box-pagseguro">
	<div class="content-pagseguro">
    	<img src="images/pagseguro.jpg" />
        <p>Você está sendo redirecionado para o site <a href="https://pagseguro.uol.com.br/" target="_blank">PagSeguro</a> para finalizar o cadastro de sua conta de Associado.</p>
        <p>Caso não seja redirecionado automaticamente em até 5 segundos, <a href="https://pagseguro.uol.com.br/" target="_blank">clique aqui</a>.</p>
        <div class="direcionando">
        	<span>direcionando... <img src="images/loading-pagseguro.GIF" /></span>
        </div>
    </div>
</div>

<div class="login login-anunciar">
	<div class="line line-border">
        <div class="campo ultimo-campo" style="width:20%;">
            <input onclick="location.href='painel.php'" name="" type="button" value="Finalizar Cadastro" class="next" />
        </div>
    </div>
	<h1>CONCLUA SEU CADASTRO VIRANDO UM ASSOCIADO DO GADO AQUI!</h1>
	<div class="line">
    	<div class="planos">   
            <p>Gostaria de anunciar seu gado ou produto agrícola? Crie uma conta e comece agora mesmo a divulgar sua mercadoria.</p>
            <div class="tabela-planos">
                <div class="plano plano-free">
                	<h1>CADASTRADO COMUM</h1>
                    <h3>Todos podem anunciar!</h3>
                    <div class="valor">
                        FREE
                    </div>
                    <div class="vantagem">
                        <p>Anúncio de Produtos:</p>
                        <div class="true">
                            <img src="images/icon-check-white.png" />
                        </div>
                    </div>
                    <div class="vantagem">
                        <p>Anúncio de Gado:</p>
                        <div class="false">
                            <img src="images/icon-delete-white.png" />
                        </div>
                    </div>
                </div>
                
                <div class="plano plano-pago">
                	<h1>ASSOCIADO</h1>
                    <h3>Anuncie seu Gado</h3>
                    <div class="valor">
                        R$ 4,99/m
                    </div>
                    <div class="vantagem">
                        <p>Anúncio de Produtos:</p>
                        <div class="true">
                            <img src="images/icon-check-blue.png" />
                        </div>
                    </div>
                    <div class="vantagem">
                        <p>Anúncio de Gado:</p>
                        <div class="true">
                            <img src="images/icon-check-blue.png" />
                        </div>
                    </div>
                </div>
                
            </div>
            <!--<img src="images/formas-pagamento.jpg" class="formas-pagamento" />-->
        </div>
    
        <div class="login-cadastrar">
            <div class="box">
                <h2>DADOS DO ASSOCIADO</h2>
                <input name="" type="text" value="CPF" onfocus="clearIt(this)" onblur="setIt(this)" />
                <input name="" type="text" value="TELEFONE 1" onfocus="clearIt(this)" onblur="setIt(this)" />
                <input name="" type="text" value="TELEFONE 2" onfocus="clearIt(this)" onblur="setIt(this)" />
                <input name="" type="text" value="CEP" onfocus="clearIt(this)" onblur="setIt(this)" />
                <p>aaaa</p>
                <input id="pagseguro" name="" type="button" value="ASSOCIAR-SE" />
                <div class="clear"></div>
            </div>
        </div>
        
    </div>
</div>
<?php include "footer.php"; ?>