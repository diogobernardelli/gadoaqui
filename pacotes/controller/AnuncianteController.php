<?php 
include 'pacotes/dao/AnuncianteDAO.php';
require_once 'pacotes/controller/ControllerGeral.php';
/**
 * @desc Classe para controlar os Anunciantes
 * @author Eduardo
 *
 */

class AnuncianteController extends ControllerGeral{
	
	private $AnuncianteDAO;
	
	function __construct() {
		parent::__construct();
	    $this->AnuncianteDAO = new AnuncianteDAO($this->conn);
	}
	
	function login($post) {
		if (isset ( $post ['login'] ) and isset ( $post ['senha'] )) {
			$login = $post['login'];
			$senha = md5 ( $post['senha'] . "_" . substr ( $post['senha'], -3 ) );
			
			$usuario = $this->AnuncianteDAO->consultaLoginSenha ( $login, $senha );
			
			if ($usuario == false) {
				return false;
			} else {
				return $usuario;
			}
		
		} else {
			return false;
		}
	}
	
	function loginAdm($post) {
		if (isset ( $post ['login'] ) and isset ( $post ['senha'] )) {
			$login = $post['login'];
			$senha = md5 ( $post['senha'] . "_" . substr ( $post['senha'], -3 ) );
			
			$usuario = $this->AnuncianteDAO->consultaLoginSenhaAdm ( $login, $senha );
			
			if ($usuario == false) {
				return false;
			} else {
				return $usuario;
			}
		
		} else {
			return false;
		}
	}
	
	public function alteraSenha($senha, $id) {
		$senha = md5 ( $senha . "_" . substr ( $senha, -3 ) );
		return $this->AnuncianteDAO->alteraSenha($senha, $id);
	}
	
	public function getAnunciante($id) {
		return $this->AnuncianteDAO->getAnunciante ($id);
	}
	
	public function getAnuncianteByEmail($email) {
		return $this->AnuncianteDAO->getAnuncianteByEmail ($email);
	}
	
	public function setAnunciante($post){
		return $this->AnuncianteDAO->setAnunciante($post);
	}
 
	public function updateAnunciante($idanunciante, $dadosNew, $dadosOld = null){
		$valores = array();
		foreach($dadosNew as $chave => $val) {
			if ($val != '') {
				$valores[] = $chave." = '".addslashes($val)."'";
			} 
		} 
		$valores = implode(",", $valores);
		
		return $this->AnuncianteDAO->updateAnunciante($idanunciante, $valores, $dadosOld, $dadosNew);
	}
	
	public function pesquisaAnunciante($busca = null, $ordem = null, $limite = null, $offset = null) {
		return $this->AnuncianteDAO->pesquisaAnunciante($this->montaSql($busca), $ordem, $limite, $offset);
	}
	
	public function countPesquisaAnunciante($busca = null) {
		return $this->AnuncianteDAO->countPesquisaAnunciante($this->montaSql($busca));
	}
	
	public function montaSql($busca) {
		$filtro=array();
		$sql=null;
		
		if(!empty($busca['id'])){
            $filtro[] = "id = " . $busca ['id'];
        }
        if(!empty($busca['id_in'])){
            $filtro[] = "id IN (" . $busca ['id_in'] . ")";
        }
        if(!empty($busca['id_not_in'])){
            $filtro[] = "id NOT IN (" . $busca ['id_not_in'] . ")";
        }
        if(!empty($busca['nome'])){
            $filtro[] = "nome ILIKE '%" . $busca ['nome'] . "%'";
        }
        if(!empty($busca['sobrenome'])){
            $filtro[] = "sobrenome ILIKE '%" . $busca ['sobrenome'] . "%'";
        }
		if(!empty($busca['telefone'])){
            $filtro[] = "telefone LIKE '%" . $busca ['telefone'] . "%'";
        }
		if(!empty($busca['email'])){
            $filtro[] = "email ILIKE '%" . $busca ['email'] . "%'";
        }
		if(!empty($busca['status'])){
            $filtro[] = "status = '" . $busca ['status'] . "'";
        }
		if(count($filtro) > 0){
  			$sql = ' WHERE '.implode(' AND ',$filtro);
        }
        return $sql;
	}
	
	function __destruct(){
		parent::__destruct();
		unset ( $this->AnuncianteDAO );
	}
	
}