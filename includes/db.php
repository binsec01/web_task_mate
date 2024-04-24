<?php

// Database configuration
$db_host = 'localhost';  // Hostname
$db_username = 'akash';  // MySQL username
$db_password = 'secretpassword';  // MySQL password
$db_name = 'taskmate_db';  // Database name

// Create a new MySQLi instance
$db = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}