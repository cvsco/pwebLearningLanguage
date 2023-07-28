<?php
	session_start();

	require_once __DIR__ . './../config.php';
	require_once DIR_UTIL . 'dbManager.php';
	require_once DIR_AJAX_UTIL . 'AjaxResponse.php';

	$response = new AjaxResponse();

	if (!isset($_GET['searchType'])){
		echo json_encode($response);
		return;
	}

	$searchType = $_GET['searchType'];
	
	switch ($searchType) {
		case 0:
			//before recovering the statData, check the powerup and streak reset
			dailyCheck();
			$result = getUserStat($_SESSION['userId']);
			if (checkEmptyResult($result)){
				$response = new AjaxResponse(-1); //error message already set in AjaxResponse.php
				echo json_encode($response);
				return;
			}
			$message = "OK";
			$response = setStatResponse($result, $message);
			echo json_encode($response);
			return;
		
		case 1:
			$result = getTopicStat($_SESSION['userId']);
			if (checkEmptyResult($result)){
				$response = new AjaxResponse(-1); //error message already set in AjaxResponse.php
				echo json_encode($response);
				return;
			}
			$message = "OK";
			$response = setTopicResponse($result, $message);
			echo json_encode($response);
			return;

		case 5:
			$result = getRank();
			if (checkEmptyResult($result)){
				$response = new AjaxResponse(-1); //error message already set in AjaxResponse.php
				echo json_encode($response);
				return;
			}
			$message = 'OK';
			$response = setRankResponse($result, $message);
			echo json_encode($response);
			return;
	}



	function checkEmptyResult($result){
		if (!$result || $result === null)
			return true;
			
		return ($result->num_rows <= 0);
	}

	function setStatResponse($result, $message){
		$response = new AjaxResponse(0, $message);

		//now we can recover user data
		$row = $result->fetch_assoc();
		$statData = new AccountStatData();

		$statData->username = ucfirst($row['username']);
		$statData->light = $row['light'];
		$statData->streak = $row['streak'];
		$statData->coin = $row['coin'];
		$statData->photo = $row['photo'];

		$response->data = $statData;
		return $response;
	}

	function setTopicResponse($result, $message){
		$response = new AjaxResponse(0, $message);

		$index = 0;
		while($row = $result->fetch_assoc()){
			$topicData = new TopicData();

			$topicData->name = $row['name'];
			$topicData->topicId = $row['topicID'];
			$topicData->times = $row['times'];
			$topicData->lastTime = $row['LastTime'];

			$response->data[$index] = $topicData;
			$index++;
		}

		return $response;
	}

	function setRankResponse($result, $message){
		$response = new AjaxResponse(0, $message);

		$index = 0;
		while($row = $result->fetch_assoc()){
			$rankData = new RankData();

			$rankData->username = ucfirst($row['username']);
			$rankData->score = $row['XP'];

			$response->data[$index] = $rankData;
			$index++;
		}

		return $response;
	}

	function dailyCheck(){
		resetStreakFreeze(); //after one day, restart streakFreeze
		$powerup = getUserStat($_SESSION['userId']);
		$row = $powerup->fetch_assoc();

		$yesterdayLessons = getYesterdayLessons($_SESSION['userId']);
		$today = date('Y-m-d');

		if(!isset($row['streakFreeze'])){
			$todayLessons = getTodayLessons($_SESSION['userId']);
			if(mysqli_num_rows($yesterdayLessons) == 0 && mysqli_num_rows($todayLessons) == 0){
				streakReset($_SESSION['userId']); //lose streak
			}
		}


		if(isset($row['coinsBet']) && $row['coinsBet'] != $today){
			if(mysqli_num_rows($yesterdayLessons) != 0){
				$purchaseDay = date_create($row['coinsBet']);
				$today = date_create(date('Y-m-d'));
				$diff = date_diff($purchaseDay, $today);
				$days = $diff->format('%d'); //number of days between the two dates
				if($days == 7){
					updateCoinStat($_SESSION['userId'], 10); //win the bet
					resetPowerup($_SESSION['userId'], 'coinsBet');
				}
			}
			else if(!isset($row['streakFreeze']))
					resetPowerup($_SESSION['userId'], 'coinsBet'); //lose the bet
		}
	}

	function resetStreakFreeze(){
		//check if a day has passed
		$result = checkStreakPowerup($_SESSION['userId']);

		if(checkEmptyResult($result)){
			resetPowerup($_SESSION['userId'], 'streakFreeze');
		}
	}
?>