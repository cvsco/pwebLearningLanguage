<?php
	require_once __DIR__ . "/config.php";
    require_once DIR_UTIL . "sessionUtil.php";
    require_once DIR_UTIL . "dbManager.php";
    require_once DIR_LAYOUT . "messageUtil.php";

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $result = insertAccount($username, $password, $email); //insert the new account in the DB

    if($result)
        header('location: ./welcome.php');
    else
        showError();

    /*All error cases ara handled in FormManager.js with AJAX*/
?>