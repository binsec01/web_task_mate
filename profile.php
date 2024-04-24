<?php

session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

$user_email = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : $_COOKIE['user_name'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa; /* Optional: Set a background color */
        }

        .users {
            
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container">
      <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom"
      >
        <a href="../" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img class="bi me-2" src="https://img.logoipsum.com/225.svg" alt="TASK-MATE" width="40" height="32">
        <span class="fs-4">Task Mate</span>
        </a>

        <div class="col-md-3 text-end">
        <!-- <p class="text-muted">Logged in as: <?php echo $user_name; ?></p> -->
          <button type="button" class="btn btn-primary me-2">Profile</button>
          <a class="btn btn-warning" href="logout.php" role="button">Logout</a>
        </div>
      </header>
    </div>
    <div class="container users text-center">

        <div class="mb-4">
            <i class="fas fa-user fa-5x"></i> <!-- Use Font Awesome user icon -->
        </div>

        <h2 class="mb-4">User Profile</h2>

        <?php
        
        $username = substr($user_email, 0, strpos($user_email, '@'));
        $birthdate = "1990-01-01";
        ?>

        <div class="mb-3">
            <label for="username" class="form-label"><strong>Username:</strong></label>
            <input type="text" class="form-control" id="username" value="<?php echo $username; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label"><strong>Email:</strong></label>
            <input type="email" class="form-control" id="email" value="<?php echo $user_email; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="birthdate" class="form-label"><strong>Birthdate:</strong></label>
            <input type="text" class="form-control" id="birthdate" value="<?php echo $birthdate; ?>" readonly>
        </div>

        <a href="home/todo.php" class="btn btn-primary">Back to Home</a>
    </div>

    <footer class="container d-flex justify-content-center align-items-center mt-5 py-3">
        <a href="/" class="me-2 text-muted text-decoration-none">
            <img class="bi me-2" src="https://img.logoipsum.com/225.svg" alt="TASK-MATE" width="40" height="32">
        </a>
        <span class="text-muted">© 2022 Task - Mate, Inc</span>
    </footer>

    <!-- Include Bootstrap JS (optional, for Bootstrap features like modals) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
