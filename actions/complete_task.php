<?php
include('../includes/db.php');

// Assuming you receive the task ID to mark as complete via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST['task_id'];

    // Prepare and execute SQL query to update task status as complete
    $query = "UPDATE tasks SET completed = 1 WHERE id = ?";
    $statement = $db->prepare($query);
    $statement->bind_param("i", $task_id);
    $statement->execute();

    // Redirect user back to the todo page after completing the task
    header("Location: ../home/todo.html");
    exit();
}
?>
