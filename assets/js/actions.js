document.addEventListener("DOMContentLoaded", function() {
    var taskList = document.querySelector(".list-group");

    // Function to fetch and display tasks
    function fetchAndDisplayTasks() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../actions/fetch_tasks.php");
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === "success") {
                    displayTasks(response.tasks);
                } else {
                    console.log("Message: " + response.message);
                }
            } else {
                console.log("Message: " + response.message);
            }
        };

        xhr.onerror = function() {
            alert("Network error occurred. Please try again.");
        };

        xhr.send();
    }

    // Function to display tasks
    function displayTasks(tasks) {
        taskList.innerHTML = ""; // Clear previous content

        tasks.forEach(function(task) {
            var listItem = createTaskListItem(task);
            taskList.appendChild(listItem);
        });
    }

    // Function to create task list item
    function createTaskListItem(task) {
        var listItem = document.createElement("li");
        listItem.id = "task_" + task.id;
        listItem.className = "list-group-item d-flex justify-content-between align-items-start";

        var taskContent = `
            <div class="ms-2 me-auto">
                <div class="fw-bold" id="taskName_${task.id}" onclick="editTask(${task.id}, 'task_name', '${task.task_name}')">${task.task_name}</div>
                <div id="description_${task.id}" onclick="editTask(${task.id}, 'description', '${task.description}')">${task.description}</div>
            </div>
        `;

        listItem.innerHTML = taskContent;

        // Create "Update", "Remove", and "Mark Complete" buttons
        var updateButton = createButton("Update", "btn-primary", function() {
            editTask(task.id, task.task_name, task.description);
        });

        var removeButton = createButton("Remove", "btn-danger", function() {
            if (confirm("Are you sure you want to remove this task?")) {
                removeTask(task.id);
            }
        });

        var completeButton = createButton("Mark Complete", "btn-success", function() {
            markTaskComplete(task.id);
        });

        listItem.appendChild(updateButton);
        listItem.appendChild(removeButton);
        listItem.appendChild(completeButton);

        // Apply completed status if task is already completed
        if (task.completed === 1) {
            markTaskAsCompleted(listItem);
        }

        return listItem;
    }

    // Function to create button element
    function createButton(text, className, clickHandler) {
        var button = document.createElement("button");
        button.type = "button";
        button.className = "btn " + className + " mx-2";
        button.textContent = text;
        button.addEventListener("click", clickHandler);
        return button;
    }

    // Function to mark a task as complete
    function markTaskComplete(taskId) {
        var formData = `task_id=${encodeURIComponent(taskId)}`;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../actions/mark_complete.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === "success") {
                    var taskListItem = document.getElementById("task_" + taskId);
                    if (taskListItem) {
                        markTaskAsCompleted(taskListItem);
                    }
                } else {
                    alert("Failed to mark task as complete. Please try again.");
                }
            } else {
                alert("An error occurred while processing your request. Please try again later.");
            }
        };

        xhr.onerror = function() {
            alert("Network error occurred. Please try again.");
        };

        xhr.send(formData);
    }

    // Function to visually mark a task as completed
    function markTaskAsCompleted(taskListItem) {
        var taskNameElement = taskListItem.querySelector(".fw-bold");
        var descriptionElement = taskListItem.querySelector("#description_" + taskListItem.id.split("_")[1]);

        taskNameElement.innerHTML = `<del>${taskNameElement.textContent}</del>`;
        descriptionElement.innerHTML = `<del>${descriptionElement.textContent}</del>`;
    }
    // editable function to
    function editTask(taskId, field, currentValue) {
        var newValue = prompt(`Enter new ${field}:`, currentValue);
        if (newValue === null) return; 

        var formData = `taskId=${encodeURIComponent(taskId)}&task_name=${field}&description=${encodeURIComponent(newValue)}`;
        sendUpdateRequest(formData, field, taskId);
    }

    
    function sendUpdateRequest(formData, field, taskId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", `../actions/update_task.php`);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                var response = JSON.parse(xhr.responseText);
                console.log(response);
                if (response.status === "success") {
                    // alert(`Task ${field} updated successfully!`);
                    window.location.href = '../home/todo.php';
                } else {
                    alert(`Failed to update task ${field}. Please try again.`);
                }
            } else {
                alert("An error occurred while processing your request. Please try again later.");
            }
        };

        xhr.onerror = function() {
            alert("Network error occurred. Please try again.");
        };

        xhr.send(formData);
    }
    // Function to remove a task
    function removeTask(taskId) {
        var formData = `task_id=${encodeURIComponent(taskId)}`;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../actions/remove_task.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === "success") {
                    var taskListItem = document.getElementById("task_" + taskId);
                    if (taskListItem) {
                        taskListItem.remove();
                        // alert("Task removed successfully!");
                    }
                } else {
                    alert("Failed to remove task. Please try again.");
                }
            } else {
                alert("An error occurred while processing your request. Please try again later.");
            }
        };

        xhr.onerror = function() {
            alert("Network error occurred. Please try again.");
        };

        xhr.send(formData);
    }

    // Initial fetch and display of tasks
    fetchAndDisplayTasks();
});
