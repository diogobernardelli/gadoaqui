<?php 
require_once ('pacotes/controller/ControllerGeral.php');
require_once ('pacotes/dao/CategoriaDAO.php');

/** 
 * @author Eduardo
 * 
 * 
 */
class CategoriaController extends ControllerGeral {
	private $CategoriaDAO;
	
	function __construct() {
		parent::__construct ();
		$this->CategoriaDAO = new CategoriaDAO ( $this->conn );
	}
	
	public function getCategoria($id) {
		return $this->CategoriaDAO->getCategoria($id);
	}

    public function setCategoria($post) {
		return $this->CategoriaDAO->setCategoria($post);
	}
   
	public function updateCategoria($idcategoria, $dadosNew, $dadosOld){
        $valores = array();
		foreach($dadosNew as $chave => $val) {
            if ($chave != 'tel' && $chave != 'status') {
    			if ($val != '') {
    				$valores[] = $chave." = '".addslashes($val)."'";
    			} 
            }
		} 
		$valores = implode(",", $valores);
		
		return $this->CategoriaDAO->updateCategoria($idcategoria, $valores, $dadosOld, $dadosNew);
	}
	
	public function deleteCategoria($id) {
		return $this->CategoriaDAO->deleteCategoria($id);
	}
	
	public function listCategorias() {
		return $this->CategoriaDAO->listCategorias();
	}
	
	function __destruct() {
		parent::__destruct ();
		unset ( $this->CategoriaDAO );
	}
}

?>
