<?php 
include 'pacotes/model/produto.php';
require_once 'pacotes/dao/LogDAO.php';

class ProdutoDAO extends LogDAO{
	
	private $conn;

	function __construct($conn) {
		$this->conn = $conn;
	}
	
	public function getProduto($idproduto) {
		$sql = "SELECT valor,
						frete,
						peso,
						informacoes_gerais,
						TO_CHAR(data_cad, 'DD/MM/YYYY') as data_cad,
						status,
						id_anunciante,
						aprovado, 
						reprovado, 
						nome, 
						video, 
						visualizacoes 
					FROM produto WHERE id = $idproduto";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();
			$produto = new Produto();
			
			$produto->setId($idproduto);
			$produto->setValor($row['valor']);
			$produto->setFrete($row['frete']);
			$produto->setPeso($row['peso']);
			$produto->setInformacoes_gerais($row['informacoes_gerais']);
			$produto->setData_cad($row['data_cad']);
			$produto->setStatus($row['status']);
			$produto->setId_anunciante($row['id_anunciante']);
			$produto->setAprovado($row['aprovado']);
			$produto->setReprovado($row['reprovado']);
			$produto->setNome($row['nome']);
			$produto->setVideo($row['video']);
			$produto->setVisualizacoes($row['visualizacoes']);
			$produto->setImagens($this->getImagens($idproduto));
		}
		unset($idproduto, $stm, $row, $sql);
		return $produto;
	}
	
	public function setProduto($post, $imagens) {
        $this->conn->beginTransaction();
        
        $sql = "INSERT INTO produto (valor, frete, peso, informacoes_gerais, id_anunciante, nome, video, status, aprovado, reprovado)
        								VALUES
        							(?,?,?,?,?,?,?,?,?,?)";
		$stm = $this->conn->prepare($sql);
		$stm->bindParam(1, $post['valor']);
		$stm->bindParam(2, $post['frete']);
		$stm->bindParam(3, $post['peso']);
		$stm->bindParam(4, $post['informacoes_gerais']);
		$stm->bindParam(5, $post['id_anunciante']);
		$stm->bindParam(6, $post['nome']);
		$stm->bindParam(7, $post['video']);
		$stm->bindParam(8, $post['status']);
		$stm->bindParam(9, $post['aprovado']);
		$stm->bindParam(10, $post['reprovado']);
		
        if (!$stm->execute()) {
			//print_r($stm->errorInfo());
			$this->conn->rollBack();
			unset($post, $sql, $stm);
			return false;
		}
        
		$id_produto = $this->conn->lastInsertId('produto_id_seq');
        
        $this->conn->commit();
        
        $this->setImagensProduto($id_produto, $imagens);
        
		$this->insertLog($id_produto, 'I', 'produto', json_encode($post), null, $this->conn);
        
        unset($post, $sql, $id_produto, $stm, $imagens);
        return true;
    }
    
    public function updateProduto($idproduto, $sql = null, $dadosOld, $dadosNew, $dadosNewImg = null){
		if(!empty($sql)){
			$stm = $this->conn->prepare("UPDATE produto SET ".$sql." WHERE id = $idproduto");
			if (!$stm->execute()){
				//print_r($stm->errorInfo());
				unset($stm,$idproduto,$sql);
				return false;
			}
		}
		
		if (count($dadosNewImg) > 0) {
			$arr = array();
			foreach ($dadosNewImg as $chv => $img) {
				$images = array();
				if ($chv == 'img1') {
					@unlink(dirname(__FILE__)."/../../images/produto/".$dadosOld->img1);
					$images['ord'] = 1;
					$images['img'] = $img;
					$arr[] = $images;
				}
				if ($chv == 'img2') {
					@unlink(dirname(__FILE__)."/../../images/produto/".$dadosOld->img2);
					$images['ord'] = 2;
					$images['img'] = $img;
					$arr[] = $images;
				}
				if ($chv == 'img3') {
					@unlink(dirname(__FILE__)."/../../images/produto/".$dadosOld->img3);
					$images['ord'] = 3;
					$images['img'] = $img;
					$arr[] = $images;
				}
				if ($chv == 'img4') {
					@unlink(dirname(__FILE__)."/../../images/produto/".$dadosOld->img4);
					$images['ord'] = 4;
					$images['img'] = $img;
					$arr[] = $images;
				}
			}

			foreach ($arr as $img) {
				if ($img['img'] == '') {
					$sql = "DELETE FROM imagem_produto WHERE id_produto = $idproduto AND ordem = ".$img['ord'];
					$stm = $this->conn->prepare($sql);
					$stm->execute();
				} else {
					@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$img['img'], dirname(__FILE__)."/../../images/produto/".$img['img']);
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
						$sql = "UPDATE imagem_produto SET arquivo = '".$img['img']."' WHERE id_produto = $idproduto AND ordem = ".$img['ord'];
					} else {
						$sql = "INSERT INTO imagem_produto (id_produto, arquivo, ordem) VALUES ($idproduto, '".$img['img']."', ".$img['ord'].")";
					}
					$stm = $this->conn->prepare($sql);
					$stm->execute();
				}
			}
		}
		
		$this->updateLog($idproduto, 'U', 'produto', json_encode($dadosNew), json_encode($dadosOld), $this->conn);
		unset($stm,$idproduto,$sql,$dadosNew,$dadosOld,$dadosNewImg);
		return true;
	}

	public function setImagensProduto($id_produto, $imagens, $edit = false) {
		$ordem = 1;
		
		foreach ($imagens as $img) {
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$img, dirname(__FILE__)."/../../images/produto/".$img);
			@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$img);
			
			$sql = "INSERT INTO imagem_produto (arquivo, id_produto, ordem) VALUES (?,?,?)";
			$stm = $this->conn->prepare($sql);
			$stm->bindParam(1, $img);
			$stm->bindParam(2, $id_produto);
			$stm->bindParam(3, $ordem);
			
		    if (!$stm->execute()) {
				//print_r($stm->errorInfo());
				$this->conn->rollBack();
				unset($post, $sql, $stm);
				return false;
			}
			
			$ordem++;
		}
		
		unset($id_produto, $imagens, $img, $ordem, $sql, $stm);
		return true;
	}

	public function pesquisaProduto($busca, $ordem, $limite, $offset) {
		$arrayList = array();
		
		if ($ordem)
			$ordem = "ORDER BY $ordem";
			
		if ($limite)
			$limite = "LIMIT $limite";
		
		if ($offset)
			$offset = "OFFSET $offset";
		
		$sql = "SELECT produto.id FROM produto INNER JOIN anunciante ON (produto.id_anunciante = anunciante.id) $busca $ordem $limite $offset";
		
		$stm = $this->conn->prepare($sql);
		$stm->execute();
		
		foreach ($stm->fetchAll() as $row){
			$arrayList[] = $this->getProduto($row['id']);
			unset($row);
		}
		unset($busca,$limite,$sql,$stm,$row);
		return $arrayList;
	}
	
	public function countPesquisaProduto($busca) {
		$ret = false;
		
		$sql = "SELECT count(id) AS cont FROM produto $busca";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();

			$ret = $row['cont'];
		}
		
		unset($busca,$sql,$stm,$row);
		return $ret;
	}

	public function getImagens($idproduto){
		$arrayList = array();
		
		$sql = "SELECT arquivo FROM imagem_produto WHERE id_produto = $idproduto ORDER BY ordem ASC";
		foreach ($this->conn->query($sql) as $row) {
			$arrayList[] = $row['arquivo'];
			unset($row);
		}
		unset($idproduto, $stm, $row, $sql);
		
		if(count($arrayList) == 0)
			$arrayList = '';
			
		return $arrayList;
	}

	function __destruct() {
		unset ( $this->conn );
	}
}

?>