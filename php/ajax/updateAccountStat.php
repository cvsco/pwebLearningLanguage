<?php
	session_start();

	require_once __DIR__ . './../config.php';
	require_once DIR_UTIL . 'dbManager.php';
	require_once DIR_AJAX_UTIL . 'AjaxResponse.php';	

	$response = new AjaxResponse();
	
	if (!isset($_GET['lightNumber']) && !isset($_GET['updateType']) && (!isset($_GET['topicId']) || !isset($_GET['lang']))){
		echo json_encode($response);
		return;
	}

	$message = "OK";

	//update user light
	if(isset($_GET['lightNumber'])){
		$result = getUserStat($_SESSION['userId']);
		$row = $result->fetch_assoc();
		$oldLightValue = $row['light'];
		$newLightValue = $_GET['lightNumber'];
		if($oldLightValue != $newLightValue && setLightStat($newLightValue)){
			setCoinStat(null, $newLightValue); //update coins
			$response = new AjaxResponse(0, $message);
			echo json_encode($response);
			return;
		}
	}

	//update user streak
	if(isset($_GET['updateType']) && $_GET['updateType'] == 0){
		$todayLessons = getTodayLessons($_SESSION['userId']);
		if($todayLessons->num_rows == 1){ //update 'streak' only once a day
			//first update coins number
			$result = getUserStat($_SESSION['userId']); //recover user stat data
			$row = $result->fetch_assoc();
			$streak = $row['streak']+1;
			setCoinStat($streak , null);//+1 coins if streak+1 is multiple of 10
			
			if(setStreakStat()){//update streak
				$response = new AjaxResponse(0, $message);
				echo json_encode($response);
				return;
			}
		}
	}

	//update user XP
	if(isset($_GET['updateType']) && $_GET['updateType'] == 1){
		if(setXPStat()){
			$response = new AjaxResponse(0, $message);
			echo json_encode($response);
			return;
		}
	}

	//insert new progress row
	if(isset($_GET['topicId']) && isset($_GET['lang'])){
		$result = insertProgress($_SESSION['userId'], $_GET['topicId'], $_GET['lang']);
		if($result){
			$response = new AjaxResponse(0, $message);
			echo json_encode($response);
			return;
		}
	}

	//do nothing
	$response = new AjaxResponse(-1);
	echo json_encode($response);
	return;
	

	function setLightStat($lightValue){
		$result = updateLightStat($_SESSION['userId'], $lightValue);
		return $result;
	}

	function setStreakStat(){
		$result = updateStreakStat($_SESSION['userId']);
		return $result;
	}

	function setXPStat(){
		$result = updateXPStat($_SESSION['userId']);
		return $result;
	}

	function setCoinStat($streak, $light){
		$coinsToAdd = 0; //number of coins to add
		
		if($streak != null && ($streak % 10) === 0) //only if 'streak' is multiple of 10
			$coinsToAdd = $streak/10; 
		else 
			if($light != null && $light != 0 && ($light%2) == 0)//add coins every 2 lights earn
				$coinsToAdd++;
		
		$result = updateCoinStat($_SESSION['userId'], $coinsToAdd);
		return $result;
	}
?>