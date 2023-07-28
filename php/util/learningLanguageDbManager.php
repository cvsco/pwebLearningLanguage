<?php
	
	require_once __DIR__ . "/../config.php";

	$dbHostname = "localhost";
	$dbUsername = "root"; 
	$dbPassword = ""; 
	$dbName = "learning_language";

	$learningLanguageDb = new learningLanguageDbManager();

	class learningLanguageDbManager{
		private $mysqli_conn = null;

		function learningLanguageDbManager(){
			$this->openConnection();
		}

		function isClosed(){
       		return ($this->mysqli_conn == null);
    	}

		function openConnection(){
    		if ($this->isClosed()){
    			global $dbHostname;
    			global $dbUsername;
    			global $dbPassword;
    			global $dbName;
    			
    			$this->mysqli_conn = new mysqli($dbHostname, $dbUsername, $dbPassword);
				if ($this->mysqli_conn->connect_error) 
					die('Connect Error (' . $this->mysqli_conn->connect_errno . ') ' . $this->mysqli_conn->connect_error);

				$this->mysqli_conn->select_db($dbName) or
					die ('Can\'t use learning_language db: ' . mysqli_error());
			}
    	}

    	function closeConnection(){
 	       	if($this->mysqli_conn !== null)
				$this->mysqli_conn->close();
			
			$this->mysqli_conn = null;
		}


    	function performQuery($queryText) {
			if ($this->isClosed())
				$this->openConnection();
	
			return $this->mysqli_conn->query($queryText);
		}

		function sqlInjectionFilter($parameter){
			if($this->isClosed())
				$this->openConnection();
				
			return $this->mysqli_conn->real_escape_string($parameter);
		}
	}
?>