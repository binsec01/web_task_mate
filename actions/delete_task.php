<?php
include('../includes/db.php');

// Assuming you receive the task ID to delete via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST['task_id'];

    // Prepare and execute SQL query to delete task from the database
    $query = "DELETE FROM tasks WHERE id = ?";
    $statement = $db->prepare($query);
    $statement->bind_param("i", $task_id);
    $statement->execute();

    // Redirect user back to the todo page after deleting the task
    header("Location: ../home/todo.html");
    exit();
}
?>
