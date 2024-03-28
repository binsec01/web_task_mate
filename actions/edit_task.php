<?php
include('../includes/db.php');

// Assuming you receive task ID and updated task data via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST['task_id'];
    $updated_task_name = $_POST['updated_task_name'];
    $updated_description = $_POST['updated_description'];

    // Prepare and execute SQL query to update task in the database
    $query = "UPDATE tasks SET task_name = ?, description = ? WHERE id = ?";
    $statement = $db->prepare($query);
    $statement->bind_param("ssi", $updated_task_name, $updated_description, $task_id);
    $statement->execute();

    // Redirect user back to the todo page after editing the task
    header("Location: ../home/todo.html");
    exit();
}
?>
