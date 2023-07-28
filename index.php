<?php
	session_start();
	require_once __DIR__ . "/php/config.php";
	include DIR_UTIL . "sessionUtil.php";

	if(isLogged() && isAdmin()){
		header('Location: ./php/homeAdmin.php');
		exit;
	}

	if(isLogged()){
		header('Location: ./php/homeLearn.php');
		exit;
	}
?>

<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="utf-8">
	<meta name = "author" content = "Progetto">
    <meta name = "keywords" content = "learning, language, english">
    <meta name="description" content="Free learning languages">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="./css/img/earth.png"/>
    <link rel="stylesheet" type="text/css" href="./css/learningLanguage_login.css"/>
	<script type="text/javascript" src="./js/indexEffects.js"></script>
	<script type="text/javascript" src="./js/ajax/ajaxManager.js"></script>
	<script type="text/javascript" src="./js/ajax/FormManager.js"></script>
	<title>Learning Language</title>	
</head>
	<?php
		echo '<body onload="begin(); FormManager.addHandlers(document.login); FormManager.addHandlers(document.signin)">';
	?>
	<div id="bg-image"></div>
	<section id="login_content">
		<div id="desc_content">
			<h1>Learning Language</h1>
			<h2>Entra subito e impara una nuova lingua</h2>
			<figure>
				<img src="./css/img/earth.png" alt="mondo" class="earthIMG">
				<figcaption>Welcome, Bienvenue, Willkommen, Bienvenida...</figcaption>
	 		</figure>
		</div>
		<div id="login_form">
			<form action="./php/login.php" method="post" name="login">
				<div>
					<label for="username">Username</label><br>
					<input type="text" id="username" name="username" required>
				</div>
				<div>
					<label for="password">Password</label><br>
					<input type="password" id="password" name="password" required>
				</div>
				<?php
					if(isset($_GET['errorMessage'])){
						echo '<div class="error_message">';
						echo '<span>' . $_GET['errorMessage'] . '</span>';
						echo '</div>';
					}
				?>
				<input type="submit" value="Login"> 
				<div class="signin_button">
					Non sei un utente registrato ? <button type="button" onclick='viewLoginSignin("login_form", "signin_form")'>Registrati ora</button>
				</div>
			</form>
		</div>
		<div id="signin_form">
			<form action="./php/signin.php" method="post" name="signin">
				<div class="email">
					<label for="email">Email</label><br>
					<input type="email" name="email" id="email" required>
				</div>
				<div class="username">
					<label for="signin_username">Username</label><br>
					<input type="text" name="username" id="signin_username" required>
				</div>
				<div>
					<label for="signin_passwd">Password <small> (min.8)</small></label><br>
					<input type="password" id="signin_passwd" name="password" pattern=".{8,}" required>
				</div> 
				<div class="conf_signin_passwd">
					<label for="conf_signin_passwd">Conferma password</label><br>
					<input type="password" id="conf_signin_passwd" name="conferma_password" pattern=".{8,}" required>
					<div class="signin_error_message">
						<span>Le password devono essere uguali</span>
					</div>
				</div>
				<input type="submit" value="SignIn">
				<div class="login_button">
				sei gia iscritto ? <button type="button" onclick="viewLoginSignin('signin_form', 'login_form')">LogIn</button>
				</div>
			</form>
		</div>
	</section>
</body>
</html>