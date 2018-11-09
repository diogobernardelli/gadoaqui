<?php 
include 'pacotes/model/publicidade.php';
require_once 'pacotes/dao/LogDAO.php';

class PublicidadeDAO extends LogDAO{
	
	private $conn;

	function __construct($conn) {
		$this->conn = $conn;
	}
	
	public function getPublicidade($idpublicidade) {
		$sql = "SELECT nome,
						url,
						tipo,
						TO_CHAR(data_inicio, 'DD/MM/YYYY') as data_inicio,
						TO_CHAR(data_fim, 'DD/MM/YYYY') as data_fim,
						cliques,
						arquivo,
						status 
					FROM publicidade WHERE id = $idpublicidade";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();
			$publicidade = new Publicidade();
			
			$publicidade->setId($idpublicidade);
			$publicidade->setNome($row['nome']);
			$publicidade->setUrl($row['url']);
			$publicidade->setTipo($row['tipo']);
			$publicidade->setData_inicio($row['data_inicio']);
			$publicidade->setData_fim($row['data_fim']);
			$publicidade->setCliques($row['cliques']);
			$publicidade->setArquivo($row['arquivo']);
			$publicidade->setStatus($row['status']);
		}
		unset($idpublicidade, $stm, $row, $sql);
		return $publicidade;
	}
	
	public function setPublicidade($post) {
        $this->conn->beginTransaction();
        
        $sql = "INSERT INTO publicidade (nome, url, tipo, data_inicio, data_fim, status, arquivo) VALUES (?,?,?,?,?,?,?)";
		$stm = $this->conn->prepare($sql);
		$stm->bindParam(1, $post['nome']);
		$stm->bindParam(2, $post['url']);
		$stm->bindParam(3, $post['tipo']);
		$stm->bindParam(4, $post['data_inicio']);
		if ($post['data_fim'])
			$stm->bindParam(5, $post['data_fim']);
		else
			$stm->bindValue(5, null, PDO::PARAM_NULL);
		$stm->bindParam(6, $post['status']);
		$stm->bindParam(7, $post['arquivo']);
		
        if (!$stm->execute()) {
			//print_r($stm->errorInfo());
			$this->conn->rollBack();
			unset($post, $sql, $stm);
			return false;
		}
        
    	@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$post['arquivo'], dirname(__FILE__)."/../../images/parceiro/".$post['arquivo']);
		@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$post['arquivo']);
        
		$id_publicidade = $this->conn->lastInsertId('publicidade_id_seq');
        
        $this->conn->commit();
        
		$this->insertLog($id_publicidade, 'I', 'publicidade', json_encode($post), null, $this->conn);
        
        unset($post, $sql, $id_publicidade, $stm);
        return true;
    }
    
    public function updatePublicidade($idpublicidade, $sql = null, $dadosOld, $dadosNew){
		if(!empty($sql)){
			$stm = $this->conn->prepare("UPDATE publicidade SET ".$sql." WHERE id = $idpublicidade");
			if (!$stm->execute()){
				//print_r($stm->errorInfo());
				unset($stm,$idpublicidade,$sql);
				return false;
			}
		}
		
		if ($dadosNew['arquivo']) {
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$dadosNew['arquivo'], dirname(__FILE__)."/../../images/parceiro/".$dadosNew['arquivo']);
			@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$dadosNew['arquivo']);
			
			@unlink(dirname(__FILE__)."/../../images/parceiro/".$dadosOld->arquivo);
		}
		
		$this->updateLog($idpublicidade, 'U', 'publicidade', json_encode($dadosNew), json_encode($dadosOld), $this->conn);
		unset($stm,$idpublicidade,$sql,$dadosNew,$dadosOld);
		return true;
	}

	public function pesquisaPublicidade($busca, $ordem, $limite, $offset) {
		$arrayList = array();
		
		if ($ordem)
			$ordem = "ORDER BY $ordem";
			
		if ($limite)
			$limite = "LIMIT $limite";
			
		if ($offset)
			$offset = "OFFSET $offset";
		
		$sql = "SELECT id FROM publicidade $busca $ordem $limite $offset";
		
		$stm = $this->conn->prepare($sql);
		$stm->execute();
		
		foreach ($stm->fetchAll() as $row){
			$arrayList[] = $this->getPublicidade($row['id']);
			unset($row);
		}
		unset($busca,$ordem,$limite,$offset,$sql,$stm,$row);
		return $arrayList;
	}
	
	function __destruct() {
		unset ( $this->conn );
	}
}

?>