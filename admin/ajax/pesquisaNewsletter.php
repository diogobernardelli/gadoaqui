<?php
chdir('../../');
require_once 'pacotes/controller/NewsletterController.php';
$newslettercontrol = new NewsletterController();

$busca['nome'] = ($_GET['nome']!='')?$_GET['nome']:'';
$busca['email'] = ($_GET['email']!='')?$_GET['email']:'';

$busca = $newslettercontrol->pesquisaNewsletter($busca, 'id DESC');

$html = '<table border="0" cellspacing="0" cellpadding="0" class="display tableJquery" id="tableJquery">
                <thead>
                    <tr class="table_titulo">
                        <th>Nome</th>
                        <th class="center" width="200">E-mail</th>
                        <th width="30"></th>
                    </tr>
                </thead>
                <tbody>';
                      
foreach ($busca as $news) {
	$html .= '<tr class="lines noticia_show odd" id="aaa" >
                    <td class="center">'.$news->getNome().'</td>
                    <td class="center">'.$news->getEmail().'</td>
                    <td class="center"><a href="javascript:;" onclick="removeNewsletter('.$news->getId().');" class="classTitle" title="Excluir"><img src="images/icon-delete.png" width="17" style="position:relative; top:5px;"></a></td>
                </tr>';
}

$html .= '</tbody>
            </table>
			
			<script type="text/javascript">
				$("#tableJquery").dataTable( {
					"sDom": \'T<"clear">lfrtip\',
			        "oTableTools": {
			            "aButtons": [
			                {
			                    "sExtends":    "collection",
			                    "sButtonText": "Salvar...",
			                    "aButtons":    [ "xls", "pdf" ]
			                }
			            ]
			        },
					"sPaginationType": "full_numbers",
					"oLanguage": {
						"sLengthMenu": "Exibir _MENU_ resultados",
						"sZeroRecords": "Nenhum resultado encontrado",
						"sInfo": "Exibindo <strong>_START_</strong> até <strong>_END_</strong> de <strong>_TOTAL_</strong> resultados",
						"sInfoEmpty": "Exibindo <strong>0</strong> até <strong>0</strong> de <strong>0</strong> resultados",
						"sInfoFiltered": "(filtrado de um total de <strong>_MAX_</strong> resultados)"
					}
				});
			</script>';

echo json_encode(array("html"=>$html));

unset($newslettercontrol, $_GET, $busca);
?>