<?php

session_start();


if (!isset($_SESSION['user_id'])) {
    
    header("Location: login.html");
    exit();
}

include('../includes/db.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user_id = $_SESSION['user_id'];

    
    $task_name = $_POST['task_name'];
    $description = $_POST['description'];

    
    $query = "INSERT INTO tasks (user_id, task_name, description, completed, created_at) VALUES (?, ?, ?, 0, CURRENT_TIMESTAMP)";
    $statement = $db->prepare($query);
    $statement->bind_param("iss", $user_id, $task_name, $description);
    $statement->execute();
    $statement->close();

    
    
    echo json_encode(array('status' => 'success'));
    exit();
} else {
    
    echo json_encode(array('status' => 'error'));
    exit();
}
?>
