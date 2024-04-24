<?php
// Start or resume session
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $_COOKIE['user_id'];
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : $_COOKIE['user_name'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Task Mate</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
      <symbol id="bootstrap" viewBox="0 0 118 94">
        <path
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"
        ></path>
      </symbol>
    </svg>
    <div class="container">
      <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom"
      >
        <a href="../" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img class="bi me-2" src="https://img.logoipsum.com/225.svg" alt="TASK-MATE" width="40" height="32">
        <span class="fs-4">Task Mate</span>
        </a>

        <div class="col-md-3 text-end">
        <p class="text-muted">Logged in as: <?php echo $user_name; ?></p>        
          <a class="btn btn-primary me-2" href="../profile.php" role="button">Profile</a>
          <a class="btn btn-warning" href="logout.php" role="button">Logout</a>
        </div>
      </header>
    </div>

    <div class="container">
      <form id="addTask">
      <label for="input" class="form-label">Task Name: </label>
      <input type="text" id="taskName" name="taskName" class="form-control" aria-describedby="task"/>
      <label for="input" class="form-label mt-1">Task Description: </label>
      <input type="text" id="description" name="description" class="form-control" aria-describedby="task"/>
      
      <button type="submit" class="btn btn-primary me-2 md-auto mt-3">Add to list</button>
      </form>
    </div>
    <div class="container pt-10 mt-5">
        <ol class="list-group list-group-numbered ">
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold">Task Name</div>
                Content for list item
              </div>
              <button type="button" class="btn btn-primary mx-2">Update</button>
              <button type="button" class="btn btn-danger">Remove</button>
            </li>
            </ol>
    </div>
    
<script src="../assets/js/add_task.js"></script>
<script src="../assets/js/actions.js"></script>
  </body>
</html>
