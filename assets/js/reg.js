document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("registerForm");
    var username = document.getElementById("username");
    var password = document.getElementById("password");

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "auth/register.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                var response = JSON.parse(xhr.responseText);
                console.log(response);
                if (response.status === "success") {
                    console.log("Registered successfully!");
                    window.location.href = "login.html";
                } else {
                    errorMessage.textContent = "Registration failed. Please try again.";
                    errorMessage.classList.remove("d-none");
                    
                }
            } else {
                errorMessage.textContent = "An error occurred while processing your request. Please try again later.";
                errorMessage.classList.remove("d-none");
            }
        };

        var formData = "username=" + encodeURIComponent(username.value) + "&password=" + encodeURIComponent(password.value);
        xhr.send(formData);
    });
});
