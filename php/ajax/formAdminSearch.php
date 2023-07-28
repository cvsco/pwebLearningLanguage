<?php
	require_once __DIR__ . './../config.php';
	require_once DIR_UTIL . 'dbManager.php';
	require_once DIR_AJAX_UTIL . 'AjaxResponse.php';

	$response = new AjaxResponse();

	if(!isset($_GET['type']) || !isset($_GET['topic']) || !isset($_GET['lang']) || !isset($_GET['text'])){
		echo json_encode($response);
		return;
	}

	$type = $_GET['type'];
	$topic = $_GET['topic'];
	$lang = $_GET['lang'];
	$text = replaceString($_GET['text'], true);

	$result = searchQuestion($type, $text, $lang, $topic);

	if(checkEmptyResult($result)){
		$response = setEmptyResponse();
		echo json_encode($response);
		return;
	}

	$message = "OK";	
	$response = setResponse($result, $message);
	echo json_encode($response);
	return;

	function checkEmptyResult($result){
		if ($result === null || !$result)
			return true;
			
		return ($result->num_rows <= 0);
	}

	function setEmptyResponse(){
		$message = "Non è stata trovata alcuna corrispondenza";
		return new AjaxResponse(-1, $message);
	}

	function setResponse($result, $message){
		$response = new AjaxResponse(0, $message);

		$index = 0;
		while($row = $result->fetch_assoc()){
			$question = new QuestionData();

			$question->questionId = $row['questionID'];
			$question->topic = $row['name']; //name of the topic
			$question->type = $row['type'];
			$question->rightAnswer = replaceString($row['rightAnswer'], false);
			$question->text = replaceString($row['text'], false);
			$question->options = replaceString($row['options'], false);
			$question->lang = $row['language'];

			$response->data[$index] = $question;
	 		$index++;
		}

	 	return $response;
	}

	function replaceString($var, $userToDB){
		$char = array('ì', 'è', 'é', 'ò', 'à', 'ù');
		$entity = array('&igrave;', '&egrave;', '&eacute;', '&ograve;', '&agrave;', '&ugrave;');
		
		if($userToDB == true)
			$var = str_replace($char, $entity, $var);
		else
			$var = str_replace($entity, $char, $var);
	
		return $var;
	}
?>