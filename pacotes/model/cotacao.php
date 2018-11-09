<?php 
/**
 * @author Eduardo
 *
 */
class Cotacao {
	
	private $id,
			$valor;
		
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getValor() {
		return $this->valor;
	}
	public function setValor($valor) {
		$this->valor = $valor;
	}
			
	function __destruct(){
		unset($this->id,
			$this->valor);
	}

}
?>