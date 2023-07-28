<?php
	require_once __DIR__ . "/../config.php";
	require_once DIR_UTIL . "learningLanguageDbManager.php";

	function buyPowerup($userId, $streakFreeze, $coinsBet, $price){
		global $learningLanguageDb;
		
		$userId = $learningLanguageDb->sqlInjectionFilter($userId);
		$streakFreeze = $learningLanguageDb->sqlInjectionFilter($streakFreeze);
		$conisBet = $learningLanguageDb->sqlInjectionFilter($coinsBet);
		$price = $learningLanguageDb->sqlInjectionFilter($price);

		if($streakFreeze != null)
			$queryText = 'UPDATE user'
					   . ' SET streakFreeze= \'' . $streakFreeze . '\', coin = coin -'.$price
					   . ' WHERE userID = \'' . $userId . '\' ;';
		else
			$queryText = 'UPDATE user'
					   . ' SET coinsBet= \'' . $coinsBet . '\', coin = coin -'.$price
					   . ' WHERE userID = \'' . $userId . '\' ;';

		$result = $learningLanguageDb->performQuery($queryText);
		$learningLanguageDb->closeConnection();
		return $result;
	}

	function resetPowerup($userId, $powerup){
		global $learningLanguageDb;
		
		$userId = $learningLanguageDb->sqlInjectionFilter($userId);
		$powerup = $learningLanguageDb->sqlInjectionFilter($powerup);

		$queryText = 'UPDATE user'
					   . ' SET ' . $powerup . ' = NULL'
					   . ' WHERE userID = \'' . $userId . '\' ;';

		$result = $learningLanguageDb->performQuery($queryText);
		$learningLanguageDb->closeConnection();
		return $result;
	}

	function updateXPStat($userId){
		global $learningLanguageDb;

		$userId = $learningLanguageDb->sqlInjectionFilter($userId);

		$queryText = 'UPDATE user'
				   . ' SET XP = XP + 10'
				   . ' WHERE userID = \''. $userId .'\';';

        $result = $learningLanguageDb->performQuery($queryText);
        $learningLanguageDb->closeConnection();
		return $result;
	}

	function updateCoinStat($userId, $coinsToAdd){
		global $learningLanguageDb;

		$userId = $learningLanguageDb->sqlInjectionFilter($userId);

		$queryText = 'UPDATE user'
				   . ' SET coin = coin + ' . $coinsToAdd
				   . ' WHERE userID = \''. $userId .'\';';

        $result = $learningLanguageDb->performQuery($queryText);
        $learningLanguageDb->closeConnection();
		return $result;
	}

	function updateStreakStat($userId){
		global $learningLanguageDb;

		$userId = $learningLanguageDb->sqlInjectionFilter($userId);

		$queryText = 'UPDATE user'
				   . ' SET streak = streak + 1'
				   . ' WHERE userID = \''. $userId .'\';';

        $result = $learningLanguageDb->performQuery($queryText);
        $learningLanguageDb->closeConnection();
		return $result;
	}

	function updateLightStat($userId, $data){
		global $learningLanguageDb;

		$userId = $learningLanguageDb->sqlInjectionFilter($userId);
		$data = $learningLanguageDb->sqlInjectionFilter($data);

		$queryText = 'UPDATE user'
				   .' SET light = ' . $data 
				   .' WHERE userID = \'' . $userId . '\';';

        $result = $learningLanguageDb->performQuery($queryText);
        $learningLanguageDb->closeConnection();
		return $result;
	}

	function streakReset($userId){
		global $learningLanguageDb;

		$userId = $learningLanguageDb->sqlInjectionFilter($userId);

		$queryText = 'UPDATE user'
				   .' SET streak = 0' 
				   .' WHERE userID = \'' . $userId . '\';';

        $result = $learningLanguageDb->performQuery($queryText);
        $learningLanguageDb->closeConnection();
		return $result;
	}

	function updateQuestion($questionId, $type, $topic, $lang, $text, $answer, $otherAnswer){
		global $learningLanguageDb;

		$questionId = $learningLanguageDb->sqlInjectionFilter($questionId);
		$type = $learningLanguageDb->sqlInjectionFilter($type);
		$topic = $learningLanguageDb->sqlInjectionFilter($topic);
		$lang = $learningLanguageDb->sqlInjectionFilter($lang);
		$text = $learningLanguageDb->sqlInjectionFilter($text);
		$answer = $learningLanguageDb->sqlInjectionFilter($answer);
		$otherAnswer = $learningLanguageDb->sqlInjectionFilter($otherAnswer);

		if($type == "audio")
			$queryText = 'UPDATE question'
				   .' SET  type = \''. $type .'\', topicID = '. $topic .', language = \''. $lang .'\', text = \''. $text .'\''
				   .' WHERE questionID = \'' . $questionId . '\';';
		else if($otherAnswer == 'null')
				$queryText = 'UPDATE question'
				   .' SET  type = \''. $type .'\', topicID = '. $topic .', language = \''. $lang .'\', text = \''. $text .'\', rightAnswer = \''. $answer .'\''
				   .' WHERE questionID = \'' . $questionId . '\';';
			else
				$queryText = 'UPDATE question'
				   .' SET  type = \''. $type .'\', topicID = '. $topic .', language = \''. $lang .'\', text = \''. $text .'\', rightAnswer = \''. $answer .'\', options = \''. $otherAnswer .'\''  
				   .' WHERE questionID = \'' . $questionId . '\';';

        $result = $learningLanguageDb->performQuery($queryText);
        $learningLanguageDb->closeConnection();
		return $result;
	}

	function insertAccount($username, $password, $email){
		global $learningLanguageDb;

		$username = $learningLanguageDb->sqlInjectionFilter($username);
		$password = $learningLanguageDb->sqlInjectionFilter($password);
		$email = $learningLanguageDb->sqlInjectionFilter($email);

		$queryText = 'INSERT INTO user (username, password, email) '
				   . ' VALUES (\''. $username .'\', \'' . $password .'\', \'' . $email . '\');';
		 
		$result = $learningLanguageDb->performQuery($queryText);
		$learningLanguageDb->closeConnection();
		return $result;
	}

	function insertProgress($userId, $topicId, $lang){
		global $learningLanguageDb;

		$userId = $learningLanguageDb->sqlInjectionFilter($userId);
		$topicId = $learningLanguageDb->sqlInjectionFilter($topicId);
		$lang = $learningLanguageDb->sqlInjectionFilter($lang);

		$queryText = 'INSERT INTO progress (userID, topicID, date, language) '
				   . ' VALUES (\''. $userId .'\', \'' . $topicId .'\', CURRENT_DATE, \'' . $lang . '\');';
		
		$result = $learningLanguageDb->performQuery($queryText);
		$learningLanguageDb->closeConnection();
		return $result;
	}

	function insertQuestion($type, $topic, $lang, $text, $answer, $otherAnswer){
		global $learningLanguageDb;

		$type = $learningLanguageDb->sqlInjectionFilter($type);
		$topic = $learningLanguageDb->sqlInjectionFilter($topic);
		$lang = $learningLanguageDb->sqlInjectionFilter($lang);
		$text = $learningLanguageDb->sqlInjectionFilter($text);
		$answer = $learningLanguageDb->sqlInjectionFilter($answer);
		$otherAnswer = $learningLanguageDb->sqlInjectionFilter($otherAnswer);

		if($type === "audio")
			$queryText = 'INSERT INTO question (topicID, type, text, language) '
				  	 . ' VALUES (\''. $topic .'\', \'' . $type .'\', \'' . $text . '\', \'' . $lang .'\');';
		else if($otherAnswer == 'null')
				$queryText = 'INSERT INTO question (topicID, type, text, rightAnswer, language) '
				  	 . ' VALUES (\''. $topic .'\', \'' . $type .'\', \'' . $text . '\', \'' . $answer . '\', \'' . $lang .'\');';
			 else
				$queryText = 'INSERT INTO question (topicID, type, text, rightAnswer, options, language) '
				  	 . ' VALUES (\''. $topic .'\', \'' . $type .'\', \'' . $text . '\', \'' . $answer . '\', \'' . $otherAnswer . '\', \''. $lang .'\');';

		$result = $learningLanguageDb->performQuery($queryText);
		$learningLanguageDb->closeConnection();
		return $result;
	}

	function getTodayLessons($userId){
		global $learningLanguageDb;

		$userId = $learningLanguageDb->sqlInjectionFilter($userId);

		$queryText = 'SELECT *'
				   . ' FROM progress'
				   . ' WHERE userID = \''. $userId .'\' AND date = CURRENT_DATE;';

        $result = $learningLanguageDb->performQuery($queryText);
        $learningLanguageDb->closeConnection();
		return $result;
	}

	function getYesterdayLessons($userId){
		global $learningLanguageDb;

		$userId = $learningLanguageDb->sqlInjectionFilter($userId);

		$queryText = 'SELECT *'
				   . ' FROM progress'
				   . ' WHERE userID = \''. $userId .'\' AND date = CURRENT_DATE - INTERVAL 1 DAY;';

        $result = $learningLanguageDb->performQuery($queryText);
        $learningLanguageDb->closeConnection();
		return $result;
	}

	function getQuestions($topicId){
		global $learningLanguageDb;

		$topicId = $learningLanguageDb->sqlInjectionFilter($topicId);

		$queryText = 'SELECT *'
				   . ' FROM question'
				   . ' WHERE topicID = \''. $topicId .'\''
				   . ' ORDER BY RAND()'
				   . ' LIMIT 10;';

        $result = $learningLanguageDb->performQuery($queryText);
        $learningLanguageDb->closeConnection();
		return $result;
	}

	function searchQuestion($type, $text, $lang, $topic){
		global $learningLanguageDb;

		$type = $learningLanguageDb->sqlInjectionFilter($type);
		$lang = $learningLanguageDb->sqlInjectionFilter($lang);
		$text = $learningLanguageDb->sqlInjectionFilter($text);
		$topic = $learningLanguageDb->sqlInjectionFilter($topic);

		if($topic == null)
			$queryText = 'SELECT *'
				       . ' FROM question'
				       . ' WHERE type = \''. $type .'\' AND language = \'' . $lang .'\'' 
				       . ' AND STRCMP(alphanum(text), alphanum(\'' . $text . '\')) = 0;';
		else
			$queryText = 'SELECT *'
				       . ' FROM question Q INNER JOIN topic T ON Q.topicID=T.topicID'
				       . ' WHERE type = \''. $type .'\' AND language = \'' . $lang .'\'' 
				       . ' AND alphanum(text) LIKE CONCAT(\'%\', alphanum(\'' . $text . '\'), \'%\')'
				       . ' AND Q.topicID = \'' . $topic . '\';';
        
        $result = $learningLanguageDb->performQuery($queryText);
        $learningLanguageDb->closeConnection();
		return $result;
	}

	function getTopicStat($userId){
		global $learningLanguageDb;

		$userId = $learningLanguageDb->sqlInjectionFilter($userId);

		$queryText = 'SELECT P.topicID, T.name, T.section, COUNT(*) AS times, 
							(SELECT MAX(P1.date)
							 FROM progress P1
							 WHERE P1.userID='. $userId .' AND P1.topicID=P.topicID) AS LastTime' 
				   . ' FROM user U INNER JOIN  progress P ON U.userId = P.userId'
            			.'	INNER JOIN topic T ON P.topicID = T.topicID'
            	   . ' WHERE P.userID =' . $userId 
            	   . ' GROUP BY P.topicID, T.name'
            	   . ' ORDER BY T.section, T.topicID;';

        $result = $learningLanguageDb->performQuery($queryText);
        $learningLanguageDb->closeConnection();
		return $result;
	}

	function getUserStat($userId){
		global $learningLanguageDb;

		$userId = $learningLanguageDb->sqlInjectionFilter($userId);

		$queryText = 'SELECT username, light, streak, coin, photo, streakFreeze, coinsBet '
				   . 'FROM user '
				   . 'WHERE userID = \''. $userId . '\';';

		$result = $learningLanguageDb->performQuery($queryText);
		$learningLanguageDb->closeConnection();
		return $result;
	}

	function getAccountByUsername($username){ //is helpful for signin verification
		global $learningLanguageDb;
		
		$username = $learningLanguageDb->sqlInjectionFilter($username);

		$queryText = 'SELECT * '
				   . ' FROM user '
				   . ' WHERE username = \'' . $username . '\' ;';

		$result = $learningLanguageDb->performQuery($queryText);
		$learningLanguageDb->closeConnection();
		return $result;
	}

	function getEmailUser($email){
		global $learningLanguageDb;
		
		$username = $learningLanguageDb->sqlInjectionFilter($email);

		$queryText = 'SELECT email '
				   . ' FROM user '
				   . ' WHERE email = \'' . $email . '\' ;';

		$result = $learningLanguageDb->performQuery($queryText);
		$learningLanguageDb->closeConnection();
		return $result;
	}

	function getCoinsCheck($userId, $price){
		global $learningLanguageDb;
		
		$userId = $learningLanguageDb->sqlInjectionFilter($userId);
		$price = $learningLanguageDb->sqlInjectionFilter($price);

		$queryText = 'SELECT *'
				   . ' FROM user'
				   . ' WHERE userID = \'' . $userId . '\' AND coin >='. $price .' ;';

		$result = $learningLanguageDb->performQuery($queryText);
		$learningLanguageDb->closeConnection();
		return $result;
	}

	function checkStreakPowerup($userId){
		global $learningLanguageDb;
		
		$userId = $learningLanguageDb->sqlInjectionFilter($userId);

		$queryText = 'SELECT * '
				   . ' FROM user '
				   . ' WHERE userID = \'' . $userId . '\' AND (streakFreeze = CURRENT_DATE OR streakFreeze = CURRENT_DATE - INTERVAL 1 DAY);';

		$result = $learningLanguageDb->performQuery($queryText);
		$learningLanguageDb->closeConnection();
		return $result;
	}

	function getRank(){
		global $learningLanguageDb;

		$queryText = 'SELECT username, XP '
				   . ' FROM user '
				   . ' WHERE admin <> 1'
				   . ' ORDER BY XP DESC;';

		$result = $learningLanguageDb->performQuery($queryText);
		$learningLanguageDb->closeConnection();
		return $result;
	}
?>