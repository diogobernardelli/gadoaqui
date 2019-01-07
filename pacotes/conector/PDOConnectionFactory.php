<?php
/** 
 * @author Eduardo
 * 
 * 
 */
abstract class PDOConnectionFactory {

	  private $con,
			  $dbType,
			  $host,
			  $user,
			  $senha,
			  $db,
			  $persistent;
	  
	function __construct() {
     
	}
	
	private function setParametros(){
		$this->persistent = false;
		$this->con = null;
		$this->dbType = "pgsql";
		$this->host = "localhost";
		$this->user = "gadoaqui_postgres";
		$this->senha = "masterssi1@";
		$this->db = "gadoaqui_gadoaqui";
	}
      

      public function getConnection(){
       $this->setParametros();
      try{
            $this->con = new PDO($this->dbType.":host=".$this->host.";dbname=".$this->db, $this->user, $this->senha,
      			array( PDO::ATTR_PERSISTENT => $this->persistent ) );
      		
      			
      	}catch ( PDOException $ex ){ 
      		$ex = new PDOException('Erro de Conexão com BD!!');
      		echo "Erro: ".$ex->getMessage();
      		exit;
      	}
      	return $this->con;
      }

      public function Close(){
      		if( $this->con != null )
      				$this->con = null;
      }
	
	
	function __destruct() {
		$this->Close();
	    unset($this->con,
	    $this->db,
	    $this->dbType,
	    $this->host,
	    $this->persistent,
	    $this->senha,
	    $this->user);
	}
}
?>