<?php 
include 'pacotes/model/gado.php';
require_once 'pacotes/dao/LogDAO.php';

class GadoDAO extends LogDAO{
	
	private $conn;

	function __construct($conn) {
		$this->conn = $conn;
	}
	
	public function getGado($idgado) {
		$sql = "SELECT valor_kg, 
						raca,
						quantidade,
						sexo,
						idade,
						finalidade,
						endereco, 
						bairro, 
						cidade,
						estado,
						latitude,
						longitude,
						peso_medio,
						informacoes_gerais,
						como_chegar,
						TO_CHAR(data_cad, 'DD/MM/YYYY') as data_cad,
						status,
						id_anunciante,
						id_categoria,
						nome, 
						video, 
						visualizacoes 
					FROM gado WHERE id = $idgado";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();
			$gado = new Gado();
			
			$gado->setId($idgado);
			$gado->setValor_kg($row['valor_kg']);
			$gado->setRaca($row['raca']);
			$gado->setQuantidade($row['quantidade']);
			$gado->setSexo($row['sexo']);
			$gado->setIdade($row['idade']);
			$gado->setFinalidade($row['finalidade']);
			$gado->setEndereco($row['endereco']);
			$gado->setBairro($row['bairro']);
			$gado->setCidade($row['cidade']);
			$gado->setEstado($row['estado']);
			$gado->setLatitude($row['latitude']);
			$gado->setLongitude($row['longitude']);
			$gado->setPeso_medio($row['peso_medio']);
			$gado->setInformacoes_gerais($row['informacoes_gerais']);
			$gado->setComo_chegar($row['como_chegar']);
			$gado->setData_cad($row['data_cad']);
			$gado->setStatus($row['status']);
			$gado->setId_anunciante($row['id_anunciante']);
			$gado->setId_categoria($row['id_categoria']);
			$gado->setNome($row['nome']);
			$gado->setVideo($row['video']);
			$gado->setVisualizacoes($row['visualizacoes']);
			$gado->setImagens($this->getImagens($idgado));
		}
		unset($idgado, $stm, $row, $sql);
		return $gado;
	}
	
	public function getGadoMenorValor($id, $idade, $peso, $valor, $sexo, $raca) {
		$gado = '';
		$sql = "SELECT id
					FROM gado 
				WHERE idade = $idade AND 
						peso_medio = $peso AND 
						id NOT IN ($id) AND 
						valor_kg < $valor 
						--AND sexo = '$sexo'
						--AND raca = '$raca' 
				ORDER BY valor_kg ASC 
				LIMIT 1";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();
			
			$gado = $this->getGado($row['id']);
		}
		
		unset($id, $idade, $peso, $sql, $stm, $row);
		return $gado;
	}
	
	public function getGadoMaiorValor($id, $idade, $peso, $valor, $sexo, $raca) {
		$gado = '';
		$sql = "SELECT id
					FROM gado 
				WHERE idade = $idade AND 
						peso_medio = $peso AND 
						id NOT IN ($id) AND 
						valor_kg > $valor 
						--AND sexo = '$sexo'
						--AND raca = '$raca' 
				ORDER BY valor_kg DESC 
				LIMIT 1";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();
			
			$gado = $this->getGado($row['id']);
		}
		
		unset($id, $idade, $peso, $sql, $stm, $row);
		return $gado;
	}
	
	public function setGado($post, $imagens) {
        $this->conn->beginTransaction();
        
        $sql = "INSERT INTO gado (valor_kg, raca, quantidade, sexo, 
									idade, endereco, bairro, cidade, estado, 
									latitude, longitude, peso_medio, 
									informacoes_gerais, id_anunciante, id_categoria, nome, video, 
									como_chegar, status, finalidade)
        								VALUES
        							(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stm = $this->conn->prepare($sql);
		$stm->bindParam(1, $post['valor_kg']);
		$stm->bindParam(2, $post['raca']);
		$stm->bindParam(3, $post['quantidade']);
		$stm->bindParam(4, $post['sexo']);
		$stm->bindParam(5, $post['idade']);
		$stm->bindParam(6, $post['endereco']);
		$stm->bindParam(7, $post['bairro']);
		$stm->bindParam(8, $post['cidade']);
		$stm->bindParam(9, $post['estado']);
		$stm->bindParam(10, $post['latitude']);
		$stm->bindParam(11, $post['longitude']);
		$stm->bindParam(12, $post['peso_medio']);
		$stm->bindParam(13, $post['informacoes_gerais']);
		$stm->bindParam(14, $post['id_anunciante']);
		$stm->bindParam(15, $post['id_categoria']);
		$stm->bindParam(16, $post['nome']);
		$stm->bindParam(17, $post['video']);
		$stm->bindParam(18, $post['como_chegar']);
		$stm->bindParam(19, $post['status']);
		$stm->bindParam(20, $post['finalidade']);
		
        if (!$stm->execute()) {
			//print_r($stm->errorInfo());
			$this->conn->rollBack();
			unset($post, $sql, $stm);
			return false;
		}
        
		$id_gado = $this->conn->lastInsertId('gado_id_seq');
        
        $this->conn->commit();
        
        $this->setImagensGado($id_gado, $imagens);
        
		$this->insertLog($id_gado, 'I', 'gado', json_encode($post), null, $this->conn);
        
        unset($post, $sql, $id_gado, $stm);
        return true;
    }
    
    public function updateGado($idgado, $sql = null, $dadosOld, $dadosNew, $dadosNewImg = null){
		if(!empty($sql)){
			$stm = $this->conn->prepare("UPDATE gado SET ".$sql." WHERE id = $idgado");
			if (!$stm->execute()){
				//print_r($stm->errorInfo());
				unset($stm,$idgado,$sql);
				return false;
			}
		}
		
		if (count($dadosNewImg) > 0) {
			$arr = array();
			foreach ($dadosNewImg as $chv => $img) {
				$images = array();
				if ($chv == 'img1') {
					@unlink(dirname(__FILE__)."/../../images/gado/".$dadosOld->img1);
					$images['ord'] = 1;
					$images['img'] = $img;
					$arr[] = $images;
				}
				if ($chv == 'img2') {
					@unlink(dirname(__FILE__)."/../../images/gado/".$dadosOld->img2);
					$images['ord'] = 2;
					$images['img'] = $img;
					$arr[] = $images;
				}
				if ($chv == 'img3') {
					@unlink(dirname(__FILE__)."/../../images/gado/".$dadosOld->img3);
					$images['ord'] = 3;
					$images['img'] = $img;
					$arr[] = $images;
				}
				if ($chv == 'img4') {
					@unlink(dirname(__FILE__)."/../../images/gado/".$dadosOld->img4);
					$images['ord'] = 4;
					$images['img'] = $img;
					$arr[] = $images;
				}
			}

			foreach ($arr as $img) {
				if ($img['img'] == '') {
					$sql = "DELETE FROM imagem_gado WHERE id_gado = $idgado AND ordem = ".$img['ord'];
					$stm = $this->conn->prepare($sql);
					if (!$stm->execute()) {
						print_r($stm->errorInfo());
						return false;
					}
				} else {
					@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$img['img'], dirname(__FILE__)."/../../images/gado/".$img['img']);
					@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$img['img']);
			
					if ($img['ord'] == 1)
						$imgold = $dadosOld->img1;
					else if ($img['ord'] == 2)
						$imgold = $dadosOld->img2;
					else if ($img['ord'] == 3)
						$imgold = $dadosOld->img3;
					else if ($img['ord'] == 4)
						$imgold = $dadosOld->img4;
						
					if ($imgold) {	
						$sql = "UPDATE imagem_gado SET arquivo = '".$img['img']."' WHERE id_gado = $idgado AND ordem = ".$img['ord'];
					} else {
						$sql = "INSERT INTO imagem_gado (id_gado, arquivo, ordem) VALUES ($idgado, '".$img['img']."', ".$img['ord'].")";
					}
					$stm = $this->conn->prepare($sql);
					$stm->execute();
				}
			}
		}
		
		$this->updateLog($idgado, 'U', 'gado', json_encode($dadosNew), json_encode($dadosOld), $this->conn);
		unset($stm,$idgado,$sql,$dadosNew,$dadosOld);
		return true;
	}

	public function setImagensGado($id_gado, $imagens, $edit = false) {
		$ordem = 1;
		
		foreach ($imagens as $img) {
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$img, dirname(__FILE__)."/../../images/gado/".$img);
			@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$img);
			
			$sql = "INSERT INTO imagem_gado (arquivo, id_gado, ordem) VALUES (?,?,?)";
			$stm = $this->conn->prepare($sql);
			$stm->bindParam(1, $img);
			$stm->bindParam(2, $id_gado);
			$stm->bindParam(3, $ordem);
			
		    if (!$stm->execute()) {
				//print_r($stm->errorInfo());
				$this->conn->rollBack();
				unset($post, $sql, $stm);
				return false;
			}
			
			$ordem++;
		}
		
		unset($id_gado, $imagens, $img, $ordem, $sql, $stm);
		return true;
	}

	public function pesquisaGado($busca, $ordem, $limite, $offset) {
		$arrayList = array();
		
		if ($ordem)
			$ordem = "ORDER BY $ordem";
			
		if ($limite)
			$limite = "LIMIT $limite";
			
		if ($offset)
			$offset = "OFFSET $offset";
		
		$sql = "SELECT id FROM gado $busca $ordem $limite $offset";
		
		$stm = $this->conn->prepare($sql);
		$stm->execute();
		
		foreach ($stm->fetchAll() as $row){
			$arrayList[] = $this->getGado($row['id']);
			unset($row);
		}
		unset($busca,$ordem,$limite,$offset,$sql,$stm,$row);
		return $arrayList;
	}
	
	public function countPesquisaGado($busca) {
		$ret = false;
		
		$sql = "SELECT count(id) AS cont FROM gado $busca";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();

			$ret = $row['cont'];
		}
		
		unset($busca,$sql,$stm,$row);
		return $ret;
	}

	public function getImagens($idgado){
		$arrayList = array();
		
		$sql = "SELECT arquivo FROM imagem_gado WHERE id_gado = $idgado ORDER BY ordem ASC";
		foreach ($this->conn->query($sql) as $row) {
			$arrayList[] = $row['arquivo'];
			unset($row);
		}
		unset($idgado, $stm, $row, $sql);
		
		if(count($arrayList) == 0)
			$arrayList = '';
			
		return $arrayList;
	}

	function __destruct() {
		unset ( $this->conn );
	}
}

?>