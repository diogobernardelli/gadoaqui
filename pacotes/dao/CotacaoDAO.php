<?php 
include 'pacotes/model/cotacao.php';
require_once 'pacotes/dao/LogDAO.php';

class CotacaoDAO extends LogDAO{
	
	private $conn;

	function __construct($conn) {
		$this->conn = $conn;
	}
	
	public function getCotacao($idcotacao){
		$sql = "SELECT valor FROM cotacao WHERE id = $idcotacao";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();
			$cotacao = new Cotacao();
			
			$cotacao->setId($idcotacao);
			$cotacao->setValor($row['valor']);
		}
		unset($idcotacao, $stm, $row, $sql);
		return $cotacao;
	}
		
	public function setCotacao($post){
		$stm = $this->conn->prepare("INSERT INTO cotacao (valor) VALUES (?)");
		$stm->bindParam(1, $post['valor']);

		if (!$stm->execute()) {
			//print_r($stm->errorInfo());
			unset($post,$stm);
			return false;
		}
		
		$idcotacao = $this->conn->lastInsertId('cotacao_id_seq');
		$this->insertLog($idcotacao, 'I', 'cotacao', json_encode($post), null, $this->conn);
		
		unset($post,$stm);
		
		return true;
	}
	
	public function updateCotacao($idcotacao, $sql, $dadosOld, $dadosNew){
		if(!empty($sql)){
			$stm = $this->conn->prepare("UPDATE cotacao SET ".$sql." WHERE id = $idcotacao");
			if (!$stm->execute()){
				//print_r($stm->errorInfo());
				unset($stm,$idcotacao,$sql);
				return false;
			}
		}
		
		$this->updateLog($idcotacao, 'U', 'cotacao', json_encode($dadosNew), json_encode($dadosOld), $this->conn);
		unset($stm,$idcotacao,$sql,$dadosNew,$dadosOld);
		return true;
	}
	
	public function deleteCotacao($idcotacao){
		$stm = $this->conn->prepare("DELETE FROM cotacao WHERE id = $idcotacao");
		if (!$stm->execute()){
			//print_r($stm->errorInfo());
			unset($stm,$idcotacao);
			return false;
		}
		
		unset($stm,$idcotacao);
		return true;
	}
	
	public function listCotacoes() {
		$arrayList = array();

		$sql = "SELECT id FROM cotacao ORDER BY id";
		$stm = $this->conn->prepare($sql);
		$stm->execute();
		
		foreach ($stm->fetchAll() as $row){
			$arrayList[] = $this->getCotacao($row['id']);
			unset($row);
		}
		unset($sql,$stm,$row);
		return $arrayList;
	}
	
	function __destruct() {
		unset ( $this->conn );
	}
}

?>