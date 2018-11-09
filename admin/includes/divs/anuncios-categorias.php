<?
	chdir(dirname(__FILE__).'/../../../');
	include "pacotes/work/work_admin_categorias.php";
	chdir('admin/');
	@session_start();
?>

<style type="text/css">
	.dataTables_length, .dataTables_filter, .dataTables_info, .dataTables_paginate {
		display:none;
	}
	.dataTables_wrapper {
		position:relative;
		bottom:15px;
	}
</style>

<script type="text/javascript">
	function cadastraCategoria() {
		if ($('#categoria').val() != '' && $('#categoria').val() != 'CATEGORIA') {
			$('.loading').show();
			$.post('ajax/cadastraCategoria.php', { nome: $('#categoria').val() }, function(data){
				$('.loading').hide();
				if (data.ok)
					mostraDivMenu('anuncios-categorias');
				else
					alert(data.erro);
			},'json');
		} else
			alert('Categoria é obrigatório!');
	}
	
	function removeCategoria(id) {
		$('.loading').show();
		$.post('ajax/removeCategoria.php', { id: id }, function(data){
			$('.loading').hide();
			if (data.ok)
				mostraDivMenu('anuncios-categorias');
			else
				alert(data.erro);
		},'json');
	}
</script>

<h1>
	Gerenciar Categorias
</h1>
<div class="line">	
    <div class="campo" style="width:40%;">
    	<div class="campo" style="width:60%;">
            <input name="categoria" id="categoria" type="text" value="CATEGORIA" onfocus="clearIt(this)" onblur="setIt(this)">
        </div>
        <div class="campo ultimo-campo">
            <input type="button" onclick="cadastraCategoria();" value="Cadastrar Categoria" />
        </div>
    </div>
    <div class="campo ultimo-campo" style="width:50%;">
    	<div class="line">
        	<table border="0" cellspacing="0" cellpadding="0" style="width:100%;" class="display tableJquery" id="tableJquery">
                <thead>
                    <tr class="table_titulo">
                        <th class="center" width="100%">CATEGORIA</th>
                        <th class="center" width="60"></th>                        
                    </tr>
                </thead>
                <tbody>
	                <?php foreach ($categorias as $categoria) { ?>
	                    <tr class="lines noticia_show odd" id="aaa" >
	                        <td class="center"><?=$categoria->getNome();?></td>
	                        <td class="center"><a href="javascript:;" onclick="removeCategoria(<?=$categoria->getId();?>);" class="classTitle" title="Excluir"><img src="images/icon-delete.png" width="17" style="position:relative; top:5px;"></a></td>
	                    </tr>
                    <?php } ?>  
                </tbody>
            </table>
        </div>
    </div>        
    
</div>