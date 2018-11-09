<?php
require_once 'pacotes/dao/NewsletterDAO.php';
require_once 'pacotes/controller/ControllerGeral.php';

/**
 * @author Eduardo
 * @desc Classe Newsletter
 */
 
class NewsletterController extends ControllerGeral {
	private $NewsletterDAO;
	
	public function __construct() {
		parent::__construct ();
		$this->NewsletterDAO = new NewsletterDAO ( $this->conn );
	}
	
	public function getNewsletter($id) {
		return $this->NewsletterDAO->getNewsletter($id);
	}

	public function getNewsletterByEmail($email) {
		return $this->NewsletterDAO->getNewsletterByEmail($email);
	}

    public function setNewsletter($post) {
		return $this->NewsletterDAO->setNewsletter($post);
	}
   
	public function updateNewsletter($idnewsletter, $dadosNew, $dadosOld){
        $valores = array();
		foreach($dadosNew as $chave => $val) {
            if ($chave != 'tel' && $chave != 'status') {
    			if ($val != '') {
    				$valores[] = $chave." = '".addslashes($val)."'";
    			} 
            }
		} 
		$valores = implode(",", $valores);
		
		return $this->NewsletterDAO->updateNewsletter($idnewsletter, $valores, $dadosOld, $dadosNew);
	}
	
	public function listNewsletters() {
		return $this->NewsletterDAO->listNewsletters();
	}
	
	public function pesquisaNewsletter($busca = null, $ordem = null, $limite = null, $offset = null) {
		return $this->NewsletterDAO->pesquisaNewsletter($this->montaSql($busca), $ordem, $limite, $offset);
	}
	
	public function countPesquisaNewsletter($busca = null) {
		return $this->NewsletterDAO->countPesquisaNewsletter($this->montaSql($busca));
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
		if(!empty($busca['email'])){
            $filtro[] = "email ILIKE '%" . $busca ['email'] . "%'";
        }
		if(!empty($busca['status'])){
            $filtro[] = "status = '" . $busca ['status'] . "'";
        }
		if(!empty($busca['id_anunciante'])){
            $filtro[] = "id_anunciante = " . $busca ['id_anunciante'];
        }
		if(count($filtro) > 0){
  			$sql = ' WHERE '.implode(' AND ',$filtro);
        }
        return $sql;
	}
	
	public function deleteNewsletter($idnewsletter) {
		return $this->NewsletterDAO->deleteNewsletter($idnewsletter);
	}
	
    function __destruct() {
		parent::__destruct ();
		unset ( $this->NewsletterDAO );
	}

}
?>