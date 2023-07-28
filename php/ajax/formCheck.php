<?php
	require_once __DIR__ . "/../config.php";
	require_once DIR_AJAX_UTIL . "AjaxResponse.php";
	require_once DIR_UTIL . "dbManager.php";

	$response = new AjaxResponse();

	if(!isset($_GET['emailRequired']) || !isset($_GET['usernameRequired'])){
		echo json_encode($response);
		return;
	}

	$emailRequired = $_GET['emailRequired'];
	$usernameRequired = $_GET['usernameRequired'];

	//check if they are already in the DB
	$resultUsername = getAccountByUsername($usernameRequired);
	$resultEmail = getEmailUser($emailRequired);

	if(checkEmptyResult($resultEmail)){
		if(checkEmptyResult($resultUsername)){
			$response = setEmptyResponse(); //OK: no email and username already used
			echo json_encode($response);
			return;
		} else{
			$response = setErrorOnUsername(); //ERROR: username already used
			echo json_encode($response);
			return;
		}
	} else{
		$response = setErrorOnEmail(); //ERROR: email already used
		echo json_encode($response);
		return;
	}


	function checkEmptyResult($result){
		if(!$result || $result === null)
			return true;

		return ($result->num_rows <= 0);
	}

	function setEmptyResponse(){//ok empty result
		$message = "OK";
		return new AjaxResponse(0, $message);
	}

	function setErrorOnEmail(){
		$message = 'Email already in use'; 
		return new AjaxResponse(-1, $message);
	}

	function setErrorOnUsername(){
		$message = 'Username already in use';
		return new AjaxResponse(-2, $message);
	}
?>
