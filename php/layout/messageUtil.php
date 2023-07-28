<?php
	function showError(){
		echo '<div class="error"><span>ERROR: Something went wrong</span><br>
		<span> Please try later!</span></div>';
	} 
	
	function showWarning($message){
		echo '<div class="warning"><span>' . $message . '</span></div>';
	}
?>