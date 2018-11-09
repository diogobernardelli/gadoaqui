<?
	chdir(dirname(__FILE__).'/../../../');
	include "pacotes/work/work_admin_newsletter.php";
	chdir('admin/');
	@session_start();
?>

<script type="text/javascript">		
	function pesquisaNewsletter() {
		$('.loading').show();
		$("#resultadoBusca").html("");
		$.get('ajax/pesquisaNewsletter.php', { nome: $('#nome').val(), email: $('#email').val() }, 
			function(data){				
				$('.loading').hide();
				$("#resultadoBusca").html(data.html);
		}, 'json');
	}
	
	function removeNewsletter(id) {
		$('.loading').show();
		$.post('ajax/removeNewsletter.php', { id: id }, function(data){
			$('.loading').hide();
			if (data.ok)
				pesquisaNewsletter();
			else
				alert(data.erro);
		},'json');
	}
</script>

<h1>Visitantes cadastrados na Newsletter</h1>
<div class="line">
	<div class="busca">
    	<div class="line">
        	<div class="campo" style="width:14%;">
                <label for="nome">Nome</label>
                <br />
                <input name="nome" id="nome" type="text">
            </div>
            <div class="campo" style="width:15%;">
            	<label for="email">E-mail</label>
                <br />
                <input name="email" id="email" type="text">
            </div>
            <div class="campo">
            	<label for="btnPesquisar"></label>
                <br />
                <input name="btnPesquisar" id="btnPesquisar" onclick="pesquisaNewsletter();" type="button" value="Pesquisar">
            </div>
        </div>
        
        <div id="resultadoBusca" class="line">
        	<table border="0" cellspacing="0" cellpadding="0" class="display tableJquery" id="tableJquery">
                <thead>
                    <tr class="table_titulo">
                        <th>Nome</th>
                        <th class="center" width="200">E-mail</th>
                        <th width="30"></th>
                    </tr>
                </thead>
                <tbody>
                	<?php foreach ($newsletters as $news) { ?>
                    <tr class="lines noticia_show odd" id="aaa" >
                        <td class="center"><?=$news->getNome();?></td>
                        <td class="center"><?=$news->getEmail();?></td>
                        <td class="center"><a href="javascript:;" onclick="removeNewsletter(<?=$news->getId();?>);" class="classTitle" title="Excluir"><img src="images/icon-delete.png" width="17" style="position:relative; top:5px;"></a></td>
                    </tr>
                    <?php } ?>  
                </tbody>
            </table>
        </div>
        
        <div class="line line-salvar">
        	<input class="xls" type="button" value="Exportar para XLS" >
        </div>
        
        
    </div><!-- //busca -->
</div>