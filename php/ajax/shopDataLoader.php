<?php
	session_start();

	require_once __DIR__ . './../config.php';
	require_once DIR_UTIL . 'dbManager.php';
	require_once DIR_AJAX_UTIL . 'AjaxResponse.php';

	$response = new AjaxResponse();

	if (!isset($_GET['powerupType'])){
		echo json_encode($response);
		return;
	}

	
	$powerupType = $_GET['powerupType'];
	$message = "OK";
	$today = date('Y-m-d');
	$price = ($powerupType == 2) ? 10 : 5;

	//update streak freeze powerup
	switch($powerupType){
		case 2:
			if(!coinsCheck($price)){
				$result = buyPowerup($_SESSION['userId'], $today, null, $price);
				if($result){
					$response = new AjaxResponse(-1, $message);
					echo json_encode($response);
					return;
				}
			}
			$message = "Non è stato possibile completare la transazione, denaro insufficiente";
			$response = new AjaxResponse(1, $message);
			echo json_encode($response);
			return;

		case 3:
			if(!coinsCheck($price)){ 
				$result = buyPowerup($_SESSION['userId'], null, $today, $price);
				if($result){
					$response = new AjaxResponse(-2, $message);
					echo json_encode($response);
					return;
				}
			}

			$message = "Non è stato possibile completare la transazione, denaro insufficiente";
			$response = new AjaxResponse(1, $message);
			echo json_encode($response);
			return;

		case 4: //when shop page is loaded
			$result = getUserStat($_SESSION['userId']);
			if(!checkEmptyResult($result)){
				$row = $result->fetch_assoc();
		
				if($row['streakFreeze'] != null && $row['coinsBet'] != null){ //disable streakFreeze button in shop
					$response = new AjaxResponse(-3, $message);
					echo json_encode($response);
					return;
				}

				if($row['coinsBet'] != null){ //disable coinsBet button in shop
					$response = new AjaxResponse(-2, $message);
					echo json_encode($response);
					return;
				}
		
				if($row['streakFreeze'] != null){ //disable streakFreeze button in shop
					$response = new AjaxResponse(-1, $message);
					echo json_encode($response);
					return;
				}
			}
			break;
	}
	

	//set default
	$response = new AjaxResponse(0, $message);
	echo json_encode($response);
	return;



	function checkEmptyResult($result){
		if (!$result || $result === null)
			return true;
			
		return ($result->num_rows <= 0);
	}

	//check if there is enough money to make the purchase
	function coinsCheck($price){
		$result = getCoinsCheck($_SESSION['userId'], $price);

		return checkEmptyResult($result);
	}
?>