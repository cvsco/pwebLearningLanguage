<?php
	session_start();

	include_once __DIR__ . "./config.php";
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
    <link rel="shortcut icon" type="image/x-icon" href="./../css/img/earth.png">
    <link rel="stylesheet" type="text/css" href="./../css/learningLanguage_practice.css">
    <script type="text/javascript" src="./../js/ajax/ajaxManager.js"></script>
    <script type="text/javascript" src="./../js/ajax/PracticeDataLoader.js"></script>
    <script type="text/javascript" src="./../js/ajax/PracticeDashboard.js"></script>
    <script type="text/javascript" src="./../js/ajax/PracticeEventHandler.js"></script>
    <script type="text/javascript" src="./../js/ajax/UpdateAccountStat.js"></script>
	<title>Learning Language</title>
</head>
	<?php
		echo '<body onload="PracticeDataLoader.loadData('. $_GET['topic'] .')">';
		echo '<div id="practice_content">';

		include DIR_LAYOUT . 'headerLoadbar.php';

		echo '<div id="practice_section"></div>';
		
		echo '</div>';
	?>
</body>
</html>