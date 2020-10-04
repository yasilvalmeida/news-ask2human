<?php
	// Inialize session
	session_start();
	if(isset($_SESSION['views']))
	{
		unset($_SESSION[$_SESSION['views'].'id']);
		unset($_SESSION[$_SESSION['views'].'email']);
		unset($_SESSION[$_SESSION['views'].'password']);
		$_SESSION['views'] = $_SESSION['views'] - 1;
		$resp = "1";
	}
	else{
		$resp = "0";
	}
	echo json_encode(array("text"=>$resp));
?>