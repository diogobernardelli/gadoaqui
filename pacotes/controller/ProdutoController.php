<?php 
include 'pacotes/dao/ProdutoDAO.php';
require_once 'pacotes/controller/ControllerGeral.php';
/**
 * @desc Classe para controlar os Produtos
 * @author Eduardo
 *
 */

class ProdutoController extends ControllerGeral{
	
	private $ProdutoDAO;
	
	function __construct() {
		parent::__construct();
	    $this->ProdutoDAO = new ProdutoDAO($this->conn);
	}
	
	public function getProduto($id) {
		return $this->ProdutoDAO->getProduto($id);
	}
	
	public function setProduto($post, $imagens){
		return $this->ProdutoDAO->setProduto($post, $imagens);
	}
	
	public function updateProduto($idproduto, $dadosNew, $dadosNewImg, $dadosOld){
		$valores = array();
		foreach($dadosNew as $chave => $val) {
			if ($val != '') {
				$valores[] = $chave." = '".addslashes($val)."'";
			} 
		} 
		$valores = implode(",", $valores);
		
		return $this->ProdutoDAO->updateProduto($idproduto, $valores, $dadosOld, $dadosNew, $dadosNewImg);
	}
	
	public function pesquisaProduto($busca = null, $ordem = null, $limite = null, $offset = null) {
		return $this->ProdutoDAO->pesquisaProduto($this->montaSql($busca), $ordem, $limite, $offset);
	}
	
	public function countPesquisaProduto($busca = null) {
		return $this->ProdutoDAO->countPesquisaProduto($this->montaSql($busca));
	}
	
	public function montaSql($busca) {
		$filtro=array();
		$sql=null;

		if(!empty($busca['id'])){
            $filtro[] = "produto.id = " . $busca ['id'];
        }
		if(!empty($busca['id_in'])){
            $filtro[] = "produto.id IN (" . $busca ['id_in'] . ")";
        }
        if(!empty($busca['id_not_in'])){
            $filtro[] = "produto.id NOT IN (" . $busca ['id_not_in'] . ")";
        }
        if(!empty($busca['nome'])){
            $filtro[] = "produto.nome ILIKE '%" . $busca ['nome'] . "%'";
        }
        if(!empty($busca['id_anunciante'])){
            $filtro[] = "produto.id_anunciante = " . $busca ['id_anunciante'];
        }
		if(!empty($busca['estado'])){
            $filtro[] = "anunciante.estado = '" . $busca ['estado'] . "'";
        }
		if(!empty($busca['peso'])){
            $filtro[] = "produto.peso = " . $busca ['peso'];
        }
        if(!empty($busca['valor'])){
            $filtro[] = "produto.valor = " . $busca ['valor'];
        }
        if(!empty($busca['valor_entre'])){
            $filtro[] = "(produto.valor BETWEEN " . $busca ['valor_entre'] . ")";
        }
        if(!empty($busca['frete'])){
            $filtro[] = "produto.frete = " . $busca ['frete'];
        }
        if(!empty($busca['status'])){
            $filtro[] = "produto.status = '" . $busca ['status'] ."'";
        }
        if(!empty($busca['aprovado'])){
            $filtro[] = "produto.aprovado = '" . $busca ['aprovado'] ."'";
        }
        if(!empty($busca['reprovado'])){
            $filtro[] = "produto.reprovado = '" . $busca ['reprovado'] ."'";
        }
        if(!empty($busca['status_video'])) {
        	if ($busca['status_video'] == 't')
        		$filtro[] = "(produto.video != '' OR produto.video IS NOT NULL)";
       		else 
       			$filtro[] = "(produto.video = '' OR produto.video IS NULL)";
        }
        
		if(count($filtro) > 0){
  			$sql = ' WHERE '.implode(' AND ',$filtro);
        }
        return $sql;
	}
	
	function __destruct(){
		parent::__destruct();
		unset($this->ProdutoDAO);
	}
	
}