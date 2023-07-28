<?php
	require_once __DIR__ . "/config.php";
    require_once DIR_UTIL . "learningLanguageDbManager.php";
    require_once DIR_UTIL . "sessionUtil.php";
 
	$username = $_POST['username'];
	$password = $_POST['password'];

	$errorMessage = login($username, $password);
	if($errorMessage === null && isAdmin())
		header('location: ./homeAdmin.php');
	else if($errorMessage === null)
			header('location: ./homeLearn.php');
		else
			header('location: ./../index.php?errorMessage=' . $errorMessage );


	function login($username, $password){   
		//empty fields case managed in FormManager.js

		$userRow = authenticate($username, $password);
    	if ($userRow != -1 && $userRow['userID'] > 0){
    		session_start();
    		setSession($userRow['username'], $userRow['userID'], $userRow['admin']);
    		return null;
    	}

    	return 'Username o password errati';
	}
	
	function authenticate ($username, $password){   
		global $learningLanguageDb;
		$username = $learningLanguageDb->sqlInjectionFilter($username);
		$password = $learningLanguageDb->sqlInjectionFilter($password);

		$queryText = "select * from user where username='" . $username . "' AND password='" . $password . "';";

		$result = $learningLanguageDb->performQuery($queryText);
		$numRow = mysqli_num_rows($result);
		if ($numRow != 1)
			return -1;
		
		$learningLanguageDb->closeConnection();
		$userRow = $result->fetch_assoc();
		$learningLanguageDb->closeConnection();
		return $userRow;
	}

?>