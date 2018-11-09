<?
require_once 'phpmailer/class.phpmailer.php';
require_once 'pacotes/controller/ControllerGeral.php';

$controller = new ControllerFunctions();
$conn = $controller->getConnection();

function enviaEmail($array, $nome, $email) {
	$phpmail = new PHPMailer ();
	
	$phpmail->isSMTP ();
	
	// Configuração de SMTP
	$phpmail->Host = "ssl://smtp.googlemail.com";
	$phpmail->SMTPAuth = true;
	//$phpmail->SMTPDebug = true;
	$phpmail->Port = 465;
	$phpmail->Username = $email;
	$phpmail->Password = "vsplus@vsplus";
	
	// Remetente da mensagem
	$phpmail->From = $phpmail->Username;
	$phpmail->FromName = $nome;
	$phpmail->Sender = $email;
	
	// Destinatario do email
	//$phpmail->AddAddress ($maildest);
	
	// Iremos enviar o email no formato HTML
	$phpmail->IsHTML ( true );
	
	foreach ($array as $arr) {
		// Destinatario do email
		$phpmail->AddAddress ($arr['destino']);
	
		// Assunto e Corpo do email
		$phpmail->Subject = $arr['assunto'];
		$phpmail->Body = $arr['mensagem'];
		if(!empty($arr['anexo'])){
			$phpmail->AddAttachment(dirname(__FILE__).'/'.$arr['anexo']);
		}
		if ($phpmail->Send ()) {
			marcaEnviado($arr['id']);
			$phpmail->ClearAllRecipients();
		} else {
			return false;
		}
	}
	
	unset($phpmail, $array, $nome, $email);
	return true;
}

function marcaEnviado($id) {
	GLOBAL $conn;
	
	$sql = "UPDATE email_enviar SET enviado = TRUE WHERE id = $id";
	$conn->query($sql);
	
	return true;
}
/*seleciona apenas email validos que não foram enviados ainda de 15 em 15
 * humberto 08/03/2012 regex
 */
/*$sql = "SELECT id, nome, destino, assunto, mensagem
			FROM email_enviar
				WHERE destino SIMILAR TO '^[a-zA-Z][[:alnum:]_.-]*@[a-zA-Z][[:alnum:]_.-]*[.][a-zA-Z]+$' AND enviado IS FALSE
			LIMIT 15";*/
			
/* Eduardo - 04/02/2013 12:10
* SQL ALTERADO PARA:
*/
$sql = "SELECT id, nome, destino, assunto, mensagem, anexo
			FROM email_enviar
				WHERE (destino !~ '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][A-Za-z]+[.][A-Za-z]$' OR destino !~ '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][A-Za-z]+$') AND enviado IS FALSE
			LIMIT 15";
$array = array();
foreach ($conn->query($sql) as $row){
	$ar = array();
	$ar['id'] = $row['id'];
	$ar['destino'] = $row['destino'];
	$ar['assunto'] = $row['assunto'];
	$ar['mensagem'] = $row['mensagem'];
	$ar['anexo'] = $row['anexo'];
	$array[] = $ar;
}
enviaEmail($array, "Logistrack", "contato@logistrack.com.br");

unset($controller, $conn, $sql, $row, $ar, $array);

exit;
?>