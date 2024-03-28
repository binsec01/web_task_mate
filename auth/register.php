<?php
// Include database connection
include('../includes/db.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    echo "$username, $password";

    // Insert user data into database
    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $statement = $db->prepare($query);
    $statement->bind_param("ss", $username, $password);
    $statement->execute();
    $statement->close();

    // Redirect to login page
    header("Location: ../login.html");
    exit();
}
?>