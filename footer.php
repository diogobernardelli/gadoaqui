<div class="footer">
	<div class="content">
    	<div class="coluna-contato">
        	<h5>INFO CONTATO</h5>
            <p>Rua Espírito Santo, 851 - Campo Grande / MS<br />
            Tel: (67) 9824.4580<br />
            E-mail: contato@gadoaqui.com.br<br />
            <a href="http://www.facebook.com/gadoaqui" target="_blank">
            	<img src="images/facebook.png">
                 /gadoaqui
            </a>
            </p>
        </div>
        <div class="coluna-mapadosite">
        	<h5>MAPA DO SITE</h5>
        	<ul>
            	<li>
                	<h6>
                    	PÁGINAS
                    </h6>
                </li>
            	<li>
                	<a href="index.php">
                    	HOME
                    </a>
                </li>
                <li>
                	<a href="gadoaqui.php">
                    	GADO AQUI
                    </a>
                </li>
                <li>
                	<a href="produtos.php">
                    	PRODUTOS
                    </a>
                </li>
                <li class="menu-anuncie">
                	<a href="anunciar.php">
                    	ANUNCIE
                    </a>
                </li>
                <li>
                	<a href="contato.php">
                    	CONTATO
                    </a>
                </li>
            </ul>
            
            <ul>
            	<li>
                	<h6>
                    	INSTITUCIONAL
                    </h6>
                </li>
            	<li class="menu-anuncie">
                	<a href="login.php">
                    	PLANOS PARA ANÚNCIO
                    </a>
                </li>
                <li>
                	<a href="politicasdeprivacidade.php">
                    	POLÍTICAS DE PRIVACIDADE
                    </a>
                </li>
                <li>
                	<a href="institucional.php">
                    	QUEM SOMOS
                    </a>
                </li>
            </ul>
            
            <ul>
            	<li>
                	<h6>
                    	GADOS
                    </h6>
                </li>
                <?
					foreach($categorias as $categoria) {
						echo '<li>
				                	<a href="gadoaqui.php?tipo='.$categoria->getId().'">
				                    	'.$categoria->getNome().'
				                    </a>
				                </li>';
           			}
           			unset($categorias, $categoria, $categoriacontrol);
		   		?>
            </ul>
        </div>
        <div class="coluna-newsletter">
        	<img src="images/icon-letter.png" class="icon-letter" /><h5>NEWSLETTER</h5>
            <p>Receba por e-mail os principais anúncios de Gado e Produtos Agrícolas do Gado Aqui!</p>
            <br />
            <div class="form">
            	<?
            		$disp = '';
            		if (isset($_SESSION['ga']['id'])) {
						$disp = 'style="display:none;"';
					}
				?>
                <input name="nomeNewsletter" id="nomeNewsletter" type="text" value="<?=($_SESSION['ga']['nome'])?$_SESSION['ga']['nome']:'nome';?>" onfocus="clearIt(this)" onblur="setIt(this)" <?=$disp;?>>
                <br />
                <input name="emailNewsletter" id="emailNewsletter" type="text" value="<?=($_SESSION['ga']['email'])?$_SESSION['ga']['email']:'e-mail';?>" onfocus="clearIt(this)" onblur="setIt(this)" <?=$disp;?>>
                <br />
                <input onclick="cadastraNewsletter($('#nomeNewsletter').val(), $('#emailNewsletter').val());" type="button" value="Cadastrar-se na Newsletter">
            </div>
            <div class="newsletter-sucesso">
            	<p>Seu cadastro em nossa newsletter foi realizado com sucesso!</p>
            </div>
        </div>
        
        <div class="copyright">
        	<div class="info">
            	<img src="images/logo-dagoaqui-rodape.png">
                <p>© 2014 - <strong>GADO AQUI</strong><br >
                Todos os direitos reservados</p>
            </div>
            <a href="http://www.diogobernardelli.com.br" target="_blank" class="classTitle logoDiogo" title="Site Criado e Desenvolvido<br />por <strong>Diogo Bernardelli</strong>">
            	<img src="images/logo-diogobernardelli.png">
            </a>
        </div>
    </div>
</div>
</body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54281103-1', 'auto');
  ga('send', 'pageview');

</script>
</html>