<?php
// Start or resume session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    exit(json_encode(['status' => 'error', 'message' => 'User not logged in']));
}

// Include database connection
include('../includes/db.php'); // Adjust path as needed

// Check if task_id is provided in the POST data
if (!isset($_POST['task_id'])) {
    http_response_code(400); // Bad request
    exit(json_encode(['status' => 'error', 'message' => 'Task ID not provided']));
}

// Sanitize and validate task_id
$task_id = intval($_POST['task_id']); // Convert to integer

// Prepare and execute SQL query to delete the task
$query = "DELETE FROM tasks WHERE id = ?";
$statement = $db->prepare($query);
$statement->bind_param("i", $task_id);
$statement->execute();

// Check if the task was successfully deleted
if ($statement->affected_rows > 0) {
    http_response_code(200); // OK
    exit(json_encode(['status' => 'success', 'message' => 'Task removed successfully']));
} else {
    http_response_code(400); // Bad request
    exit(json_encode(['status' => 'error', 'message' => 'Failed to remove task']));
}

// Close prepared statement and database connection
$statement->close();
$db->close();
?>
