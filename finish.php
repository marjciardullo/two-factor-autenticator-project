<?php header("Access-Control-Allow-Origin: *"); 
      header("Access-Control-Allow-Credentials: true "); 
      header("Access-Control-Allow-Methods: OPTIONS, GET, POST"); 
      header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");

require 'vendor/autoload.php';
session_start();
use RobThree\Auth\TwoFactorAuth;
$tfa = new TwoFactorAuth();

$success = '<DOCTYPE! html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Multi-Factor E-mail</title>
			<link rel="stylesheet" href="style.css">
			<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<link rel="icon" type="image/x-icon" href="https://favicon-generator.org/favicon-generator/htdocs/favicons/2021-11-16/563683422b8f63ed94a3ca125d2eaadb.ico">
	</head>

	<body>
		<div class="container">
			<div class="success">
				<span class="fingerprint material-icons">fingerprint</span>
				<span class="page-name">Multi Factor Authenticator</span>
			</div>
			<div class="right-side">
				<h2 style="font-weight: bold; font-size: 30px; color: #0C7966">SUCESSO!</h2>
				<span class="msg">Se você está vendo essa mensagem, seu usuário foi autenticado com sucesso!</span><br><span class="msg">Lembre-se de usar a autenticação multifator como método de segurança!</span>
			</div>
		</div>
	</body>
</html>';

$error = '<DOCTYPE! html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Multi-Factor E-mail</title>
			<link rel="stylesheet" href="style.css">
			<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<link rel="icon" type="image/x-icon" href="https://favicon-generator.org/favicon-generator/htdocs/favicons/2021-11-16/563683422b8f63ed94a3ca125d2eaadb.ico">
	</head>

	<body>
		<div class="container">
			<div class="error">
				<span class="fingerprint material-icons">fingerprint</span>
				<span class="page-name">Multi Factor Authenticator</span>
			</div>
			<div class="right-side">
				<h2 style="font-weight: bold; font-size: 30px; color: #7E1B26">ERRO!</h2>
				<span class="msg">Se você está vendo essa mensagem, houve uma falha na autenticação ou a página foi recarregada.</span><br><span class="msg"> Como os dados não são salvos em um banco de dados, os códigos não são mais válidos, por favor recomece o processo.</span>
			</div>
		</div>
	</body>
</html>';

$result = $tfa->verifyCode($_SESSION["secret"], $_POST['code']);
if ($result === true) {
	echo $success;
} else {
	echo $error;
}

?>