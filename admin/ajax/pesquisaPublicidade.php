<?php
chdir('../../');
require_once 'pacotes/controller/PublicidadeController.php';
$publicidadecontrol = new PublicidadeController();

$busca = $publicidadecontrol->pesquisaPublicidade(array('status'=>'true'), 'id DESC');

$html = '<table border="0" cellspacing="0" cellpadding="0" class="display tableJquery" id="tableJquery">
                <thead>
                    <tr class="table_titulo">
                        <th>Nome</th>
                        <th class="center" width="160">Tipo</th>
                        <th class="center" width="80">Cliques</th>
                        <th class="center" width="140">Data Inicial</th>
                        <th class="center" width="140">Data Final</th>  
                        <th class="center" width="160">Gerenciamento</th>
                    </tr>
                </thead>
                <tbody>';
                      
foreach ($busca as $pub) {
	if ($pub->getTipo() == '1')
		$tp = 'FullBanner (970x80px)';
	else
		$tp = 'Lateral (40x200px)';
	$html .= '<tr class="lines noticia_show odd" id="aaa" >
					<td class="center">'.$pub->getNome().'</td>
					<td class="center">'.$tp.'</td>
					<td class="center">'.$pub->getCliques().'</td>
                    <td class="center">'.$pub->getData_inicio().'</td>
                    <td class="center">'.$pub->getData_fim().'</td>
                    <td class="center"><a href="javascript:;" onclick="getPublicidade('.$pub->getId().');">Editar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="removePublicidade('.$pub->getId().');">Desativar</a></a></td>
                </tr>';
}

$html .= '</tbody>
            </table>
			
			<script type="text/javascript">
				$("#tableJquery").dataTable( {
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

unset($publicidadecontrol, $_GET, $busca);
?>