<?php

class OutrosDAO {
	private $conn;
	
	function __construct($con) {
		$this->conn = $con;
	}
	
	public function listEstados(){
		$ufs = array();
		foreach ($this->conn->query("select \"UFE_SG\",\"UFE_NO\" from \"correios\".\"LOG_FAIXA_UF\" ORDER BY \"UFE_NO\"") as $row){
			$uf = array();
			$uf['sigla'] = $row['UFE_SG'];
			$uf['nome'] = $row['UFE_NO'];
			$ufs[] = $uf;
			unset($uf, $row);
		}
		return $ufs;
	}
	
	public function getCidadesCorreio($uf){
		foreach ($this->conn->query("SELECT \"LOC_NU_SEQUENCIAL\",\"LOC_NO\" FROM \"correios\".\"LOG_LOCALIDADE\" WHERE \"UFE_SG\" = '".$uf."' ORDER BY \"LOC_NO\"") as $row){
		   $cidade['id'] = $row['LOC_NU_SEQUENCIAL'];	
		   $cidade['nome'] = $row['LOC_NO'];	
		   $cidades[]=$cidade;
		   unset($cidade);
		}
		unset($uf);
		return $cidades;
	}
		
	public function buscaEndereco($cep){
		$end = null;
		foreach ($this->conn->query("SELECT t1.\"LOG_NOME\",t1.\"UFE_SG\",t2.\"LOC_NU_SEQUENCIAL\",t2.\"LOC_NO\",t3.\"BAI_NO\" FROM \"correios\".\"LOG_LOGRADOURO\" t1 
										INNER JOIN \"correios\".\"LOG_LOCALIDADE\" t2 ON t2.\"LOC_NU_SEQUENCIAL\" = t1.\"LOC_NU_SEQUENCIAL\" 
										INNER JOIN \"correios\".\"LOG_BAIRRO\" t3 ON t3.\"BAI_NU_SEQUENCIAL\" = t1.\"BAI_NU_SEQUENCIAL_INI\"
										WHERE (t1.\"CEP\" = '".$cep."' OR t2.\"CEP\" = '".$cep."')") as $row){
			$end['rua'] = $row['LOG_NOME']; 
			$end['uf'] = $row['UFE_SG']; 
			$end['cidade_id'] = $row['LOC_NU_SEQUENCIAL']; 
			$end['cidade'] = $row['LOC_NO']; 
			$end['bairro'] = $row['BAI_NO']; 
		}
		unset($row);
		return $end;
	}
	
	public function buscaCepPorCidadeRua($cid,$rua){
		$row=$this->conn->query("SELECT t1.\"CEP\" as cep1,t2.\"CEP\" as cep2 FROM \"correios\".\"LOG_LOGRADOURO\" t1 
INNER JOIN \"correios\".\"LOG_LOCALIDADE\" t2 ON t2.\"LOC_NU_SEQUENCIAL\" = t1.\"LOC_NU_SEQUENCIAL\" 
WHERE (t2.\"LOC_NU_SEQUENCIAL\" = '".$cid."' AND t1.\"LOG_NOME\" ilike '%".$rua."%')")->fetch();
		if (!empty($row['cep1'])){
			$cep = $row['cep1'];
		}else{
			$cep = $row['cep2'];
		}
		unset($row,$cid,$rua);
		return $cep;
	}

function __destruct() {
	unset($this->conn);
	}
}

?>