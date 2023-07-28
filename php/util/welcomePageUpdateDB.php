<?php
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "sessionUtil.php";
    require_once DIR_UTIL . "learningLanguageDbManager.php";
    require_once DIR_LAYOUT . "messageUtil.php";
	
	$level = $_GET['level'];

	$result = getNewAccount();//get username & userID by level attribute

	if($result->num_rows == 1){
		$resultRow = $result->fetch_assoc();
		$username = $resultRow['username'];
		$userID = $resultRow['userID'];

		$result = updateAccount($username);//update level field

		session_start();
		setSession($username, $userID);
		header('location: ./../homeLearn.php');
	}
	else
		showError();
	

	function getNewAccount(){
		global $learningLanguageDb;

		$queryText = 'SELECT * '
				   	. ' FROM user '
				   	. ' WHERE level IS NULL;';//newly registered accounts have level=null 

		$result = $learningLanguageDb->performQuery($queryText);
		echo $result->num_rows . '<br>';
		$learningLanguageDb->closeConnection();
		return $result;
	}

	function updateAccount($username){
		global $learningLanguageDb;

		$queryText = 'UPDATE user '
				   	. ' SET level = \'' . $_GET['level'] . '\'' 
				   	. ' WHERE username = \'' . $username . '\';';

		$result = $learningLanguageDb->performQuery($queryText);
		$learningLanguageDb->closeConnection();
		return $result;
	}
?>