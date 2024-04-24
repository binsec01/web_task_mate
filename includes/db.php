<?php


$db_host = 'localhost';  
$db_username = 'akash';  
$db_password = 'secretpassword';  
$db_name = 'taskmate_db';  


$db = new mysqli($db_host, $db_username, $db_password, $db_name);


if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}