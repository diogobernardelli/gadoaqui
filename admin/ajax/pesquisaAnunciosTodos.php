<?php
chdir('../../');
require_once 'pacotes/controller/ProdutoController.php';
require_once 'pacotes/controller/GadoController.php';
require_once 'pacotes/controller/AnuncianteController.php';
$produtocontrol = new ProdutoController();
$gadocontrol = new GadoController();
$anunciantecontrol = new AnuncianteController();

$busca['nome'] = ($_GET['titulo']!='')?$_GET['titulo']:'';
$busca['valor_entre'] = ($_GET['valor']!='')?$_GET['valor']:'';
$busca['status_video'] = ($_GET['video']!='')?$_GET['video']:'';
$busca['id_anunciante'] = ($_GET['anunciante']!='')?$_GET['anunciante']:'';
$busca['status'] = ($_GET['status']!='')?$_GET['status']:'';

if ($busca['valor_entre']) {
	if (strpos($busca['valor_entre'], '|')) {
		$busca['valor_entre'] = str_replace("|", " AND ", $busca['valor_entre']);
	}
}

if ($_GET['tipo'] == 'p') {
	$busca = $produtocontrol->pesquisaProduto($busca, 'id DESC');
} else {
	$busca = $gadocontrol->pesquisaGado($busca, 'id DESC');
}

$html = '<table border="0" cellspacing="0" cellpadding="0" class="display tableJquery" id="tableJquery">
                <thead>
                    <tr class="table_titulo">
                        <th class="center" width="180">TIPO</th>
                        <th>TÍTULO</th>
                        <th class="center" width="180">VALOR</th>
                        <th class="center" width="200">VÍDEO</th>
                        <th class="center" width="360">ANUNCIANTE</th>                      
						<th class="center" width="170">DATA CADASTRO</th>                      
						<th class="center" width="120">STATUS</th>
                    </tr>
                </thead>
                <tbody>';
                   
foreach ($busca as $b) {
	if ($_GET['tipo'] == 'p') {
		$tipo = 'Produto';
		$valor = $b->getValor();
		$function = 'getDadosProduto';
	} else {
		$tipo = 'Gado';
		$valor = $b->getValor_kg();
		$function = 'getDadosGado';
	}

	if ($b->getStatus())
		$status = 'Ativo';
	else
		$status = 'Inativo';
	
	$anunciante = $anunciantecontrol->getAnunciante($b->getId_anunciante());
	
	$html .= '<tr class="lines noticia_show odd" id="aaa" onclick="'.$function.'('.$b->getId().');">
				<td class="center">'.$tipo.'</td>
                <td>'.$b->getNome().'</td>
				<td class="center">R$ '.number_format($valor, 2, ',', '.').'</td>';
                if ($b->getVideo()) 
                	$video = 'SIM';
               	else
               		$video = 'NÃO';
	$html .= '<td class="center">'.$video.'</td>
			  <td>'.$anunciante->getNome().' '.$anunciante->getSobrenome().'</td>
			  <td class="center">'.$b->getData_cad().'</td>
			  <td class="center">'.$status.'</td>
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

unset($produtocontrol, $gadocontrol, $anunciantecontrol, $_GET, $busca, $b, $tipo, $valor, $anunciante, $video);
?>