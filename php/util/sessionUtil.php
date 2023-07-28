<?php
	
	function setSession($username, $userId, $admin){
		$_SESSION['username'] = $username;
		$_SESSION['userId'] = $userId;
		$_SESSION['admin'] = $admin;
	}

	function isLogged(){		
		if(isset($_SESSION['userId']))
			return $_SESSION['userId'];
		else
			return false;
	}

	function isAdmin(){
		if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
			return true;
		else
			return false;
	}

?>