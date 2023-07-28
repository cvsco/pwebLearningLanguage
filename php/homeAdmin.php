<?php
	session_start();

	require_once __DIR__ . "/config.php";
	require_once DIR_UTIL . "sessionUtil.php";

	if(!isLogged()){
		header('Location: ./../index.php');
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name = "author" content = "Progetto">
    <meta name = "keywords" content = "learning, language, english">
    <meta name="description" content="Free learning languages">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="./../css/img/earth.png"/>
    <link rel="stylesheet" type="text/css" href="./../css/learningLanguage_admin.css">
    <script type="text/javascript" src="./../js/ajax/FormManagerAdmin.js"></script>
    <script type="text/javascript" src="./../js/ajax/ajaxManager.js"></script>
    <script type="text/javascript" src="./../js/ajax/AdminEventHandler.js"></script>
    <script type="text/javascript" src="./../js/ajax/AdminSearchDashboard.js"></script>
	<title>Learning Language</title>
</head>
<body onload="AdminEventHandler.begin()">
	<header id="head">
		<h1>Sezione amministratore</h1>
		<hr>
		<p>Gestione delle domande</p>
	</header>

	<nav id="sidenav" class="sidenav">
  		<a href="#add" id="addSidenav">Aggiungi</a>
	  	<a href="#change" id="changeSidenav">Modifica</a>
	  	<a href="./logout.php" id="exit">Esci</a>
	</nav>

		
	<article id="add">
		<h2>Aggiungi una nuova domanda</h2>
		<form id="formAdd">
			<div class="row">
				<div class="col-25">
					<label for="addTypes">Tipo:</label>
				</div>
				<div class="col-75">
					<select id="addTypes" name="type" required onchange="AdminEventHandler.handleTextFields()">
						<option value="" selected disabled hidden>Select type:</option>
						<option value="audio">Audio</option>
						<option value="multiple">Multiple</option>
						<option value="reverso">Reverso</option>
						<option value="translate">Translate</option>
					</select>
				</div>
			</div>
	
			<div class="row">
				<div class="col-25">
					<label for="addTopics">Argomento:</label>
				</div>
				<div class="col-75">
					<select id="addTopics" name="topic" required>
						<option value="" selected disabled hidden>Select arg:</option>
						<optgroup label="Sezione-1">
							<option value="1">Basi</option>
							<option value="2">Cibo</option>
							<option value="3">Animali</option>
							<option value="4">Possessivi</option>
							<option value="5">Pronomi oggetto</option>
							<option value="6">Colori</option>
						</optgroup>
						<optgroup label="Sezione-2">
							<option value="7">Presente</option>
							<option value="8">Aggettivi</option>
							<option value="9">Avverbi</option>
							<option value="10">Scuola</option>
							<option value="11">Viaggi</option>
							<option value="12">Pronomi indefiniti</option>
						<optgroup label="Sezione-3">
							<option value="13">Passato</option>
							<option value="14">Infinito</option>
							<option value="15">Presente perfetto</option>
							<option value="16">Participio</option>
							<option value="17">Pronomi relativi</option>
							<option value="18">Oggetti</option>
						</optgroup>
						<optgroup label="Sezione-4">
							<option value="19">Pronomi riflessivi</option>
							<option value="20">Futuro</option>
							<option value="21">Verbi modali</option>
							<option value="22">Condizionale perfetto</option>
							<option value="23">Scienza</option>
							<option value="24">Attributi</option>
						</optgroup>
					</select>
				</div>
			</div>
				
			<div class="row">
				<div class="col-25">
					<label for="addLang">Lingua:</label>
				</div>
				<div class="col-75">
					<select id="addLang" name="lang" required>
						<option value="" selected disabled hidden>Select lang:</option>
						<option value="eng">English</option>
					</select>
				</div>
			</div>
	
			<div class="row">
				<div class="col-25">
					<label for="addText">Testo dell'eserizio:</label>
				</div>
				<div class="col-75">
					<textarea id="addText" name="text" placeholder="Inserire testo dell'esercizio..." required></textarea>
				</div>
			</div>
	
			<div class="row">
				<div class="col-25">
					<label for="addAnswer">Risposta:</label>
				</div>
				<div class="col-75">
					<textarea id="addAnswer" name="answer" placeholder="Inserire la miglior risposta possibile..."></textarea>
				</div>
			</div>
	
			<div class="row">
				<div class="col-25">
					<label for="addOptions">Altre risposte:<br>
						<small id="caption">separare ogni opzione con un - (trattino alto)</small>
					</label>
				</div>
				<div class="col-75">
					<textarea id="addOptions" name="otherAnswers" placeholder="Inserire altre possibili risposte..."></textarea>
				</div>
			</div>
	
			<div class="subButton">
				<input type="submit" value="Aggiungi" id="submitAdd">
			</div>
		</form>
	</article>

	<article id="change">
		<h2>Cerca e modifica una domanda</h2>
		<div>
			<form id="formChange">
				<label>Tipo:<br> 
					<select id="changeTypes" required>
						<option value="" selected disabled hidden>Select type:</option>
						<option value="audio">Audio</option>
						<option value="multiple">Multiple</option>
						<option value="reverso">Reverso</option>
						<option value="translate">Translate</option>
					</select>
				</label>

				<label>Argomento:<br>
					<select id="changeTopics" required>
						<option value="" selected disabled hidden>Select arg:</option>
						<optgroup label="Sezione-1">
							<option value="1">Basi</option>
							<option value="2">Cibo</option>
							<option value="3">Animali</option>
							<option value="4">Possessivi</option>
							<option value="5">Pronomi oggetto</option>
							<option value="6">Colori</option>
						</optgroup>
						<optgroup label="Sezione-2">
							<option value="7">Presente</option>
							<option value="8">Aggettivi</option>
							<option value="9">Avverbi</option>
							<option value="10">Scuola</option>
							<option value="11">Viaggi</option>
							<option value="12">Pronomi indefiniti</option>
						<optgroup label="Sezione-3">
							<option value="13">Passato</option>
							<option value="14">Infinito</option>
							<option value="15">Presente perfetto</option>
							<option value="16">Participio</option>
							<option value="17">Pronomi relativi</option>
							<option value="18">Oggetti</option>
						</optgroup>
						<optgroup label="Sezione-4">
							<option value="19">Pronomi riflessivi</option>
							<option value="20">Futuro</option>
							<option value="21">Verbi modali</option>
							<option value="22">Condizionale perfetto</option>
							<option value="23">Scienza</option>
							<option value="24">Attributi</option>
						</optgroup>
					</select>
				</label>

				<label>Lingua:<br>
					<select id="changeLang" required>
						<option value="" selected disabled hidden>Select lang:</option>
						<option value="eng">English</option>
					</select>
				</label>

				<label>Testo dell'esercizio:<br>
					<textarea id="changeText" placeholder="Inserire testo dell'esercizio..." required></textarea>
				</label>
				<div class="subButton">
					<input type="submit" value="Cerca" id="submitChange">
				</div>
			</form>
		</div>
	</article>

	<div id="message">
		<div id="messageImg"></div>
		<p id="textMessage">Messaggio di errore</p>
	</div>	
</body>
</html>