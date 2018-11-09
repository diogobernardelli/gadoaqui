<?php 
/**
 * @author Eduardo
 *
 */
class Anunciante {
	
	private $id,
			$nome,
			$sobrenome,
			$telefone,
			$email,
			$senha,
			$associado,
			$status,
			$cep,
			$endereco,
			$bairro,
			$estado,
			$complemento,
			$cidade;
	
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

	public function getSobrenome(){
		return $this->sobrenome;
	}

	public function setSobrenome($sobrenome){
		$this->sobrenome = $sobrenome;
	}

	public function getTelefone(){
		return $this->telefone;
	}

	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function getAssociado(){
		return $this->associado;
	}

	public function setAssociado($associado){
		$this->associado = $associado;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getCep(){
		return $this->cep;
	}

	public function setCep($cep){
		$this->cep = $cep;
	}
	
	public function getEndereco(){
		return $this->endereco;
	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}
	
	public function getBairro(){
		return $this->bairro;
	}

	public function setBairro($bairro){
		$this->bairro = $bairro;
	}
	
	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}
	
	public function getComplemento(){
		return $this->complemento;
	}

	public function setComplemento($complemento){
		$this->complemento = $complemento;
	}
	
	public function getCidade(){
		return $this->cidade;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}
	
	function __destruct(){
		unset($this->id,
			$this->nome,
			$this->sobrenome,
			$this->telefone,
			$this->email,
			$this->senha,
			$this->associado,
			$this->status,
			$this->cep,
			$this->endereco,
			$this->bairro,
			$this->estado,
			$this->complemento,
			$this->cidade);
	}
}
?>