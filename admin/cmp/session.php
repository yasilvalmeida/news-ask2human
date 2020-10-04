<?php
	// Inialize session
	session_start();
	// Check
  if (isset($_SESSION) && $_SESSION['views'] == 0)
  {
		header('Location: index.php');
  }
  else
  {
    // Load user information from $_SESSION
    $id       = $_SESSION[$_SESSION['views'].'id'];
    $email    = $_SESSION[$_SESSION['views'].'email'];
    $password = $_SESSION[$_SESSION['views'].'password'];
    echo "<input type='hidden' id='logged_id' value='".$id."' />";
    echo "<input type='hidden' id='logged_email' value='".$email."' />";
    echo "<input type='hidden' id='logged_password' value='".$password."' />";
  }
?>