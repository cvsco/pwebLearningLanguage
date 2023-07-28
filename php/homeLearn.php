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
<html lang="it">
<head>
	<meta charset="utf-8">
	<meta name = "author" content = "Progetto">
    <meta name = "keywords" content = "learning, language, english">
    <meta name="description" content="Free learning languages">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="./../css/img/earth.png"/>
    <link rel="stylesheet" type="text/css" href="./../css/learningLanguage_menu.css">
    <link rel="stylesheet" type="text/css" href="./../css/learningLanguage_topicList.css">
    <link rel="stylesheet" type="text/css" href="./../css/learningLanguage_rank.css">
    <script type="text/javascript" src="./../js/ajax/AccountDataLoader.js"></script>
    <script type="text/javascript" src="./../js/ajax/ajaxManager.js"></script>
    <script type="text/javascript" src="./../js/ajax/LearnDashboard.js"></script>
    <script type="text/javascript" src="./../js/ajax/UpdateAccountStat.js"></script>
	<title>Learning Language</title>
</head>
	<?php
		echo '<body onload="AccountDataLoader.loadData('.TOPIC_USER_DATA .'); AccountDataLoader.loadData(' . NAVBAR_USER_DATA . '); AccountDataLoader.loadData('. RANK_DATA.')">';

		include DIR_LAYOUT . "menu.php";
	?>

	<script type="text/javascript">
		document.getElementById("learnTxt").setAttribute("class", "highlighted_text title");
		document.getElementById("learnImg").setAttribute("class", "menu_item_image learn_img_1");

		//active if bottom menu is visible
		document.getElementById("bottom_learnImg").setAttribute("class", "menu_item_image learn_img_1");
	</script>

	<?php
		echo '<div id="content">';
		
		include DIR_LAYOUT . "topicList.php"; //create topics list

		echo '<div id="rank">';
		echo '</div>';
		echo '</div>';
	?>
		
</body>
</html>