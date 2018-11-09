<?php 

/** 
 * @author Eduardo
 * 
 * 
 */
class Publicidade {
	
	private $id,
			$nome,
			$url,
			$tipo,
			$data_inicio,
			$data_fim,
			$cliques,
			$arquivo,
			$status;

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

	public function getUrl(){
		return $this->url;
	}

	public function setUrl($url){
		$this->url = $url;
	}

	public function getTipo(){
		return $this->tipo;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}
	
	public function getData_inicio(){
		return $this->data_inicio;
	}

	public function setData_inicio($data_inicio){
		$this->data_inicio = $data_inicio;
	}
	
	public function getData_fim(){
		return $this->data_fim;
	}

	public function setData_fim($data_fim){
		$this->data_fim = $data_fim;
	}
	
	public function getArquivo(){
		return $this->arquivo;
	}

	public function setArquivo($arquivo){
		$this->arquivo = $arquivo;
	}
	
	public function getCliques(){
		return $this->cliques;
	}

	public function setCliques($cliques){
		$this->cliques = $cliques;
	}
	
	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}
	
	function __destruct() {
	 unset($this->id,
			$this->nome,
			$this->url,
			$this->tipo,
			$this->data_inicio,
			$this->data_fim,
			$this->cliques,
			$this->arquivo,
			$this->status);
	}
}

?>