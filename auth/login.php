<?php
// Start or resume session
session_start();

// Include database connection
include('../includes/db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute SQL query to retrieve user information based on username
    $query = "SELECT id, password FROM users WHERE username = ?";
    $statement = $db->prepare($query);
    $statement->bind_param("s", $username);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows == 1) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variable for user ID
            $_SESSION['user_id'] = $user['id'];

            // Set cookie containing user ID
            setcookie('user_id', $user['id'], time() + (86400 * 30), '/'); // Cookie valid for 30 days

            // Redirect user to todo page
            header("Location: ../home/todo.html");
            exit(); // Ensure script stops executing after redirection
        } else {
            // Incorrect password
            $error_message = "Incorrect username or password.";
        }
    } else {
        // User not found
        $error_message = "User not found.";
    }
}

// If we reach here, it means login failed or the page was loaded without form submission
// Output login form or error message
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php
    if (isset($error_message)) {
        echo '<p style="color: red;">' . $error_message . '</p>';
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Login">
        </div>
    </form>
</body>
</html>