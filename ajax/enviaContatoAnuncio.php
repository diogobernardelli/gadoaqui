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
$phpmail->Password = "SENHA";

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
$phpmail->AddAddress($_POST['emailAnunciante'], $_POST['nomeAnunciante']);

// Assunto e Corpo do email
$phpmail->Subject = 'Contato de anúncio';

$mensagem = 'O visitante abaixo ficou interessado em seu seguinte anúncio: <br>';
			if ($_POST['t'] == 'g')
				$mensagem .= '<a href="http://www.gadoaqui.com.br/anuncio.php?id='.$_POST['id'].'">Anúncio Gado Aqui</a><br><br>';
			else
				$mensagem .= '<a href="http://www.gadoaqui.com.br/produto.php?id='.$_POST['id'].'">Anúncio Gado Aqui</a><br><br>';
$mensagem .= 'Nome: '.$_POST['nome'].'<br>
			E-mail: '.$_POST['email'].'<br>
			Telefone: '.$_POST['telefone'].'<br>
			Cidade/UF: '.$_POST['cidade'].'/'.$_POST['estado'].'<br>
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