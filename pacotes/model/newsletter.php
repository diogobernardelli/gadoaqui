<?php 

/** 
 * @author Eduardo
 * 
 * 
 */
class Newsletter {
	
	private $id,
			$nome,
			$email,
			$status,
			$id_anunciante;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getId_anunciante(){
		return $this->id_anunciante;
	}

	public function setId_anunciante($id_anunciante){
		$this->id_anunciante = $id_anunciante;
	}
	
	function __destruct() {
	 unset($this->id,
			$this->nome,
			$this->email,
			$this->status,
			$this->id_anunciante);
	}
}

?>