<?php

session_start();


if (!isset($_SESSION['user_id'])) {
    http_response_code(401); 
    exit(json_encode(['status' => 'error', 'message' => 'User not logged in']));
}


include('../includes/db.php'); 


if (!isset($_POST['task_id'])) {
    http_response_code(400); 
    exit(json_encode(['status' => 'error', 'message' => 'Task ID not provided']));
}


$task_id = intval($_POST['task_id']); 


$query = "UPDATE tasks SET completed = 1 WHERE id = ?";
$statement = $db->prepare($query);
$statement->bind_param("i", $task_id);
$statement->execute();


if ($statement->affected_rows > 0) {
    http_response_code(200); 
    exit(json_encode(['status' => 'success']));
} else {
    http_response_code(400); 
    exit(json_encode(['status' => 'error', 'message' => 'Failed to update status task']));
}


$statement->close();
$db->close();
?>
