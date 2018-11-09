<?php $PAGE = "QUEM SOMOS"; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<div class="anuncios anuncios-gados">	
    
	<div class="leftbar">        	
        
        <div class="ads">
        	<a href="javascript:;" target="_blank">
                <img src="images/120x240.gif" />
            </a>
            <a href="javascript:;" target="_blank">
                <img src="images/120x2400.gif" />
            </a>
        </div>
        
        <div class="chamada-anunciar">
        	<a href="login.php" class="classTitle botao" title="Anuncie seu Gado ou <br />Produto Agrícola <strong>Aqui</strong>!">
                <img src="images/topo-anuncie.png" />Anuncie Aqui!
            </a>
        </div>
        
        <div class="resumo-produtos">
        	<h4>Veja também</h4>
			<?php for ($i = 1; $i <= 2; $i++) { ?>
            <div class="item">
                <a href="produto.php" >
                    <div class="imagem">
                        <img src="images/imagem-produto.jpg" />
                    </div>
                    <div class="info">
                        <h1>Ração</h1>
                        <br />
                        Peso: <strong>70 Kg</strong><br />
                        Estado: <strong>MS</strong><br />
                        Valor: <span>R$ 1.400,00</span><br />                    
                    </div>
                    <div class="botao">
                        mais informações
                    </div>
                </a>
            </div>
            <?php } ?>
            <?php for ($i = 1; $i <= 2; $i++) { ?>
            <div class="item">
                <a href="produto.php" >
                    <div class="imagem">
                        <img src="images/imagem-gado.jpg" />
                    </div>
                    <div class="info">
                        <h1>BOIS</h1>
                        <br />
                        Tipo: <strong>Bovino</strong><br />
                        Qtd: <strong>12</strong><br />
                        Valor: <span>R$ 4,40 / Kg</span><br />                    
                    </div>
                    <div class="botao">
                        mais informações
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
        
        <div class="facebook">
        	<div class="fb-like" data-href="https://www.facebook.com/omicareteiro" data-width="200" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
        </div>
    </div><!-- //leftbar -->
    
    <div class="rightbar">
    	<h1>QUEM SOMOS</h1>
        
        <div class="texto">
        	<img src="images/imagem-quem-somos.jpg" class="imagem-quem-somos" />
        	<p><strong>Gado Aqui</strong> é um projeto que vem sendo amadurecido há anos, e já é chego o momento do produtor rural desfrutar das suas facilidades na hora de comprar ou vender animais das mais variadas espécies, raças e finalidades, podendo contar também com a possibilidade de anunciar adjacentes de insumos, tais como: feno, ração, grãos, silo e similares.</p>
<p>O Gado Aqui começa seus trabalhos no dia 22 de agosto de 2014, e espera contribuir dessa data em diante com as negociações do produtor, livre de taxas de comissão e com o contato direto comprador/vendedor. Contem também com as ferramentas de localização dos anúncios, isso facilitará você comprador a ponderar suas despesas de frete na hora de arrematar seu lote! E a você vendedor, conte com a comodidade de não se preocupar com cortar nota para leilões, pagar comissão para leilões, pagar frete para chegar ao recinto.</p>
<p>Com esses intuitos o site <strong>gadoaqui</strong> foi elaborado, pensando nos dois lados da moeda do agronegócio: vendedor/comprador.</p>
<p>Que esse site seja uma ferramenta adicional para o produtor que já tanto paga por impostos, taxas e custos adicionais para produzir.</p>
        </div>
        
        
    </div><!-- //rightbar -->
</div>

<?php include "footer.php"; ?>