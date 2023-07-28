<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="utf-8">
	<meta name = "author" content = "Progetto">
    <meta name = "keywords" content = "learning, language, english">
    <meta name="description" content="Free learning languages">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="./../css/img/earth.png"/>
    <link rel="stylesheet" type="text/css" href="./../css/welcome.css">
    <script type="text/javascript" src="./../js/welcomeEffects.js"></script>
	<title>Welcome in Learning Language</title>
</head>
<body onload="begin()">
	<section id="container">
		<h1>Benvenuto, ora scegli un obiettivo giornaliero</h1>
		<form action="./util/welcomePageUpdateDB.php" method="get">
			<div id="options">
				<label>
					<input type="radio" name="level" value="rilassato" onclick="setStyle()">
					<span class="level">Rilassato</span>
					<span class="minutes">5 min / giorno</span>
				</label>
				<label>
					<input type="radio" name="level" value="normale" checked onclick="setStyle()">
					<span class="level">Normale</span>
					<span class="minutes">10 min / giorno</span>
				</label>
				<label>
					<input type="radio" name="level" value="serio" onclick="setStyle()">
					<span class="level">Serio</span>
					<span class="minutes">15 minuti / giorno</span>
				</label>
				<label>
					<input type="radio" name="level" value="intenso" onclick="setStyle()">
					<span class="level">Intenso</span>
					<span class="minutes">20 minuti / giorno</span>
				</label>
			</div>
			<input type="submit" name="continua" value="Continua">
		</form>
	</section>
</body>
</html>