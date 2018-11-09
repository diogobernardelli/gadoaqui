<?php 
include 'pacotes/dao/GadoDAO.php';
require_once 'pacotes/controller/ControllerGeral.php';
/**
 * @desc Classe para controlar os Gados
 * @author Eduardo
 *
 */

class GadoController extends ControllerGeral{
	
	private $GadoDAO;
	
	function __construct() {
		parent::__construct();
	    $this->GadoDAO = new GadoDAO($this->conn);
	}
	
	public function getGado($id) {
		return $this->GadoDAO->getGado($id);
	}
	
	public function getGadoMenorValor($id, $idade, $peso, $valor, $sexo, $raca) {
		return $this->GadoDAO->getGadoMenorValor($id, $idade, $peso, $valor, $sexo, $raca);
	}
	
	public function getGadoMaiorValor($id, $idade, $peso, $valor, $sexo, $raca) {
		return $this->GadoDAO->getGadoMaiorValor($id, $idade, $peso, $valor, $sexo, $raca);
	}
	
	public function setGado($post, $imagens){
		return $this->GadoDAO->setGado($post, $imagens);
	}
	
	public function updateGado($idgado, $dadosNew, $dados_new_img, $dadosOld){
		$valores = array();
		foreach($dadosNew as $chave => $val) {
			if ($val != '') {
				$valores[] = $chave." = '".addslashes($val)."'";
			} 
		} 
		$valores = implode(",", $valores);
		
		return $this->GadoDAO->updateGado($idgado, $valores, $dadosOld, $dadosNew, $dados_new_img);
	}
	
	public function pesquisaGado($busca = null, $ordem = null, $limite = null, $offset = null) {
		return $this->GadoDAO->pesquisaGado($this->montaSql($busca), $ordem, $limite, $offset);
	}
	
	public function countPesquisaGado($busca = null) {
		return $this->GadoDAO->countPesquisaGado($this->montaSql($busca));
	}
	
	public function montaSql($busca) {
		$filtro=array();
		$sql=null;
		
		if(!empty($busca['id'])){
            $filtro[] = "id = " . $busca ['id'];
        }
        if(!empty($busca['id_in'])){
            $filtro[] = "id IN (" . $busca ['id_in'] . ")";
        }
        if(!empty($busca['id_not_in'])){
            $filtro[] = "id NOT IN (" . $busca ['id_not_in'] . ")";
        }
        if(!empty($busca['nome'])){
            $filtro[] = "nome ILIKE '%" . $busca ['nome'] . "%'";
        }
		if(!empty($busca['estado'])){
            $filtro[] = "estado = '" . $busca ['estado'] . "'";
        }
		if(!empty($busca['cidade'])){
            $filtro[] = "cidade = '" . $busca ['cidade'] . "'";
        }
		if(!empty($busca['sexo'])){
            $filtro[] = "sexo = '" . $busca ['sexo'] . "'";
        }
		if(!empty($busca['categoria'])){
            $filtro[] = "id_categoria = " . $busca ['categoria'];
        }
		if(!empty($busca['id_anunciante'])){
            $filtro[] = "id_anunciante = " . $busca ['id_anunciante'];
        }
		if(!empty($busca['peso'])){
            $filtro[] = "peso_medio = " . $busca ['peso'];
        }
        if(!empty($busca['idade'])){
            $filtro[] = "idade = " . $busca ['peso'];
        }
        if(!empty($busca['idade_entre'])){
            $filtro[] = "(idade BETWEEN " . $busca ['idade_entre'] . ")";
        }
        if(!empty($busca['valor'])){
            $filtro[] = "valor_kg = " . $busca ['valor'];
        }
        if(!empty($busca['valor_entre'])){
            $filtro[] = "(valor_kg BETWEEN " . $busca ['valor_entre'] . ")";
        }
        if(!empty($busca['quantidade'])){
            $filtro[] = "quantidade = " . $busca ['quantidade'];
        }
        if(!empty($busca['quantidade_entre'])){
            $filtro[] = "(quantidade BETWEEN " . $busca ['quantidade_entre'] . ")";
        }
        if(!empty($busca['status'])){
            $filtro[] = "status = '" . $busca ['status'] ."'";
        }
        if(!empty($busca['raca'])){
            $filtro[] = "raca ILIKE '%" . $busca ['raca'] ."%'";
        }
        if(!empty($busca['finalidade'])){
            $filtro[] = "finalidade = '" . $busca ['finalidade'] ."'";
        }
        if(!empty($busca['status_video'])) {
        	if ($busca['status_video'] == 't')
        		$filtro[] = "(video != '' OR video IS NOT NULL)";
       		else 
       			$filtro[] = "(video = '' OR video IS NULL)";
        }
        
		if(count($filtro) > 0){
  			$sql = ' WHERE '.implode(' AND ',$filtro);
        }
        return $sql;
	}
	
	function __destruct(){
		parent::__destruct();
		unset($this->GadoDAO);
	}
	
}