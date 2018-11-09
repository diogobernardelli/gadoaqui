<div class="menu-lateral">
	<div class="topo">
   		<img src="images/logo-sistema-white.png" class="logo-sistema">
        <a href="ajax/logout.php">
        	<img src="images/logout.png" class="logout">
        </a>
    </div>
	<div class="logo-menu">
    	<img src="images/temp-cliente.jpg">
        
    </div>
    <div id="wrapper">
    
        <ul class="menu" id="menu-principal">        	
            <li class="item1"><a href="javascript:;"><font>Anúncios</font><img src="images/open.png" class="open" /></a>
                <ul>
                    <li class="subitem1"><a href="javascript:;" onclick="mostraDivMenu('anuncios-novos');">Novos<span id="countNovosAnuncios" style="display: none;">&nbsp;</span></a></li>
                    <li class="subitem2"><a href="javascript:;" onclick="mostraDivMenu('anuncios');">Todos</a></li>                    
                    <li class="subitem2"><a href="javascript:;" onclick="mostraDivMenu('anuncios-cadastrar');">Cadastrar</a></li>
                    <li class="subitem2"><a href="javascript:;" onclick="mostraDivMenu('anuncios-categorias');">Categorias</a></li>
                </ul>
            </li>
            <li class="item2"><a href="javascript:;" onclick="mostraDivMenu('usuarios');"><font>Usuários</font></a></li>
            <li class="item5"><a href="javascript:;" onclick="mostraDivMenu('cotacoes');"><font>Cotações</font></a></li> 
            <li class="item3"><a href="javascript:;" onclick="mostraDivMenu('newsletter');"><font>Newsletter</font></a></li>
            <li class="item4"><a href="javascript:;" onclick="mostraDivMenu('publicidade');"><font>Publicidade</font></a></li>                                   
        </ul>
    
    </div>
</div>