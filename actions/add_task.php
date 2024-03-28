<?php
include('../includes/db.php');

// Assuming you have a form submitting task data via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have form fields named 'task_name' and 'description'
    $task_name = $_POST['task_name'];
    $description = $_POST['description'];

    // Prepare and execute SQL query to insert task into database
    $query = "INSERT INTO tasks (task_name, description) VALUES (?, ?)";
    $statement = $db->prepare($query);
    $statement->bind_param("ss", $task_name, $description);
    $statement->execute();

    // Redirect user back to the todo page after adding the task
    header("Location: ../home/todo.html");
    exit();
}
?>
