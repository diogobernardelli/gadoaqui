<?php 
/**
 * @author Eduardo
 *
 */
class Produto {
	
	private $id,
			$valor,
			$frete,
			$peso,
			$informacoes_gerais,
			$data_cad,
			$status,
			$id_anunciante,
			$aprovado,
			$reprovado,
			$nome,
			$video,
			$visualizacoes,
			$imagens;
		
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getValor(){
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}

	public function getFrete(){
		return $this->frete;
	}
	
	public function setFrete($frete) {
		$this->frete = $frete;
	}

	public function getPeso(){
		return $this->peso;
	}

	public function setPeso($peso){
		$this->peso = $peso;
	}

	public function getInformacoes_gerais(){
		return $this->informacoes_gerais;
	}

	public function setInformacoes_gerais($informacoes_gerais){
		$this->informacoes_gerais = $informacoes_gerais;
	}

	public function getData_cad(){
		return $this->data_cad;
	}

	public function setData_cad($data_cad){
		$this->data_cad = $data_cad;
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

	public function getAprovado(){
		return $this->aprovado;
	}

	public function setAprovado($aprovado){
		$this->aprovado = $aprovado;
	}

	public function getReprovado(){
		return $this->reprovado;
	}

	public function setReprovado($reprovado){
		$this->reprovado = $reprovado;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function getVideo(){
		return $this->video;
	}

	public function setVideo($video){
		$this->video = $video;
	}
	
	public function getVisualizacoes(){
		return $this->visualizacoes;
	}

	public function setVisualizacoes($visualizacoes){
		$this->visualizacoes = $visualizacoes;
	}
	
	public function getImagens(){
		return $this->imagens;
	}

	public function setImagens($imagens){
		$this->imagens = $imagens;
	}
		
	function __destruct(){
		unset($this->id,
			$this->valor,
			$this->frete,
			$this->peso,
			$this->informacoes_gerais,
			$this->data_cad,
			$this->status,
			$this->id_anunciante,
			$this->aprovado,
			$this->reprovado,
			$this->nome,
			$this->video,
			$this->visualizacoes,
			$this->imagens);
	}

}
?>