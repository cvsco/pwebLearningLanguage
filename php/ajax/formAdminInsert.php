<?php
	require_once __DIR__ . './../config.php';
	require_once DIR_UTIL . 'dbManager.php';
	require_once DIR_AJAX_UTIL . 'AjaxResponse.php';

	$response = new AjaxResponse();

	if(!isset($_GET['type']) || !isset($_GET['topic']) || !isset($_GET['lang']) || !isset($_GET['text'])){
		echo json_encode($response);
		return;
	}

	if( ($_GET['type'] != 'audio' && !isset($_GET['answer'])) || ($_GET['type'] == 'multiple' && !isset($_GET['otherAnswer'])) ){
		echo json_encode($response);
		return;
	}

	$type = $_GET['type'];
	$topic = $_GET['topic'];
	$lang = $_GET['lang'];
	$text = replaceString($_GET['text']);
	$answer = replaceString($_GET['answer']);
	$otherAnswer = replaceString($_GET['otherAnswer']);
	$questionId = ($_GET['questionId'] === 'null') ? null : $_GET['questionId'];

	//updates the question already present in the db
	if(isset($questionId)){
		if(!isAlreadySet($type, $text, $lang)){
			$result = updateQuestion($_GET['questionId'], $type, $topic, $lang, $text, $answer, $otherAnswer);
			if($result){
				$message = "Domanda modificata correttamente!";
				$response = new AjaxResponse(0, $message);
				echo json_encode($response);
				return;
			}
		}

		setErrorResponse();
		return;
	}

	//insert new question in the db
	if(!isAlreadySet($type, $text, $lang)){
		$result = insertQuestion($type, $topic, $lang, $text, $answer, $otherAnswer);
		if($result){
			$message = "Domanda inserita correttamente!";
			$response = new AjaxResponse(0, $message);
			echo json_encode($response);
			return;
		}
	}
	else{
		setErrorResponse();
		return;
	}



	//test if the question is already in the db
	function isAlreadySet($type, $text, $lang){
		$result = searchQuestion($type, $text, $lang, null);

		if (!$result || $result === null)
			return false;
			
		return ($result->num_rows > 0);
	}

	function setErrorResponse(){
		$message = "La domanda è già presente nel database";
		$response = new AjaxResponse(-1, $message);
		echo json_encode($response);
		return;
	}

	function replaceString($var){
		$search = array('ì', 'è', 'é', 'ò', 'à', 'ù');
		$replace = array('&igrave;', '&egrave;', '&eacute;', '&ograve;', '&agrave;', '&ugrave;');
		
		$var = str_replace($search, $replace, $var);
	
		return $var;
	}
?>