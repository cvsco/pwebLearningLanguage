<?php
	session_start();

	 require_once __DIR__ . "./../config.php";
	 require_once DIR_UTIL . "dbManager.php";
	 require_once DIR_AJAX_UTIL . 'AjaxResponse.php';

	 $response = new AjaxResponse();
	 
	 if(!isset($_GET['topicId'])){
	 	echo json_encode($response);
	 	return;
	 }

	 //get 10 random questions
	 $result = getQuestions($_GET['topicId']);


	 if(checkEmptyResult($result)){
	 	$response = new AjaxResponse(-1);
	 	echo json_encode($response);
		return;
	 }

	 $message = "OK";
	 $response = setResponse($result, $message);
	 echo json_encode($response);
	 return;

	 function checkEmptyResult($result){
	 	if (!$result || $result === null)
			return true;
			
		return ($result->num_rows <= 0);
	 }

	 function setResponse($result, $message){
	 	$response = new AjaxResponse(0, $message);

	 	$index = 0;
	 	while($row = $result->fetch_assoc()){
	 		$questionData = new QuestionData();

	 		$questionData->topic = $row['topicID'];
	 		$questionData->type = $row['type']; 
	 		$questionData->rightAnswer = replaceString($row['rightAnswer']);
	 		$questionData->text = replaceString($row['text']);
	 		$questionData->options = replaceString($row['options']);
	 		$questionData->lang = $row['language'];

			$response->data[$index] = $questionData;
	 		$index++;
	 	}

	 	return $response;
	 }

	 function replaceString($var){
		$search = array('&igrave;', '&egrave;', '&eacute;', '&ograve;', '&agrave;', '&ugrave;');
		$replace = array('ì', 'è', 'é', 'ò', 'à', 'ù');
		
		$var = str_replace($search, $replace, $var);
	
		return $var;
	}
?>