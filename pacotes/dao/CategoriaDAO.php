<?php 
include 'pacotes/model/categoria.php';
require_once 'pacotes/dao/LogDAO.php';

class CategoriaDAO extends LogDAO{
	
	private $conn;

	function __construct($conn) {
		$this->conn = $conn;
	}
	
	public function getCategoria($idcategoria){
		$sql = "SELECT nome FROM categoria WHERE id = $idcategoria";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();
			$categoria = new Categoria();
			
			$categoria->setId($idcategoria);
			$categoria->setNome($row['nome']);
		}
		unset($idcategoria, $stm, $row, $sql);
		return $categoria;
	}
		
	public function setCategoria($post){
		$stm = $this->conn->prepare("INSERT INTO categoria (nome) VALUES (?)");
		$stm->bindParam(1, $post['nome']);

		if (!$stm->execute()) {
			//print_r($stm->errorInfo());
			unset($post,$stm);
			return false;
		}
		
		$idcategoria = $this->conn->lastInsertId('categoria_id_seq');
		$this->insertLog($idcategoria, 'I', 'categoria', json_encode($post), null, $this->conn);
		
		unset($post,$stm);
		
		return true;
	}
	
	public function updateCategoria($idcategoria, $sql, $dadosOld, $dadosNew){
		if(!empty($sql)){
			$stm = $this->conn->prepare("UPDATE categoria SET ".$sql." WHERE id = $idcategoria");
			if (!$stm->execute()){
				//print_r($stm->errorInfo());
				unset($stm,$idcategoria,$sql);
				return false;
			}
		}
		
		$this->updateLog($idcategoria, 'U', 'categoria', json_encode($dadosNew), json_encode($dadosOld), $this->conn);
		unset($stm,$idcategoria,$sql,$dadosNew,$dadosOld);
		return true;
	}
	
	public function deleteCategoria($idcategoria){
		$stm = $this->conn->prepare("DELETE FROM categoria WHERE id = $idcategoria");
		if (!$stm->execute()){
			//print_r($stm->errorInfo());
			unset($stm,$idcategoria);
			return false;
		}
		
		unset($stm,$idcategoria);
		return true;
	}
	
	public function listCategorias() {
		$arrayList = array();

		$sql = "SELECT id FROM categoria ORDER BY id";
		$stm = $this->conn->prepare($sql);
		$stm->execute();
		
		foreach ($stm->fetchAll() as $row){
			$arrayList[] = $this->getCategoria($row['id']);
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
