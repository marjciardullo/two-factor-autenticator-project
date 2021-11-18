<?php header("Access-Control-Allow-Origin: *"); 
      header("Access-Control-Allow-Credentials: true "); 
      header("Access-Control-Allow-Methods: OPTIONS, GET, POST"); 
      header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");

require 'vendor/autoload.php';
session_start();
use \Mailjet\Resources;
use RobThree\Auth\TwoFactorAuth;
$tfa = new TwoFactorAuth();
$secret = $tfa->createSecret();
$_SESSION["secret"] = $secret;

if (isset($_POST["email"])) {
	$mj = new \Mailjet\Client('055674d167d2b2c7ca07d224dde82604', '90db33f9b80a9c1e7356febde596643b', true, ['version' => 'v3.1']);
	$body = [
		'Messages' => [
			[
				'From' => [
					'Email' => "ms.marjorye@gmail.com",
					'Name' => "Multi-Factor E-mail"
				],
				'To' => [
					[
						'Email' => $_POST["email"],
						'Name' => "User"
					]
				],
				'Subject' => "Please authenticate your account",
				'TextPart' => "Account authentication request",
				'HTMLPart' => "<center><h3>Por favor insira o seguinte código em um aplicativo de autenticação:</h3> <br> <h1>".$secret."</h1></center>",
				'CustomID' => "AppGettingStartedTest"
			]
		]
	];
	$response = $mj->post(Resources::$Email, ['body' => $body]);
};

echo '<DOCTYPE! html>
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
			<div class="left-side">
				<span class="fingerprint material-icons">fingerprint</span>
				<span class="page-name">Multi Factor Authenticator</span>
			</div>
			<div class="right-side">
				<h2>AUTHENTICATE</h2>
				<span class="instruction">Digite o código no seu app de autenticação</span>
				<form class="form-2" action="finish.php" method="post">
					<input class="input" type="text" id="code" name="code" placeholder="code" required>	
					<input class="button" type="submit" name="button" value="ENVIAR">
				</form>
			</div>
		</div>
	</body>
</html>';
