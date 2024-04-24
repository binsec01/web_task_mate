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

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Prepare and execute SQL query to fetch tasks for the logged-in user
$query = "SELECT id, task_name,completed, description FROM tasks WHERE user_id = ?";
$statement = $db->prepare($query);
$statement->bind_param("i", $user_id);
$statement->execute();

// Get result set
$result = $statement->get_result();

// Check if tasks are found
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

    // Return tasks as JSON response
    http_response_code(200); // OK
    exit(json_encode(['status' => 'success', 'tasks' => $tasks]));
} else {
    http_response_code(200); // Not found
    exit(json_encode(['status' => 'error', 'message' => 'No tasks found']));
}

// Close prepared statement and database connection
$statement->close();
$db->close();
?>
