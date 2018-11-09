<?php
@session_start();
// Flag que indica se há erro ou não
$erro = null;
// Quando enviado o formulário
if (isset($_FILES['arquivo']))
{
    // Configurações
    $extensoes = array(".jpeg", ".gif", ".png", ".jpg");
    $caminho = $_SERVER['DOCUMENT_ROOT'].'/tmp/';
    // Recuperando informações do arquivo
    $nome = $_FILES['arquivo']['name'];
    $temp = $_FILES['arquivo']['tmp_name'];
    // Verifica se a extensão é permitida
    if (!in_array(strtolower(strrchr($nome, ".")), $extensoes)) {
		$erro = 'Extensão inválida';
	}
    // Se não houver erro
    if (!$erro) {
        // Gerando um nome aleatório para a imagem
        $nomeAleatorio = uniqid() . strrchr($nome, ".");
        // Movendo arquivo para servidor
        if (!move_uploaded_file($temp, $caminho . $nomeAleatorio))
            $erro = 'Não foi possível anexar o arquivo';
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Upload dinâmico com jQuery/PHP</title>
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
    
    <script type="text/javascript">
        function removeAnexo(tp) {
	    	var arquivo = $('#imgGado'+tp, top.document).val();
	    	$.post("removeAnexoFlag.php", {arquivo: arquivo}, function(data){
	    		if (tp) {
	    			$('#upload').show();
		    		$('#imgGado'+tp+'ex', top.document).html('');
		            $("#imgGado"+tp, top.document).val('');
		            $("#imgprinGado"+tp, top.document).attr('src','');
		            $("#linkGado"+tp, top.document).attr('href','#');
	            	$("#zoomGado"+tp, top.document).hide();
	            }
	    	});
		}
		
	    $(function($) {
	        // Definindo página pai
	        var pai = top.document;
	        
	        <?php if (isset($erro)): // Se houver algum erro ?>
	            // Exibimos o erro
	            //$("#campo_imgfundo",pai).html('<?php echo $erro ?>').show();
	           
	        <?php elseif (isset($nome)): // Se não houver erro e o arquivo foi enviado ?>
	       		removeAnexo();
	            // Adicionamos um item na lista (ul) que tem ID igual a "anexos"
	            
	            $('#upload').hide();
	            //$('#img<?=$_GET['tp'];?>ex', pai).html('<li lang="<?=$nomeAleatorio;?>"><?=$nome;?> <img src="images/remove.png" alt="Remover" class="remover" style="width:20px;height:20px;" onclick="$(\'#uploadImg<?=$_GET['tp'];?>\')[0].contentWindow.removeAnexo(\'<?=$_GET['tp'];?>\')" \/> </li>');
	            $('#imgGado<?=$_GET['tp'];?>ex', pai).html('<li lang="<?=$nomeAleatorio;?>"><input name="" type="button" value="Excluir Imagem" onclick="$(\'#uploadImgGado<?=$_GET['tp'];?>\')[0].contentWindow.removeAnexo(\'<?=$_GET['tp'];?>\')" \/> </li>');
	            $("#imgGado<?=$_GET['tp'];?>", pai).val('<?=$nomeAleatorio;?>');
	            $("#imgprinGado<?=$_GET['tp'];?>", pai).attr('src','/tmp/<?=$nomeAleatorio;?>');
	            $("#linkGado<?=$_GET['tp'];?>", pai).attr('href','/tmp/<?=$nomeAleatorio;?>');
	            $("#zoomGado<?=$_GET['tp'];?>", pai).show();
	            
	        <?php endif ?>
	        
			<?
	        	if ($_GET['edit'] == '1') {
	        		echo "$('#upload').hide();";
	        	}
			?>
			
	        // Quando enviado o arquivo
	    	$("#arquivo").change(function() {
	            // Se o arquivo foi selecionado
	            if (this.value != "")
	            {    
	                // Exibimos o loder
	                $("#status").show();
	                // Enviamos o formulário
	                $("#upload").submit();
	                
	                $("#imgGado<?=$_GET['tp'];?>", pai).val('<?=$nomeAleatorio;?>');
	            }
	        });
	    });
    </script>
</head>

<body>

    <form id="upload" action="uploadpcgado.php?tp=<?=$_GET['tp'];?>" method="post" enctype="multipart/form-data">
    
    <span id="status" style="display: none;"><img src="../images/loader.gif" alt="Enviando..." /></span> <br />
    <input type="file" name="arquivo" id="arquivo" />
        
</form>

</body>
</html>