<?
	chdir(dirname(__FILE__).'/../../../');
	include "pacotes/work/work_admin_cotacoes.php";
	chdir('admin/');
	@session_start();
?>

<script type="text/javascript">
	$(function(){
		$('#valor1').maskMoney();
		$('#valor2').maskMoney();
		$('#valor3').maskMoney();
		$('#valor4').maskMoney();
		$('#valor5').maskMoney();
		
		getCotacoes();
	});
	
	function editaCotacoes() {
		if ($('#valor1').val() != '' && $('#valor2').val() != '' && $('#valor3').val() != '' && $('#valor4').val() != '' && $('#valor5').val() != '') {
			$('.loading').show();
			$.post('ajax/editaCotacoes.php', { valor1: $('#valor1').val(), valor2: $('#valor2').val(), valor3: $('#valor3').val(), 
												valor4: $('#valor4').val(), valor5: $('#valor5').val() }, function(data){
				$('.loading').hide();
				if (data.ok)
					mostraDivMenu('cotacoes');
				else
					alert(data.erro);
			},'json');
		} else
			alert('Valores são obrigatórios!');
	}
	
	function getCotacoes() {
		$('.loading').show();
		$.get('ajax/getCotacoes.php', function(data){
			$('.loading').hide();
			if (data) {
				for (var i in data) {
					var cot = data[i];
					$('#valor'+cot.id).val(cot.valor);
				}
			}
		},'json');
	}
</script>

<h1>Cotações</h1>
<div class="line">
	<div class="campo" style="width:150px;">
        <label for="valor1">Arroba Boi Gordo</label>
        <br />
        <input id="valor1" name="valor1" type="text" style="width:80px;"> R$
    </div>
    
    <div class="campo" style="width:150px;">
        <label for="valor2">Arroba Vaca Gorda</label>
        <br />
        <input id="valor2" name="valor2" type="text" style="width:80px;"> R$
    </div>
    
    <div class="campo" style="width:150px;">
        <label for="valor3">Vaca Boiadeira</label>
        <br />
        <input id="valor3" name="valor3" type="text" style="width:80px;"> R$
    </div>
    
    <div class="campo" style="width:150px;">
        <label for="valor4">Macho Desmama</label>
        <br />
        <input id="valor4" name="valor4" type="text" style="width:80px;"> R$
    </div>
    
    <div class="campo" style="width:150px;">
        <label for="valor5">Fêmea Desmama</label>
        <br />
        <input id="valor5" name="valor5" type="text" style="width:80px;"> R$
    </div>
    
    <div class="line line-salvar">
        <input type="button" onclick="editaCotacoes()" id="btnCotacoes" value="Salvar">
    </div>

</div>