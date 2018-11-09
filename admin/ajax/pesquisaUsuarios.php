<?php
chdir('../../');
require_once 'pacotes/controller/AnuncianteController.php';
$anunciantecontrol = new AnuncianteController();

$busca['nome'] = ($_GET['nome']!='')?$_GET['nome']:'';
$busca['sobrenome'] = ($_GET['sobrenome']!='')?$_GET['sobrenome']:'';
$busca['telefone'] = ($_GET['telefone']!='')?$_GET['telefone']:'';
$busca['email'] = ($_GET['email']!='')?$_GET['email']:'';
$busca['status'] = ($_GET['status']!='')?$_GET['status']:'';

$busca = $anunciantecontrol->pesquisaAnunciante($busca, 'id DESC');

$html = '<table border="0" cellspacing="0" cellpadding="0" class="display tableJquery" id="tableJquery">
                <thead>
                    <tr class="table_titulo">
                        <th>Nome</th>
                        <th class="center" width="180">Telefone</th>
                        <th class="center" width="200">E-mail</th>
                        <th class="center" width="160">Status</th>                        
                    </tr>
                </thead>
                <tbody>';
                      
foreach ($busca as $user) {
	$html .= '<tr class="lines noticia_show odd" id="aaa" onclick="getDadosUsuario('.$user->getId().');">
                <td class="center">'.$user->getNome().' '.$user->getSobrenome().'</td>
                <td class="center">'.$user->getTelefone().'</td>
                <td class="center">'.$user->getEmail().'</td>';
                if ($user->getStatus()) 
                	$status = 'Ativo';
               	else
               		$status = 'Inativo';
	$html .= '<td class="center">'.$status.'</td>
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

unset($anunciantecontrol, $_GET, $busca, $status);
?>