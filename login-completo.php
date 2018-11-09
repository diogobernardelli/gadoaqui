<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<div class="login login-anunciar">
	<!--<h1>VOCÊ PRECISA ESTAR LOGADO PARA ANUNCIAR</h1>-->
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
                    <a href="cadastro.php">
                        CADASTRAR
                    </a>
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
                    <a href="cadastro.php">
                        CADASTRAR
                    </a>
                </div>
                
            </div>
            <img src="images/formas-pagamento.jpg" class="formas-pagamento" />
        </div>
    
        <div class="login-cadastrar">
            <div class="box">
                <h2>ACESSE SUA CONTA</h2>
                <input name="" type="text" value="NOME" onfocus="clearIt(this)" onblur="setIt(this)" />
                <input name="" type="password" value="SENHA" onfocus="clearIt(this)" onblur="setIt(this)" />
                <input onclick="location.href='minhaconta.php'" name="" type="button" value="ACESSAR" />
                <a href="javascript:;">Esqueceu sua senha / conta?</a>
                <div class="clear"></div>
            </div>
            <div class="box box-cadastro">
                <h2>AINDA NÃO TEM UMA CONTA?</h2>
                <input name="" type="text" value="NOME" onfocus="clearIt(this)" onblur="setIt(this)" />
                <input onclick="location.href='cadastro.php'" name="" type="button" value="CADASTRAR" />
            </div>
        </div>
        
    </div>
</div>
<?php include "footer.php"; ?>