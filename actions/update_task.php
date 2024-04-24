<?php
include('../includes/db.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST['taskId'];
    $updated_task_name = $_POST['task_name'];
    $updated_description = $_POST['description'];

    
    $query = "UPDATE tasks SET task_name = ?, description = ? WHERE id = ?";
    $statement = $db->prepare($query);
    $statement->bind_param("ssi", $updated_task_name, $updated_description, $task_id);
    $statement->execute();

    
    echo json_encode(array('status' => 'success'));
    exit();
} else {
    
    echo json_encode(array('status' => 'error'));
    exit();
}
?>
