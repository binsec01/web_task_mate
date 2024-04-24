<?php


session_start();


include('../includes/db.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $query = "SELECT id,username, password FROM users WHERE username = ?";
    $statement = $db->prepare($query);
    $statement->bind_param("s", $username);
    $statement->execute();
    $result = $statement->get_result();


    if ($result->num_rows == 1) {
        
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            
            $response = array('message' => "success");
        } else {            
            $response = array('message' => "failure"); 
        }
    } else {
        
        $response = array('message' => "User not found.");
    }
}
echo json_encode($response);
?>