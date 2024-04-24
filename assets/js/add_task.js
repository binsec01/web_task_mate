        document.addEventListener("DOMContentLoaded", function() {
            var form = document.getElementById("addTask");

            form.addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent default form submission

                var taskName = document.getElementById("taskName").value;
                var description = document.getElementById("description").value;

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../actions/add_task.php");
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        var response = JSON.parse(xhr.responseText);
                        console.log(response);
                        if (response.status === "success") {
                            alert("Task added successfully!");
                            window.location.href = '../home/todo.php';
                        } else {
                            alert("Error adding task. Please try again.");
                        }
                    } else {
                        alert("An error occurred while processing your request. Please try again later.");
                    }
                };

                xhr.onerror = function() {
                    alert("Network error occurred. Please try again.");
                };

                var formData = "task_name=" + encodeURIComponent(taskName) + "&description=" + encodeURIComponent(description);
                xhr.send(formData);
            });
        });