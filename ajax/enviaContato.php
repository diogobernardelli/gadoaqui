<?
chdir('../');
require_once 'phpmailer/class.phpmailer.php';

$phpmail = new PHPMailer ();

$phpmail->isSMTP ();

// Configuração de SMTP
$phpmail->Host = "ssl://smtp.googlemail.com";
$phpmail->SMTPAuth = true;
//$phpmail->SMTPDebug = true;
$phpmail->Port = 465;
$phpmail->Username = 'EMAIL';
$phpmail->Password = "senha";

// Remetente da mensagem
$phpmail->From = $_POST['email'];
$phpmail->FromName = 'Logistrack';
$phpmail->Sender = $phpmail->Username;

// Destinatario do email
//$phpmail->AddAddress ($maildest);

// Iremos enviar o email no formato HTML
$phpmail->IsHTML ( true );

// Destinatario do email
$phpmail->AddReplyTo($_POST['email'], $_POST['nome']);
$phpmail->SetFrom($_POST['email'], $_POST['nome']);
$phpmail->AddAddress($phpmail->Sender, $phpmail->FromName);

// Assunto e Corpo do email
$phpmail->Subject = $_POST['assunto'];

$mensagem = 'Nome: '.$_POST['nome'].'<br>
			E-mail: '.$_POST['email'].'<br>
			Telefone: '.$_POST['telefone'].'<br>
			Cidade/UF: '.$_POST['cidade_estado'].'<br>
			Mensagem: '.$_POST['msg'];
$phpmail->Body = $mensagem;

if ($phpmail->Send ()) {
	$phpmail->ClearAllRecipients();
	$ret = true;	
} else {
	$ret = false;
}

unset($phpmail, $mensagem, $_POST);
exit($ret);
?>