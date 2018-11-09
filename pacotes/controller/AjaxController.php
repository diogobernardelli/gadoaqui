<?php 
require_once 'pacotes/dao/OutrosDAO.php';
require_once 'pacotes/controller/ControllerGeral.php';
/** 
 * @author Eduardo
 * 
 * 
 */
class AjaxController extends ControllerGeral {
	//TODO - Insert your code here
	private $outrosDAO;
	
	function __construct() {
		parent::__construct ();
	}
	
	public function listEstados(){
		$this->outrosDAO = new OutrosDAO($this->conn);
		return $this->outrosDAO->listEstados();
	}
	
	public function getCidadesCorreios($uf, $cid=false){
		$html = '<option value=""></option>';
		$selected = null;
		$this->outrosDAO = new OutrosDAO($this->conn);
		$cidades = $this->outrosDAO->getCidadesCorreio($uf);
		foreach ($cidades as $cidade){
			if ($cid == $cidade['nome']){
				$selected = 'selected="selected"';
			}
			$html .= '<option value="'.$cidade['nome'].'" '.$selected.'>'.$cidade['nome'].'</option>';
			$selected=null;
		}
		unset($cidade,$cidades,$uf);
		return $html;
	}
	
	public function buscaEndereco($cep){
		$this->outrosDAO = new OutrosDAO($this->conn);
		return $this->outrosDAO->buscaEndereco($this->soNumero($cep));
	}
	
	public function buscaCepPorCidadeRua($cid, $rua){
		$this->outrosDAO = new OutrosDAO($this->conn);
		$cep = $this->outrosDAO->buscaCepPorCidadeRua($cid, $rua);
		return $this->mascaraCEP($cep);
	}
	
	/**
	 * 
	 */
	function __destruct() {
		parent::__destruct ();
		unset ( $this->conn, $this->outrosDAO );
	}
}

?>