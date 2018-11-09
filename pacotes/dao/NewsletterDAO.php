<?php 
include 'pacotes/model/newsletter.php';
require_once 'pacotes/dao/LogDAO.php';

class NewsletterDAO extends LogDAO{
	
	private $conn;

	function __construct($conn) {
		$this->conn = $conn;
	}
	
	public function getNewsletter($idnewsletter) {
		$sql = "SELECT nome,
						email, 
						status, 
						id_anunciante 
					FROM newsletter WHERE id = $idnewsletter";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();
			$newsletter = new Newsletter();
			
			$newsletter->setId($idnewsletter);
			$newsletter->setNome($row['nome']);
			$newsletter->setEmail($row['email']);
			$newsletter->setStatus($row['status']);
			$newsletter->setId_anunciante($row['id_anunciante']);
		}
		unset($idnewsletter, $stm, $row, $sql);
		return $newsletter;
	}
	
	public function getNewsletterByEmail($email) {
		$newsletter = false;
		
		$sql = "SELECT id
					FROM newsletter WHERE email = '$email'";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();
			$newsletter = $this->getNewsletter($row['id']);
		}
		unset($email, $stm, $row, $sql);
		return $newsletter;
	}
	
	public function setNewsletter($post) {
        $this->conn->beginTransaction();
        
        $sql = "INSERT INTO newsletter (nome, email, id_anunciante) VALUES (?,?,?)";
		$stm = $this->conn->prepare($sql);
		$stm->bindParam(1, $post['nome']);
		$stm->bindParam(2, $post['email']);
		$stm->bindParam(3, $post['id_anunciante']);
		
        if (!$stm->execute()) {
			//print_r($stm->errorInfo());
			$this->conn->rollBack();
			unset($post, $sql, $stm);
			return false;
		}
        
		$id_newsletter = $this->conn->lastInsertId('newsletter_id_seq');
        
        $this->conn->commit();
        
		$this->insertLog($id_newsletter, 'I', 'newsletter', json_encode($post), null, $this->conn);
        
        unset($post, $sql, $id_newsletter, $stm);
        return true;
    }
    
    public function updateNewsletter($idnewsletter, $sql = null, $dadosOld, $dadosNew){
		if(!empty($sql)){
			$stm = $this->conn->prepare("UPDATE newsletter SET ".$sql." WHERE id = $idnewsletter");
			if (!$stm->execute()){
				//print_r($stm->errorInfo());
				unset($stm,$idnewsletter,$sql);
				return false;
			}
		}
		
		$this->updateLog($idnewsletter, 'U', 'newsletter', json_encode($dadosNew), json_encode($dadosOld), $this->conn);
		unset($stm,$idnewsletter,$sql,$dadosNew,$dadosOld);
		return true;
	}

	public function listNewsletters() {
		$arrayList = array();

		$sql = "SELECT id FROM newsletter ORDER BY id";
		$stm = $this->conn->prepare($sql);
		$stm->execute();
		
		foreach ($stm->fetchAll() as $row){
			$arrayList[] = $this->getNewsletter($row['id']);
			unset($row);
		}
		unset($sql,$stm,$row);
		return $arrayList;
	}

	public function pesquisaNewsletter($busca, $ordem, $limite, $offset) {
		$arrayList = array();
		
		if ($ordem)
			$ordem = "ORDER BY $ordem";
			
		if ($limite)
			$limite = "LIMIT $limite";
			
		if ($offset)
			$offset = "OFFSET $offset";
		
		$sql = "SELECT id FROM newsletter $busca $ordem $limite $offset";
		
		$stm = $this->conn->prepare($sql);
		$stm->execute();
		
		foreach ($stm->fetchAll() as $row){
			$arrayList[] = $this->getNewsletter($row['id']);
			unset($row);
		}
		unset($busca,$ordem,$limite,$offset,$sql,$stm,$row);
		return $arrayList;
	}
	
	public function countPesquisaNewsletter($busca) {
		$ret = false;
		
		$sql = "SELECT count(id) AS cont FROM newsletter $busca";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();

			$ret = $row['cont'];
		}
		
		unset($busca,$sql,$stm,$row);
		return $ret;
	}

	public function deleteNewsletter($idnewsletter){
		$stm = $this->conn->prepare("DELETE FROM newsletter WHERE id = $idnewsletter");
		if (!$stm->execute()){
			//print_r($stm->errorInfo());
			unset($stm,$idnewsletter);
			return false;
		}
		
		unset($stm,$idnewsletter);
		return true;
	}

	function __destruct() {
		unset ( $this->conn );
	}
}

?>