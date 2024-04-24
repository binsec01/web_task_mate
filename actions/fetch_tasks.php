<?php

session_start();


if (!isset($_SESSION['user_id'])) {
    http_response_code(401); 
    exit(json_encode(['status' => 'error', 'message' => 'User not logged in']));
}


include('../includes/db.php'); 


$user_id = $_SESSION['user_id'];


$query = "SELECT id, task_name,completed, description FROM tasks WHERE user_id = ?";
$statement = $db->prepare($query);
$statement->bind_param("i", $user_id);
$statement->execute();


$result = $statement->get_result();


if ($result->num_rows > 0) {
    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[] = [
            'id' => $row['id'],
            'task_name' => $row['task_name'],
            'description' => $row['description'],
            'completed' => $row['completed'],
        ];
    }

    
    http_response_code(200); 
    exit(json_encode(['status' => 'success', 'tasks' => $tasks]));
} else {
    http_response_code(200); 
    exit(json_encode(['status' => 'error', 'message' => 'No tasks found']));
}


$statement->close();
$db->close();
?>
