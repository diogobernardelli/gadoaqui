<?php 
require_once ('pacotes/controller/ControllerGeral.php');
require_once ('pacotes/dao/CotacaoDAO.php');

/** 
 * @author Eduardo
 * 
 * 
 */
class CotacaoController extends ControllerGeral {
	private $CotacaoDAO;
	
	function __construct() {
		parent::__construct ();
		$this->CotacaoDAO = new CotacaoDAO ( $this->conn );
	}
	
	public function getCotacao($id) {
		return $this->CotacaoDAO->getCotacao($id);
	}

    public function setCotacao($post) {
		return $this->CotacaoDAO->setCotacao($post);
	}
   
	public function updateCotacao($idcotacao, $dadosNew, $dadosOld){
        $valores = array();
		foreach($dadosNew as $chave => $val) {
            if ($chave != 'tel' && $chave != 'status') {
    			if ($val != '') {
    				$valores[] = $chave." = '".addslashes($val)."'";
    			} 
            }
		} 
		$valores = implode(",", $valores);
		
		return $this->CotacaoDAO->updateCotacao($idcotacao, $valores, $dadosOld, $dadosNew);
	}
	
	public function deleteCotacao($id) {
		return $this->CotacaoDAO->deleteCotacao($id);
	}
	
	public function listCotacoes() {
		return $this->CotacaoDAO->listCotacoes();
	}
	
	function __destruct() {
		parent::__destruct ();
		unset ( $this->CotacaoDAO );
	}
}

?>