<?php 
/**
 * @author Eduardo
 *
 */
class Gado {
	
	private $id,
			$valor_kg,
			$raca,
			$quantidade,
			$sexo,
			$idade,
			$finalidade,
			$endereco,
			$bairro,
			$cidade,
			$estado,
			$latitude,
			$longitude,
			$peso_medio,
			$informacoes_gerais,
			$como_chegar,
			$data_cad,
			$status,
			$id_anunciante,
			$id_categoria,
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

	public function getValor_kg(){
		return $this->valor_kg;
	}

	public function setValor_kg($valor_kg){
		$this->valor_kg = $valor_kg;
	}

	public function getRaca(){
		return $this->raca;
	}

	public function setRaca($raca){
		$this->raca = $raca;
	}

	public function getQuantidade(){
		return $this->quantidade;
	}

	public function setQuantidade($quantidade){
		$this->quantidade = $quantidade;
	}

	public function getSexo(){
		return $this->sexo;
	}

	public function setSexo($sexo){
		$this->sexo = $sexo;
	}

	public function getIdade(){
		return $this->idade;
	}

	public function setIdade($idade){
		$this->idade = $idade;
	}

	public function getFinalidade(){
		return $this->finalidade;
	}

	public function setFinalidade($finalidade){
		$this->finalidade = $finalidade;
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

	public function getCidade(){
		return $this->cidade;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getLatitude(){
		return $this->latitude;
	}

	public function setLatitude($latitude){
		$this->latitude = $latitude;
	}

	public function getLongitude(){
		return $this->longitude;
	}

	public function setLongitude($longitude){
		$this->longitude = $longitude;
	}

	public function getPeso_medio(){
		return $this->peso_medio;
	}

	public function setPeso_medio($peso_medio){
		$this->peso_medio = $peso_medio;
	}

	public function getInformacoes_gerais(){
		return $this->informacoes_gerais;
	}

	public function setInformacoes_gerais($informacoes_gerais){
		$this->informacoes_gerais = $informacoes_gerais;
	}
	
	public function getComo_chegar(){
		return $this->como_chegar;
	}

	public function setComo_chegar($como_chegar){
		$this->como_chegar = $como_chegar;
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

	public function getId_categoria(){
		return $this->id_categoria;
	}

	public function setId_categoria($id_categoria){
		$this->id_categoria = $id_categoria;
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
			$this->valor_kg,
			$this->raca,
			$this->quantidade,
			$this->sexo,
			$this->idade,
			$this->finalidade,
			$this->endereco,
			$this->bairro,
			$this->cidade,
			$this->estado,
			$this->latitude,
			$this->longitude,
			$this->peso_medio,
			$this->informacoes_gerais,
			$this->como_chegar, 
			$this->data_cad,
			$this->status,
			$this->id_anunciante,
			$this->id_categoria,
			$this->nome,
			$this->video,
			$this->visualizacoes,
			$this->imagens);
	}

}
?>