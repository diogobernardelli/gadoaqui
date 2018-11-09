<?php
require_once 'pacotes/model/anunciante.php';
require_once 'pacotes/dao/LogDAO.php';
/** 
 * @author Eduardo
 * 
 * 
 */
class AnuncianteDAO extends LogDAO{
	
	private $conn;
	
	function __construct($con) {
		$this->conn = $con;
	}
	
	public function consultaLoginSenha($login, $senha) {
		try {
			$stm = $this->conn->prepare ( "SELECT id FROM anunciante
											WHERE email = ?
												AND senha = ?
												AND status IS TRUE" );
			$stm->bindParam ( 1, $login );
			$stm->bindParam ( 2, $senha );
			$stm->execute ();
			$result = $stm->fetch ();
			if ($result['id'])
				$result = $this->getAnunciante($result['id']);

		} catch ( PDOException $e ) {
			throw new PDOException ( "Erro ao efetuar o login!" );
			return false;
		}
		unset ( $stm, $login, $senha );
		return $result;
	}
	
	public function consultaLoginSenhaAdm($login, $senha) {
		try {
			$stm = $this->conn->prepare ( "SELECT id FROM admin
											WHERE email = ?
												AND senha = ?
												AND status IS TRUE" );
			$stm->bindParam ( 1, $login );
			$stm->bindParam ( 2, $senha );
			$stm->execute ();
			$result = $stm->fetch ();
			if ($result['id'])
				$result = $result['id'];

		} catch ( PDOException $e ) {
			throw new PDOException ( "Erro ao efetuar o login!" );
			return false;
		}
		unset ( $stm, $login, $senha );
		return $result;
	}
	
	public function alteraSenha($senha, $id) {
		$stm = $this->conn->prepare ( "UPDATE anunciante SET senha = ? WHERE id = ?" );
		$stm->bindParam ( 1, $senha );
		$stm->bindParam ( 2, $id );
		
		if ($stm->execute ()) {
			unset ( $stm, $id, $senha );
			return true;
		} else {
			unset ( $stm, $id, $senha );
			return false;
		}
	}
	
    public function getAnunciante($id) {
    	$anunciante = false;
    	
        $sql = "SELECT nome,
        				sobrenome,
        				telefone,
						email,
						associado,
						status, 
						cep,
						endereco, 
						bairro, 
						estado, 
						complemento, 
						cidade 
					FROM anunciante
				WHERE id = $id";
		$stm = $this->conn->prepare($sql);

		if($stm->execute()){
			$row = $stm->fetch();
			$anunciante = new Anunciante();
			
			$anunciante->setId($id);
			$anunciante->setNome($row['nome']);
			$anunciante->setSobrenome($row['sobrenome']);
			$anunciante->setTelefone($row['telefone']);
			$anunciante->setEmail($row['email']);
			$anunciante->setAssociado($row['associado']);
			$anunciante->setStatus($row['status']);
			$anunciante->setCep($row['cep']);
			$anunciante->setEndereco($row['endereco']);
			$anunciante->setBairro($row['bairro']);
			$anunciante->setEstado($row['estado']);
			$anunciante->setComplemento($row['complemento']);
			$anunciante->setCidade($row['cidade']);
		}
		unset($id, $stm, $row, $sql);
		return $anunciante;
    }
    
    public function getAnuncianteByEmail($email) {
    	$anunciante = false;
    	
        $sql = "SELECT id
					FROM anunciante
				WHERE email = '$email'";
		$stm = $this->conn->prepare($sql);

		if($stm->execute()){
			$row = $stm->fetch();
			
			$anunciante = $row['id'];
		}
		unset($id, $stm, $row, $sql);
		return $anunciante;
    }
    
    public function setAnunciante($post) {
        $this->conn->beginTransaction();
        
        $sql = "INSERT INTO anunciante (nome, sobrenome, telefone, 
										email, senha)
        								VALUES
        							('".$post['nome']."', '".$post['sobrenome']."', '".$post['telefone']."', 
									'".$post['email']."', '".$post['senha']."')";
		$stm = $this->conn->prepare($sql);
		
        if (!$stm->execute()) {
			//print_r($stm->errorInfo());
			$this->conn->rollBack();
			unset($post, $sql, $stm);
			return false;
		}
        
		$id_anunciante = $this->conn->lastInsertId('anunciante_id_seq');
        
        $this->conn->commit();
        
		$this->insertLog($id_anunciante, 'I', 'anunciante', json_encode($post), null, $this->conn);
        
        unset($post, $sql, $stm);
        return $id_anunciante;
    }
    
    public function updateAnunciante($idanunciante, $sql = null, $dadosOld = null, $dadosNew){
		if(!empty($sql)){
			$stm = $this->conn->prepare("UPDATE anunciante SET ".$sql." WHERE id = $idanunciante");
			if (!$stm->execute()){
				//print_r($stm->errorInfo());
				unset($stm,$idanunciante,$sql);
				return false;
			}
		}
		
		//$this->updateLog($idanunciante, 'U', 'anunciante', json_encode($dadosNew), json_encode($dadosOld), $this->conn);
		unset($stm,$idanunciante,$sql,$dadosNew,$dadosOld);
		return true;
	}
    
    public function pesquisaAnunciante($busca, $ordem, $limite, $offset) {
		$arrayList = array();
		
		if ($ordem)
			$ordem = "ORDER BY $ordem";
			
		if ($limite)
			$limite = "LIMIT $limite";
			
		if ($offset)
			$offset = "OFFSET $offset";
		
		$sql = "SELECT id FROM anunciante $busca $ordem $limite $offset";
		
		$stm = $this->conn->prepare($sql);
		$stm->execute();
		
		foreach ($stm->fetchAll() as $row){
			$arrayList[] = $this->getAnunciante($row['id']);
			unset($row);
		}
		unset($busca,$ordem,$limite,$offset,$sql,$stm,$row);
		return $arrayList;
	}
	
	public function countPesquisaAnunciante($busca) {
		$ret = false;
		
		$sql = "SELECT count(id) AS cont FROM anunciante $busca";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();

			$ret = $row['cont'];
		}
		
		unset($busca,$sql,$stm,$row);
		return $ret;
	}
    
    function __destruct() {
		unset ( $this->conn );
	}
}
?>