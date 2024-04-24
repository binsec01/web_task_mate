<?php
// Start the session to access session variables
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page or another destination
header("Location: ../login.html");
exit();
?>
