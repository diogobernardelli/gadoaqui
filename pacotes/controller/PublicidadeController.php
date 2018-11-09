<?php
require_once 'pacotes/dao/PublicidadeDAO.php';
require_once 'pacotes/controller/ControllerGeral.php';

/**
 * @author Eduardo
 * @desc Classe Publicidade
 */
 
class PublicidadeController extends ControllerGeral {
	private $PublicidadeDAO;
	
	public function __construct() {
		parent::__construct ();
		$this->PublicidadeDAO = new PublicidadeDAO ( $this->conn );
	}
	
	public function getPublicidade($id) {
		return $this->PublicidadeDAO->getPublicidade($id);
	}

    public function setPublicidade($post) {
		return $this->PublicidadeDAO->setPublicidade($post);
	}
   
	public function updatePublicidade($idpublicidade, $dadosNew, $dadosOld){
        $valores = array();
		foreach($dadosNew as $chave => $val) {
			if ($val != '') {
				$valores[] = $chave." = '".addslashes($val)."'";
			} else {
				$valores[] = $chave." = null";
			}
		} 
		$valores = implode(",", $valores);
		
		return $this->PublicidadeDAO->updatePublicidade($idpublicidade, $valores, $dadosOld, $dadosNew);
	}
	
	public function pesquisaPublicidade($busca = null, $ordem = null, $limite = null, $offset = null) {
		return $this->PublicidadeDAO->pesquisaPublicidade($this->montaSql($busca), $ordem, $limite, $offset);
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
        if(!empty($busca['tipo'])){
            $filtro[] = "tipo = " . $busca ['tipo'];
        }
		if(!empty($busca['url'])){
            $filtro[] = "url ILIKE '%" . $busca ['url'] . "%'";
        }
		if(!empty($busca['data_inicio']) && empty($busca['data_fim'])){
            $filtro[] = "(data_inicio <= '" . $busca ['data_inicio'] . "' AND data_fim IS NULL)";
        } else if (!empty($busca['data_inicio']) && !empty($busca['data_fim'])) {
        	$filtro[] = "(data_inicio <= '" . $busca ['data_inicio'] . "' AND data_fim >= '" . $busca ['data_fim'] . "')";
        }
		if(!empty($busca['status'])){
            $filtro[] = "status = '" . $busca ['status'] . "'";
        }
        if(!empty($busca['listagem'])) {
        	$filtro[] = "((data_inicio <= now() AND data_fim IS NULL) OR (data_inicio <= now() AND data_fim >= now()))";
        }        
		if(count($filtro) > 0){
  			$sql = ' WHERE '.implode(' AND ',$filtro);
        }
        return $sql;
	}
	
    function __destruct() {
		parent::__destruct ();
		unset ( $this->NewsletterDAO );
	}

}
?>