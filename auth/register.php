<?php

include('../includes/db.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $statement = $db->prepare($query);
    $statement->bind_param("ss", $username, $hashed_password);
    $statement->execute();
    $statement->close();
    
    $message = array('status' => "success");
} else {
    $message = array('status' => "failed");
}
echo json_encode($message);
?>