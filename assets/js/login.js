document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("loginForm");
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    var errorMessage = document.getElementById("errorMessage");

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "auth/login.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                var response = JSON.parse(xhr.responseText);
                if (response.message === "success") {
                    console.log("Login successfully!");
                    window.location.href = "home/todo.php";
                } else if (response.message === "failure") {
                    errorMessage.textContent = "Incorrect username or password.";
                    errorMessage.classList.remove("d-none");
                } else {
                    errorMessage.textContent = response.message;
                    errorMessage.classList.remove("d-none");
                }
            } else {
                errorMessage.textContent = "Server Error";
                errorMessage.classList.remove("d-none");
            }
        };

        var formData = "username=" + encodeURIComponent(username.value) + "&password=" + encodeURIComponent(password.value);
        xhr.send(formData);
    });
});
