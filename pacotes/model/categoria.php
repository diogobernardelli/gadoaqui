<?php 
/**
 * @author Eduardo
 *
 */
class Categoria {
	
	private $id,
			$nome;
		
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
			
	function __destruct(){
		unset($this->id,
			$this->nome);
	}

}
?>